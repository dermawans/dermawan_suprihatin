<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpass extends CI_Controller

{
	var $API ="";
	
    function __construct(){
        parent::__construct(); 
		$this->API="http://localhost/dermawan_suprihatin/server";
    }

    function index(){
        $data=array(
			'title'=>"Forgot Password");
        $this->load->view('pages/v_forgotpass',$data);
    }
	
	 // insert data mahasiswa
    function sendpass(){
	   $data = array(
            'email'=>  $this->input->post('email'));
			$cekmail = json_decode($this->curl->simple_get($this->API.'/api/cekemailfp',$data)); 
			if($cekmail)
			{
				foreach ($cekmail as $row)
					{	$id_user=$row->id_user;
						$tokencode=$row->tokencode;
					}
				
           
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
						
					$email = $this->input->post('email');   
					$token = $tokencode;  
					$abc = $id_user;
					
					$this->email->to($email);
					$this->email->subject("Forgot Password");
					$this->email->message(
						"					
						Hello , $email
					   <br /><br />
					   We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore this email,
					   <br /><br />
					   Click Following Link To Reset Your Password 
					   <br /><br />
					   <a href='".site_url("forgotpass/resetpin/$abc/$token")."'>click here to reset your password</a>
					   <br /><br />
					   thank you :)
						"
					);
					
					if($this->email->send())
					{
					$this->session->set_flashdata('berhasil','We have sent an email to '.$email.'.<br>
                    Please click on the password reset link in the email to generate new password. ');
					}else
					{
						$this->session->set_flashdata('gagal','Failed');
					}
					redirect('forgotpass');
			}
			else
			{
		            $this->session->set_flashdata('gagal','Email not registered');
            		redirect('forgotpass');
            }
	}
	
	
	public function resetpin()
	{
		  $data = array( 
                'title' =>  "Reset PIN" );
            $this->load->view('pages/v_resetpin',$data);
	}
	
	
	 // insert data mahasiswa
    function reset(){
	   $data = array(
            'id_user'=>  $this->input->post('id_user'),
            'tokencode'=>  $this->input->post('tokencode'));
			$cektoken = json_decode($this->curl->simple_get($this->API.'/api/cektoken',$data)); 
			if($cektoken)
			{
				$data = array(
                'id_user'   =>  $this->input->post('id_user'),
                'password' =>  md5($this->input->post('password')),
                'newtokencode' =>  md5($this->input->post('newtokencode')));
				$update =  $this->curl->simple_put($this->API.'/api/resetpassword', $data, array(CURLOPT_BUFFERSIZE => 10)); 
				if($update)
				{
					$this->session->set_flashdata('berhasil','Password change success');
				}else
				{
				   $this->session->set_flashdata('gagal','Password change failed');
				}
				redirect('login');
			}
			else
			{
				$this->session->set_flashdata('gagal','Wrong token code');
				redirect('login');
            }
	}
	
}
