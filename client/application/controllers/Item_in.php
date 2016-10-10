<?php
class Item_in extends CI_Controller{
    var $API ="";
   
    function __construct(){
        parent::__construct();
		$this->API="http://localhost/dermawan_suprihatin/server";
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','Silahkan Login Terlebih Dahulu !');
            redirect('');
        };
		$data=array(); 
    }
	
    function index(){
		
        $data=array('title'=>"Item In",
            'active_item_in'=>"active"
			);
		$params = array('userID'=>  $this->session->userdata('userID'));
		$data['item_in'] = json_decode($this->curl->simple_get($this->API.'/api/item_in',$params));
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		
		$this->load->view('element/v_header',$data);
        $this->load->view('pages/v_item_in',$data);
        $this->load->view('element/v_footer');
    }
	
    function detail_item_in(){
		
        $data=array('title'=>"Item In",
            'active_item_in'=>"active"
			);
		$params = array('userID'=>  $this->session->userdata('userID'),'id_item_in'=> $this->uri->segment(3));
		$data['item_in_header'] = json_decode($this->curl->simple_get($this->API.'/api/item_in_header',$params));
		$data['item_in_data'] = json_decode($this->curl->simple_get($this->API.'/api/item_in_data',$params));
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		
		$this->load->view('element/v_header',$data);
        $this->load->view('pages/v_detail_item_in',$data);
        $this->load->view('element/v_footer');
    }
		
}
