<?php
Class Login extends MY_controller{
    
    function index()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('login' ,'login', 'callback_check_login');
            if($this->form_validation->run())
            {
                $this->session->set_userdata('login', true);
                
                redirect(admin_url('home'));
            }
        }
        
        $this->load->view('admin/login/index');
    }
    
    /*
     * Kiem tra username va password co chinh xac khong
     */
    function check_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $this->load->model('admin_model');
        $where = array('username' => $username , 'password' => $password);
        $admin = $this->admin_model->get_info_rule($where);
        if ($admin) {
//             pre($admin);
            $this->session->set_userdata('admin_name', $admin->name);
            $this->session->set_userdata('admin_id', $admin->id);
            $roleid = $admin->roleid;
            $this->load->model('roles_model');
            $role = $this->roles_model->get_info_rule(array('id' => $roleid));
            $rolename = $role->rolename;
            $this->session->set_userdata('admin_role', $rolename);
            return true;
        }
        
//         if($this->admin_model->check_exists($where))
//         {
//             return true;
//         }
        $this->form_validation->set_message(__FUNCTION__, 'Không đăng nhập thành công');
        return false;
    }
}