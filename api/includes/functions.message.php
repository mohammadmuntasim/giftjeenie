<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require  dirname( __DIR__ ) . '/classes/message.class.php';

function giftj_message_create( Request $request, Response $response )
{
	$body = $request->getParsedBody();
	$headers = $request->getHeaders();

	if( isset( $body['gift_id'] ) )
	{
		$gift_id = $body['gift_id'];
	}
	if( isset( $body['message_description'] ) )
	{
		$message_desc = $body['message_description'];
	}

	if( isset( $body['message_content'] ) )
	{
		$message_content = $body['message_content'];
		$message_type = 14;
	}
	else if(  $check = sizeof( $_FILES["message_content"]["tmp_name"] ) )
	{
		move_uploaded_file( $_FILES["message_content"]["tmp_name"], dirname( __DIR__ ) . '/uploads/' . $_FILES['message_content']['name'] );
		$message_content = 'http://' . $_SERVER['HTTP_HOST'] . '/api/uploads/' . $_FILES['message_content']['name'];
		$message_type = 15;
	}

	$meta['created_on'] = date('Y-m-d H:i:s');
	$meta['created_by'] = $headers['PHP_AUTH_USER'][0];
	$meta['last_modified_on'] = $meta['created_on'];
	$meta['last_modified_by'] = $meta['created_by'];

	$message = new Message();

	$message->setGiftId( $gift_id );
	$message->setMessageDesc( $message_desc );
	$message->setMessageType( $message_type );
	$message->setMessageContent( $message_content );
	$message->setMeta( $meta );

	$db = new Database();
	$data = $db->createMessage( $message );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_message_get( Request $request, Response $response )
{  

	$id = $request->getAttribute('id');

	$db = new Database();
	$data = $db->getMessage( $id );
	$db->disconnect();
	
	return $response->withJson( $data, 200 )->withHeader( 'ETag', md5( json_encode( $data ) ) );
}

function giftj_message_get_gift( Request $request, Response $response )
{
	$id = $request->getAttribute('gid');

	$db = new Database();
	$data = $db->getMessage( $id, true );
	$db->disconnect();

	return $response->withJson( $data, 200 )->withHeader( 'ETag', md5( json_encode( $data ) ) );
}

function giftj_message_delete( Request $request, Response $response )
{
	$id = $request->getAttribute('id');

	$db = new Database();
	$data = $db->deleteMessage( $id );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}