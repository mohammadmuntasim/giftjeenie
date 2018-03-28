<?php

class User extends CI_Controller {

	/**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->library('form_validation');


    }
    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */  
    function index()
    {   
        if($this->session->userdata('is_logged_in')){
            redirect('wishlist/shared_wishlist');
        }else{ 
            
            $this->load->view('frontend/login');   
        }
    }
    /**
    * check the username and the password with the database
    * @return void
    */
    function validate_credentials()
    {   

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $result = $this->Users_model->validate($email, $password);
        $user_id = $result->id;
        
        $result2 = $this->Users_model->get_userstatus($user_id);
       

        if( isset( $result->message_code ) && $result->message_code = 153 &&  isset( $result2->status ) && $result2->status==2)
        {
            $user_id = $result->id;
            $token = $result->token;

            $auth = base64_encode( $user_id . ':' . $token );

            $this->session->set_userdata( array( 'auth' => $auth, 'is_logged_in' => true ) );

            redirect('user/login');
        }
        else if( $result2->status == 1)// inactive user
        {
            echo "hello";
            exit();
            $data['inactiveuser'] = $this->Users_model->get_userstatus($user_id);
            $this->load->view('frontend/login', $data);
        }
        else // incorrect username or password
        {
            $data['message_error'] = TRUE;
            $this->load->view('frontend/login', $data);
        }
    }   
    /**
    * Register new user and store it in the database
    * @return void
    */  
       function register()
    {
        $data['title'] = 'Register';
        
        // field name, error message, validation rules
        $this->form_validation->set_rules('first_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

        
        if(isset($_POST['submit'])) 
        {        
               
        
            if($this->form_validation->run() == TRUE)
            {
                
                $new_member_insert_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email' => $this->input->post('email'),         
                    'password' => md5($this->input->post('password')),
                    'created_on'=>date('Y-m-d H:i:s')
                );

                $this->Users_model->create_member($new_member_insert_data); 
                redirect('wishlist/logout');
            }
        }
           
            $this->load->view('frontend/register_user'); 
        
    }


    /**
    * Forgot password functionality.
    * @return void
    */
    public function forgot_password()
    {   

        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');

    if(isset($_POST['submit'])) 
        { 

        if ($this->form_validation->run() == FALSE)
            {
                
                $this->load->view('frontend/forgotpassword_form');
         
            }else
            { 
                $data = array('email'=>$this->input->post('email'));
               $this->Users_model->forgot_password($data);
			
			 if(isset( $result->message_code ) && $result->message_code = 151)
    	       { 
    	       	$this->session->set_flashdata('success_msg','Password successfully sent on your email.');
    	       	redirect('wishlist/logout');
    	       }
		
            }
        }
        $this->load->view('frontend/forgotpassword_form');
    }

	
	
     public function shared_wishlist()
    {   

    
        $this->load->view('frontend/sharedwishlist_form');

    }

      public function product_wishlist()
    {   

    
        $this->load->view('frontend/productwishlist_form');
    }

     public function product_details()
    {   

    
        $this->load->view('frontend/productdetails_form');
    }
}
