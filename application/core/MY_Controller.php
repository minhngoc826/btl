<?php

class MY_Controller extends CI_Controller
{
    // bien gui du lieu sang ben view
    public $data = array();

    function __construct()
    {
        // ke thua tu CI_Controller
        parent::__construct();
        
        
        
        $controller = $this->uri->segment(1);
        switch ($controller) {
            case 'admin':
                {
                    // xu ly cac du lieu khi truy cap vao trang admin
                    $this->load->helper('admin');
                    $this->_check_login();
                    break;
                }
            default:
                {
                    //xu ly du lieu o trang ngoai
                    
                    //lay danh sach danh muc file
                    $this->load->model('category_model');
                    $input = array();
                    $input['where'] = array('parent_id' => 0);
                    $category_list = $this->category_model->get_list($input);
                    foreach ($category_list as $row)
                    {
                        $input['where'] = array('parent_id' => $row->id);
                        $subs = $this->category_model->get_list($input);
                        $row->subs = $subs;
                    }
                    $this->data['category_list'] = $category_list;
                    
                    //lay danh sach slide
                    $this->load->model('slide_model');
                    $slide_list = $this->slide_model->get_list();
                    $this->data['slide_list'] = $slide_list;
                 
                    // load mode
                    $this->load->model('modes_model');
                    
                    // load part, ages, roles
                    $this->load->model('parts_model');
                    $list_part = $this->parts_model->get_list(array());
                    $this->data['list_part'] = $list_part;
                    
                    $this->load->model('roles_model');
                    $list_role = $this->roles_model->get_list(array());
                    $this->data['list_role'] = $list_role;
                    
                    $this->load->model('ages_model');
                    $list_age = $this->ages_model->get_list(array());
                    $this->data['list_age'] = $list_age;
                    
                    //kiem tra xem thanh vien da dang nhap hay chua
                    $user_id_login = $this->session->userdata('user_id_login');
                    $this->data['user_id_login'] = $user_id_login;
                    //neu da dang nhap thi lay thong tin cua thanh vien
                    if($user_id_login)
                    {
                        $this->load->model('users_model');
                        $user_info = $this->users_model->get_info($user_id_login);
                        $this->data['user_info'] = $user_info;  
                    }
                }
        }
    }

    /*
     * Kiem tra trang thai dang nhap cua admin
     */
    private function _check_login()
    {
        $controller = $this->uri->rsegment('1');
        $controller = strtolower($controller);
        
        $login = $this->session->userdata('login');
        // neu ma chua dang nhap,ma truy cap 1 controller khac login
        if (! $login && $controller != 'login') {
            redirect(admin_url('login'));
        }
        // neu ma admin da dang nhap thi khong cho phep vao trang login nua.
        if ($login && $controller == 'login') {
            redirect(admin_url('home'));
        }
    }
}