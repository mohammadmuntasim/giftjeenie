<?php

class Admin extends CI_Controller {
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }


    }
    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
	function index()
	{
        if($this->session->userdata('remember_me') && $this->session->userdata('role')==3)
        {
            redirect('admin/home');
        }
		if($this->session->userdata('is_logged_in') && $this->session->userdata('role')==3){
			redirect('admin/home');
        }else{
        	$this->load->view('admin/login');	
        }
    }

    function home()
    {
//print_r($this->session->userdata('auth'));
        if($this->session->userdata('is_logged_in') && $this->session->userdata('role')==3){
            $data['title'] = 'User List';
            // $count = $this->Users_model->get_count_alluser();

            //display userdata from user table
//            $data['userdata'] = $this->Users_model->getAllUsersForDatatable();

            $data['main_content'] = 'admin/users/list_user';
            $this->load->view('includes/template', $data);
        }else{
            $this->load->view('admin/login');   
        }
        
    }
}
