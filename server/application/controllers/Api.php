<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller
{
	
    function __construct($config = 'rest') 
    {
        parent::__construct($config);
        $this->load->model('model_api');
    }
   	
	//login
	function login_get()
    {		
      $email = $this->get('email');
      $password = $this->get('password');
       
	  $user = $this->model_api->cekEmail($email);
	   if($user) 
	   {
		   $user = $this->model_api->cekAktifasi($email);
	   	   if($user)
	   	   {
			   $user = $this->model_api->cekPassword($email,$password);
			   if($user)
			   {
					$this->response($user, 200);	
				} else {
				$u=$this->response(array(['pesan' => 'Password Salah'])); 
					$this->response($u, 400);
				}
			} else {
		    $u=$this->response(array(['pesan' => 'Akun belum diaktifasi'])); 
	 	  		$this->response($u, 400);
            }
       } else {
		   $u=$this->response(array(['pesan' => 'Email tidak terdaftar'])); 
	 	  $this->response($u, 400);
        }
    }
	
	// show data user
    function user_get() {
        $id_user = $this->get('id_user');
           $this->db->where('id_user', $id_user);
            $user = $this->db->get('tbl_master_user')->result();
        $this->response($user, 200);
    }
	
	// update data user
    function user_put() {
        $id_user = $this->put('id_user');
        $data = array(
                    'id_user'=> $this->put('id_user'),
                    'name' => $this->put('name'),
                    'email'=> $this->put('email'));
        $this->db->where('id_user', $id_user);
        $update = $this->db->update('tbl_master_user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
	
	
	// ganti password  user
    function changepassword_put() {
        $id_user = $this->put('id_user');
        $data = array(
                    'id_user'   => $this->put('id_user'),
                    'password' => $this->put('password'));
        $this->db->where('id_user', $id_user);
        $update = $this->db->update('tbl_master_user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
	
	
    // daftar user baru
    function daftar_post() {
      $email = $this->post('email');
       
	  $insert = $this->model_api->cekEmailDB($email);
	   if($insert) 
	    {		   
		$data = array(
					'id_user' => $this->post('id_user'),
					'level' => "Agent",
					'name' => $this->post('name'),
					'email'=> $this->post('email'),
					'password' => $this->post('password'),
					'status' => $this->post('status'),
					'tokencode' => $this->post('tokencode'),
					'date_create' => $this->post('date_create'));
					
		$insert = $this->db->insert('tbl_master_user', $data);
			if ($insert) 
			{
				$this->response($data, 200);
			} else 
			{
				$this->response(array('status' => 'fail', 502));
			}
        }
		else 
		{
		 $u=$this->response(array(
				
                 'pesan' => 'Email sudah terdaftar'
                )); 
	 	  		$this->response($u, 400);
        }
      }
	  
	  
	// verifikasi user
    function verifikasi_put() {
        $tokencode = $this->put('tokencode'); 
        $data = array(
                    'tokencode'   => $this->put('newtokencode'),
                    'status' => $this->put('status'));
        $this->db->where('tokencode', $tokencode); 
        $update = $this->db->update('tbl_master_user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
	
	
	// cek email forgot password
    function cekemailfp_get() {
        $email = $this->get('email');
           $this->db->where('email', $email);
            $user = $this->db->get('tbl_master_user')->result();
        $this->response($user, 200);
    }
	
	// cek token reset pin
    function cektoken_get() {
        $id_user = $this->get('id_user');
        $tokencode = $this->get('tokencode');
		   $this->db->where('id_user', $id_user);
		   $this->db->where('tokencode', $tokencode);
			$user = $this->db->get('tbl_master_user')->result();
        $this->response($user, 200);
    }
	
	// ganti password  user
    function resetpassword_put() {
        $id_user = $this->put('id_user');
        $data = array(
                    'id_user'   => $this->put('id_user'),
                    'password' => $this->put('password'),
                    'tokencode' => $this->put('newtokencode'));
        $this->db->where('id_user', $id_user);
        $update = $this->db->update('tbl_master_user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
	
	// show data item
		function item_get() {
				$user = $this->model_api->getItem();
			$this->response($user, 200);
		}
		
	// show data item in
		function item_in_get() {
				$user = $this->model_api->getItemIn();
			$this->response($user, 200);
		}
	
	// show data item in
		function item_out_get() {
				$user = $this->model_api->getItemOut();
			$this->response($user, 200);
		}
	
	// ambil data header item in
    function get_data_item_in_get() {
      $id_item_in = $this->get('id_item_in');
      	$query = $this->model_api->getItemInHeader($id_item_in);
			$this->response($query, 200);
	}
	
	// show data item in data
		function item_in_data_get() {
        $id_item_in = $this->get('id_item_in');
				$user = $this->model_api->getItemInData($id_item_in);
			$this->response($user, 200);
		}
	
	// ambil data nomor baru item in
		function get_id_item_in_get() { 
				$user = $this->model_api->getIDItemIn();
			$this->response($user, 200);
		}
	
	// ambil data nomor baru item out
		function get_id_item_out_get() { 
				$user = $this->model_api->getIDItemOut();
			$this->response($user, 200);
		}
	
	// ambil data nomor baru item 
		function get_id_item_get() { 
				$user = $this->model_api->getIDItem();
			$this->response($user, 200);
		}
	
	// ambil data category item
		function get_data_category_item_get() { 
            $user = $this->db->get('tbl_master_category')->result();
			$this->response($user, 200);
		}
	
	
	// ambil data inventory agen
		function get_data_inventory_agen_get() { 
				$user = $this->model_api->getDataInventoryAgen();
			$this->response($user, 200);
		}
	
	// ambil data agen
		function get_data_agen_get() { 
				$user = $this->model_api->getDataAgen();
			$this->response($user, 200);
		}
	 
	
	// ambil data barang yang belum keluar
		function get_data_item_not_out_get() { 
				$user = $this->model_api->getDataItemNotOut();
			$this->response($user, 200);
		}
		
	
	// ambil data agen yang belum dikasih keluar
		function get_data_agen_not_out_get() { 
				$user = $this->model_api->getDataAgenNotOut();
			$this->response($user, 200);
		}	
	
	// ambil data delivery service / giver
		function get_data_delivery_service_get() { 
				$user = $this->model_api->getDataDeliveryService();
			$this->response($user, 200);
		}
	
	// hitung data item
		function jumlah_item_get() {
				$user = $this->model_api->getAllDataItemNumber();
			$this->response($user, 200);
		}
	
	// hitung data item in
		function jumlah_item_in_get() {
				$user = $this->model_api->getAllDataItemInNumber();
			$this->response($user, 200);
		}
		
	// hitung data item out
		function jumlah_item_out_get() {
				$user = $this->model_api->getAllDataItemOutNumber();
			$this->response($user, 200);
		}
	
    // tambah barang masuk
    function save_item_in_post() {
      	$data = array(
		'id_item_in' => $this->post('id_item_in'),
		'id_sender' => $this->post('id_sender'),
		'id_receiver' => $this->post('id_receiver'),
		'date_in' => $this->post('date_in'),
		'note' => $this->post('note'),
		'inputer' => $this->post('inputer'));
					
		$insert = $this->db->insert('tbl_master_item_in', $data);
		
		if ($insert) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
 	
	 
	// tambah master barang 
    function save_master_item_post() {
		
      	$data = array(
		'id_item' => $this->post('id_item'),
		'item_name' => $this->post('item_name'),
		'esn' => $this->post('esn'),
		'sn' => $this->post('sn'),
		'total' => $this->post('total'),
		'status' => $this->post('status'),
		'contents' => $this->post('contents'),
		'note' => $this->post('note'),
		'inputer' => $this->post('inputer'));
		$insert1 = $this->db->insert('tbl_master_item', $data);
		
		if ($insert1) 
		{
			$data = array(
			'id_item' => $this->post('id_item'), 
			'id_item_in' => $this->post('id_item_in'), 
			'inputer' => $this->post('inputer'));
			$insert2 = $this->db->insert('tbl_detail_item_in', $data);
			if ($insert2) 
			{
				$data = array(
				'id_item' => $this->post('id_item'),
				'id_category' => $this->post('id_category'),
				'id_item_in' => $this->post('id_item_in'),
				'id_agen' => $this->post('id_receiver'),
				'inputer' => $this->post('inputer'));
				$insert2 = $this->db->insert('tbl_detail_item', $data);
				if ($insert2) 
				{
					$this->response($data, 200);
				} else 
				{
					$this->response(array('status' => 'fail', 502));
				}
			} else 
			{
				$this->response(array('status' => 'fail', 502));
			}
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	} 
	 
	 
    // tambah barang keluar
    function save_item_out_post() {
      	$data = array(
		'id_item_out' => $this->post('id_item_out'),
		'id_sender' => $this->post('id_sender'),
		'id_receiver' => $this->post('id_receiver'),
		'date_out' => $this->post('date_out'),
		'note' => $this->post('note'),
		'inputer' => $this->post('inputer'));
					
		$insert = $this->db->insert('tbl_master_item_out', $data);
		
		if ($insert) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
 	
	 
}
?>