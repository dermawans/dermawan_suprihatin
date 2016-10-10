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
		
        $data=array('title'=>"Item List",
            'active_item_list'=>"active"
			);
		$params = array('userID'=>  $this->session->userdata('userID'));
		$data['item'] = json_decode($this->curl->simple_get($this->API.'/api/item_in',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		
		$this->load->view('element/v_header',$data);
        $this->load->view('pages/v_item',$data);
        $this->load->view('element/v_footer');
    }
		
}
