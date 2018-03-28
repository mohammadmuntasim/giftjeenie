<?php

class Login extends CI_Controller {
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');

    }
    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
	function index()
	{
		/*if($this->session->userdata('is_logged_in')){ //print_r($this->session->all_userdata());die;
			redirect('product/home');
        }else{

            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $result = $this->Users_model->validate($email, $password);
            
            if( isset( $result->message_code ) && $result->message_code = 153 )
            { 
                $user_id = $result->id;
                $token = $result->token;

                $auth = base64_encode( $user_id . ':' . $token );

                $this->session->set_userdata( array( 'auth' => $auth, 'is_logged_in' => true ) );

                redirect('product/home');
            }
            else // incorrect username or password
            {
                $data['message_error'] = TRUE;
                $this->load->view('frontend/login', $data);
            }
        	//$this->load->view('frontend/login');	
        }*/
         if($this->session->userdata('is_logged_in')){
            redirect('wishlist/shared_wishlist');
        }else{
            $this->load->view('frontend/login');   
        }
    }

    function home()
    {   
            $data['title'] = 'User List';

            //display userdata from user table
            $data['userdata'] = $this->Users_model->get_alluserdata(); 

            $data['main_content'] = 'admin/users/list_user';
            $this->load->view('includes/template', $data);
    }


	

}