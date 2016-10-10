<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller

{
	var $API ="";
	
    function __construct(){
        parent::__construct(); 
		$this->API="http://localhost/dermawan_suprihatin/server";
    }

    function index(){
        $data=array(
			'title'=>"Login Page");
        $this->load->view('pages/v_login',$data);
    }
	
    // edit data mahasiswa
    function cek_login(){
        	
            $params = array('email'=>  $this->input->post('email'),'password'=>  $this->input->post('password'));
            $data['user'] = json_decode($this->curl->simple_get($this->API.'/api/login',$params));
						foreach($data['user'] as $row) {
						//create the session
						if($row->email<>"")
						{
							$sess_array = array(
								'id_user' => $row->id_user,
								'email'=>$row->email,
								'name' => $row->name,
								'level' => $row->level,
								'login_status'=>true
							);
							
							//set session with value from database
							$this->session->set_userdata($sess_array);
							redirect('dashboard','refresh');
						}
						else
						{
							$this->session->set_flashdata('notif',$row->pesan);
            				redirect('');
						}
					}
			
			
			}
    
	
    function logout() {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('login_status');
        $this->session->set_flashdata('notif','Logout Berhasil');
        redirect('login');
    }
}
