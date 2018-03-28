<?php

class Gift_model extends CI_Model {


	/*get gift sent by user*/
	public function gift_given($user_id)
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

		//return ( $response_wishlist );
		/*$gift_sent_wishlist = $response_wishlist;

		if(!empty($gift_sent_wishlist))
        {  
            foreach ($gift_sent_wishlist as $key => $value) 
            {
                @$wishlist_ids[] = $value->wishlist_id;
            }
            //print_r($wishlist_ids);die;
        }
		foreach($wishlist_ids as $key=>$value)
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, API_BASE ."/wishlist/".$value);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
			//curl_setopt($ch, CURLOPT_HEADER  ,1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	    	'Authorization: Basic ' . $this->session->userdata('auth') )); 

			$content_sent_id = curl_exec( $ch );

			$response_sent_ids[] = json_decode( $content_sent_id );
		}

       return $response_sent_ids;*/
       return $response_wishlist;

	}

	/***************
	*function to get goft recieved
	*
	*******************/
	public function gift_received($user_id)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, API_BASE ."/gift/user/".$user_id."/received");
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') )); 

		$content = curl_exec( $ch );

		$response = json_decode( $content );

		return $response;
	}

	/*get products under the wishlist sharedby user */
	public function getproductsunderwishlist($wishlist_id)
	{
	        $ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, API_BASE ."/wishlist/".$wishlist_id);
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
/* get gift sent by users */
	
	function getmessagebygiftid($gift_id)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, API_BASE ."/gift/".$gift_id);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') )); 

		$content = curl_exec( $ch );

		$response = json_decode( $content );

		return $response;
	}
 
}

