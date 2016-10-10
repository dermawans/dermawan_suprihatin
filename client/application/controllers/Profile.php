<?php
class Profile extends CI_Controller{
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
		
        $data=array('title'=>"Profile",
            'active_profile'=>"active");
		$params = array('id_user'=>  $this->session->userdata('id_user'));
		$data['user'] = json_decode($this->curl->simple_get($this->API.'/api/user',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		
		$this->load->view('element/v_header',$data);
        $this->load->view('pages/v_profile',$data);
        $this->load->view('element/v_footer');
    }
	
	function edit(){
		$data=array('title'=>"Dashboard User");
		$params = array('id_user'=> $this->uri->segment(3));
		$data['user'] = json_decode($this->curl->simple_get($this->API.'/api/user',$params));
		
		$this->load->view('element/v_header',$data);
        $this->load->view('pages/v_edit_user',$data);
        $this->load->view('element/v_footer');
    }
	
	
	function save(){
            $data = array(
                'id_user'   =>  $this->input->post('id_user'),
                'name' =>  $this->input->post('name'),
                'email'=>  $this->input->post('email'));
            $update =  $this->curl->simple_put($this->API.'/api/user', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update)
            {
                $this->session->set_flashdata('berhasil','Update Data Berhasil');
            }else
            {
               $this->session->set_flashdata('gagal','Update Data Gagal');
            }
            redirect('profile');
		
	}
	
	
	function changepassword(){
            $data = array(
                'id_user'   =>  $this->input->post('id_user'),
                'password' =>  md5($this->input->post('password')));
            $update =  $this->curl->simple_put($this->API.'/api/changepassword', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update)
            {
                $this->session->set_flashdata('berhasil','Perubahan Password Berhasil');
            }else
            {
               $this->session->set_flashdata('gagal','Perubahan Password Gagal');
            }
            redirect('profile');
		
	}
		 
	
		
}
