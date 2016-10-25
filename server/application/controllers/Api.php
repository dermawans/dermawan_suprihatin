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
					'email'=> $this->post('email'),
					'username'=> $this->post('username'),
					'password' => $this->post('password'),
					'name' => $this->post('name'),
					'id_agen' => $this->post('id_agen'),
					'status' => $this->post('status'),
					'tokencode' => $this->post('tokencode'),
					'date_create' => $this->post('date_create'),
					'created' => $this->post('created'));
					
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
	
	// show data agen
		function agen_get() {
        	$type = "LAKU";
			$this->db->where('agen_type', $type);
            $user = $this->db->get('tbl_master_agen')->result();
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
	
	// ambil data header item out
    function get_data_item_out_get() {
      $id_item_out = $this->get('id_item_out');
      	$query = $this->model_api->getItemOutHeader($id_item_out);
			$this->response($query, 200);
	}
	
	// show data item out data
		function item_out_data_get() {
        $id_item_out = $this->get('id_item_out');
				$user = $this->model_api->getItemOutData($id_item_out);
			$this->response($user, 200);
		}
	
	//untuk item
	
	// show data item in data
		function item_in_data_item_get() {
        $id_item = $this->get('id_item');
				$user = $this->model_api->getItemInItemData($id_item);
			$this->response($user, 200);
		}
	
	// show data item out data
		function item_out_data_item_get() {
        $id_item = $this->get('id_item');
				$user = $this->model_api->getItemOutItemData($id_item);
			$this->response($user, 200);
		}
	
	//untuk item
	
	
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
	
	// ambil data nomor baru agen
		function get_id_agen_get() { 
				$user = $this->model_api->getIDAgen();
			$this->response($user, 200);
		}
	
	
	
	// ambil data tipe agen
		function get_master_agen_type_get() { 
            $user = $this->db->get('tbl_master_agen_type')->result();
			$this->response($user, 200);
		}
		
	
	// ambil data status agen
		function get_master_status_agen_get() { 
            $user = $this->db->get('tbl_master_status_agen')->result();
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
		if ($user) 
			{
			$this->response($user, 200);
			} 
		else 
			{
			$user = $this->model_api->getDataAgen();
			$this->response($user, 200);
			}
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
	
	// hitung data agen
		function jumlah_agen_get() {
				$user = $this->model_api->getAllDataAgenNumber();
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
 	
	
    // tambah item untuk barang keluar
    function save_item_for_item_out_post() {
      	$data = array(
		'id_item_out' => $this->post('id_item_out'),
		'id_item' => $this->post('id_item'),
		'inputer' => $this->post('inputer'));
					 
		$insert = $this->db->insert('tbl_detail_item_out', $data);
		
		if ($insert) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
	
    // tambah item untuk barang keluar
    function update_data_item_for_item_out_put() {
		 
        $id_item = $this->put('id_item'); 
      	$data = array(
		'id_item_out' => $this->put('id_item_out'),
		'id_agen' => $this->put('id_receiver'),
		'id_item' => $this->put('id_item'),
		'last_edit_by' => $this->put('inputer'));
					
		$this->db->where('id_item', $id_item);
        $update = $this->db->update('tbl_detail_item', $data);
		 
		
		if ($insert) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
 	
	 
    // tambah agen baru
    function save_new_agen_post() {
      	$data = array(
			'id_agen' => $this->post('id_agen'),
			'agen_name' => $this->post('agen_name'),
			'status' => $this->post('status'),
			'agen_phone_number_1' => $this->post('agen_phone_number_1'),
			'agen_phone_number_2' => $this->post('agen_phone_number_2'),
			'agen_address' => $this->post('agen_address'),
			'agen_city' => $this->post('agen_city'),
			'agen_province' => $this->post('agen_province'),
			'longitude' => $this->post('longitude'),
			'latitude' => $this->post('latitude'),
			'terminal_id' => $this->post('terminal_id'),
			'no_unique_agen' => $this->post('no_unique_agen'),
			'virtual_account_number' => $this->post('virtual_account_number'),
			'virtual_account_name' => $this->post('virtual_account_name'), 
			'agen_operational_name' => $this->post('agen_operational_name'),
			'agen_operational_address' => $this->post('agen_operational_address'),
			'agen_nearest_branch' => $this->post('agen_nearest_branch'),
			'agen_type' => $this->post('agen_type'),
			'note' => $this->post('note'),
			'date_of_interested' => $this->post('date_of_interested'),
			'inputer' => $this->post('inputer'));
					
		$insert = $this->db->insert('tbl_master_agen', $data);
		
		if ($insert) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
 	
	
    // tambah foto tampak depan agen
    function update_foto_tampak_depan_agen_put() {
		 
        $id_agen = $this->put('id_agen'); 
      	$data = array(
		'foto_tampak_depan_agen' => $this->put('foto_tampak_depan_agen'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		 
		
		if ($insert) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
    // tambah foto tampak seberang agen
    function update_foto_tampak_seberang_agen_put() {
		 
        $id_agen = $this->put('id_agen'); 
      	$data = array(
		'foto_tampak_seberang_agen' => $this->put('foto_tampak_seberang_agen'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		 
		
		if ($insert) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
    // tambah foto tampak kanan agen
    function update_foto_tampak_kanan_agen_put() {
		 
        $id_agen = $this->put('id_agen'); 
      	$data = array(
		'foto_tampak_kanan_agen' => $this->put('foto_tampak_kanan_agen'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		 
		
		if ($insert) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
    // tambah foto tampak kiri agen
    function update_foto_tampak_kiri_agen_put() {
		 
        $id_agen = $this->put('id_agen'); 
      	$data = array(
		'foto_tampak_kiri_agen' => $this->put('foto_tampak_kiri_agen'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		 
		
		if ($insert) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
    // update data agen
    function update_data_agen_put() {
        $id_agen = $this->put('id_agen'); 
      	$data = array(
			'id_agen' =>  $this->put('id_agen'),
			'agen_name' =>  $this->put('agen_name'),
			'status' =>  $this->put('status'),
			'agen_phone_number_1' =>  $this->put('agen_phone_number_1'),
			'agen_phone_number_2' =>  $this->put('agen_phone_number_2'),
			'agen_address' =>  $this->put('agen_address'),
			'agen_city' =>  $this->put('agen_city'),
			'agen_province' =>  $this->put('agen_province'),
			'longitude' =>  $this->put('longitude'),
			'latitude' =>  $this->put('latitude'),
			'terminal_id' =>  $this->put('terminal_id'),
			'no_unique_agen' =>  $this->put('no_unique_agen'),
			'virtual_account_number' =>  $this->put('virtual_account_number'),
			'virtual_account_name' =>  $this->put('virtual_account_name'), 
			'agen_operational_name' =>  $this->put('agen_operational_name'),
			'agen_operational_address' =>  $this->put('agen_operational_address'),
			'agen_nearest_branch' =>  $this->put('agen_nearest_branch'),
			'agen_type' =>  $this->put('agen_type'),
			'note' =>  $this->put('note'), 
			'date_of_submit_to_bca' =>  $this->put('date_of_submit_to_bca'), 
			'date_of_approve_or_reject_or_canceled' =>  $this->put('date_of_approve_or_reject_or_canceled'), 
			'last_edit_by' =>  $this->put('last_edit_by'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		
		if ($update) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
    // tambah foto agen
    function update_foto_agen_put() {
		 
        $id_agen = $this->put('id_agen'); 
      	$data = array(
		'foto_agen' => $this->put('foto_agen'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		 
		
		if ($update) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
    // tambah foto ktp agen
    function update_foto_ktp_put() {
		 
        $id_agen = $this->put('id_agen'); 
      	$data = array(
		'foto_ktp' => $this->put('foto_ktp'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		 
		
		if ($update) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
    // tambah foto form pengajuan agen
    function update_foto_form_pengajuan_agen_put() {
		 
        $id_agen = $this->put('id_agen'); 
      	$data = array(
		'foto_form_pengajuan_agen' => $this->put('foto_form_pengajuan_agen'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		 
		
		if ($update) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
    // tambah foto cover buku tabungan agen
    function update_foto_cover_buku_tabungan_put() {
		 
        $id_agen = $this->put('id_agen'); 
      	$data = array(
		'foto_cover_buku_tabungan' => $this->put('foto_cover_buku_tabungan'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		 
		
		if ($update) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
    // tambah foto npwp atau surat keterangan tidak punya
    function update_foto_npwp_atau_surat_keterangan_tidak_punya_put() {
		 
        $id_agen = $this->put('id_agen'); 
      	$data = array(
		'foto_npwp_atau_surat_keterangan_tidak_punya' => $this->put('foto_npwp_atau_surat_keterangan_tidak_punya'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		 
		
		if ($update) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
    // tambah foto surat keterangan usaha atau bapu
    function update_foto_surat_keterangan_usaha_atau_bapu_put() {
		 
        $id_agen = $this->put('id_agen'); 
      	$data = array(
		'foto_surat_keterangan_usaha_atau_bapu' => $this->put('foto_surat_keterangan_usaha_atau_bapu'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		 
		
		if ($update) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
    // tambah foto install mesin
    function update_foto_instalasi_mesin_agen_put() {
		 
        $id_agen = $this->put('id_agen'); 
      	$data = array(
		'foto_instalasi_mesin_agen' => $this->put('foto_instalasi_mesin_agen'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		 
		
		if ($update) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
    // tambah foto training agen
    function update_foto_training_agen_put() {
		 
        $id_agen = $this->put('id_agen'); 
      	$data = array(
		'foto_training_agen' => $this->put('foto_training_agen'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		 
		
		if ($update) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
    // tambah foto spanduk agen
    function update_foto_spanduk_agen_put() {
		 
        $id_agen = $this->put('id_agen'); 
      	$data = array(
		'foto_spanduk_agen' => $this->put('foto_spanduk_agen'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		 
		
		if ($update) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
    // tambah foto sertifikat agen
    function update_foto_sertifikat_agen_put() {
		 
        $id_agen = $this->put('id_agen'); 
      	$data = array(
		'foto_sertifikat_agen' => $this->put('foto_sertifikat_agen'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		 
		
		if ($update) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
    // tambah foto pks agen
    function update_foto_pks_agen_put() {
		 
        $id_agen = $this->put('id_agen'); 
      	$data = array(
		'foto_pks_agen' => $this->put('foto_pks_agen'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		 
		
		if ($update) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
    // tambah foto aktifasi agen
    function update_foto_aktifasi_agen_put() {
		 
        $id_agen = $this->put('id_agen'); 
      	$data = array(
		'foto_aktifasi_agen' => $this->put('foto_aktifasi_agen'));
					
		$this->db->where('id_agen', $id_agen);
        $update = $this->db->update('tbl_master_agen', $data);
		 
		
		if ($update) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
	
	// ambil data item agen header
    function get_agen_item_header_get() {
      $id_agen = $this->get('id_agen');
      	$query = $this->model_api->getDataItemAgenHeader($id_agen);
		if ($query) 
		{
			$this->response($query, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
	// show data item agen body
	function get_agen_item_get() {
        $id_agen = $this->get('id_agen');
		$query = $this->model_api->getDataItemAgen($id_agen);
		if ($query) 
		{
			$this->response($query, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
	
	// ambil data master level user
		function data_master_level_user_get() { 
            $user = $this->db->get('tbl_master_level_user')->result();
			$this->response($user, 200);
		}
	
	// ambil data master delivery service
		function data_master_delivery_service_get() { 
            $user = $this->db->get('tbl_master_delivery_service')->result();
			$this->response($user, 200);
		}
		
	// ambil data master agen type
		function data_master_agen_type_get() { 
            $user = $this->db->get('tbl_master_agen_type')->result();
			$this->response($user, 200);
		}
	
	// ambil data master status agen
		function data_master_status_agen_get() { 
            $user = $this->db->get('tbl_master_status_agen')->result();
			$this->response($user, 200);
		}
	
	// ambil data master kategori barang
		function data_master_category_get() { 
            $user = $this->db->get('tbl_master_category')->result();
			$this->response($user, 200);
		}
		
	// ambil data master user
		function data_master_user_get() { 
            $user = $this->db->get('tbl_master_user')->result();
			$this->response($user, 200);
		}
		
	// ambil data master agen
		function data_master_agen_get() { 
            $user = $this->db->get('tbl_master_agen')->result();
			$this->response($user, 200);
		}
		
		
	// ambil data nomor baru untuk user
		function get_id_user_get() { 
				$user = $this->model_api->getIDUser();
			$this->response($user, 200);
		}
	
	
    // tambah data user
    function add_user_post() {
      	$data = array( 
			'id_user'  => $this->post('id_user'),
			'level'  => $this->post('level'),
			'email'  => $this->post('email'),
			'username'  => $this->post('username'),
			'password' => $this->post('password'),
			'name'  => $this->post('name'),
			'id_agen' => $this->post('id_agen'),
			'status' => $this->post('status'),
			'tokencode' => $this->post('tokencode'),
			'date_create'  => $this->post('date_create'),
			'created'  => $this->post('created'));
					 
		$insert = $this->db->insert('tbl_master_user', $data);
		
		if ($insert) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
	
    // tambah delivery service
    function add_delivery_service_post() {
      	$data = array( 
			'delivery_service_name'  => $this->post('delivery_service_name'),
			'inputer'  => $this->post('inputer'));
					 
		$insert = $this->db->insert('tbl_master_delivery_service', $data);
		
		if ($insert) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
	
	
    // simpan edit delivery service
    function save_delivery_service_put() {
		
		$id_delivery_service = $this->put('id_delivery_service');
      	$data = array( 
			'id_delivery_service'  => $this->put('id_delivery_service'),
			'delivery_service_name'  => $this->put('delivery_service_name'),
			'last_edit_by'  => $this->put('last_edit_by'));
		
		$this->db->where('id_delivery_service', $id_delivery_service);
        $update = $this->db->update('tbl_master_delivery_service', $data);
		
		if ($update) 
		{
			$this->response($data, 200);
		} else 
		{
			$this->response(array('status' => 'fail', 502));
		}
	}
}
?>