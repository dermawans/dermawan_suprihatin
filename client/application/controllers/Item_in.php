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
	$this->session->unset_userdata('id_item_in');
		
        $data=array('title'=>"Item In",
            'active_item_in'=>"active"
			);
		$params = array('id_user'=>  $this->session->userdata('id_user'));
		$data['item_in'] = json_decode($this->curl->simple_get($this->API.'/api/item_in',$params));
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item_out'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_out',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		
		$this->load->view('element/v_header',$data);
        $this->load->view('pages/v_item_in',$data);
        $this->load->view('element/v_footer');
    }
	
	function add_item_in(){
        $data=array('title'=>"Add Item In",
            'active_item_in'=>"active"
			);
		$params = array('id_user'=>  $this->session->userdata('id_user')); 
		$data['id_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/get_id_item_in',$params));
		$data['data_inventory_agen'] = json_decode($this->curl->simple_get($this->API.'/api/get_data_inventory_agen',$params));
		$data['data_giver'] = json_decode($this->curl->simple_get($this->API.'/api/get_data_delivery_service',$params));
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item_out'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_out',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_add_item_in');
        $this->load->view('element/v_footer');
	}
	
	function save_item_in(){
		$data = array(
		'date_in' => $this->input->post('date_in'),
		'id_item_in' => $this->input->post('id_item_in'),
		'id_sender' => $this->input->post('id_sender'),
		'id_receiver' => $this->input->post('id_receiver'),
		'note' => $this->input->post('note'),
		'inputer' => $this->input->post('inputer'));
		$insert =  $this->curl->simple_post($this->API.'/api/save_item_in', $data, array(CURLOPT_BUFFERSIZE => 10)); 
			
		if($insert)
		{
			$this->session->set_flashdata('berhasil','Data berhasil disimpan.');		
		}
		else
		{
			$this->session->set_flashdata('gagal','Data gagal disimpan');
		}
		//$sess_array = array('id_item_in'=>$this->input->post('id_item_in'));
		//$this->session->set_userdata($sess_array);
		//redirect('item_in/add_item_item_in');
		redirect('item_in');
	}
	
	function add_item_item_in(){
	
		$data=array('title'=>"Add Item",
            'active_item_in'=>"active"
			);
		/*
		if($this->input->post('id_item_in')<>"")
		{$params = array('id_user'=>  $this->session->userdata('id_user'),'id_item_in'=>  $this->input->post('id_item_in')); }
		else
		{$params = array('id_user'=>  $this->session->userdata('id_user'),'id_item_in'=>  $this->session->userdata('id_item_in')); }
		*/
		$params = array('id_user'=>  $this->session->userdata('id_user'),'id_item_in'=>  $this->input->post('id_item_in')); 
		$data['id_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/get_data_item_in',$params)); 
		$data['id_item'] = json_decode($this->curl->simple_get($this->API.'/api/get_id_item',$params)); 
		$data['data_category_item'] = json_decode($this->curl->simple_get($this->API.'/api/get_data_category_item',$params));
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item_out'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_out',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_add_item_for_item_in',$data);
        $this->load->view('element/v_footer');
	}
	// jangan lupa tambahin ini $this->session->unset_userdata('id_item_in');   nanti buat hapus sessionnya
	
	function save_item_item_in(){
		$data1 = array( 
		'id_item' => $this->input->post('id_item'),
		'item_name' => $this->input->post('item_name'),
		'esn' => $this->input->post('esn'),
		'sn' => $this->input->post('sn'),
		'total' => $this->input->post('total'),
		'status' => $this->input->post('status'),
		'contents' => $this->input->post('contents'),
		'note' => $this->input->post('note'),
		'inputer' => $this->input->post('inputer'),
		'id_item_in' => $this->input->post('id_item_in'),
		'id_category' => $this->input->post('id_category'),
		'id_receiver' => $this->input->post('id_receiver'),);
		$insert1 =  $this->curl->simple_post($this->API.'/api/save_master_item', $data1, array(CURLOPT_BUFFERSIZE => 10)); 
		
		if($insert1)
		{
			$this->session->set_flashdata('berhasil','Data berhasil disimpan.');		
		}
		else
		{
			$this->session->set_flashdata('gagal','Data gagal disimpan');
		} 
		
		
		redirect('item_in');
	}
		
	
	function view_item_in(){
	
		$data=array('title'=>"View Item In",
            'active_item_in'=>"active"
			);
		$params = array('id_user'=>  $this->session->userdata('id_user'),'id_item_in'=>  $this->input->post('id_item_in')); 
		$data['item_in_header'] = json_decode($this->curl->simple_get($this->API.'/api/get_data_item_in',$params)); 
		$data['item_in_data'] = json_decode($this->curl->simple_get($this->API.'/api/item_in_data',$params));  
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item_out'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_out',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_view_item_in',$data);
        $this->load->view('element/v_footer');
	}
	
	
	function print_item_in(){
	
		$data=array('title'=>"View Item In",
            'active_item_in'=>"active"
			);
		$params = array('id_user'=>  $this->session->userdata('id_user'),'id_item_in'=>  $this->input->post('id_item_in')); 
		$data['item_in_header'] = json_decode($this->curl->simple_get($this->API.'/api/get_data_item_in',$params)); 
		$data['item_in_data'] = json_decode($this->curl->simple_get($this->API.'/api/item_in_data',$params));   
		
        $this->load->view('pages/v_print_item_in',$data);
	}
	
	/*
    function detail_item_in(){
		
        $data=array('title'=>"Item In",
            'active_item_in'=>"active"
			);
		$params = array('id_user'=>  $this->session->userdata('id_user'),'id_item_in'=> $this->uri->segment(3));
		$data['item_in_header'] = json_decode($this->curl->simple_get($this->API.'/api/item_in_header',$params));
		$data['item_in_data'] = json_decode($this->curl->simple_get($this->API.'/api/item_in_data',$params));
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		
		$this->load->view('element/v_header',$data);
        $this->load->view('pages/v_detail_item_in',$data);
        $this->load->view('element/v_footer');
    }
	*/
}
