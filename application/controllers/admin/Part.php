<?php
class Part extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('parts_model');
//         $list_part = $this->parts_model->get_list(array());
//         $this->data['list_part'] = $list_part;
    }
    /*
     * Lay danh sach admin
     */
    function index()
    {
        $input = array();
        $list = $this->parts_model->get_list($input);
        $this->data['list'] = $list;

        $total = $this->parts_model->get_total();
        $this->data['total'] = $total;

        //lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp'] = 'admin/part/index';
        $this->load->view('admin/main', $this->data);
    }

    /*
     * Kiểm tra partname đã tồn tại chưa
     */
    function check_partname()
    {
        $partname = $this->input->post('partname');
        $where = array('partname' => $partname);
        //kiêm tra xem partname đã tồn tại chưa
        if($this->parts_model->check_exists($where))
        {
            //trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__, 'Part đã tồn tại');
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
            $this->form_validation->set_rules('partname', 'partname', 'required|callback_check_partname');

            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $partname = $this->input->post('partname');

                $data = array(
                    'partname' => $partname,
                );
                if($this->parts_model->create($data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách quản trị viên
                redirect(admin_url('part'));
            }
        }

        $this->data['temp'] = 'admin/part/add';
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
        $info  = $this->parts_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại nhóm role');
            redirect(admin_url('part'));
        }
        $this->data['info'] = $info;

        if($this->input->post())
        {
            $this->form_validation->set_rules('partname', 'partname', 'required|callback_check_partname');

            if($this->form_validation->run())
            {
                //them vao csdl
                $partname = $this->input->post('partname');
                 
                $data = array(
                    'partname' => $partname,
                );

                if($this->parts_model->update($id, $data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không cập nhật được');
                }
                //chuyen tới trang danh sách quản trị viên
                redirect(admin_url('part'));
            }
        }

        $this->data['temp'] = 'admin/part/edit';
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
        $info = $this->parts_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại nhóm role');
            redirect(admin_url('part'));
        }
        //thuc hiện xóa
        $this->parts_model->delete($id);

        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('part'));
    }
}



