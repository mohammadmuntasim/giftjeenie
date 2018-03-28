<?php

class Admin_product extends CI_Controller {

    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');


        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }

    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
        $data['title'] = 'Product List';

        //display userdata from user table
//        $data['productdata'] = $this->product_model->get_allproductdata();

        //all the posts sent by the view
        $category_id = $this->input->post('category_id');        
        
        //load the view
        $data['main_content'] = 'admin/products/list';
        $this->load->view('includes/template', $data);  

    }//index

    /**
    * Create new product and store it in the database
    * @return void
    */  
	public function add()
    {   
        $data['title'] = 'Add Product';
        // field name, error message, validation rules
        $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
        $this->form_validation->set_rules('product_category', 'Product Category', 'trim|required');
        $this->form_validation->set_rules('product_price', 'Product Pricing', 'trim|required');
        $this->form_validation->set_rules('product_url', 'Product Url', 'trim|required');
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

        if(isset($_POST['submit'])) 
        {

            //set preferences
            $config['upload_path'] = './api/uploads/product/';
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['max_size']    = '10240000';
            $this->load->library('upload', $config);

            if($this->upload->do_upload('image'))
            {
                $upload_data = $this->upload->data();
            }
            else
            {
                $data['upload_error'] = array('error' => $this->upload->display_errors());
            }   


            if($this->form_validation->run() == TRUE)
            {
                if($_FILES['image']['name']=='')
                {
                    $image_name = $this->input->post('image');
                }  
                else
                {
                    $image_name = API_BASE . '/uploads/product/' . $upload_data['file_name'];
                }

                    $insertdata = array('name'=>$this->input->post('product_name'),
                        'category'=>$this->input->post('product_category'),
                        'description'=>$this->input->post('product_desc'),
                        'price'=>$this->input->post('product_price'),
                        'trend_rating'=>$this->input->post('trend_rating'),
                        'url'=>$this->input->post('product_url'),
                        'created_on'=>date('Y-m-d H:i:s'),
                        'source' => '11',
                        'currency' => ( $this->input->post('currency') == 1 ) ? 'CAD' : '$',
                        'image' =>$image_name);        
                
                    $this->product_model->add_product($insertdata); 
                    $this->session->set_flashdata('success_msg','Product added successfully');
                    redirect('admin/product');           
            }
        
        }
        //get all product categories
        $data['categories'] = $this->product_model->get_all_productcategories();
        
        //load the view
        $data['main_content'] = 'admin/products/add';
        $this->load->view('includes/template', $data); 
        
    }

    /**
    * update existing product and store it in the database
    * @return void
    */
    public function update()
    {   
        $data['title'] = 'Update Product';

        $edit_id = $this->uri->segment(4); 
        $data['productdata'] = $this->product_model->getproductdatabyid($edit_id);

        // field name, error message, validation rules
        $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
        //$this->form_validation->set_rules('product_category', 'Product Category', 'trim|required');
        $this->form_validation->set_rules('product_price', 'Product Pricing', 'trim|required');
        $this->form_validation->set_rules('product_url', 'Product Url', 'trim|required');
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');


        if(isset($_POST['submit'])) 
        {

            //set preferences
            $config['upload_path'] = './api/uploads/product/';
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['max_size']    = '10240000';
            $this->load->library('upload', $config);

            if($this->upload->do_upload('image'))
            {
                $upload_data = $this->upload->data();
            }
            else
            {
                //$data['upload_error'] = array('error' => $this->upload->display_errors());
            }


            if($this->form_validation->run() == TRUE)
            {   
                if($_FILES['image']['name']=='')
                {
                    $image_name = $this->input->post('image');
                }  
                else
                {
                   $image_name = API_BASE . '/uploads/product/' . $upload_data['file_name'];
                }

                    $updatedata = array('name'=>$this->input->post('product_name'),
                        'category'=>$this->input->post('product_category'),
                        'description'=>$this->input->post('product_desc'),
                        'price'=>$this->input->post('product_price'),
                        'currency' => ( $this->input->post('currency') == 1 ) ? 'CAD' : '$',
                        'source' => 11,
                        'trend_rating'=>$this->input->post('trend_rating'),
                        'url'=>$this->input->post('product_url'),
                        'created_on'=>date('Y-m-d H:i:s'),
                        'image'=>$image_name);
                    
                    $res = $this->product_model->update_product($updatedata,$edit_id); 
                    $this->session->set_flashdata('success_msg','Product updated successfully');
                    redirect('admin/product');           
            }
        
        }
        //get all product categories
        $data['categories'] = $this->product_model->get_all_productcategories();
        //load the view
        $data['main_content'] = 'admin/products/edit';
        $this->load->view('includes/template', $data); 
        
    }

}
