<?php
class Category extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('category_model');
    }
    
    function index()
    {
        $list = $this->category_model->get_list();
        $this->data['list'] = $list;
    
        //lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
    
        //load view
        $this->data['temp'] = 'admin/category/index';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Them moi du lieu
     */
    function add()
    {
        //load thư viện validate dữ liệu
        $this->load->library('form_validation');
        $this->load->helper('form');
    
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên', 'required');
    
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $name       = $this->input->post('name');
                $parent_id  = $this->input->post('parent_id');
    
                //luu du lieu can them
                $data = array(
                    'catname'      => $name,
                    'parent_id' => $parent_id
                );
                //them moi vao csdl
                if($this->category_model->create($data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách
                redirect(admin_url('category'));
            }
        }
    
        //lay danh sach danh muc cha
        $input = array();
        $input['where'] = array('parent_id' => 0);
        $list = $this->category_model->get_list($input);
        $this->data['list']  = $list;
    
        $this->data['temp'] = 'admin/category/add';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Cập nhật du lieu
     */
    function edit()
    {
        //load thư viện validate dữ liệu
        $this->load->library('form_validation');
        $this->load->helper('form');
    
        //lay id danh mục
        $id = $this->uri->rsegment(3);
        $info = $this->category_model->get_info($id);
        if(!$info)
        {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('message', 'không tồn tại danh mục này');
            redirect(admin_url('category'));
        }
        $this->data['info'] = $info;
    
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên', 'required|callback_check_catname');
    
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $name       = $this->input->post('name');
                $parent_id  = $this->input->post('parent_id');
    
                //luu du lieu can them
                $data = array(
                    'catname'      => $name,
                    'parent_id' => $parent_id
                );
                //them moi vao csdl
                if($this->category_model->update($id, $data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách
                redirect(admin_url('category'));
            }
        }
    
        //lay danh sach danh muc cha
        $input = array();
        $input['where'] = array('parent_id' => 0);
        $list = $this->category_model->get_list($input);
        $this->data['list']  = $list;
    
        $this->data['temp'] = 'admin/category/edit';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Xoa danh mục
     */
    function delete()
    {
        //lay id danh mục
        $id = $this->uri->rsegment(3);
        $this->_del($id);
    
        //tạo ra nội dung thông báo
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('category'));
    }
    
    /*
     * Xoa nhieu danh muc san pham
     */
    function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach ($ids as $id)
        {
            $this->_del($id , false);
        }
    }
    
    /*
     * Thuc hien xoa
     */
    private function _del($id, $rediect = true)
    {
        $info = $this->category_model->get_info($id);
        if(!$info)
        {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('message', 'không tồn tại danh mục này');
            if($rediect)
            {
                redirect(admin_url('category'));
            }else{
                return false;
            }
        }
    
        //kiem tra xem danh muc nay co san pham khong
        $this->load->model('files_model');
        $product = $this->files_model->get_info_rule(array('catid' => $id), 'id');
        if($product)
        {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('message', 'Danh mục '.$info->name.' có chứa sản phẩm,bạn cần xóa các sản phẩm trước khi xóa danh mục');
            if($rediect)
            {
                redirect(admin_url('category'));
            }else{
                return false;
            }
        }
    
        //xoa du lieu
        $this->category_model->delete($id);
    
    }
    
    function check_catname()
    {
        $catname = $this->input->post('name');
        $where = array('catname' => $catname);
        //kiêm tra xem rolename đã tồn tại chưa
        if($this->category_model->check_exists($where))
        {
            //trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__, 'Role đã tồn tại');
            return false;
        }
        return true;
    }
}