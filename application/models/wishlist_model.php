<?php
//echo "Hello";exit;
class Wishlist_model extends CI_Model {


	/*get wishlist shared by user*/
	public function product_wishlist($user_id)
	{
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, API_BASE ."/wishlist/user/".$user_id);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') ));

		$content = curl_exec( $ch );

		$response = json_decode( $content );

		return ( $response );
	}

	/*get products under the wishlist sharedby user */
	public function getproductsunderwishlist($wishlist_id)
	{
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_BASE ."/wishlist/".$wishlist_id);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') ));

		$content = curl_exec( $ch );

		$response = json_decode( $content );

		return ( $response );
	}
	/**********************
	* to get shred wishlists of logged in user
	*
	******************************/
	public function get_shared_wishlist($user_id)
	{
		//echo "Hello";exit;
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, API_BASE ."/wishlist/sharedlist");
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') ));

		$content = curl_exec( $ch );

		$response = json_decode( $content );

		return ( $response );
	}

 
}

