<?php

class Product_model extends CI_Model {


	public function add_product($insertdata)
	{   

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, API_BASE ."/products");
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') )); 


        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($insertdata));

        $response = curl_exec($ch);
        
        if(!$response) {
            return false;
        }

        return $response;
	}

	/**
    * Update product's data into the database
    * @return boolean - check the insert
    */	
	function update_product($updatedata,$id)
	{

			/*$this->db->where('id', $id);
			$this->db->update('product', $data); */
			$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, API_BASE ."/products/".$id."/update");
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') )); 


        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($updatedata));

		$response = curl_exec($ch);
        
        if(!$response) {
            return false;
        }

        return $response;
	      
	}//update_member


	/**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */
    public function getproductdatabyid($id)
    {
       /*$sql = "SELECT * FROM product where id=".$id;
       $query = $this->db->query($sql);

	   return $query->result_array();*/
	   $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_BASE . "/products/".$id);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') )); 

		$content = curl_exec( $ch );

		$response = json_decode( $content );

		return ( $response );

    }

 	/**
    * fetch user's data from the database
    * 
    */
	public function get_allproductdata()
	{  

		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, API_BASE ."/products/all/category/0");
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') ));

		$content = curl_exec( $ch );

		$response = json_decode( $content );

		return ( $response );
	}

	/*get all product categories */
	public function get_all_productcategories()
	{
		 $sql = "SELECT * FROM product_category";
       	 $query = $this->db->query($sql);

	     return $query->result_array();
	}

	public function mark_product_as_claimed( $wishlist_id, $product_id ) {
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, API_BASE ."/wishlist/" . $wishlist_id . "/product/" . $product_id . "/claim");
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') ));

		$content = curl_exec( $ch );

		$response = json_decode( $content );

		return ( $response );
	}
	
	public function mark_product_as_granted( $wishlist_id, $product_id, $comment, $videofile ) {
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, API_BASE ."/wishlist/" . $wishlist_id . "/product/" . $product_id . "/grant");
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') ));

		$content = curl_exec( $ch );

		$response = json_decode( $content );

		return ( $response );
	}
}

