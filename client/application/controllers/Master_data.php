<?php
class Master_data extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->API="http://localhost/dermawan_suprihatin/server";
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','Silahkan Login Terlebih Dahulu !');
            redirect('');
        };
    }

    function index(){ 
        $data=array(
            'title'=>'Master Data',
            'active_master_data'=>'active'
        );
		
		$params = array('id_user'=>  $this->session->userdata('id_user'));
		$data['data_master_level_user'] = json_decode($this->curl->simple_get($this->API.'/api/data_master_level_user',$params));
		$data['data_master_delivery_service'] = json_decode($this->curl->simple_get($this->API.'/api/data_master_delivery_service',$params));
		$data['data_master_agen_type'] = json_decode($this->curl->simple_get($this->API.'/api/data_master_agen_type',$params));
		$data['data_master_status_agen'] = json_decode($this->curl->simple_get($this->API.'/api/data_master_status_agen',$params));
		$data['data_master_category'] = json_decode($this->curl->simple_get($this->API.'/api/data_master_category',$params));
		$data['data_master_user'] = json_decode($this->curl->simple_get($this->API.'/api/data_master_user',$params));
		$data['data_master_agen'] = json_decode($this->curl->simple_get($this->API.'/api/data_master_agen',$params));
		$data['id_user'] = json_decode($this->curl->simple_get($this->API.'/api/get_id_user',$params));
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item_out'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_out',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		$data['jumlah_agen'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_agen',$params));
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_master_data');
        $this->load->view('element/v_footer'); 
    }
	
	//    INSERT DATA USER
    function add_user(){ 
		$data=array( 
			'id_user'  => $this->input->post('id_user'),
			'level'  => $this->input->post('level'),
			'email'  => $this->input->post('email'),
			'username'  => $this->input->post('username'),
			'password'  => md5($this->input->post('password')),
			'name'  => $this->input->post('name'),
			'id_agen'  => $this->input->post('id_agen'),
			'status' => "N",
			'tokenCode' => md5($this->input->post('email').$this->input->post('date_create')),
			'date_create'  => $this->input->post('date_create'),
			'created'  => $this->input->post('created'));
	
			$insert =  $this->curl->simple_post($this->API.'/api/add_user', $data, array(CURLOPT_BUFFERSIZE => 10)); 
			
			if($insert)
            {
					$ci = get_instance();
			        $ci->load->library('email');
					
					$config['charset'] = 'utf-8';
					$config['protocol']= 'smtp';
					$config['mailtype']= "html";
					$config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
					$config['smtp_port']= "465"; 
					$config['smtp_user']= "tesemail098@gmail.com"; // isi dengan email kamu
					$config['smtp_pass']= "qwerty123!@#"; // isi dengan password kamu
					$config['newline']="\r\n"; 
					//memanggil library email dan set konfigurasi untuk pengiriman email
						
					$ci->email->initialize($config);
					//konfigurasi pengiriman
			        $ci->email->from('tesemail098@gmail.com', 'Tes email');
					
					$encrypted_id = md5($this->input->post('email').$this->input->post('date_create'));	
					$email = $this->input->post('email');   
					$name = $this->input->post('username');   
					$encrypted_email = md5($this->input->post('email'));
					
					$this->email->to($email);
					$this->email->subject("Verifikasi Akun");
					$this->email->message(
						"					
						Hello $name,
						<br /><br />
						Welcome new user !<br/>
						To complete your registration  please , just click following link<br/>
						<br /><br />
						<a href='".site_url("daftar/verifikasi/$encrypted_email/$encrypted_id")."'>Click HERE to Activate :)</a>
						<br /><br />
						Thanks,"
					);
					
					if($this->email->send())
					{
					    $this->session->set_flashdata('berhasil','Registration success. Please check your inbox to verification your account');
					}else
					{
						$this->session->set_flashdata('berhasil','Registration success. But failed to sent email.');
					}
					
            }else
            {
               $this->session->set_flashdata('gagal','Registration Failed');
            }
			
			header('location:'.base_url().'master_data'); 
	}
	
	
	//    INSERT DATA DELIVERY SERVICE
    function add_delivery_service(){
		if ($this->session->userdata('level') == 'super_admin' or $this->session->userdata('level') == 'operation_admin') {
			$data = array (
			'delivery_service_name' => $this->input->post('delivery_service_name'),
			'inputer' => $this->input->post('inputer'));
	
			$insert =  $this->curl->simple_post($this->API.'/api/add_delivery_service', $data, array(CURLOPT_BUFFERSIZE => 10)); 
			if($insert)
			{
				$this->session->set_flashdata('berhasil','Save Success');
			}else
			{
				$this->session->set_flashdata('berhasil','Save Failed');
			}
			header('location:'.base_url().'master_data');
		}
	}
	
	//    UPDATE DATA DELIVERY SERVICE
    function save_delivery_service(){
		if ($this->session->userdata('level') == 'super_admin' or $this->session->userdata('level') == 'operation_admin') {
			
			$data = array (
			'id_delivery_service'=> $this->input->post('id_delivery_service'),
			'delivery_service_name' => $this->input->post('delivery_service_name'),
			'last_edit_by' => $this->input->post('last_edit_by'));
	
			$update =  $this->curl->simple_put($this->API.'/api/save_delivery_service', $data, array(CURLOPT_BUFFERSIZE => 10));
			 
			if($update)
			{
				$this->session->set_flashdata('berhasil','Update Succes');
			}else
			{
				$this->session->set_flashdata('berhasil','Update Failed');
			}
			header('location:'.base_url().'master_data');
		}
	}
	
	/* 
		
	 
	//    INSERT DATA AGEN TYPE
    function add_agen_type(){
		if ($this->session->userdata('level') == 'super_admin') { 
		
			$agentype['agen_type_name'] = $this->input->post('agen_type_name');
			$agentype['inputer'] = $this->input->post('inputer');
	
			$this->db->insert('tbl_master_agen_type', $agentype);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	//    UPDATE DATA AGEN TYPE
    function save_agen_type(){
		if ($this->session->userdata('level') == 'super_admin') { 
			
			$id_agen_type['id_agen_type']= $this->input->post('id_agen_type');
			$agentype['agen_type_name'] = $this->input->post('agen_type_name');
			$agentype['last_edit_by'] = $this->input->post('last_edit_by');
	
			$this->db->update('tbl_master_agen_type', $agentype, $id_agen_type);
			
			header('location:'.base_url().'master_data');
		}
	}
	 
	//    INSERT DATA CATEGORY
    function add_category(){
		if ($this->session->userdata('level') == 'super_admin') { 
		
			$category['category_name'] = $this->input->post('category_name');
			$category['inputer'] = $this->input->post('inputer');
	
			$this->db->insert('tbl_master_category', $category);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	//    UPDATE DATA CATEGORY
    function save_category(){
		if ($this->session->userdata('level') == 'super_admin') { 
			
			$id_category['id_category']= $this->input->post('id_category');
			$category['agen_type_name'] = $this->input->post('agen_type_name');
			$category['last_edit_by'] = $this->input->post('last_edit_by');
	
			$this->db->update('tbl_master_category', $category, $id_category);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	
	//    INSERT DATA STATUS AGEN
    function add_status_agen(){
		if ($this->session->userdata('level') == 'super_admin') { 
		
			$status['nama_status'] = $this->input->post('nama_status') ;
			$status['warna_lingkaran'] = $this->input->post('warna_lingkaran') ;
			$status['warna_huruf_dalam_lingkaran'] = $this->input->post('warna_huruf_dalam_lingkaran') ;
	
			$this->db->insert('tbl_master_status_agen', $status);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	//    UPDATE DATA STATUS AGEN
    function save_status_agen(){
		if ($this->session->userdata('level') == 'super_admin') { 
			
			$id_status_agen['id_status_agen']= $this->input->post('id_status_agen');
			$status['nama_status'] = $this->input->post('nama_status'); 
			$status['warna_lingkaran'] = $this->input->post('warna_lingkaran') ;
			$status['warna_huruf_dalam_lingkaran'] = $this->input->post('warna_huruf_dalam_lingkaran') ;
	
			$this->db->update('tbl_master_status_agen', $status, $id_status_agen);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	
	
	//    UPDATE DATA USER
    function save_user(){
		if ($this->session->userdata('level') == 'super_admin' or $this->session->userdata('level') == 'operation_admin'or $this->session->userdata('level') == 'inventory_admin' or $this->session->userdata('level') == 'managerial' or $this->session->userdata('level') == 'agent' or $this->session->userdata('level') == 'sales') {
			
			$id_user['id_user']= $this->input->post('id_user'); 
			$user['username'] = $this->input->post('username'); 
			$user['last_edit'] = $this->input->post('last_edit');
	
			$this->db->update('tbl_master_user', $user, $id_user);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	//    UPDATE DATA PASSWORD USER
    function change_password(){
		if ($this->session->userdata('level') == 'super_admin' or $this->session->userdata('level') == 'operation_admin'or $this->session->userdata('level') == 'inventory_admin' or $this->session->userdata('level') == 'managerial' or $this->session->userdata('level') == 'agent' or $this->session->userdata('level') == 'sales') {
			
			$id_user['id_user']= $this->input->post('id_user');
			$password['password'] = md5($this->input->post('password'));
			$password['last_edit'] = $this->input->post('last_edit');
	
			$this->db->update('tbl_master_user', $password, $id_user);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	
	//    UPDATE DATA level
    function change_level(){
		if ($this->session->userdata('level') == 'super_admin') { 
			
			$id_user['id_user']= $this->input->post('id_user');
			$level['level'] = $this->input->post('level');
			$level['last_edit'] = $this->input->post('last_edit');
	
			$this->db->update('tbl_master_user', $level, $id_user);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	*/
}
