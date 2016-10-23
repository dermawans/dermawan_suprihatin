<?php
class Dashboard extends CI_Controller{
    var $API ="";
   
    function __construct(){
        parent::__construct();
		$this->API="http://localhost/dermawan_suprihatin/server";
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','Silahkan Login Terlebih Dahulu !');
            redirect('login');
        };
		$data=array(); 
    }
	
    function index(){
		
        $data=array('title'=>"Dashboard",
            'active_dashboard'=>"active");
		$params = array('id_user'=>  $this->session->userdata('id_user'));
		$data['user'] = json_decode($this->curl->simple_get($this->API.'/api/user',$params));
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item_out'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_out',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		
		$this->load->view('element/v_header',$data);
        $this->load->view('pages/v_dashboard',$data);
        $this->load->view('element/v_footer');
    }
		
}
