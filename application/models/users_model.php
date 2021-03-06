<?php

class Users_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	function validate($email, $password)
	{

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_BASE . "/user/login");
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_POST, true);
		
		$data = array(
			'email' => $email,
		    'password' => $password
		);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		$content = curl_exec($ch);

		curl_close($ch);
		return json_decode( $content );
		
	}

	function validateExisting($email, $password)
	{

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_BASE . "/user/loginexisting"); //giftj_user_loginExisting
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_POST, true);
		
		$data = array(
			'email' => $email,
		    'password' => $password
		);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		$content = curl_exec($ch); 

		curl_close($ch);

		return json_decode( $content );
		
	}

    /**
    * Serialize the session data stored in the database, 
    * store it in a new array and return it to the controller 
    * @return array
    */
	function get_db_session_data()
	{
		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); /* array to store the user data we fetch */
		foreach ($query->result() as $row)
		{
		    $udata = unserialize($row->user_data);
		    /* put data in array using username as key */
		    $user['user_name'] = $udata['user_name'];
		    $user['id']  = $udata['user_id'];
		    $user['is_logged_in'] = $udata['is_logged_in']; 
		}
		return $user;
	}

    /**
    * register user from frontend
    * @return boolean - check the insert
    */	
    function create_member($insertdata)
    {
    	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_BASE . "/user/register");
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
        else
        {
        	return json_decode( $response );
        }
    }

	/**
    * Update user's data into the database
    * @return boolean - check the insert
    */	
	function update_member($updatedata,$id)
	{
// echo API_BASE . "/user/". $id."/update";exit;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_BASE . "/user/". $id."/update");

		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') )); 
// var_dump($updatedata);exit();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($updatedata));

        $response = curl_exec($ch);
        // var_dump($response);exit;
        if(!$response) {
            return false;
        }
	      
	}//update_member

	/*update status of user */
	function update_status($status,$id)
	{
        /*$this->db->set('status',$status);
        $this->db->where('id',$id);
        $this->db->update('users'); */
		$ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, API_BASE . "/user/". $id."/status");
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Authorization: Basic ' . $this->session->userdata('auth') )); 
		if($status['status']==2)
		{
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		}else
		{
			 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		}
       
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($status));

        $response = curl_exec($ch);
        if(!$response) {
            return false;
        }

        return $response;
	}

	/**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */
    public function getuserdatabyid($id)
    {
       /*$sql = "SELECT * FROM users where id=".$id;
       $query = $this->db->query($sql);

	   return $query->result_array();*/
	   	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_BASE . "/user/".$id);
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
	public function get_alluserdata()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_BASE . "/users");
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') )); 

		$content = curl_exec( $ch );
		$response = json_decode( $content );

		return ( $response );
	}
	/********************************
	 *
	 *change password functinality
	 *
	 *********************************/
	public function change_password($data,$id)
	{
       		/*$this->db->set('password', $new_pass);
       		$this->db->where('id', $id);
			$this->db->update('users'); */
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, API_BASE ."/user/".$id."/changepassword");
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') )); 


        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));

        $response = curl_exec($ch);
       
       if($response) {
            return json_decode($response);
        }else
        {
        	return false;
        }

	}

	/***************************
	*
	* forgot password functionality
	*
	******************************/
	public function forgot_password($email)
	{

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, API_BASE ."/user/forgotpassword");
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') )); 


        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($email));

        $response = curl_exec($ch);
        if($response) {
            return json_decode($response);
        }else
        {
        	return false;
        }
	}
	/***
	*check current password in db
	*
	*/
	public function get_current_password($id)
	{
			$this->db->select('password');
       		$this->db->where('id', $id);
      $query = $this->db->get('users'); 
       		if($query->num_rows()==1)
       		{
       			return $query->row();
       		}
	}
	/* search ajax */
		public function get_searchdata()
	{
		$term = strip_tags(substr($_POST['searchit'],0, 100));

		// Attack Prevention
		$sql = ("select * from users where id !=".$this->session->userdata('user_id')." and (first_name like '{$term}%' or last_name like '{$term}%' or email like '{$term}%')"); 			
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	/* Get Status */
		public function get_userstatus($id)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, API_BASE ."/user/".$id."/status");
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic ' . $this->session->userdata('auth') )); 


        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        $response = curl_exec($ch);
        if($response) {
            return json_decode($response);
        }else
        {
        	return false;
        }
	}
}

