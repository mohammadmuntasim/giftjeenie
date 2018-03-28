<?php

class Admin_trends extends CI_Controller {

    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('trends_model');

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
        $data['title'] = 'Trends';

        $data['main_content'] = 'admin/trends/list';
        $this->load->view('includes/template', $data);  
    }

    // public function list_add()
    // {
    //     $data['title'] = 'Add list';

    //     $data['main_content'] = 'admin/trends/list/add';
    //     $this->load->view('includes/template', $data);
    // }

    public function list_add()
    {   
        $data['title'] = 'Add list';
        $data['gradients'] = json_decode($this->trends_model->get_gradients())->data;

        // field name, error message, validation rules
        $this->form_validation->set_rules('list_name', 'List Name', 'trim|required');

        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
        

        if(isset($_POST['submit'])) 
        {
            //set preferences
            $config['upload_path'] = './api/uploads/lists/';
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
                    $image_name = API_BASE . '/uploads/lists/' . $upload_data['file_name'];
                }

                    $gradient = array_keys($this->input->post('gradient'));

                    $insertdata = array(
                        'list_name'=>$this->input->post('list_name'),
                        'list_image' =>$image_name,
                        'list_gradient_id' => current($gradient)
                    );
                
                    $res = $this->trends_model->add_list($insertdata); 

                    $this->session->set_flashdata('success_msg','list added successfully');
                    redirect('admin/trends');           
            }
        
        }
        
        //load the view
        $data['main_content'] = 'admin/trends/list/add';
        $this->load->view('includes/template', $data); 
        
    }

    public function list_update()
    {   
        // echo "string";exit;
        $list_id = $this->uri->segment(4);
        $data['title'] = 'Edit list';
        $data['listdata'] = json_decode($this->trends_model->get_list($list_id))->data;
        $data['gradients'] = json_decode($this->trends_model->get_gradients())->data;

        // field name, error message, validation rules
        $this->form_validation->set_rules('list_name', 'list Name', 'trim|required');

        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

        if(isset($_POST['submit'])) 
        {
            //set preferences
            $config['upload_path'] = './api/uploads/lists/';
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
                    $image_name = API_BASE . '/uploads/lists/' . $upload_data['file_name'];
                }

                    $gradient = array_keys($this->input->post('gradient'));

                    $insertdata = array(
                        'list_id' => $list_id,
                        'list_name'=>$this->input->post('list_name'),
                        'list_image' =>$image_name,
                        'list_gradient_id' => current($gradient)
                    );

                    $res = $this->trends_model->update_list($insertdata);
                    
                    $this->session->set_flashdata('success_msg','list updated successfully');
                    redirect('admin/trends');           
            }
        
        }
        
        //load the view
        $data['main_content'] = 'admin/trends/list/edit';
        $this->load->view('includes/template', $data); 
        
    }

    public function list_add_item()
    {
        $list_id = $this->uri->segment(4);
        $data['title'] = 'Add Item';
        $data['listdata'] = json_decode($this->trends_model->get_list($list_id))->data;

        if(isset($_POST['submit'])) {
            $ids = array_keys($_POST['check']);
            $list_id = $data['listdata']->list_id;

            $response = $this->trends_model->add_items($list_id, $ids);
            $this->session->set_flashdata('success_msg', 'Items added to list successfully');
            redirect('admin/trends');
        }

        //load the view
        $data['main_content'] = 'admin/trends/list/add_item';
        $this->load->view('includes/template', $data);
    }
}
