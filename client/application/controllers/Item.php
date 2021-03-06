<?php
class Item extends CI_Controller{
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
		$params = array('id_user'=>  $this->session->userdata('id_user'));
		$data['item'] = json_decode($this->curl->simple_get($this->API.'/api/item',$params));
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item_out'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_out',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		$data['jumlah_agen'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_agen',$params));
		
		$this->load->view('element/v_header',$data);
        $this->load->view('pages/v_item',$data);
        $this->load->view('element/v_footer');
    }
	
 	
	//view detail data item list
    function view_item(){ 
       
		$data=array('title'=>"View Item List",
            'active_item_list'=>"active"
			);
		$params = array('id_user'=>  $this->session->userdata('id_user'),'id_item'=>  $this->input->post('id_item')); 
		$data['item'] = json_decode($this->curl->simple_get($this->API.'/api/item',$params));   
		$data['item_in_data'] = json_decode($this->curl->simple_get($this->API.'/api/item_in_data_item',$params));    
		$data['item_out_data'] = json_decode($this->curl->simple_get($this->API.'/api/item_out_data_item',$params));   
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item_out'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_out',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		$data['jumlah_agen'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_agen',$params));
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_view_item',$data);
        $this->load->view('element/v_footer');

	} 
	
}
