<?php

class Dailydeals_model extends CI_Model {
	public function add_brand($insertdata)
	{   

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, API_BASE ."/deals/brands");
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') )); 


        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($insertdata));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);

        if(!$response) {
            return false;
        }

        return $response;
	}

	public function update_brand($insertdata)
	{   

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, API_BASE ."/deals/brands/" . $insertdata['brand_id']);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') )); 


        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($insertdata));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);

        if(!$response) {
            return false;
        }

        return $response;
	}

	public function get_brand($brand_id)
	{   

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, API_BASE ."/deals/brands/" . $brand_id);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') )); 


        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);

        if(!$response) {
            return false;
        }

        return $response;
	}

	public function add_items($brand_id, $ids)
	{   

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, API_BASE ."/deals/brands/" . $brand_id . "/add");
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') )); 

		curl_setopt($ch, CURLOPT_POSTFIELDS, ['product_id' => implode(',', $ids)]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);

        if(!$response) {
            return false;
        }

        return $response;
	}
}

