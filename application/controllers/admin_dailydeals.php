<?php

class Admin_dailydeals extends CI_Controller {

    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dailydeals_model');

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
        $data['title'] = 'Daily Deals';

        $data['main_content'] = 'admin/dailydeals/list';
        $this->load->view('includes/template', $data);  
    }

    // public function brand_add()
    // {
    //     $data['title'] = 'Add Brand';

    //     $data['main_content'] = 'admin/dailydeals/brand/add';
    //     $this->load->view('includes/template', $data);
    // }

    public function brand_add()
    {   
        $data['title'] = 'Add Brand';
        // field name, error message, validation rules
        $this->form_validation->set_rules('brand_name', 'Brand Name', 'trim|required');

        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

        if(isset($_POST['submit'])) 
        {

            //set preferences
            $config['upload_path'] = './api/uploads/brands/';
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
                    $image_name = API_BASE . '/uploads/brands/' . $upload_data['file_name'];
                }

                    $insertdata = array(
                        'brand_name'=>$this->input->post('brand_name'),
                        'brand_image' =>$image_name
                    );        
                
                    $res = $this->dailydeals_model->add_brand($insertdata); 
                    $this->session->set_flashdata('success_msg','Brand added successfully');
                    redirect('admin/dailydeals');           
            }
        
        }
        
        //load the view
        $data['main_content'] = 'admin/dailydeals/brand/add';
        $this->load->view('includes/template', $data); 
        
    }

    public function brand_update()
    {   
        $brand_id = $this->uri->segment(4);
        $data['title'] = 'Edit Brand';
        $data['branddata'] = json_decode($this->dailydeals_model->get_brand($brand_id))->data;
        // field name, error message, validation rules
        $this->form_validation->set_rules('brand_name', 'Brand Name', 'trim|required');

        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

        if(isset($_POST['submit'])) 
        {
            //set preferences
            $config['upload_path'] = './api/uploads/brands/';
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['max_size']    = '10240000';

            $this->load->library('upload', $config);

            if($this->upload->do_upload('image'))
            {
                $upload_data = $this->upload->data();
            }
            else
            {
                // $data['upload_error'] = array('error' => $this->upload->display_errors());
            }   


            if($this->form_validation->run() == TRUE)
            {
                if($_FILES['image']['name']=='')
                {
                    $image_name = $this->input->post('img_req');
                }  
                else
                {
                    $image_name = API_BASE . '/uploads/brands/' . $upload_data['file_name'];
                }

                    $insertdata = array(
                        'brand_id' => $brand_id,
                        'brand_name'=>$this->input->post('brand_name'),
                        'brand_image' =>$image_name
                    );       
                
                    $res = $this->dailydeals_model->update_brand($insertdata);
                    $this->session->set_flashdata('success_msg','Brand updated successfully');
                    redirect('admin/dailydeals');           
            }
        
        }
        
        //load the view
        $data['main_content'] = 'admin/dailydeals/brand/edit';
        $this->load->view('includes/template', $data); 
        
    }

    public function brand_add_item()
    {
        $brand_id = $this->uri->segment(4);
        $data['title'] = 'Add Item';
        $data['branddata'] = json_decode($this->dailydeals_model->get_brand($brand_id))->data;

        if(isset($_POST['submit'])) {
            $ids = array_keys($_POST['check']);
            $brand_id = $data['branddata']->brand_id;

            $response = $this->dailydeals_model->add_items($brand_id, $ids);
            $this->session->set_flashdata('success_msg', 'Items added to brand successfully');
            redirect('admin/dailydeals');
        }

        //load the view
        $data['main_content'] = 'admin/dailydeals/brand/add_item';
        $this->load->view('includes/template', $data);
    }
}
