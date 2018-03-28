<?php

class Wishlist extends CI_Controller {
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('wishlist_model');
        $this->load->model('gift_model');
        $this->load->model('message_model');

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
		if($this->session->userdata('is_logged_in')){
			redirect('admin/home');
        }else{
        	$this->load->view('admin/login');	
        }
    }

    /* user wishlist
    *
    */
    public function user_wishlist()
    {   
         $data['wishlists'] = (object) array('message_code' => '');

        $data['title'] = 'Product Wishlist';

        
        $user_id =  $this->uri->segment(3);
        $data['userdata'] = $this->Users_model->getuserdatabyid($user_id);

        $data['wishlists'] = $this->wishlist_model->product_wishlist($user_id);

        $data['giftsent_to_userid'] = $this->gift_model->gift_given($user_id);
        $data['sent_messages'] = $this->message_model->message_sent($user_id);
       
        /*foreach($data['sent_messages'] as $key=>$value)
        {
           $message_details =$this->message_model->get_message_details($value->gift_message_id); 
        }*/

          //$this->message_model->get_message_details($message_details->gift_message_id);
        //$data['message_detail'] = $message_details;
        //getproductsunderwishlist
        //$data['products_wishlist'] = $this->wishlist_model->getproductsunderwishlist();
        //load the view
        $data['main_content'] = 'admin/wishlist/list_wishlist';
        $this->load->view('includes/template', $data);  
    }

    function edit_user_form()
    {   
       
        $user_id =  $this->input->post('id');
        $data['userdata'] = $this->Users_model->getuserdatabyid($user_id);

        $this->load->view('admin/users/edit_user_form',$data);
    }


	

}