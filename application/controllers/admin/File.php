<?php
class File extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('files_model');
        $this->load->model('category_model');
    }
        
        /*
         * Hien thi danh sach file
         */
        function index()
        {
            //lay tong so luong ta ca cac san pham trong websit
            $total_rows = $this->files_model->get_total();
            $this->data['total_rows'] = $total_rows;
        
            //load ra thu vien phan trang
            $this->load->library('pagination');
            $config = array();
            $config['total_rows'] = $total_rows;//tong tat ca cac san pham tren website
            $config['base_url']   = admin_url('files/index'); //link hien thi ra danh sach san pham
            $config['per_page']   = 20;//so luong san pham hien thi tren 1 trang
            $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
            $config['next_link']   = 'Next';
            $config['prev_link']   = 'Prev';
            //khoi tao cac cau hinh phan trang
            $this->pagination->initialize($config);
        
            $segment = $this->uri->segment(4);
            $segment = intval($segment);
        
            $input = array();
            $input['limit'] = array($config['per_page'], $segment);
        
            //kiem tra co thuc hien loc du lieu hay khong
            $id = $this->input->get('id');
            $id = intval($id);
            $input['where'] = array();
            if($id > 0)
            {
                $input['where']['id'] = $id;
            }
            $name = $this->input->get('filename');
            if($name)
            {
                $input['like'] = array('filename', $name);
            }
            $category_id = $this->input->get('catid');
            $category_id = intval($category_id);
            if($category_id > 0)
            {
                $input['where']['catid'] = $category_id;
            }
        
            //lay danh sach san pha
            $list = $this->files_model->get_list($input);
            $this->data['list'] = $list;
             
            //lay danh sach danh muc san pham
            $this->load->model('category_model');
            $input = array();
            $input['where'] = array('parent_id' => 0);
            $categorys = $this->category_model->get_list($input);
            foreach ($categorys as $row)
            {
                $input['where'] = array('parent_id' => $row->id);
                $subs = $this->category_model->get_list($input);
                $row->subs = $subs;
            }
            $this->data['categorys'] = $categorys;
        
            //lay nội dung của biến message
            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;
        
            //load view
            $this->data['temp'] = 'admin/files/index';
            $this->load->view('admin/main', $this->data);
        }
        
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
//             $data['luotxem'] = $files->luotxem + 1;
//             $this->files_model->update($files->id, $data);
        
            // lay thong tin cua danh mục san pham
            $category = $this->category_model->get_info($files->catid);
            $this->data['category'] = $category;
        
            // hiển thị ra view
//             $this->data['temp'] = 'admin/files/view';
//             $this->load->view('admin/main', $this->data);
            $this->data['temp'] = 'site/files/view';
            $this->load->view('site/layout', $this->data);
        }
        
        /*
         * Them san pham moi
         */
        function add()
        {
//             //lay danh sach danh muc san pham
//             $this->load->model('category_model');
//             $input = array();
//             $input['where'] = array('parent_id' => 0);
//             $categorys = $this->category_model->get_list($input);
//             foreach ($categorys as $row)
//             {
//                 $input['where'] = array('parent_id' => $row->id);
//                 $subs = $this->category_model->get_list($input);
//                 $row->subs = $subs;
//             }
//             $this->data['categorys'] = $categorys;
        
//             //load thư viện validate dữ liệu
//             $this->load->library('form_validation');
//             $this->load->helper('form');
        
//             //neu ma co du lieu post len thi kiem tra
//             if($this->input->post())
//             {
//                 $this->form_validation->set_rules('name', 'Tên', 'required');
//                 $this->form_validation->set_rules('category', 'Thể loại', 'required');
        
//                 //nhập liệu chính xác
//                 if($this->form_validation->run())
//                 {
//                     //them vao csdl
//                     $name        = $this->input->post('name');
//                     $category_id  = $this->input->post('category');
//                     $price       = $this->input->post('price');
        
// //                     //lay ten file anh minh hoa duoc update len
// //                     $this->load->library('upload_library');
// //                     $upload_path = './upload/files';
// //                     $upload_data = $this->upload_library->upload($upload_path, 'image');
// //                     $image_link = '';
// //                     if(isset($upload_data['file_name']))
// //                     {
// //                         $image_link = $upload_data['file_name'];
// //                     }
// //                     //upload cac anh kem theo
// //                     $image_list = array();
// //                     $image_list = $this->upload_library->upload_file($upload_path, 'image_list');
// //                     $image_list = json_encode($image_list);
        
//                     //luu du lieu can them
//                     $data = array(
//                         'filename'       => $name,
//                         'url' =>
//                         'catid' => $category_id,
//                         'price'      => $price,
//                         'image' => 'file.png',
                        
//                     );
//                     //them moi vao csdl
//                     if($this->files_model->create($data))
//                     {
//                         //tạo ra nội dung thông báo
//                         $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
//                     }else{
//                         $this->session->set_flashdata('message', 'Không thêm được');
//                     }
//                     //chuyen tới trang danh sách
//                     redirect(admin_url('file'));
//                 }
//             }
        
        
//             //load view
//             $this->data['temp'] = 'admin/files/add';
//             $this->load->view('admin/main', $this->data);
        }
        
        /*
         * Chinh sua san pham
         */
        function edit()
        {
            $id = $this->uri->rsegment('3');
            $files = $this->files_model->get_info($id);
            if(!$files)
            {
                //tạo ra nội dung thông báo
                $this->session->set_flashdata('message', 'Không tồn tại sản phẩm này');
                redirect(admin_url('file'));
            }
            $this->data['files'] = $files;
             
            //lay danh sach danh muc san pham
            $this->load->model('category_model');
            $input = array();
            $input['where'] = array('parent_id' => 0);
            $categorys = $this->category_model->get_list($input);
            foreach ($categorys as $row)
            {
                $input['where'] = array('parent_id' => $row->id);
                $subs = $this->category_model->get_list($input);
                $row->subs = $subs;
            }
            $this->data['categorys'] = $categorys;
        
            //load thư viện validate dữ liệu
            $this->load->library('form_validation');
            $this->load->helper('form');
        
            //neu ma co du lieu post len thi kiem tra
            if($this->input->post())
            {
                $this->form_validation->set_rules('name', 'Tên', 'required');
//                 $this->form_validation->set_rules('category', 'Thể loại', 'required');
        
                //nhập liệu chính xác
                if($this->form_validation->run())
                {
                    //them vao csdl
                    $name        = $this->input->post('name');
//                     $category_id  = $this->input->post('category');
                     
        
                    //lay ten file anh minh hoa duoc update len
        
                    //luu du lieu can them
                    $data = array(
                        'filename'       => $name,
                    );
        
                    //them moi vao csdl
                    if($this->files_model->update($files->id, $data))
                    {
                        //tạo ra nội dung thông báo
                        $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                    }else{
                        $this->session->set_flashdata('message', 'Không cập nhật được');
                    }
                    //chuyen tới trang danh sách
                    redirect(admin_url('file'));
                }
            }
        
        
            //load view
            $this->data['temp'] = 'admin/files/edit';
            $this->load->view('admin/main', $this->data);
        }
        
        /*
         * Xoa du lieu
         */
        function del()
        {
            $id = $this->uri->rsegment(3);
            $this->_del($id);
        
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('message', 'không tồn tại file này');
            redirect(admin_url('file'));
        }
        
        /*
         * Xóa nhiều sản phẩm
         */
        function delete_all()
        {
            $ids = $this->input->post('ids');
            foreach ($ids as $id)
            {
                $this->_del($id);
            }
        }
        
        /*
         *Xoa san pham
         */
        private function _del($id)
        {
            $files = $this->files_model->get_info($id);
            if(!$files)
            {
                //tạo ra nội dung thông báo
                $this->session->set_flashdata('message', 'không tồn tại file này');
                redirect(admin_url('file'));
            }
            //thuc hien xoa san pham
            $this->files_model->delete($id);
            //xoa cac anh cua san pham
            $image_link = './upload/files/'.$files->url;
            if(file_exists($image_link))
            {
                unlink($image_link);
            }
            //xoa cac anh kem theo cua san pham
            $image_link = './upload/images/'.$files->image;
            if(file_exists($image_link))
            {
                unlink($image_link);
            }
        }
}