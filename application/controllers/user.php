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
    if( $this->session->userdata('remember_me') )
    {
      redirect('admin/home');
    }
    if($this->session->userdata('is_logged_in')){
      redirect('admin/home');
        }else{
          $this->load->view('admin/login'); 
        }
  }

    /**
    * encript the password 
    * @return mixed
    */  
    function __encrip_password($password) {
        return md5($password);
    } 

    /**
    * check the username and the password with the database
    * @return void
    */
  function validate_credentials()
  { 

    $email = $this->input->post('email');
    $password = $this->input->post('password');

    $remember_me = $this->input->post('remember_me');

    $result = $this->Users_model->validate($email, $password);

    
    
    if( isset( $result->message_code ) && $result->message_code == 153 && $result->role==3 )
    {
      $user_id = $result->id;
      $token = $result->token;
            $role = $result->role;

      $auth = base64_encode( $user_id . ':' . $token );


      //$this->session->set_userdata('user', $user); // a cookie has been created

        if($remember_me == 'remember-me')
        {
          $this->session->set_userdata( array( 'auth' => $auth,'user_id'=>$user_id, 'is_logged_in' => true,'role'=>$role, 'remember_me' => true ) );
          // $cookie = array(
          //  'name'   => 'remember_me',
          //  'value'  => sha1($password),
          //  'expire' => time()+86500,
          //  'domain' => '.localhost',
          //  'path'   => '/',
          //  'prefix' => 'gj_',
          // );

        //et_cookie( $cookie );
            //$this->load->helper('cookie');
            //$cookie = $this->input->cookie('ci_session'); // we get the cookie

            //$this->input->set_cookie('ci_session', $cookie, '35580000'); // and add one year to it's expiration
        }
        else
        {
          $this->session->set_userdata( array( 'auth' => $auth,'user_id'=>$user_id, 'is_logged_in' => true, 'role'=>$role,'remember_me' => false ) );
        }

      redirect('admin/home');
    } else if(isset( $result->message_code ) && $result->message_code == 105) // incorrect username or password
    {   
      $data['message_error'] = TRUE;
      $this->load->view('admin/login', $data);
    }
    else{
      $data['invalid_user'] = TRUE;
      $this->load->view('admin/login', $data);
    }
  } 

    /**
    * Create new user and store it in the database
    * @return void
    */  
  function add()
  {
    $data['title'] = 'Add User';
    
    // field name, error message, validation rules
    $this->form_validation->set_rules('first_name', 'Name', 'trim|required');
    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
    $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

    //display userdata from user table
    $data['userdata'] = $this->Users_model->get_alluserdata(); 
    
        if(isset($_POST['submit'])) 
        {        
                //set preferences
        $config['upload_path'] = './uploads/profile_pics/';
        $config['allowed_types'] = "gif|jpg|png|jpeg";

        $this->load->library('upload', $config);

        $image_name='';
        if($this->upload->do_upload('profile_picture'))
        {
            $upload_data = $this->upload->data();
            $image_name = $upload_data['file_name'];
        }
        else
        {
            $data['upload_error'] = array('error' => $this->upload->display_errors());
        }
    
    if($this->form_validation->run() == TRUE)
    {
      
      $new_member_insert_data = array(
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'email' => $this->input->post('email'),     
        'password' => md5($this->input->post('password')),
                                'location' => $this->input->post('location'),
                                'status' => $this->input->post('status'),
                                'created_on'=>date('Y-m-d H:i:s'),
                                'profile_picture' => $image_name
      );

      $this->Users_model->create_member($new_member_insert_data); 
      redirect('user/add');
    }
        }
        //load the view
      $data['main_content'] = 'admin/users/add_user';
      $this->load->view('includes/template', $data); 
    
  }

  /**
    * Update existing user and store it in the database
    * @return void
    */  
    public function update()
    {  
    // echo "Hello";exit; 
      $data['title'] = 'Edit User';

      $edit_id = $this->uri->segment(3);
      // var_dump($edit_id);exit; 
      $data['userdata'] = $this->Users_model->getuserdatabyid($edit_id); 
// var_dump($data);exit;
      $this->load->library('form_validation');
    
    // field name, error message, validation rules
    $this->form_validation->set_rules('first_name', 'Name', 'trim|required');
    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
    //$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
    $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

  if(isset($_POST['submit'])) 
    {        
                //set preferences
        $config['upload_path'] = './api/uploads/profile_pics/';
        $config['allowed_types'] = "gif|jpg|png|jpeg";
        $config['max_size']    = '10240000';

        $this->load->library('upload', $config);

        if($this->upload->do_upload('profile_picture'))
        {
            $upload_data = $this->upload->data();
           
        }
        else
        {
            $data['upload_error'] = array('error' => $this->upload->display_errors());
        }
      if($this->form_validation->run() == FALSE)
    {
      //load the view
      $data['main_content'] = 'admin/users/edit_user';
      $this->load->view('includes/template', $data); 
    }else
    {
                        if($_FILES['profile_picture']['name']=='')
                         {
                         $image_name = $this->input->post('hid_image');
                         }  else
                         {
                             $image_name = API_BASE . '/uploads/profile_pics/' . $upload_data['file_name'];

                         }
      $update_data = array('id'=>$edit_id,
                  'first_name' => $this->input->post('first_name'),
                  'last_name'=>$this->input->post('last_name'),
                    'email'=>$this->input->post('email'),
                    'password' =>'',
                 'source'=>$data['userdata']->source,
                  'gender'=>$data['userdata']->gender,
                 'created_on'=>$this->input->post('created_on'),
                              'location'=>$this->input->post('location'),
                                 'status' => $this->input->post('status'),
                                 'last_modified_on'=>  date('Y-m-d H:i:s'),
                 'profile_picture' => $image_name);        
// var_dump($update_data);
// var_dump($edit_id);exit;
      $this->Users_model->update_member($update_data,$edit_id); 
      $this->session->set_flashdata('success_msg','User updated successfully');
      redirect('admin/home');
      
    }
    }
    $data['main_content'] = 'admin/users/edit_user';
  $this->load->view('includes/template', $data);
    }

  public function add_userdata()
  {   
    echo "<tr>";
    echo "<td>".$_POST['first_name']."</td>";
    echo "<td>".$_POST['last_name']."</td>";
    echo "<td>".$_POST['email']."</td>";
    echo "<td>".$_POST['status']."</td>";
    //echo "<td>".$_POST['regdate']."</td>";
    echo "</tr>";
    $insertdata = array($this->input->post('first_name'),$this->input->post('last_name'),$this->input->post('email'));        

      $this->Users_model->create_member($insertdata); 
      $this->session->set_flashdata('success_msg','User added successfully');
      
  }


  /*
  *
  * change user status when clicked on active/inactive link
  *
  */
  public function change_status()
  {  
    $user_id =  $this->uri->segment(3);
    $current_status = $this->uri->segment(4);

    if($current_status==2)
    {
      $status = array('status'=>1);
      $this->Users_model->update_status($status,$user_id);
      redirect('admin');
    }
    if($current_status==1)
      {
      $status = array('status'=>2);
      $this->Users_model->update_status($status,$user_id);
      redirect('admin');
    }
  }

  /**
  *
  */
  public function search()
  {
    //$userdata = $this->Users_model->get_searchdata(); 
        $data['userdata']  = $this->Users_model->get_alluserdata(); 
    echo  json_encode($data['userdata']);
    //$data['main_content'] = 'admin/users/list_user'; 

    /*$string = '';

    foreach($userdata as $key=>$value)
    {
      $string .= "<tr><td>".$value['first_name']."</td>";
      $string .= "<td>".$value['last_name']."</td>";
      $string .= "<td>".$value['email']."</td>";
      $string .= "<td>";
      if( $value['status']=='2') {
      $string .="<a href='".site_url('user/change_status')."/".$value['id']."/".$value['status']."' onclick='change_status();'>";
         $string.="<span style='color:#4b156d;'>Active</span></a>";
      } else
      {
        $string .="<a href='".site_url('user/change_status')."/".$value['id']."/".$value['status']."' onclick='change_status();'>";
         $string.="<span style='color:#FF0000;'>Inactive</span></a>"; 
      }
      $string .= "</td>";
      $string .= "<td>".$value['created_on']."</td>";
      $string .= "</tr>";
      $string .= "<script type='text/javascript'>";
      $string .="function change_status()
            {
                 var r = confirm('Are you sure you want to change status ?');
            if (r == true) {
                return true;
            } else {
             
              window.history.back();

            }
            }";
      $string .= "</script>";


    }

    if($string!='')
    {
      echo $string;
    }else
    {
      echo "<td colspan='5'><div class='alert alert-info'>No Records Found</div></td>";
    }
    */  
    
  }

  /**
    * Change password functionality.
    * @return void
    */
    public function change_password()
{
       $user_id = $this->session->userdata('user_id');//session user id
       
        //$this->form_validation->set_rules('current_password','Current Password','required|trim|xss_clean|callback_check_current_password');
        $this->form_validation->set_rules('current_password','Current Password','required|trim|xss_clean');

        $this->form_validation->set_rules('new_password','New Password','required|trim');
        $this->form_validation->set_rules('confirm_password','Confirm Password','required|trim|matches[new_password]');
 
        if ($this->form_validation->run() == FALSE)
     
        {
          
          $this->load->view('admin/change_password');
     
        }else
        {   
          $new_password = array('password' => $this->input->post('current_password'),
                      'new_password'=> $this->input->post('new_password'));
          $result = $this->Users_model->change_password($new_password,$user_id);

      if(isset( $result->message_code ) && $result->message_code == 138)
      {
        $data['invalid_password'] = TRUE;
        $this->load->view('admin/change_password', $data);
      }
        if(isset( $result->message_code ) && $result->message_code == 185)
        {   
          $this->session->set_flashdata('success_msg','Password changed successfully');
          redirect('admin/home');
        }
    } 
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
          
          $this->load->view('admin/forgotpassword_form');
     
        }else
        { 
          $data = array('email'=>$this->input->post('email'));
              $result=$this->Users_model->forgot_password($data);
             if(isset( $result->message_code ) && $result->message_code = 151)
             { 
              $this->session->set_flashdata('success_msg','Password successfully sent on your email.');
              redirect('admin/login');
             }
             
            }
        }
        $this->load->view('admin/forgotpassword_form');
    }
    /**
    * callback function to check current password in db.   Deprecated
    * @return void
    */
   /* public function check_current_password()
    {
      $logged_in_userid = $this->session->userdata('user_id');
      $posted_password = md5($this->input->post('current_password'));
      
      $current_db_password = $this->Users_model->get_current_password($logged_in_userid);

      if($current_db_password->password==$posted_password)
      {
        return TRUE;
      }else
      { 
        $this->form_validation->set_message('check_current_password','Wrong current password!');

        return FALSE;
      }

      
    }*/
  /**
    * Destroy the session, and logout the user.
    * @return void
    */    
  function logout()
  {
    $this->session->sess_destroy();
    redirect('admin/login');
  }

}