<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

function giftj_deals_brands_create( Request $request, Response $response )
{
    $body = $request->getParsedBody();
    $headers = $request->getHeaders();

	if( isset( $body['brand_name'] ) )
	{
		$name = $body['brand_name'];
	} else {
		$data = array( 'error' => 'Brand Name not provided.' );
		return $response->withJson( $data, 422 );
    }

	if (isset($_FILES["brand_image"]["tmp_name"]))
	{
        if(  $check = getimagesize( $_FILES["brand_image"]["tmp_name"] ) )
        {
            move_uploaded_file( $_FILES["brand_image"]["tmp_name"], dirname( __DIR__ ) . '/uploads/brands/' . $_FILES['brand_image']['name']  );
            $image = 'http://' . $_SERVER['HTTP_HOST'] . '/api/uploads/brands/' . $_FILES['brand_image']['name'];
        }

    } elseif (isset($body['brand_image'])) {
        $img = array();

        $image = $body['brand_image'];

	} else {
        $data = array( 'error' => 'Brand Image not provided.' );
		return $response->withJson( $data, 422 );
    }

    $img = array();

    $size = getimagesize( $image );

    $img['url'] = $image;
    $img['width'] = $size[0];
    $img['height'] = $size[1];
    
    $db = new Database();

    $data = $db->createBrand($name, $img, $headers['PHP_AUTH_USER'][0]);

    return $response->withJson( $data, 200 );
}

function giftj_deals_brand_update(Request $request, Response $response)
{
    $body = $request->getParsedBody();
    $headers = $request->getHeaders();
    $brand_id = $request->getAttribute('id');


    if (isset($body['brand_name'])) {
        $name = $body['brand_name'];
    } else {
        $data = array( 'error' => 'Brand Name not provided.' );
        return $response->withJson($data, 422);
    }

    if (isset($_FILES["brand_image"]["tmp_name"])) {
        if ($check = getimagesize($_FILES["brand_image"]["tmp_name"])) {
            move_uploaded_file($_FILES["brand_image"]["tmp_name"], dirname(__DIR__) . '/uploads/brands/' . $_FILES['brand_image']['name']);
            $image = 'http://' . $_SERVER['HTTP_HOST'] . '/api/uploads/brands/' . $_FILES['brand_image']['name'];
        }
    } elseif (isset($body['brand_image'])) {
        $img = array();

        $image = $body['brand_image'];
    } else {
        $data = array( 'error' => 'Brand Image not provided.' );
        return $response->withJson($data, 422);
    }



    $img = array();

    $size = getimagesize($image);

    $img['url'] = $image;
    $img['width'] = $size[0];
    $img['height'] = $size[1];
    
    $db = new Database();

    $data = $db->updateBrand($brand_id, $name, $img, $headers['PHP_AUTH_USER'][0]);

    return $response->withJson($data, 200);
}


function giftj_deals_get( Request $request, Response $response )
{
    $db = new Database();

    $data = $db->getDeals();

    return $response->withJson( $data, 200 );
}

function giftj_deals_brands_add_item( Request $request, Response $response )
{
    $body = $request->getParsedBody();

    $product_id = $body['product_id'];
    if(strpos($product_id, ',') !== false) {
        $product_id = explode(',', $product_id);
    }
    $brand_id = $request->getAttribute('id');

    $db = new Database();
    
    $data = $db->addProductToBrand($product_id, $brand_id);

    return $response->withJson( $data, 200 );
}

function giftj_deals_brands_get( Request $request, Response $response )
{
    $body = $request->getParsedBody();
    $draw = $body['draw'];

    $db = new Database();

    $data = $db->getBrands();
    $data['draw'] = $draw;

    return $response->withJson( $data, 200 );
}

function giftj_deals_brand_get( Request $request, Response $response )
{
    $body = $request->getParsedBody();
    $brand_id = $request->getAttribute('id');
    
    $db = new Database();

    $data = $db->getBrand($brand_id);
    $data['draw'] = $body['draw'];

    return $response->withJson( $data, 200 );
}

function giftj_deals_brands_delete( Request $request, Response $response )
{
    $brand_id = $request->getAttribute('id');
    $db = new Database();

    $data = $db->deleteBrand($brand_id);

    return $response->withJson( $data, 200 );
}