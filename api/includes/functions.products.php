<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require  dirname( __DIR__ ) . '/classes/product.class.php';
require  dirname( __DIR__ ) . '/classes/product.category.class.php';


function giftj_add_product( Request $request, Response $response, $update = false ) 
{
	
	$body = $request->getParsedBody();
	$headers = $request->getHeaders();

	$product = new Product();
	
	if( $update )
	{
		$id = $request->getAttribute('id');
	}

	if( isset( $body['name'] ) )
	{
		$name = $body['name'];
	}
	else
	{
		$data = array( 'error' => 'Product Name not provided.' );
		return $response->withJson( $data, 409 );
	}

	if( isset( $body['url'] ) )
	{
		$url = $body['url'];
	}
	else
	{
		$data = array( 'error' => 'Product URL not provided.' );
		return $response->withJson( $data, 409 );
	}

	if( isset( $body['price'] ) )
	{
		$price = $body['price'];
	}
	else
	{
		$data = array( 'error' => 'Product Price not provided.' );
		return $response->withJson( $data, 409 );
	}

	$IsImage = false;
	if (!$update )
	{
		if (isset($body['image']))
			$image = $body['image'];
		else
			$image  = 'http://' . $_SERVER['HTTP_HOST'] . '/api/uploads/product/placeholder.png';
		
		$img = array();
		
		$size = getimagesize( $image );
		$img['url'] = $image;
		$img['width'] = $size[0];
		$img['height'] = $size[1];
		$product->setImages( $img );
		$IsImage = true;
	}

	if (isset($_FILES["image"]["tmp_name"]))
	{
		if (($_FILES["image"]["name"] !="" ) || ($_FILES["image"]["name"] !="image" ))
		{
			if(  $check = getimagesize( $_FILES["image"]["tmp_name"] ) )
			{
				move_uploaded_file( $_FILES["image"]["tmp_name"], dirname( __DIR__ ) . '/uploads/product/' . $_FILES['image']['name']  );
				$image = 'http://' . $_SERVER['HTTP_HOST'] . '/api/uploads/product/' . $_FILES['image']['name'];
			}

			$img = array();
			//$image;
	
			$size = getimagesize( $image );

			$img['url'] = $image;
			$img['width'] = $size[0];
			$img['height'] = $size[1];

			$product->setImages( $img );
			$IsImage = true;

		}
		else
		{
			$img = array();

			$image = $body['image'];
	
			$size = getimagesize( $image );

			$img['url'] = $image;
			$img['width'] = $size[0];
			$img['height'] = $size[1];

			$product->setImages( $img );
			$IsImage = true;
		}
	}
	// else if ($_FILES["image"]["name"] != "image" )
	// {
	// 	$img = array();

	// 	$image = $body['image'];

	// 	$size = getimagesize( $image );

	// 	$img['url'] = $image;
	// 	$img['width'] = $size[0];
	// 	$img['height'] = $size[1];

	// 	$product->setImages( $img );
	// 	$IsImage = true;
	// }

	if( isset( $body['currency'] ) )
	{
		$currency = $body['currency'];
	}
	else
	{
		$currency = 'CAD';
	}

	if( isset( $body['category'] ) )
	{
		$category = $body['category'];
	}
	else
	{
		$category = '1';
	}

	if( isset( $body['source'] ) )
	{
		$source = $body['source'];
	}
	else
	{
		$source = '';
	}
	if( isset( $body['description'] ) )
	{
		$description = $body['description'];
	}
	else
	{
		$description = '';
	}
	if( isset( $body['trend_rating'] ) )
	{
		$trend_rating = $body['trend_rating'];
	}
	else
	{
		$trend_rating = -1;
	}

	
	$product->setName( $name );
	$product->setUrl( $url );
	$product->setPrice( $price );
	
	$product->setCurrency( $currency );
	$product->setCategory( $category );
	$product->setSource( $source );
	$product->setDescription( $description );
	$product->setTrendRating( $trend_rating );

	$meta['created_on'] = date('Y-m-d H:i:s');
	$meta['created_by'] = $headers['PHP_AUTH_USER'][0];
	$meta['last_modified_on'] = $meta['created_on'];
	$meta['last_modified_by'] = $headers['PHP_AUTH_USER'][0];

	if( $update )
	{
		$product->setID( $id );
		$meta = $product->getMeta();
		$meta['last_modified_on'] = date('Y-m-d H:i:s');
		$meta['last_modified_by'] = $headers['PHP_AUTH_USER'][0];
	}

	$product->setMeta( $meta );

	$db = new Database();

	$data = $db->addProduct( $product, $update, $IsImage );

	$db->disconnect();

	if( isset( $data['id'] ) )
	{
		return $response->withJson( $data, 200 );
	}
	else
	{
		return $response->withJson( $data, 200 );
	}
}

function giftj_get_products( Request $request, Response $response, $cat_id = NULL )
{
	$option = $request->getAttribute('option');
	$offset = $request->getAttribute('offset');
	$limit = $request->getAttribute('limit');

	if( $option == 'all' || $option == 'social' || $option == 'trending' )
	{
		$db = new Database();

		$data = $db->getProducts( $option, $cat_id, $offset, $limit );
		$db->disconnect();
		$db = NULL;

		return $response->withJson( $data )->withHeader( 'ETag', md5( json_encode( $data ) ) );
	}
	else
	{
		return $response->withJson( array( 'message_code' => 109 ) );
	}
}

function giftj_get_products_by_cat( Request $request, Response $response )
{

	$cat_id = $request->getAttribute('id');

	return giftj_get_products( $request, $response, $cat_id );

}

function giftj_get_products_datatable_by_cat( Request $request, Response $response ) {

    $cat_id = $request->getAttribute('id');

    return giftj_get_products_datatable( $request, $response, $cat_id );

}

function giftj_get_products_datatable( Request $request, Response $response, $cat_id = NULL )
{
	$without = $_GET['without'];
    $db = new Database();

    $catsById = $db->getCategoriesName();

    // DB table to use
    $table = 'product';

    // Table's primary key
    $primaryKey = 'id';

    // Array of database columns which should be read and sent back to DataTables.
    // The `db` parameter represents the column name in the database, while the `dt`
    // parameter represents the DataTables column identifier. In this case simple
    // indexes
    $columns = array(
        array('db' => 'category_id', 'dt' => 0,
            'formatter' => function($cat_id, $row) use ($catsById) {
                return $catsById[$cat_id];
            }),
        array('db' => 'image', 'dt' => 1,
            'formatter' => function ($d, $row) {
                return json_decode($d)->url;
            }),
        array('db' => 'name', 'dt' => 2),
        array('db' => 'price', 'dt' => 3),
        array('db' => 'currency', 'dt' => 4),
        array('db' => 'trend_rating', 'dt' => 5),
        array('db' => 'url', 'dt' => 6),
        array('db' => 'id', 'dt' => 7)
    );

    // SQL server connection information
    $sql_details = array(
        'user' => USER,
        'pass' => PASSWORD,
        'db' => DATABASE,
        'host' => HOST
    );    

    require( 'ssp.class.php' );

	if( null !== $without && $without != '' ) {
		return json_encode(
			SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, 'id NOT IN (' . $without .  ')' )
		);
	} else {
		return json_encode(
            SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );

	}
}

function giftj_get_products_by_admin( Request $request, Response $response )
{
	return giftj_get_products( $request, $response, $cat_id, true );
}

function giftj_get_product( Request $request, Response $response )
{
	$id = $request->getAttribute( 'id' );

	$db = new Database();
	$data = $db->getProduct( $id );
	$db->disconnect();
	$db = NULL;

	return $response->withJson( $data )->withHeader( 'ETag', md5( json_encode( $data ) ) )->withHeader('Content-type', 'application/json');
}

function giftj_product_update( Request $request, Response $response )
{
	return giftj_add_product( $request, $response, true );
}

function giftj_product_delete( Request $request, Response $response )
{
	$id = $request->getAttribute('id');

	$db = new Database();
	$data = $db->deleteProduct( $id );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_product_categories( Request $request, Response $response )
{
	$db = new Database();
	$data = $db->getCategories();
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_product_update_trend( Request $request, Response $response )
{
	$pid = $request->getAttribute('id');
	$tr = $request->getAttribute('tr');

	$db = new Database();
	$data = $db->updateTrend( $pid, $tr );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}
