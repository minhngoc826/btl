<?php
Class Home extends MY_Controller
{
	function index()
	{
	    $id = intval($this->uri->rsegment(3));
	    $input = array();
		//lay tong so file
		$this->load->model('files_model');
// 		$total_rows = $this->files_model->get_total();
		$total_rows = $this->files_model->get_total_row();
		$this->data['total_rows'] = $total_rows;
		
		// load ra thu vien phan trang
		$config = array();
		$config['total_rows'] = $total_rows; // tong tat ca cac san pham tren website
		$config['base_url'] = base_url('home/index/'.$id); // link hien thi ra danh sach san pham
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
		$list = $this->files_model->get_list($input);
		$this->data['list'] = $list;
		
// 		pre($list);
		
		//lay nội dung của biến message
		$message = $this->session->flashdata('message');
		$this->data['message'] = $message;
		
		$this->data['temp'] = 'site/home/index';
		$this->load->view('site/layout', $this->data);
	}
	
	function gioithieu() {
	    $this->data['temp'] = 'site/home/gioithieu';
	    $this->load->view('site/layout', $this->data);
	}
	
	function huongdan() {
	    $this->data['temp'] = 'site/home/huongdan';
	    $this->load->view('site/layout', $this->data);
	}
	
	function lienhe() {
	    $this->data['temp'] = 'site/home/lienhe';
	    $this->load->view('site/layout', $this->data);
	}
}