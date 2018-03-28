diff --git api/includes/config.php api/includes/config.php
index f1e8132..f38b7ad2 100644
--- api/includes/config.php
+++ api/includes/config.php
@@ -1,9 +1,10 @@
 <?php
-
+date_default_timezone_set('UTC');
 /**
  * These are the database login details
  */
-define("HOST", "localhost");     	// The host you want to connect to.
+define("HOST", "10.0.1.4");     	// The host you want to connect to.
 define("USER", "root");    			// The database username. 
-define("PASSWORD", "theapplabb11!");	// The database password. 
+//define("PASSWORD", "theapplabb11!");	// The database password. 
+define("PASSWORD", "Torinit@2017@Secur3");
 define("DATABASE", "giftjeenie");	// The database name.
diff --git application/controllers/admin.php application/controllers/admin.php
index 4021957..fc8c85e 100644
--- application/controllers/admin.php
+++ application/controllers/admin.php
@@ -1,64 +1,63 @@
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
         if($this->session->userdata('remember_me') && $this->session->userdata('role')==3)
         {
             $data['title'] = 'User List';
             // $count = $this->Users_model->get_count_alluser();
 
             //display userdata from user table
             $data['userdata'] = $this->Users_model->get_alluserdata(); 
 
             $data['main_content'] = 'admin/users/list_user';
             $this->load->view('includes/template', $data);
         }
         if($this->session->userdata('is_logged_in') && $this->session->userdata('role')==3){
             $data['title'] = 'User List';
             // $count = $this->Users_model->get_count_alluser();
 
             //display userdata from user table
             $data['userdata'] = $this->Users_model->get_alluserdata(); 
-
             $data['main_content'] = 'admin/users/list_user';
             $this->load->view('includes/template', $data);
         }else{
             $this->load->view('admin/login');   
         }
         
     }
 }
\ No newline at end of file
diff --git application/logs/log-2017-09-01.php application/logs/log-2017-09-01.php
index 6d5d158..38c5517 100644
--- application/logs/log-2017-09-01.php
+++ application/logs/log-2017-09-01.php
@@ -58933,1000 +58933,1084 @@ DEBUG - 2017-09-01 16:27:26 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:26 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:26 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:26 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:26 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:26 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:26 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:26 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:26 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:26 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:26 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:26 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:27 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:27 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:28 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:28 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:28 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:28 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:28 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:28 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:28 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:28 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:28 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:28 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:28 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:28 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:28 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:28 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:28 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:28 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:29 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:29 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:29 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:29 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:29 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:29 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:29 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:29 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:29 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:29 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:29 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:29 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:29 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:29 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:29 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:29 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:29 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:30 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:30 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:31 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:31 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:32 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:32 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:32 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:32 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:32 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:32 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:32 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:32 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:32 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:32 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:32 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:32 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:32 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:32 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:32 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:32 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:33 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:33 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:33 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:33 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:33 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:33 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:33 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:33 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:33 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:33 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:33 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:33 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:33 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:33 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:33 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:33 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:33 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:34 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:34 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:35 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:35 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:35 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:35 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:35 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:35 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:35 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:35 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:35 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:35 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:35 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:35 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:35 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:35 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:35 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Router Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Config Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Hooks Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Utf8 Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> UTF-8 Support Enabled
 DEBUG - 2017-09-01 16:27:35 --> URI Class Initialized
 DEBUG - 2017-09-01 16:27:35 --> Router Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Config Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Hooks Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Utf8 Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> UTF-8 Support Enabled
+DEBUG - 2017-09-01 23:58:46 --> URI Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Router Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Output Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Security Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Input Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Global POST and COOKIE data sanitized
+DEBUG - 2017-09-01 23:58:46 --> Language Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Loader Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Helper loaded: url_helper
+DEBUG - 2017-09-01 23:58:46 --> Helper loaded: form_helper
+DEBUG - 2017-09-01 23:58:46 --> Helper loaded: cookie_helper
+DEBUG - 2017-09-01 23:58:46 --> Database Driver Class Initialized
+ERROR - 2017-09-01 23:58:46 --> Severity: 8192  --> mysql_connect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead /var/www/html/system/database/drivers/mysql/mysql_driver.php 73
+DEBUG - 2017-09-01 23:58:46 --> Pagination Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Session Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Helper loaded: string_helper
+DEBUG - 2017-09-01 23:58:46 --> Session routines successfully run
+DEBUG - 2017-09-01 23:58:46 --> User Agent Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Form Validation Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Controller Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Model Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Model Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Form_validation class already loaded. Second attempt ignored.
+DEBUG - 2017-09-01 23:58:46 --> Config Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Hooks Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Utf8 Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> UTF-8 Support Enabled
+DEBUG - 2017-09-01 23:58:46 --> URI Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Router Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Output Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Security Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Input Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Global POST and COOKIE data sanitized
+DEBUG - 2017-09-01 23:58:46 --> Language Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Loader Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Helper loaded: url_helper
+DEBUG - 2017-09-01 23:58:46 --> Helper loaded: form_helper
+DEBUG - 2017-09-01 23:58:46 --> Helper loaded: cookie_helper
+DEBUG - 2017-09-01 23:58:46 --> Database Driver Class Initialized
+ERROR - 2017-09-01 23:58:46 --> Severity: 8192  --> mysql_connect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead /var/www/html/system/database/drivers/mysql/mysql_driver.php 73
+DEBUG - 2017-09-01 23:58:46 --> Pagination Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Session Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Helper loaded: string_helper
+DEBUG - 2017-09-01 23:58:46 --> Session routines successfully run
+DEBUG - 2017-09-01 23:58:46 --> User Agent Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Form Validation Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Controller Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Model Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> Model Class Initialized
+DEBUG - 2017-09-01 23:58:46 --> File loaded: application/views/includes/header.php
+DEBUG - 2017-09-01 23:58:46 --> File loaded: application/views/includes/left_menu.php
+DEBUG - 2017-09-01 23:58:46 --> File loaded: application/views/admin/users/list_user.php
+DEBUG - 2017-09-01 23:58:46 --> File loaded: application/views/includes/footer.php
+DEBUG - 2017-09-01 23:58:46 --> File loaded: application/views/includes/template.php
+DEBUG - 2017-09-01 23:58:48 --> Final output sent to browser
+DEBUG - 2017-09-01 23:58:48 --> Total execution time: 0.2862
+DEBUG - 2017-09-01 23:58:51 --> Config Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> Config Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> Hooks Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> Hooks Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> Utf8 Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> UTF-8 Support Enabled
+DEBUG - 2017-09-01 23:58:51 --> URI Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> Router Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> Config Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> Hooks Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> Utf8 Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> Config Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> Hooks Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> Utf8 Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> UTF-8 Support Enabled
+DEBUG - 2017-09-01 23:58:51 --> UTF-8 Support Enabled
+DEBUG - 2017-09-01 23:58:51 --> URI Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> URI Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> Router Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> Router Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> Utf8 Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> UTF-8 Support Enabled
+DEBUG - 2017-09-01 23:58:51 --> URI Class Initialized
+DEBUG - 2017-09-01 23:58:51 --> Router Class Initialized
diff --git application/models/users_model.php application/models/users_model.php
index f3ce9c2..26177d2 100644
--- application/models/users_model.php
+++ application/models/users_model.php
@@ -1,321 +1,320 @@
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
 		$ch = curl_init();
 		curl_setopt($ch, CURLOPT_URL, API_BASE . "/user/". $id."/update");
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
-
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
 
diff --git index.html index.html
index c942a79..7f684df 100644
--- index.html
+++ index.html
@@ -1,10 +1,10 @@
 <html>
 <head>
 	<title>403 Forbidden</title>
 </head>
 <body>
 
 <p>Directory access is forbidden.</p>
 
 </body>
-</html>
\ No newline at end of file
+</html>
