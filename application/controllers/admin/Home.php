<?php
Class Home extends MY_Controller
{   
    function __construct() {
        parent::__construct();
//         $this->load->model('admin_model');
    }
    function index()
    {
        redirect(admin_url('admin'));
//         $this->data['temp'] = 'admin/admin/index';
//         $this->load->view('admin/main', $this->data);
    }
}