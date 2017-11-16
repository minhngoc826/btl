<?php
class Permission extends MY_Controller {
    function __construct() {
        parent::__construct();
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
        $list = $this->roles_model->get_list($input);
        $this->data['list'] = $list;

        $total = $this->roles_model->get_total();
        $this->data['total'] = $total;

        //lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp'] = 'admin/role/index';
        $this->load->view('admin/main', $this->data);
    }

    /*
     * Kiểm tra rolename đã tồn tại chưa
     */
    function check_rolename()
    {
        $rolename = $this->input->post('rolename');
        $where = array('rolename' => $rolename);
        //kiêm tra xem rolename đã tồn tại chưa
        if($this->roles_model->check_exists($where))
        {
            //trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__, 'Role đã tồn tại');
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
            $this->form_validation->set_rules('rolename', 'Rolename', 'required|callback_check_rolename');

            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $rolename = $this->input->post('rolename');

                $data = array(
                    'rolename' => $rolename,
                );
                if($this->roles_model->create($data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách quản trị viên
                redirect(admin_url('role'));
            }
        }

        $this->data['temp'] = 'admin/role/add';
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
        $info  = $this->roles_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại nhóm role');
            redirect(admin_url('role'));
        }
        $this->data['info'] = $info;

        if($this->input->post())
        {
            $this->form_validation->set_rules('rolename', 'Rolename', 'required|callback_check_rolename');

            if($this->form_validation->run())
            {
                //them vao csdl
                $name     = $this->input->post('name');
                $rolename = $this->input->post('rolename');
                 
                $data = array(
                    'name'     => $name,
                    'rolename' => $rolename,
                );
                //neu ma thay doi mat khau thi moi gan du lieu
                if($password)
                {
                    $data['password'] = md5($password);
                }

                if($this->roles_model->update($id, $data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không cập nhật được');
                }
                //chuyen tới trang danh sách quản trị viên
                redirect(admin_url('role'));
            }
        }

        $this->data['temp'] = 'admin/role/edit';
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
        $info = $this->roles_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại nhóm role');
            redirect(admin_url('role'));
        }
        //thuc hiện xóa
        $this->roles_model->delete($id);

        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('role'));
    }
}



