<?php

class File extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('files_model');
        $this->load->library('pagination');
    }
    
    function index()
    { // vao trang myfile
        // lấy ID của user
        $uid = $this->session->userdata('user_id_login');
        if (!$uid) {
            redirect(base_url('file/error'));
        }
        $input = array();
        $input['where'] = array('userid' => $uid);
    
        $total_rows = $this->files_model->get_total($input);
        $this->data['total_rows'] = $total_rows;
    
        // load ra thu vien phan trang
        $config = array();
        $config['total_rows'] = $total_rows; // tong tat ca cac san pham tren website
        $config['base_url'] = base_url('file/myfile/' . $uid); // link hien thi ra danh sach san pham
        $config['per_page'] = 9; // so luong san pham hien thi tren 1 trang
        $config['uri_segment'] = 4; // phan doan hien thi ra so trang tren url
        $config['num_link'] = 3;
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        // khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);
    
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array(
            $config['per_page'],
            $segment
        );
    
        // lay danh sach file
        $list = $this->files_model->get_list($input); // list file
        $this->data['list'] = $list;
    
        // hiển thị ra view
        $this->data['temp'] = 'site/files/myfile';
        $this->load->view('site/layout', $this->data);
    }
    
    function category()
    {
        // lấy ID của danh mục
        $id = intval($this->uri->rsegment(3));
        // lay ra thông tin của thể loại
        $this->load->model('category_model');
        $category = $this->category_model->get_info($id);
        if (! $category) {
            redirect();
        }
        
        $this->data['category'] = $category;
        $input = array();
        
        // kiêm tra xem đây là danh con hay danh mục cha
        if ($category->parent_id == 0) { // dm cha
            $input_category = array();
            $input_category['where'] = array(
                'parent_id' => $id
            );
            $category_subs = $this->category_model->get_list($input_category);
            if (! empty($category_subs)) // neu danh muc hien tai co danh muc con
            {
                $category_subs_id = array();
                foreach ($category_subs as $sub) {
                    $category_subs_id[] = $sub->id;
                }
                // lay tat ca file thuoc cac danh mục con do
                $this->db->where_in('catid', $category_subs_id);
            } else { // dm con
                $input['where'] = array(
                    'catid' => $id
                );
            }
        } else { // dm con
            $input['where'] = array(
                'catid' => $id
            );
        }
        
        // lấy ra danh sách file thuộc danh mục đó
        $total_rows = $this->files_model->get_total($input);
        $this->data['total_rows'] = $total_rows;
        
        // load ra thu vien phan trang
        $config = array();
        $config['total_rows'] = $total_rows; // tong tat ca cac san pham tren website
        $config['base_url'] = base_url('file/category/' . $id); // link hien thi ra danh sach san pham
        $config['per_page'] = 9; // so luong san pham hien thi tren 1 trang
        $config['uri_segment'] = 4; // phan doan hien thi ra so trang tren url
        $config['num_link'] = 3;
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        // khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);
        
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array(
            $config['per_page'],
            $segment
        );
        
        // lay danh sach all file
        if (isset($category_subs_id)) {
            $this->db->where_in('catid', $category_subs_id);
        }
        $list = $this->files_model->get_list($input); // list file
        $this->data['list'] = $list;
        
        // hiển thị ra view
        $this->data['temp'] = 'site/files/category';
        $this->load->view('site/layout', $this->data);
    }
    
    function error() {
        $this->data['temp'] = 'site/error';
        $this->load->view('site/layout', $this->data);
    }
    
    function myfile()
    {
        // lấy ID của user
        $uid = $this->session->userdata('user_id_login');
        if (!$uid) {
            redirect(base_url('file/error'));
        }
        $input = array();
        $input['where'] = array('userid' => $uid);
        
        $total_rows = $this->files_model->get_total($input);
        $this->data['total_rows'] = $total_rows;
        
        // load ra thu vien phan trang
        $config = array();
        $config['total_rows'] = $total_rows; // tong tat ca cac san pham tren website
        $config['base_url'] = base_url('file/myfile/' . $uid); // link hien thi ra danh sach san pham
        $config['per_page'] = 9; // so luong san pham hien thi tren 1 trang
        $config['uri_segment'] = 4; // phan doan hien thi ra so trang tren url
        $config['num_link'] = 3;
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        // khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);
        
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array(
            $config['per_page'],
            $segment
        );
        
        // lay danh sach file
        $list = $this->files_model->get_list($input); // list file
        $this->data['list'] = $list;
        
        // hiển thị ra view
        $this->data['temp'] = 'site/files/myfile';
        $this->load->view('site/layout', $this->data);
    }
    
    /*
     * Xem chi tiết sản phẩm
     */
    function view()
    {
        // lay id san pham muon xem
        $id = $this->uri->rsegment(3);
        $files = $this->files_model->get_info($id);
//         if (! $files)
//             redirect();
        
//         $uid = $this-
        $this->data['files'] = $files;
        
        // lấy danh sách ảnh sản phẩm kèm theo
        $image = $files->image;
        $this->data['image'] = $image;
        
        // cap nhat lai luot xem cua san pham
        $data = array();
        $data['luotxem'] = $files->luotxem + 1;
        $this->files_model->update($files->id, $data);
        
        // lay thong tin cua danh mục san pham
        $category = $this->category_model->get_info($files->catid);
        $this->data['category'] = $category;
        
        // hiển thị ra view
        $this->data['temp'] = 'site/files/view';
        $this->load->view('site/layout', $this->data);
    }

    /*
     * Tim kiem theo ten san pham
     */
    function search()
    {
        if ($this->uri->rsegment('3') == 1) {
            // lay du lieu tu autocomplete
            $key = $this->input->get('term');
        } else {
            $key = $this->input->get('key-search');
        }
        
        $this->data['key'] = trim($key);
        $input = array();
        $input['like'] = array(
            'filename', $key
        );
        $list = $this->files_model->get_list($input);
        $this->data['list'] = $list;
        
        // phan trang
        // lấy ra danh sách file thuộc danh mục đó
        // lay tong so luong ta ca cac san pham trong websit
        $total_rows = count($list);
        $this->data['total_rows'] = $total_rows;
        
//         // load ra thu vien phan trang
//         $this->load->library('pagination');
//         $config = array();
//         $config['total_rows'] = $total_rows; // tong tat ca cac san pham tren website
//         $config['base_url'] = base_url('file/search/'); // link hien thi ra danh sach san pham
//         $config['per_page'] = 9; // so luong san pham hien thi tren 1 trang
//         $config['uri_segment'] = 4; // phan doan hien thi ra so trang tren url
//         $config['num_link'] = 3;
//         $config['next_link'] = 'Next';
//         $config['prev_link'] = 'Prev';
//         // khoi tao cac cau hinh phan trang
//         $this->pagination->initialize($config);
        
//         $segment = $this->uri->segment(4);
//         $segment = intval($segment);
//         $input['limit'] = array(
//             $config['per_page'],
//             $segment
//         );
        
        if ($this->uri->rsegment('3') == 1) {
            // xu ly autocomplete
            $result = array();
            foreach ($list as $row) {
                $item = array();
                $item['id'] = $row->id;
                $item['label'] = $row->filename;
                $item['value'] = $row->filename;
                $result[] = $item;
            }
            // du lieu tra ve duoi dang json
            die(json_encode($result));
        } else {
            
            // load view
            $this->data['temp'] = 'site/files/search';
            $this->load->view('site/layout', $this->data);
        }
    }
    
    function upload() {
        $uid = $this->session->userdata('user_id_login');
        if (!$uid) {
            redirect(base_url('file/error'));
        }
        
        $this->load->library('form_validation');
        $this->load->helper('form');
        if ($this->input->post()) {
            $this->form_validation->set_rules('filename', 'Tên file', 'required|max_length[255]');
            $this->form_validation->set_rules('cat', 'Danh mục', 'required');
            $this->form_validation->set_rules('mode', 'Mode', 'required');
//             $this->form_validation->set_rules('userfile', 'Chọn file', 'callback_check_urlfile');
    
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                $config['upload_path'] = './upload/files/';
                $config['allowed_types'] =  'pdf';
                $config['max_size'] =  8192;
                $this->load->library('upload', $config);
    
                if ( ! $this->upload->do_upload('userfile'))
                {
                    $this->data['error_upload'] = $this->upload->display_errors();
                    $this->session->set_flashdata('message', 'Upload file không thành công');
                }
                else
                {   
                    //them file vao csdl
                    $filename = $this->input->post('filename');
                    $cat = $this->input->post('cat');
                    $mode = $this->input->post('mode');
                    $url = $this->upload->data('file_name');
                    
                    $data = array(
                        'filename'    => $filename,
                        'url' => $url,
                        'image'    => 'file.png',
                        'luotxem' => 0,
                        'catid'  => $cat,
                        'userid' => $this->session->userdata('user_id_login'),
                        'modeid' => $mode
                    );
                    
                    if($this->files_model->create($data))
                        $this->session->set_flashdata('message', 'Upload file thành công');
                    else
                        $this->session->set_flashdata('message', 'Không lưu được file vào cơ sở dữ liệu');
                }
                
                redirect(base_url('file/upload'));
            }
        }

        // load view
        $this->data['temp'] = 'site/files/upload';
        $this->load->view('site/layout', $this->data);
    }
    
//     function index() {
//         $this->data['error'] = 'Upload thành công';
//         $this->data['temp'] = 'site/files/uploadfile';
//         $this->load->view('site/layout', $this->data);
//     }
    
    function dupload() {
        $this->load->helper(array('form', 'url'));
        $config['upload_path']   = './upload/files/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 100;
        $config['max_width']     = 1024;
        $config['max_height']    = 768;
        $this->load->library('upload', $config);
        	
//         if ($this->input->post()) {
            if ( ! $this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
                $this->data['error'] = $error;
                $this->data['temp'] = 'site/files/uploadfile';
                $this->load->view('site/layout', $this->data);
            }
            else {
                $data = array('upload_data' => $this->upload->data());
                $this->data['file_data'] = $data;
                $this->data['error'] = 'Upload thành công';
                $this->data['temp'] = 'site/files/upsuccess';
                $this->load->view('site/layout', $this->data);
            }
//             redirect(base_url('file/dupload'));
//         }
        
        // load view
//         $this->data['temp'] = 'site/files/uploadfile';
//         $this->load->view('site/layout', $this->data);
    }
    
    function check_user() {
        $username = $this->input->post('username');
        $where = array('username' => $username);
        $this->load->model('users_model');
        $uid = $this->users_model->get_info_rule($where);
        
//         if (!$this->users_model->check_exists($where)) {
        if (! $uid) {
             $this->form_validation->set_message(__FUNCTION__, 'Username không tồn tại');
            return false;
        }
        $this->data['user_id'] = $uid->id;
        return true;
    }
    
    function share() {
        $uid = $this->session->userdata('user_id_login');
        if (!$uid) {
            redirect(base_url('file/error'));
        }
        
        $fileid = intval($this->uri->rsegment(3));
        if ($fileid == 0)
            redirect(base_url('file/myfile'));
        
        $this->data['fileid'] = $fileid;
        
        $file = $this->files_model->get_info($fileid);
        
        $this->load->library('form_validation');
        $this->load->helper('form');
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('username', 'Username', 'required|');
            if ($this->form_validation->run()) {
//                 
               }
            }
        }
        // load view
        $this->data['temp'] = 'site/files/share';
        $this->load->view('site/layout', $this->data);
    }
    
    function delete() {
        $uid = $this->session->userdata('user_id_login');
        if (!$uid) {
            redirect(base_url('file/error'));
        }
        
        $fileid = intval($this->uri->rsegment(3));
        if ($fileid == 0)
            redirect(base_url('file/myfile'));
        
        $this->data['fileid'] = $fileid;
        
        $file = $this->files_model->get_info($fileid);
        $uid = $file->userid;
        $userid = $this->session->userdata('user_id_login');
        
        $this->data['uid'] = $uid;
        $this->data['usid'] = $userid;
        
        if ($userid == $uid) {
            if ($this->files_model->delete($fileid)) {
                $this->data['delete'] = 'Xóa file thành công';
            }
            else {
                $this->data['delete'] = 'Xóa file không thành công';
            }
            $this->data['temp'] = 'site/files/delete';
            $this->load->view('site/layout', $this->data);
        } else {
            $this->data['temp'] = 'site/error';
            $this->load->view('site/layout', $this->data);
        }
    }
}