<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller

{
	var $API ="";
	
    function __construct(){
        parent::__construct(); 
		$this->API="http://localhost/dermawan_suprihatin/server";
    }

    function index(){
        $data=array(
			'title'=>"Registration Page");
        $this->load->view('pages/v_daftar',$data);
    }
	
	 // insert data mahasiswa
    function daftar(){
			$data = array(
			'userID' =>  "",
			'userName' =>  $this->input->post('userName'),
			'userEmail'=>  $this->input->post('userEmail'),
			'userPass' =>  md5($this->input->post('userPass')),
			'userStatus' => "N",
			'tokenCode' => md5($this->input->post('userEmail').$this->input->post('date')),
			'date_create'=>  $this->input->post('date'));
            $insert =  $this->curl->simple_post($this->API.'/api/daftar', $data, array(CURLOPT_BUFFERSIZE => 10)); 
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
					
					$encrypted_id = md5($this->input->post('userEmail').$this->input->post('date'));	
					$email = $this->input->post('userEmail');   
					$name = $this->input->post('userName');   
					$encrypted_email = md5($this->input->post('userEmail'));
					
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
               $this->session->set_flashdata('gagal','Registration Failed / Email already registered');
            }
            redirect('daftar');
	}
	
	
	public function verifikasi()
	{
		  $data = array( 
                'tokenCode'  => $this->uri->segment(4),
                'NewtokenCode'  => md5($this->uri->segment(3).date("Y-m-d H:i:s")),
                'userStatus' =>  "Y");
            $update =  $this->curl->simple_put($this->API.'/api/verifikasi', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update)
            {
                $this->session->set_flashdata('berhasil','Selamat akun anda sudah diverifikasi');
            }else
            {
               $this->session->set_flashdata('gagal','Gagal Verifikasi');
            }
            redirect('login');
	}
	
}
