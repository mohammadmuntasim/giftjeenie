<?php

class Admin_wishlist extends CI_Controller {
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
// var_dump($data['userdata']);exit;
        $data['wishlists'] = $this->wishlist_model->product_wishlist($user_id);

        //$data['giftsent_to_userid'] = $this->gift_model->gift_given($user_id);
        $data['sent_messages'] = $this->message_model->message_sent($user_id);
        if( !isset( $data['sent_messages']->message_code ) || $data['sent_messages']->message_code != 121 )
        {
            foreach($data['sent_messages'] as $key=>$value)
            {
                $data['message_details'] = $this->message_model->get_message_details($value->gift_id);
            }
        }

        $data['user_info_giftsent'] = $this->gift_model->gift_given($user_id);
        
        $data['user_info_giftreceived'] = $this->gift_model->gift_received($user_id);

        $data['sent_messages'] = array();

        $data['received_messages'] = array();

        foreach( $data['user_info_giftsent'] as $index => $gift )
        {
            if( isset( $gift->gift_info->gift_message_id ) )
            {
                if( !in_array( $gift, $data['sent_messages'] ) )
                    array_push( $data['sent_messages'], $gift );
            }
            if( isset( $gift->gift_info->gift_thankyou_id ) )
            {
                if( !in_array( $gift, $data['received_messages'] ) )
                    array_push( $data['received_messages'], $gift );
            }
        }

        foreach( $data['user_info_giftreceived'] as $index => $gift )
        {
            if( isset( $gift->gift_info->gift_thankyou_id ) )
            {
                if( !in_array( $gift, $data['sent_messages'] ) )
                    array_push( $data['sent_messages'], $gift );
            }
            if( isset( $gift->gift_info->gift_message_id ) )
            {
                if( !in_array( $gift, $data['received_messages'] ) )
                    array_push( $data['received_messages'], $gift );
            }
        }
	// var_dump($data);exit;	
        $data['main_content'] = 'admin/wishlist/list_wishlist';
        
        $this->load->view('includes/template', $data);  
    }

    function edit_user_form()
    {   
       
        $user_id =  $this->input->post('id');
        $data['userdata'] = $this->Users_model->getuserdatabyid($user_id);

        $this->load->view('admin/users/edit_user_form',$data);
    }

function delete_message()
{
    $message_id = $this->uri->segment(3);
    $user_id = $this->uri->segment(4);
   $this->message_model->delete_message($message_id);
    //$this->session->set_flashdata('success_msg','message deleted successfully.');
    //redirect('admin_wishlist/user_wishlist/'.$user_id);
echo "sucess";
return true;
}
	

}