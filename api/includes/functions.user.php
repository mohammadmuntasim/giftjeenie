<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require  dirname( __DIR__ ) . '/classes/user.class.php';

// function giftj_user_register( Request $request, Response $response, $update = false ) 
// {
// 	if( $update )
// 	{
// 		$id = $request->getAttribute('id');
// 	}

// 	$body = $request->getParsedBody();

// 	if( isset( $body['first_name'] ) )
// 	{
// 		$first_name = $body['first_name'];
// 	}
// 	else
// 	{
// 		$data = array( 'error' => 'First Name not provided.' );
// 		return $response->withJson( $data, 409 );
// 	}

// 	if( isset( $body['last_name'] ) )
// 	{
// 		$last_name = $body['last_name'];
// 	}
// 	else
// 	{
// 		$data = array( 'error' => 'Last Name not provided.' );
// 		return $response->withJson( $data, 409 );
// 	}

// 	if( isset( $body['email'] ) )
// 	{
// 		$email = $body['email'];
// 	}
// 	else
// 	{
// 		$data = array( 'error' => 'Email not provided.' );
// 		return $response->withJson( $data, 409 );
// 	}

// 	if( isset( $body['password'] ) )
// 	{
// 		$password = $body['password'];
// 	}
// 	else
// 	{
// 		$data = array( 'error' => 'Password not provided.' );
// 		return $response->withJson( $data, 409 );
// 	}

// 	if( isset( $body['source'] ) )
// 	{
// 		$source = $body['source'];
// 	}

// 	if( isset( $body['social_id'] ) )
// 	{
// 		$social_id = $body['social_id'];
// 	}
// 	else
// 	{
// 		$social_id = 0;
// 	}
// 	if( isset( $body['profile_picture'] ) )
// 	{
// 		$profile_picture = $body['profile_picture'];
// 	}
// 	else if( $check = getimagesize( $_FILES["profile_picture"]["tmp_name"] ) )
// 	{		
// 		move_uploaded_file( $_FILES["profile_picture"]["tmp_name"], dirname( __DIR__ ) . '/uploads/profile_pics/' . $_FILES['profile_picture'] ['name']  );
// 		$profile_picture = 'http://' . $_SERVER['HTTP_HOST'] . '/api/uploads/profile_pics/' . $_FILES['profile_picture']['name'];
// 	}

// 	if( isset( $body['date_of_birth'] ) )
// 	{
// 		$date_of_birth = $body['date_of_birth'];
// 	}
// 	else
// 	{
// 		$date_of_birth = date('Y-m-d H:i:s');
// 	}

// 	if( isset( $body['phone'] ) )
// 	{
// 		$phone = $body['phone'];
// 	}
// 	else
// 	{
// 		$phone = 0;
// 	}

// 	if(  isset( $body['status'] ) )
// 	{
// 		$status = $body['status'];
// 	}
// 	else
// 	{
// 		$status = 2;
// 	}

// 	if(  isset( $body['location'] ) )
// 	{
// 		$location = $body['location'];
// 	}
// 	else
// 	{
// 		$location = '';
// 	}

// 	$user = new User( $first_name, $last_name, $email, $source, $social_id, $profile_picture );
// 	$user->setID( $id );
// 	$user->setDob( $date_of_birth );
// 	$user->setPhone( $phone );
// 	$user->setStatus( $status );
// 	$user->setLocation( $location );

// 	$db = new Database();

// 	$data = $db->createUser( $user, $password, $update );

// 	$db->disconnect();

// 	if( isset( $data['id'] ) )
// 	{
// 		return $response->withJson( $data, 200 );
// 	}
// 	else
// 	{
// 		return $response->withJson( $data, 200 );
// 	}
// }

function giftj_user_register( Request $request, Response $response, $update = false ) 
{
	if( $update )
	{
		$id = $request->getAttribute('id');
	}

	$body = $request->getParsedBody();

	if( isset( $body['first_name'] ) )
	{
		$first_name = $body['first_name'];
	}
	else
	{
		$data = array( 'error' => 'First Name not provided.' );
		return $response->withJson( $data, 409 );
	}

	if( isset( $body['last_name'] ) )
	{
		$last_name = $body['last_name'];
	}
	else
	{
		$data = array( 'error' => 'Last Name not provided.' );
		return $response->withJson( $data, 409 );
	}

	if( isset( $body['gender'] ) )
	{
		$gender = $body['gender'];
	}
	else
	{
		$data = array( 'error' => 'Gender not provided.' );
		return $response->withJson( $data, 409 );
	}

	if( isset( $body['email'] ) )
	{
		$email = $body['email'];
	}
	else
	{
		$data = array( 'error' => 'Email not provided.' );
		return $response->withJson( $data, 409 );
	}

	if( isset( $body['password'] ) )
	{
		$password = $body['password'];
	}
	else
	{
		$data = array( 'error' => 'Password not provided.' );
		return $response->withJson( $data, 409 );
	}

	if( isset( $body['source'] ) )
	{
		$source = $body['source'];
	}

	if( isset( $body['social_id'] ) )
	{
		$social_id = $body['social_id'];
	}
	else
	{
		$social_id = 0;
	}
	if( isset( $body['profile_picture'] ) )
	{
		$profile_picture = $body['profile_picture'];
	}
	else if( $check = getimagesize( $_FILES["profile_picture"]["tmp_name"] ) )
	{		
		move_uploaded_file( $_FILES["profile_picture"]["tmp_name"], dirname( __DIR__ ) . '/uploads/profile_pics/' . $_FILES['profile_picture'] ['name']  );
		$profile_picture = 'http://' . $_SERVER['HTTP_HOST'] . '/api/uploads/profile_pics/' . $_FILES['profile_picture']['name'];
	}

	if( isset( $body['date_of_birth'] ) )
	{
		$date_of_birth = $body['date_of_birth'];
	}
	else
	{
		$date_of_birth = date('Y-m-d H:i:s');
	}

	if( isset( $body['phone'] ) )
	{
		$phone = $body['phone'];
	}
	else
	{
		$phone = 0;
	}

	if(  isset( $body['status'] ) )
	{
		$status = $body['status'];
	}
	else
	{
		$status = 2;
	}

	if(  isset( $body['location'] ) )
	{
		$location = $body['location'];
	}
	else
	{
		$location = '';
	}

	$user = new User( $first_name, $last_name, $gender, $email, $source, $social_id, $profile_picture );
	$user->setID( $id );
	$user->setDob( $date_of_birth );
	$user->setPhone( $phone );
	$user->setStatus( $status );
	$user->setLocation( $location );

	$db = new Database();

	$data = $db->createUser( $user, $password, $update );

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


function giftj_user_login( Request $request, Response $response ) 
{
	$body = $request->getParsedBody();

	$email = $body['email'];
	$password = $body['password'];

	$db = new Database();
	$data = $db->verifyUser( $email, $password );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_loginExisting( Request $request, Response $response ) 
{
	$body = $request->getParsedBody();

	$email = $body['email'];
	$password = $body['password'];

	$db = new Database();
	$data = $db->verifyUserExisting( $email, $password );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}



function giftj_user_activate( Request $request, Response $response )
{
	$user_id = $request->getAttribute('id');
	$key = $request->getAttribute('key');

	$db = new Database();
	$data = $db->activateUser( $user_id, $key );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_forgotpassword( Request $request, Response $response )
{
	$body = $request->getParsedBody();
	$email = $body['email'];

	$db = new Database();
	$data = $db->resetPassword( $email );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_changepassword( Request $request, Response $response )
{
	$body = $request->getParsedBody();
	$password = $body['password'];
	$newPassword = $body['new_password'];
	$user_id = $request->getAttribute('id');

	$db = new Database();
	$data = $db->changePassword( $user_id, $password, $newPassword );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_logout( Request $request, Response $response )
{
	$body = $request->getParsedBody();
	$user_id = $body['user_id'];

	$db = new Database();
	$data = $db->logout( $user_id );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_info( Request $request, Response $response )
{
	$user_id = $request->getAttribute( 'id' );

	$db = new Database();
	$data = $db->getUser( $user_id );
	$db->disconnect();

	return $response->withJson( $data )->withHeader( 'Etag', md5( json_encode( $data ) ) );
}

function giftj_users_info( Request $request, Response $response )
{
	$db = new Database();
	$data = $db->getUsers();
	$db->disconnect();

	return $response->withJson( $data )->withHeader( 'Etag', md5( json_encode( $data ) ) );
}

function giftj_users_info_datatable( Request $request, Response $response )
{

    $db = new Database();
    $data = ['data' => $db->getUsersDatatable()];
    $db->disconnect();

    return $response->withJson( $data )->withHeader( 'Etag', md5( json_encode( $data ) ) );
}

function giftj_user_update( Request $request, Response $response )
{
	return giftj_user_register( $request, $response, true );
}

function giftj_user_delete( Request $request, Response $response )
{
	$user_id = $request->getAttribute('id');

	$db = new Database();
	$data = $db->deleteUser( $user_id );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_add_to_grant( Request $request, Response $response )
{
	$user_id = $request->getAttribute('id');
	$product_id = $request->getAttribute('pid');

	$db = new Database();
	$data = $db->toggleGrantList( $user_id, $product_id, true );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_remove_from_grant( Request $request, Response $response )
{
	$user_id = $request->getAttribute('id');
	$product_id = $request->getAttribute('pid');

	$db = new Database();
	$data = $db->toggleGrantList( $user_id, $product_id, false );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_grantlist( Request $request, Response $response )
{
	$user_id = $request->getAttribute('id');

	$db = new Database();
	$data = $db->getGrantList( $user_id );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_feedback( Request $request, Response $response )
{
	$user_id = $request->getAttribute('id');

	$body = $request->getParsedBody();
	$email = $body['email'];
	$message = $body['message'];

	$db = new Database();
	$data = $db->postFeedback( $user_id, $email, $message);
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

// ------------------------ modified on 13 Feb
// feedback list
function giftj_user_getfeedbacks( Request $request, Response $response )
{
	$headers = $request->getHeaders();
	$user_id = $headers['PHP_AUTH_USER'][0];

	$db = new Database();
	$data = $db->getFeedbacks( $user_id );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

// single feedback details
function giftj_user_getfeedback( Request $request, Response $response )
{
	$headers = $request->getHeaders();
	$user_id = $headers['PHP_AUTH_USER'][0];

	$feedback_id = $request->getAttribute('fid');

	$db = new Database();
	$data = $db->getFeedback( $user_id, $feedback_id );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}
// ------------------------ modified on 13 Feb

function giftj_user_getnotifications( Request $request, Response $response )
{
	$headers = $request->getHeaders();
	$user_id = $headers['PHP_AUTH_USER'][0];

	$db = new Database();
	$data = $db->getNotifications( $user_id );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}


function giftj_user_getnotificationscount( Request $request, Response $response )
{
	$headers = $request->getHeaders();
	$user_id = $headers['PHP_AUTH_USER'][0];

	$db = new Database();
	$data = $db->getNotificationsCount( $user_id );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}


function giftj_user_notification_markread( Request $request, Response $response )
{
	$headers = $request->getHeaders();
	$user_id = $headers['PHP_AUTH_USER'][0];

	$notification_id = $request->getAttribute('nid');

	$db = new Database();
	$data = $db->markNotificationAsRead( $user_id, $notification_id );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_notification_clear( Request $request, Response $response )
{
	$headers = $request->getHeaders();
	$user_id = $headers['PHP_AUTH_USER'][0];

	$notification_id = $request->getAttribute('nid');

	$db = new Database();
	$data = $db->clearNotification( $user_id, $notification_id );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_status_active( Request $request, Response $response )
{
	$user_id = $request->getAttribute('id');

	$db = new Database();
	$data = $db->toggleUserStatus( $user_id, true );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_status_inactive( Request $request, Response $response )
{
	$user_id = $request->getAttribute('id');

	$db = new Database();
	$data = $db->toggleUserStatus( $user_id, false );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_status_get( Request $request, Response $response )
{
	$user_id = $request->getAttribute('id');

	$db = new Database();
	$data = $db->getUserStatus( $user_id );
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_birthday_get( Request $request, Response $response )
{

	// $monthyear = $request->getAttribute('monthyear');

	// $monthyear = substr($monthyear, 0,2) . substr($monthyear, 2);
	$db = new Database();
	$data = $db->birthday();
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_address_add( Request $request, Response $response )
{
	$user_id = $request->getAttribute('id');
	$body = $request->getParsedBody();

	$address = [
		'address' => $body['address'],
		'apt_suite' => $body['apt_suite'],
		'zip_code' => $body['zip_code'],
		'city' => $body['city'],
		'state' => $body['state'],
		'country' => $body['country'],
	];

	$db = new Database();
	$data = $db->addUserAddress($user_id, $address);
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_categories_add( Request $request, Response $response )
{
	$user_id = $request->getAttribute('id');
	$body = $request->getParsedBody();

	$categories = explode(',', $body['categories']);

	$db = new Database();
	$data = $db->addUserCategories($user_id, $categories);
	$db->disconnect();

	return $response->withJson( $data, 200 );
}

function giftj_user_getfaqs( Request $request, Response $response )
{
	
    $db = new Database();
    $data = $db->getFaqs();
    //print_r($data);
   $db->disconnect();
    return $response->withJson($data, 200);

}

function giftj_user_search( Request $request, Response $response )
{

	$body = $request->getParsedBody();
    $headers = $request->getHeaders();
    
    $user_id = $body['user_id'];

    $searchname = $body['searchname'];
// var_dump($user_id);
// var_dump($searchname);exit;
    $db = new Database();

    $data = $db->listProductWishlist($user_id, $searchname, $headers['PHP_AUTH_USER'][0]);

    return $response->withJson($data, 200);

}