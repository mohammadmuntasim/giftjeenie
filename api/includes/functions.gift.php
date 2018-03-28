<?php
// echo "Hie";exit;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require  dirname( __DIR__ ) . '/classes/gift.class.php';

// function giftj_gift_give( Request $request, Response $response )
// {
// 	$body = $request->getParsedBody();
// 	$headers = $request->getHeaders();

// 	$wishlist_id = $body['wishlist_id'];
// 	$product_id = $body['product_id'];
// 	$order_details = ( isset( $body['order_details'] ) ) ? $body['order_details'] : '';
// 	$delivery_details = ( isset( $body['delivery_details'] ) ) ? $body['delivery_details'] : '';
	
// 	$meta['created_on'] = date('Y-m-d H:i:s');
// 	$meta['created_by'] = $headers['PHP_AUTH_USER'][0];
// 	$meta['last_modified_on'] = $meta['created_on'];
// 	$meta['last_modified_by'] = $meta['created_by'];

// 	$gift = new Gift();

// 	$gift->setWishlistID( $wishlist_id );
// 	$gift->setProductID( $product_id );
// 	$gift->setOrderDetails( $order_details );
// 	$gift->setDeliveryDetails( $delivery_details );
// 	$gift->setMeta( $meta );
	
// 	$db = new Database();
// 	$data = $db->giveGift( $gift );
// 	$db->disconnect();

// 	return $response->withJson( $data );
// }

function giftj_gift_give( Request $request, Response $response )
{

	$body = $request->getParsedBody();
	$headers = $request->getHeaders();

	$gift_id = $body['gift_id']; // 16feb -m
	$wishlist_id = $body['wishlist_id'];
	$product_id = $body['product_id'];
	$order_details = ( isset( $body['order_details'] ) ) ? $body['order_details'] : '';
	$delivery_details = ( isset( $body['delivery_details'] ) ) ? $body['delivery_details'] : '';
	
	$meta['created_on'] = date('Y-m-d H:i:s');
	$meta['created_by'] = $headers['PHP_AUTH_USER'][0];
	$meta['last_modified_on'] = $meta['created_on'];
	$meta['last_modified_by'] = $meta['created_by'];

	$gift = new Gift();

	$gift->setGiftID( $gift_id ); // 16feb -m
	$gift->setWishlistID( $wishlist_id );
	$gift->setProductID( $product_id );
	$gift->setOrderDetails( $order_details );
	$gift->setDeliveryDetails( $delivery_details );
	$gift->setMeta( $meta );
	
	$db = new Database();
	$data = $db->giveGift( $gift );
	$db->disconnect();

	return $response->withJson( $data );
}

function giftj_gift_given( Request $request, Response $response )
{
	// echo "Hie";exit;
	$headers = $request->getHeaders();

	if( NULL !== $request->getAttribute('id') )
	{
		$user_id = $request->getAttribute('id');
	}
	else
	{
		$headers = $request->getHeaders();
		$user_id = $headers['PHP_AUTH_USER'][0];
	}
// var_dump($user_id);exit;
	$db = new Database();
	$data = $db->getGiftsGiven( $user_id );
	$db->disconnect();

	return $response->withJson( $data )->withHeader( 'ETag', md5( json_encode( $data ) ) );
}

function giftj_gift_received( Request $request, Response $response )
{
	if( NULL !== $request->getAttribute('id') )
	{
		$user_id = $request->getAttribute('id');
	}
	else
	{
		$headers = $request->getHeaders();
		$user_id = $headers['PHP_AUTH_USER'][0];
	}

	$db = new Database();
	$data = $db->getGiftsReceived( $user_id );
	$db->disconnect();

	return $response->withJson( $data )->withHeader( 'ETag', md5( json_encode( $data ) ) );
}

function giftj_gift_get( Request $request, Response $response )
{
	$gift_id = $request->getAttribute('id');

	$db = new Database();
	$data = $db->getGiftInfo( $gift_id );
	$db->disconnect();

	return $response->withJson( $data )->withHeader( 'ETag', md5( json_encode( $data ) ) );
}

function giftj_gift_update_delivery_details( Request $request, Response $response )
{
	$gift_id = $request->getAttribute('id');

	$body = $request->getParsedBody();

	$delivery_details = $body['delivery_date'];

	$db = new Database();
	$data = $db->updateDeliveryDetails( $gift_id, $delivery_details );
	$db->disconnect();

	return $response->withJson( $data );
}

function giftj_gift_update_order_details( Request $request, Response $response )
{
	$gift_id = $request->getAttribute('id');

	$body = $request->getParsedBody();

	$order_details = $body['order_details'];

	$db = new Database();
	$data = $db->updateOrderDetails( $gift_id, $order_details );
	$db->disconnect();

	return $response->withJson( $data );
}

function giftj_gift_categories( Request $request, Response $response )
{
	$headers = $request->getHeaders();
	$user_id = $headers['PHP_AUTH_USER'][0];
	// var_dump($user_id);exit;
// echo "Inside";exit;
	// if( NULL !== $request->getAttribute('id') )
	// {
	// 	$user_id = $request->getAttribute('id');
	// }
	// else
	// {
	// 	$headers = $request->getHeaders();
	// 	$user_id = $headers['PHP_AUTH_USER'][0];
	// }

	$db = new Database();
	$data = $db->getGiftsCategoriesList( $user_id );
	$db->disconnect();

	return $response->withJson( $data )->withHeader( 'ETag', md5( json_encode( $data ) ) );
}