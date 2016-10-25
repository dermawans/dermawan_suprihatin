<?php
class Item_out extends CI_Controller{
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
        $data=array('title'=>"Item Out",
            'active_item_out'=>"active"
			);
		$params = array('id_user'=>  $this->session->userdata('id_user'));
		$data['item_out'] = json_decode($this->curl->simple_get($this->API.'/api/item_out',$params));
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item_out'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_out',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		$data['jumlah_agen'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_agen',$params));
		
		$this->load->view('element/v_header',$data);
        $this->load->view('pages/v_item_out',$data);
        $this->load->view('element/v_footer'); 
    }
	
	
	function add_item_out(){
        $data=array('title'=>"Add Item Out",
            'active_item_out'=>"active"
			);
		$params = array('id_user'=>  $this->session->userdata('id_user')); 
		$data['id_item_out'] = json_decode($this->curl->simple_get($this->API.'/api/get_id_item_out',$params)); 
		$data['item_not_out'] = json_decode($this->curl->simple_get($this->API.'/api/get_data_item_not_out',$params));
		$data['data_agen'] = json_decode($this->curl->simple_get($this->API.'/api/get_data_agen_not_out',$params));
		$data['data_sender'] = json_decode($this->curl->simple_get($this->API.'/api/get_data_delivery_service',$params));
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item_out'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_out',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		$data['jumlah_agen'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_agen',$params));
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_add_item_out');
        $this->load->view('element/v_footer');
	}
	
	function save_item_out(){
		$data = array(
		'date_out' => $this->input->post('date_out'),
		'id_item_out' => $this->input->post('id_item_out'),
		'id_sender' => $this->input->post('id_sender'),
		'id_receiver' => $this->input->post('id_receiver'),
		'note' => $this->input->post('note'),
		'inputer' => $this->input->post('inputer'));
		$insert =  $this->curl->simple_post($this->API.'/api/save_item_out', $data, array(CURLOPT_BUFFERSIZE => 10)); 
			
		if($insert)
		{
			$this->session->set_flashdata('berhasil','Data berhasil disimpan.');		
		}
		else
		{
			$this->session->set_flashdata('gagal','Data gagal disimpan');
		} 
		redirect('item_out');
	}
	
	
	function add_item_item_out(){
	
		$data=array('title'=>"Add Item",
            'active_item_out'=>"active"
			);
		
		$params = array('id_user'=>  $this->session->userdata('id_user'),'id_item_out'=>  $this->input->post('id_item_out')); 
		$data['id_item_out'] = json_decode($this->curl->simple_get($this->API.'/api/get_data_item_out',$params));  
		$data['item_not_out'] = json_decode($this->curl->simple_get($this->API.'/api/get_data_item_not_out',$params)); 
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item_out'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_out',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		$data['jumlah_agen'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_agen',$params));
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_add_item_for_item_out',$data);
        $this->load->view('element/v_footer');
	}
	
	
	function save_item_item_out(){
		$data = array( 
		'id_item_out' => $this->input->post('id_item_out'),
		'id_receiver' => $this->input->post('id_receiver'),
		'id_item' => $this->input->post('id_item'),
		'inputer' => $this->input->post('inputer'));
		$insert =  $this->curl->simple_post($this->API.'/api/save_item_for_item_out', $data, array(CURLOPT_BUFFERSIZE => 10)); 
		$update =  $this->curl->simple_put($this->API.'/api/update_data_item_for_item_out', $data, array(CURLOPT_BUFFERSIZE => 10)); 
		
		if($insert)
		{
			$this->session->set_flashdata('berhasil','Data berhasil disimpan.');		
		}
		else
		{
			$this->session->set_flashdata('gagal','Data gagal disimpan');
		} 
		
		
		redirect('item_out');
	}
	
	function view_item_out(){
	
		$data=array('title'=>"View Item Out",
            'active_item_out'=>"active"
			);
		$params = array('id_user'=>  $this->session->userdata('id_user'),'id_item_out'=>  $this->input->post('id_item_out')); 
		$data['item_out_header'] = json_decode($this->curl->simple_get($this->API.'/api/get_data_item_out',$params)); 
		$data['item_out_data'] = json_decode($this->curl->simple_get($this->API.'/api/item_out_data',$params));  
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item_out'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_out',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		$data['jumlah_agen'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_agen',$params));
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_view_item_out',$data);
        $this->load->view('element/v_footer');
	}
	
	
	function print_work_order(){
	
		$data=array('title'=>"View Item Out",
            'active_item_out'=>"active"
			);
		$params = array('id_user'=>  $this->session->userdata('id_user'),'id_item_out'=>  $this->input->post('id_item_out')); 
		$data['item_out_header'] = json_decode($this->curl->simple_get($this->API.'/api/get_data_item_out',$params)); 
		$data['item_out_data'] = json_decode($this->curl->simple_get($this->API.'/api/item_out_data',$params));   
		
        $this->load->view('pages/v_print_work_order',$data);
	}
	
	
	function print_tanda_terima_training(){
	
		$data=array('title'=>"View Item Out",
            'active_item_out'=>"active"
			);
		$params = array('id_user'=>  $this->session->userdata('id_user'),'id_item_out'=>  $this->input->post('id_item_out')); 
		$data['item_out_header'] = json_decode($this->curl->simple_get($this->API.'/api/get_data_item_out',$params)); 
		$data['item_out_data'] = json_decode($this->curl->simple_get($this->API.'/api/item_out_data',$params));   
		
        $this->load->view('pages/v_print_tbt',$data);
	}
}
