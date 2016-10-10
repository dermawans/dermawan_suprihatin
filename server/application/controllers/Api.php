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
	
	// show data item in header
		function item_in_header_get() {
        $id_item_in = $this->get('id_item_in');
				$user = $this->model_api->getItemInHeader($id_item_in);
			$this->response($user, 200);
		}
	
	
	// show data item in data
		function item_in_data_get() {
        $id_item_in = $this->get('id_item_in');
				$user = $this->model_api->getItemInData($id_item_in);
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
	
}
?>