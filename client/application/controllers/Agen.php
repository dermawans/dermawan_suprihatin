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
			$operational_name=$this->input->post('agen_operational_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('name');
			$nmfile = $agen_city."-".$agen_province."-Tampak Depan Agen-".$operational_name."-".$name."-".$sales;  
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
			$operational_name=$this->input->post('agen_operational_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('name');
			$nmfile = $agen_city."-".$agen_province."-Tampak Seberang Agen-".$operational_name."-".$name."-".$sales; 
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
			$operational_name=$this->input->post('agen_operational_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('name');
			$nmfile = $agen_city."-".$agen_province."-Tampak Kanan Agen-".$operational_name."-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config); 
					
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
			$operational_name=$this->input->post('agen_operational_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('name');
			$nmfile = $agen_city."-".$agen_province."-Tampak Kiri Agen-".$operational_name."-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config); 
					
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
			
			header('location:'.base_url().'agen');
	}

	
	//UPDATE DATA AGEN
    function save_agen(){	
	
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
			'date_of_submit_to_bca' => $this->input->post('date_of_submit_to_bca'), 
			'date_of_approve_or_reject_or_canceled' => $this->input->post('date_of_approve_or_reject_or_canceled'), 
			'last_edit_by' => $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2'),
			);
			$insert =  $this->curl->simple_put($this->API.'/api/update_data_agen', $data, array(CURLOPT_BUFFERSIZE => 10));
			
			//fungsi upload foto foto agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config); 
					
			if($_FILES['filefotoagen']['name'])
			{
				if ($this->upload->do_upload('filefotoagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_agen' =>$gbr['file_name'],
					    'id_agen' => $this->input->post('id_agen')
					);
			$insert =  $this->curl->simple_put($this->API.'/api/update_foto_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
				}
       		} 
			 	
			//fungsi upload foto ktp agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto KTP Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config); 
					
			if($_FILES['filektpagen']['name'])
			{
				if ($this->upload->do_upload('filektpagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_ktp' =>$gbr['file_name'],
					    'id_agen' => $this->input->post('id_agen')
					);
			$insert =  $this->curl->simple_put($this->API.'/api/update_foto_ktp', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
				}
       		} 
			
			//fungsi upload foto form pengajuan agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Form Pengajuan Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config); 
					
			if($_FILES['fileformregistrasiagen']['name'])
			{
				if ($this->upload->do_upload('fileformregistrasiagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_form_pengajuan_agen' =>$gbr['file_name'],
					   'id_agen' => $this->input->post('id_agen')
					);
			$insert =  $this->curl->simple_put($this->API.'/api/update_foto_form_pengajuan_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
				}
       		} 
			 
			//fungsi upload foto cover buku tabungan agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Cover Buku Tabungan Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config); 
					
			if($_FILES['filecoverbukutabunganagen']['name'])
			{
				if ($this->upload->do_upload('filecoverbukutabunganagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_cover_buku_tabungan' =>$gbr['file_name'],
					    'id_agen' => $this->input->post('id_agen')
					);
			$insert =  $this->curl->simple_put($this->API.'/api/update_foto_cover_buku_tabungan', $datafoto, array(CURLOPT_BUFFERSIZE => 10)); 
				}
       		} 	
			 	
			 
			//fungsi upload foto npwp atau surat keterangan
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto NPWP atau Surat Keterangan Tidak Punya Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config); 
					
			if($_FILES['filenpwpagen']['name'])
			{
				if ($this->upload->do_upload('filenpwpagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_npwp_atau_surat_keterangan_tidak_punya' =>$gbr['file_name'],
					    'id_agen' => $this->input->post('id_agen')
					);
			$insert =  $this->curl->simple_put($this->API.'/api/update_foto_npwp_atau_surat_keterangan_tidak_punya', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
				}
       		} 	
			
			//fungsi upload foto surat keterangan usaha atau bapu
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Surat Keterangan Usaha atau BAPU Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config); 
					
			if($_FILES['filesuratketeranganusahaagen']['name'])
			{
				if ($this->upload->do_upload('filesuratketeranganusahaagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_surat_keterangan_usaha_atau_bapu' =>$gbr['file_name'],
					    'id_agen' => $this->input->post('id_agen')
					);
			$insert =  $this->curl->simple_put($this->API.'/api/update_foto_surat_keterangan_usaha_atau_bapu', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
				}
       		} 	
			
			//fungsi upload foto instalasi mesin agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Instalasi Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config); 
					
			if($_FILES['fileinstalasiagen']['name'])
			{
				if ($this->upload->do_upload('fileinstalasiagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_instalasi_mesin_agen' =>$gbr['file_name'],
					    'id_agen' => $this->input->post('id_agen')
					);
			$insert =  $this->curl->simple_put($this->API.'/api/update_foto_instalasi_mesin_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
				}
       		} 	
			
			//fungsi upload foto training agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Training Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config); 
					
			if($_FILES['filetrainingagen']['name'])
			{
				if ($this->upload->do_upload('filetrainingagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_training_agen' =>$gbr['file_name'],
					    'id_agen' => $this->input->post('id_agen')
					);
			$insert =  $this->curl->simple_put($this->API.'/api/update_foto_training_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
				}
       		} 	
			
			
			//fungsi upload foto spanduk agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Spanduk Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config); 					
			if($_FILES['filespandukagen']['name'])
			{
				if ($this->upload->do_upload('filespandukagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_spanduk_agen' =>$gbr['file_name'],
					    'id_agen' => $this->input->post('id_agen')
					);
			$insert =  $this->curl->simple_put($this->API.'/api/update_foto_spanduk_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
				}
       		} 
			
			
			
			//fungsi upload foto sertifikat agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Spanduk Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config); 
					
			if($_FILES['filesertifikatagen']['name'])
			{
				if ($this->upload->do_upload('filesertifikatagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_sertifikat_agen' =>$gbr['file_name'],
					    'id_agen' => $this->input->post('id_agen')
					);
			$insert =  $this->curl->simple_put($this->API.'/api/update_foto_sertifikat_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
				}
       		} 
			
			//fungsi upload foto pks agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto PKS Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config); 
					
			if($_FILES['filetpksagen']['name'])
			{
				if ($this->upload->do_upload('filetpksagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_pks_agen' =>$gbr['file_name'],
					    'id_agen' => $this->input->post('id_agen')
					);
			$insert =  $this->curl->simple_put($this->API.'/api/update_foto_pks_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
				}
       		} 	
			
			
			//fungsi upload foto aktifasi agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Aktifasi Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config); 
					
			if($_FILES['filepembukaanagen']['name'])
			{
				if ($this->upload->do_upload('filepembukaanagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_aktifasi_agen' =>$gbr['file_name'],
					    'id_agen' => $this->input->post('id_agen')
					);
			$insert =  $this->curl->simple_put($this->API.'/api/update_foto_aktifasi_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
				}
       		} 	
			
			
			header('location:'.base_url().'agen');
	}
		
}
