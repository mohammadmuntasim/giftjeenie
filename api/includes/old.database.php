<?php

/**
 * Simple class to connect to the database.
 *
 *
 * @author Ajitem Sahasrabuddhe <asahasrabuddhe@torinit.com>
 * @package GiftJeenie
 * @subpackage Database
 * @since 1.0
 */

require dirname( __DIR__ ) . "/config.php";

class Database 
{
	private $connect;
	private $error_message;

	public function __construct() 
	{

		$this->error_message = '';

		$this->connect = new mysqli(HOST, USER, PASSWORD, DATABASE);

		if ($this->connect->connect_errno) 
		{
			$error_message = array("error" => "Failed to connect to MySQL: (" . $this->connect->connect_errno . ") " . $this->connect->connect_error);
		}
	}

	public function disconnect()
	{
		$this->connect->close();
		$this->connect = NULL;
	}

	public function createActivationToken( $user_id )
	{
		$activation = md5(uniqid(rand(), true));

		$stmt = $this->connect->prepare("INSERT INTO user_activation (user_id, token) VALUES (?, ?)");

		$stmt->bind_param( 'is', $user_id, $activation );
		$stmt->execute();

		$stmt->close();
	}

	public function generateToken( $user_id )
	{
		$api_key = hash('sha256', (time() . $user_id . md5(uniqid(rand(), true)) . rand()));
		$created_on = date('Y-m-d H:i:s');

		$stmt = $this->connect->prepare("DELETE FROM user_keys WHERE user_id = ?");
		$stmt->bind_param( 'i', $user_id );
		$stmt->execute();
		$stmt = NULL;

		$stmt = $this->connect->prepare("INSERT INTO user_keys (user_id, token, created_on) VALUES (?, ?, ?)");

		$stmt->bind_param( 'iss', $user_id, $api_key, $created_on );
		$stmt->execute();

		echo $stmt->error;

		$stmt->close();

		return $api_key;
	}

	public function verifyToken( $user_id, $token )
	{

		$stmt = $this->connect->prepare("SELECT * FROM user_keys WHERE user_id = ?");

		$stmt->bind_param( 'i', $user_id );
		$stmt->execute();
		$stmt->bind_result( $t_id, $u_id, $tk, $created_on );
		$stmt->fetch();

		if( $tk == $token )
		{
			if( 1 ) // expiry check
			{
				return true;
			}
		}
		
		return false;
	}

	public function random_password( $length = 8 )
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    	$password = substr( str_shuffle( $chars ), 0, $length );
    	return $password;
	}

	public function createUser( $user, $password )
	{
		if( $this->error_message != '' )
		{
			return $error_message;
		}

		$stmt = $this->connect->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");

		if( $stmt )
		{
			$first_name = $user->getFirstName();
			$last_name = $user->getLastName();
			$email = $user->getEmail();
			$source = $user->getSource();
			$source_id = $user->getSourceId();
			$profile_picture = $user->getProfilePicture();
			$status = $user->getStatus();
			$role = $user->getRole();
			$location = $user->getLocation();
			$created_on = date('Y-m-d H:i:s');
			$last_login_date = $created_on;
			$last_modified_on = $created_on;
			$last_logout = $created_on;

			$stmt->bind_param( 's', $email );
			$stmt->execute();
			$stmt->store_result();

			if($stmt->num_rows == 1)
			{
				$stmt->close();
				return array( 'message_code' => 104 );
			}

			$password = sha1( $email . ':' . $password );
			$password = password_hash($password, PASSWORD_BCRYPT);

			if( $insert_stmt = $this->connect->prepare( "INSERT INTO users ( first_name, last_name, email, password, source, source_id, status, role, profile_picture, location, created_on, last_login_date, last_modified_on, last_logout ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )" ) )
			{
				$insert_stmt->bind_param( 'ssssssiissssss', $first_name, $last_name, $email, $password, $source, $source_id, $status, $role, $profile_picture, $location, $created_on, $last_login_date, $last_modified_on, $last_logout );

				if( !$insert_stmt->execute() )
				{
					$insert_stmt->close();
					return array('message_code' => 103 );
				}

				$insert_stmt->close();
				$user_id = $this->connect->insert_id;

				//$this->createActivationToken( $user_id );

				return array('message_code' => 154, 'id' => $user_id );
			}
			else
			{
				return array('message_code' => 103 );
			}
		}
	}

	public function verifyUser( $email, $password )
	{

		$stmt = $this->connect->prepare("SELECT id, password, status FROM users WHERE email = ? LIMIT 1");

		$stmt->bind_param( 's', $email );
		$stmt->execute();
		$stmt->bind_result( $user_id, $db_password, $status );
		$stmt->fetch();
		$stmt->close();
		$stmt = NULL;

		echo sha1( $email . ':' . $password ) . '<br />' . $db_password;

		if( password_verify( sha1( $email . ':' . $password ), $db_password) )
		{
			if( 1 )//$status != 1 && $status == 2 )
			{
				$token = $this->generateToken( $user_id );
				$last_login_date = date('Y-m-d H:i:s');
				
				$stmt = $this->connect->prepare("UPDATE users SET last_login_date = ? WHERE id = ?");
				$stmt->bind_param( 'si', $last_login_date, $user_id );
				$stmt->execute();
				$stmt->close();
				$stmt = NULL;

				return array( 'message_code' => 153, 'id' => $user_id, 'token' => $token );
			}
			else
			{
				return array( 'message_code' => 100 );
			}
		}
		else
		{
			return array( 'message_code' => 105 );
		}
	}

	public function activateUser( $user_id, $key )
	{
		$stmt = $this->connect->prepare("SELECT token FROM user_activation WHERE user_id = ?");

		$stmt->bind_param( 'i', $user_id );
		$stmt->execute();
		$stmt->bind_result( $token );
		$stmt->fetch();
		$stmt->close();
		$stmt = NULL;

		if( $token == $key )
		{
			$stmt = $this->connect->prepare("UPDATE users SET status = 2 WHERE id = ?");

			$stmt->bind_param( 'i', $user_id );
			$stmt->execute();
			$stmt->close();

			return array( 'message_code' => 152 );
		}
		else
		{
			return array( 'message_code' => 102 );
		}
	}

	public function resetPassword( $email )
	{
		$stmt = $this->connect->prepare("SELECT id FROM users WHERE email = ?");

		$stmt->bind_param( 's', $email );
		$stmt->execute();
		$stmt->bind_result( $user_id );
		$stmt->fetch();
		$stmt->close();
		$stmt = NULL;

		if( isset( $user_id ) && !empty( $user_id ) )
		{
			$newpass = $this->random_password(8);

			$password = sha1( $email . ':' . $newpass );
			$password = password_hash($password, PASSWORD_BCRYPT);

			$stmt = $this->connect->prepare("UPDATE users SET password = ? WHERE id = ?");

			$stmt->bind_param( 'si', $password, $user_id );
			$stmt->execute();
			$stmt->close();
			$stmt = NULL;

			$to = $email;
			$subject = "Your GiftJeenie Password has been Reset";
         
			$message = "Your new password is " . $newpass;
         
			$header = "From:asahasrabuddhe@torinit.com \r\n";
			//$header .= "Cc:afgh@somedomain.com \r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-type: text/html\r\n";

 			$result = mail( $to, $subject, $message, $header );

			return array( "message_code" => 151, "user_id" => $user_id );
		}

		return array( "message_code" => 101 );
	}

	public function logout( $user_id )
	{
		$last_logout = date('Y-m-d H:i:s');
		
		$stmt = $this->connect->prepare("UPDATE users SET last_logout = ? WHERE id = ?");
		$stmt->bind_param( 'si', $last_login_date, $user_id );
		$stmt->execute();
		$stmt->close();
		$stmt = NULL;

		$stmt = $this->connect->prepare("DELETE FROM user_keys WHERE user_id = ?");
		$stmt->bind_param( 'i', $user_id );
		$stmt->execute();
		$stmt->close();
		$stmt = NULL;

		return array( "message_code" => 150 );
	}

	public function getUser( $user_id )
	{
		$stmt = $this->connect->prepare("SELECT * FROM users WHERE id = ?");
		$stmt->bind_param( 'i', $user_id );
		$stmt->execute();
		$stmt->bind_result( $id, $first_name, $last_name, $email, $password, $status, $role, $profile_picture, $created_on, $location, $last_login_date, $last_modified_on, $source, $source_id, $last_logout );
		$stmt->fetch();

		$user = new User( $first_name, $last_name, $email, $source, $source_id, $profile_picture );
		$user->setID( $id );
		$user->setStatus( $status );
		$user->setRole( $role );
		$user->setLocation( $location );
		$user->setCreatedOn( $created_on );
		$user->setLastLoginDate( $last_login_date );
		$user->setLastModifiedOn( $last_modified_on );
		$user->setLastLogOut( $last_logout );

		return $user;
	}

	public function deleteUser( $user_id )
	{
		$stmt = $this->connect->prepare("DELETE FROM users WHERE id = ?");
		$stmt->bind_param( 'i', $user_id );
		$stmt->execute();

		return array('message_code' => 156);

	}

	public function addProduct( $product )
	{
		if( $this->error_message != '' )
		{
			return $error_message;
		}

		$name = $product->getName();
		$url = $product->getUrl();
		$price = $product->getPrice();
		$currency = $product->getCurrency();
		$trend_rating = $product->getTrendRating();
		$category_id = $product->getCategory();
		$images = implode( ',', $product->getImages() );
		$source = $product->getSource();
		$description = $product->getDescription();
		$meta = $product->getMeta();

		if( $insert_stmt = $this->connect->prepare("INSERT INTO product ( name, url, price, currency, trend_rating, category_id, image, source, description, created_on, created_by, last_modified_on, last_modified_by ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )") )
		{
			$insert_stmt->bind_param( 'ssisiisissisi', $name, $url, $price, $currency, $trend_rating, $category_id, $images, $source, $description, $meta['created_on'], $meta['created_by'], $meta['last_modified_on'], $meta['last_modified_by']);
			if( !$insert_stmt->execute() )
			{
				$insert_stmt->close();
				return array('message_code' => '108' );
			}
			$insert_stmt->close();
			return array('message_code' => '155', 'id' => $this->connect->insert_id );
		}
		else
		{
			return array('message_code' => '108' );
		}
	}

	public function getProducts( $option )
	{
		if( $option == 'all' )
		{
			$query = "SELECT p.*, pc.name FROM product AS p JOIN product_category AS pc ON p.category_id = pc.id";
		}
		if( $option == 'social' )
		{
			$query = "SELECT p.*, pc.name FROM product AS p JOIN product_category AS pc ON p.category_id = pc.id WHERE trend_rating = -1 AND source IN (8, 9, 10)";
		}
		if( $option == 'trending' )
		{
			$query = "SELECT p.*, pc.name FROM product AS p JOIN product_category AS pc ON p.category_id = pc.id WHERE trend_rating BETWEEN 0 AND 10 AND source = 11";
		}
		$stmt = $this->connect->prepare( $query );

		$stmt->execute();
		$stmt->bind_result( $id, $list_order, $name, $url, $price, $currency, $trend_rating, $category_id, $image, $source, $description, $created_on, $created_by, $last_modified_on, $last_modified_by, $cat_name );
		
		$products = array();
		while( $stmt->fetch() )
		{
			$product = new Product();

			$product->setID( $id );
			$product->setOrder( $list_order );
			$product->setName( $name );
			$product->setURL( $url );
			$product->setPrice( $price );
			$product->setCurrency( $currency );
			$product->setTrendRating( $trend_rating );

			$category = new ProductCategory();
			$category->setID( $category_id );
			$category->setName( $cat_name );

			$product->setCategory( $category );
			$product->setImages( explode( ',', $image ) );
			$product->setSource( $source );
			$product->setDescription( $description );

			$meta = array(  'created_on' => $created_on, 
							'created_by' => $created_by,
							'last_modified_on' => $last_modified_on,
							'last_modified_by' => $last_modified_by );
			$product->setMeta( $meta );
			$products[] = $product;
		}

		return $products;
	}

	public function getProduct( $id )
	{
		$stmt = $this->connect->prepare( "SELECT p.*, pc.name FROM product AS p JOIN product_category AS pc ON p.category_id = pc.id WHERE p.id = ?" );
		$stmt->bind_param( 'i', $id );
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result( $id, $list_order, $name, $url, $price, $currency, $trend_rating, $category_id, $image, $source, $description, $created_on, $created_by, $last_modified_on, $last_modified_by, $cat_name );
		$stmt->fetch();

		if( $stmt->num_rows > 0 )
		{
			$product = new Product();

			$product->setID( $id );
			$product->setOrder( $list_order );
			$product->setName( $name );
			$product->setURL( $url );
			$product->setPrice( $price );
			$product->setCurrency( $currency );
			$product->setTrendRating( $trend_rating );
		
			$category = new ProductCategory();
			$category->setID( $category_id );
			$category->setName( $cat_name );
			
		
			$product->setCategory( $category );
			$product->setImages( explode( ',', $image ) );
			$product->setSource( $source );
			$product->setDescription( $description );
			$meta = array(  'created_on' => $created_on, 
							'created_by' => $created_by,
							'last_modified_on' => $last_modified_on,
							'last_modified_by' => $last_modified_by );
			$product->setMeta( $meta );

			return $product;
		}
		else
		{
			return array( 'message_code' => 110 );
		}
	}
}