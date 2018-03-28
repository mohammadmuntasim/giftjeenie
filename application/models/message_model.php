<?php

class Message_model extends CI_Model 
{

	/*get gift sent by user*/
	public function message_sent($user_id)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, API_BASE ."/gift/user/".$user_id."/given");
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') )); 

		$content_wishlist = curl_exec( $ch );

		$response_wishlist = json_decode( $content_wishlist );

		return ( $response_wishlist );
		
	}
	
	
	/*get gift received by user*/
	public function message_received($user_id)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, API_BASE ."/gift/user/".$user_id."/received");
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') )); 

		$content_wishlist = curl_exec( $ch );

		$response_wishlist = json_decode( $content_wishlist );

		return ( $response_wishlist );
		
	}
	
	
	function get_message_details($gift_id)
	{
				$ch = curl_init();

				curl_setopt($ch, CURLOPT_URL, API_BASE ."/gift/".$gift_id);
				curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
				//curl_setopt($ch, CURLOPT_HEADER  ,1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				    'Authorization: Basic ' . $this->session->userdata('auth') )); 

				$content = curl_exec( $ch );

				$response = json_decode( $content );

				return ( $response );
	}
	
	
	/*delete message*/
function delete_message($message_id)
{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_BASE . "/message/".$message_id);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Authorization: Basic ' . $this->session->userdata('auth') )); 

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

		

		$response = curl_exec($ch);
		if(!$response) {
			return false;
		}

}
 
}

