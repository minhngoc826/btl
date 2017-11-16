<?php
class Users extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('parts_model');
        $list_part = $this->parts_model->get_list(array());
        $this->data['list_part'] = $list_part;
        
        $this->load->model('roles_model');
        $list_role = $this->roles_model->get_list(array());
        $this->data['list_role'] = $list_role;
    }
    
    /*
     * Lay danh sach admin
     */
    function index()
    {
        $input = array();
        $list = $this->users_model->get_list($input);
        $this->data['list'] = $list;
    
        $total = $this->users_model->get_total();
        $this->data['total'] = $total;
    
        //lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
    
        $this->data['temp'] = 'admin/users/index';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Kiểm tra username đã tồn tại chưa
     */
    function check_username()
    {
        $username = $this->input->post('username');
        $where = array('username' => $username);
        //kiêm tra xem username đã tồn tại chưa
        if($this->users_model->check_exists($where))
        {
            //trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__, 'Tài khoản đã tồn tại');
            return false;
        }
        return true;
    }
    
    /*
     * Thêm mới quản trị viên
     */
    function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
    
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');
            $this->form_validation->set_rules('username', 'Tài khoản đăng nhập', 'required|callback_check_username');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
            $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
            
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $name     = $this->input->post('name');
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $partid     = $this->input->post('partname');
                $roleid = $this->input->post('rolename');
    
                $data = array(
                    'username' => $username,
                    'password' => $password,
                    'name'     => $name,
                    'partid'     => $partid,
                    'roleid' => $roleid,
                );
                if($this->users_model->create($data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                    // them vao bang admin
                    if ($roleid == 1 || $roleid == 2) {
                        $this->load->model('admin_model');
                        if (! $this->admin_model->check_exists($username)) {
                            $data1 = array(
                                'username' => $username,
                                'password' => $password,
                                'name'     => $name,
                                'roleid' => $roleid,
                            );
                            if($this->admin_model->create($data1)) {
                                $this->session->set_flashdata('message_admin', 'Thêm mới admin thành công');
                            }
                        }
                    }
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách quản trị viên
                redirect(admin_url('users'));
            }
        }
    
        $this->data['temp'] = 'admin/users/add';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Ham chinh sua thong tin quan tri vien
     */
    function edit()
    {
        //lay id cua quan tri vien can chinh sua
        $id = $this->uri->rsegment('3');
        $id = intval($id);
    
        $this->load->library('form_validation');
        $this->load->helper('form');
    
        //lay thong cua quan trị viên
        $info  = $this->users_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại thành viên');
            redirect(admin_url('users'));
        }
        $this->data['info'] = $info;
    
        if($this->input->post())
        {
            //them vao csdl
            $partid     = $this->input->post('partname');
            $roleid = $this->input->post('rolename');
             
            $data = array(
                'partid'     => $partid,
                'roleid' => $roleid,
            );
            //neu ma thay doi mat khau thi moi gan du lieu
            if($this->users_model->update($id, $data))
            {
                //tạo ra nội dung thông báo
                $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
            }else{
                $this->session->set_flashdata('message', 'Không cập nhật được');
            }
            //chuyen tới trang danh sách quản trị viên
            redirect(admin_url('users'));
        }
    
        $this->data['temp'] = 'admin/users/edit';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Hàm xóa dữ liệu
     */
    function delete()
    {
        $id = $this->uri->rsegment('3');
        $id = intval($id);
        //lay thong tin cua quan tri vien
        $info = $this->users_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại thành viên');
            redirect(admin_url('users'));
        }
        //thuc hiện xóa
        $this->users_model->delete($id);
    
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('users'));
    }
    
    /*
     * Thuc hien dang xuat
     */
    function logout()
    {
        if($this->session->userdata('login'))
        {
            $this->session->unset_userdata('login');
        }
        redirect(admin_url('login'));
    }
}