<?php
class Agen extends CI_Controller{
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
		
        $data=array('title'=>"Agen List",
            'active_agen_list'=>"active"
			);
		$params = array('id_user'=>  $this->session->userdata('id_user'));
		$data['id_agen'] = json_decode($this->curl->simple_get($this->API.'/api/get_id_agen',$params));
		$data['data_agen'] = json_decode($this->curl->simple_get($this->API.'/api/agen',$params));
		$data['data_master_agen_type'] = json_decode($this->curl->simple_get($this->API.'/api/get_master_agen_type',$params));
		$data['data_master_status_agen'] = json_decode($this->curl->simple_get($this->API.'/api/get_master_status_agen',$params));
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item_out'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_out',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		$data['jumlah_agen'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_agen',$params));
		
		$this->load->view('element/v_header',$data);
        $this->load->view('pages/v_agen',$data);
        $this->load->view('element/v_footer');
    }
	
 	
	//INSERT DATA AGEN
    function add_agen(){
		$data = array(
			'id_agen' => $this->input->post('id_agen'),
			'agen_name' => $this->input->post('agen_name'),
			'status' => $this->input->post('status'),
			'agen_phone_number_1' => $this->input->post('agen_phone_number_1'),
			'agen_phone_number_2' => $this->input->post('agen_phone_number_2'),
			'agen_address' => $this->input->post('agen_address'),
			'agen_city' => $this->input->post('agen_city'),
			'agen_province' => $this->input->post('agen_province'),
			'longitude' => $this->input->post('longitude'),
			'latitude' => $this->input->post('latitude'),
			'terminal_id' => $this->input->post('terminal_id'),
			'no_unique_agen' => $this->input->post('no_unique_agen'),
			'virtual_account_number' => $this->input->post('virtual_account_number'),
			'virtual_account_name' => $this->input->post('virtual_account_name'), 
			'agen_operational_name' => $this->input->post('agen_operational_name'),
			'agen_operational_address' => $this->input->post('agen_operational_address'),
			'agen_nearest_branch' => $this->input->post('agen_nearest_branch'),
			'agen_type' => $this->input->post('agen_type'),
			'note' => $this->input->post('note'),
			'date_of_interested' => $this->input->post('date_of_interested'),
			'inputer' => $this->input->post('inputer'));
			$insert =  $this->curl->simple_post($this->API.'/api/save_new_agen', $data, array(CURLOPT_BUFFERSIZE => 10)); 
		
			
			//fungsi upload foto tampak depan
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Tampak Depan Agen-".$name."-".$sales;  
			$config['upload_path'] = 'assets/foto/'; 
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';  
	 		$config['file_name'] = $nmfile; 
	 
			$this->upload->initialize($config);
			 
					
			if($_FILES['filetampakdepanagen']['name'])
			{
				if ($this->upload->do_upload('filetampakdepanagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_tampak_depan_agen' =>$gbr['file_name'],
					   'id_agen' => $this->input->post('id_agen')
					);
			$insert =  $this->curl->simple_put($this->API.'/api/update_foto_tampak_depan_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10)); 
				}
       		} 
			
			
			//fungsi upload foto tampak seberang
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Tampak Seberang Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';  
	 		$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config); 
					
			if($_FILES['filetampakseberangagen']['name'])
			{
				if ($this->upload->do_upload('filetampakseberangagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_tampak_seberang_agen' =>$gbr['file_name'],
					   'id_agen' => $this->input->post('id_agen')
					);
			$insert =  $this->curl->simple_put($this->API.'/api/update_foto_tampak_seberang_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10)); 
				}
       		} 
			
			//fungsi upload foto tampak kanan
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Tampak Kanan Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filetampakkananagen']['name'])
			{
				if ($this->upload->do_upload('filetampakkananagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_tampak_kanan_agen' =>$gbr['file_name'],
					   'id_agen' => $this->input->post('id_agen')
					);
			$insert =  $this->curl->simple_put($this->API.'/api/update_foto_tampak_kanan_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
				}
       		} 
			 		
			//fungsi upload foto tampak kiri
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Tampak Kiri Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filetampakkiriagen']['name'])
			{
				if ($this->upload->do_upload('filetampakkiriagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_tampak_kiri_agen' =>$gbr['file_name'],
					   'id_agen' => $this->input->post('id_agen')
					);
			$insert =  $this->curl->simple_put($this->API.'/api/update_foto_tampak_kiri_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
				}
       		} 
			
			header('location:'.base_url().'agen_list');
	}
	
}
