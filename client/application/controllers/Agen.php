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
			$insert1 =  $this->curl->simple_post($this->API.'/api/save_new_agen', $data, array(CURLOPT_BUFFERSIZE => 10)); 
			if($insert1)
			{
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
			$insert2 =  $this->curl->simple_put($this->API.'/api/update_foto_tampak_depan_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10)); 					}
			} 
				if($insert2)
				{
				//fungsi upload foto tampak depan
				$this->load->library('upload');
				$name=$this->input->post('agen_name');
				$operational_name=$this->input->post('agen_operational_name');
				$agen_city=$this->input->post('agen_city');
				$agen_province=$this->input->post('agen_province');
				$sales=$this->session->userdata('name');
				$nmfile = $agen_city."-".$agen_province."-Tampak Seberang Agen-".$operational_name."-".$name."-".$sales;  
				$config['upload_path'] = 'assets/foto/'; 
				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';  
				$config['file_name'] = $nmfile; 
		 
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
				$insert3 =  $this->curl->simple_put($this->API.'/api/update_foto_tampak_seberang_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10)); 					}
				} 
					if($insert3)
					{			
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
					$insert4 =  $this->curl->simple_put($this->API.'/api/update_foto_tampak_kanan_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
						}
					} 
						if($insert4)
						{	
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
						$insert5 =  $this->curl->simple_put($this->API.'/api/update_foto_tampak_kiri_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
							}
						}  
							if($insert5)
							{
								$this->session->set_flashdata('berhasil','Data berhasil disimpan');
							}	
							else
							{
								$this->session->set_flashdata('gagal','Data foto tampak kiri gagal disimpan');
							}
						}	
						else
						{
							$this->session->set_flashdata('gagal','Data foto tampak kanan gagal disimpan');
						}
					}
					else
					{
						$this->session->set_flashdata('gagal','Data foto tampak seberang gagal disimpan');
					}
				}	 
				else
				{
					$this->session->set_flashdata('gagal','Data foto tampak depan gagal disimpan');
				} 	
			}
			else
			{
				$this->session->set_flashdata('gagal','Data agen gagal disimpan');
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
			$insert1 =  $this->curl->simple_put($this->API.'/api/update_data_agen', $data, array(CURLOPT_BUFFERSIZE => 10));
			if($insert1)
			{
			//fungsi upload foto foto agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$operational_name=$this->input->post('agen_operational_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('name');
			$nmfile = $agen_city."-".$agen_province."-Foto Agen".$operational_name."-".$name."-".$sales; 
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
				$insert2 =  $this->curl->simple_put($this->API.'/api/update_foto_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
				}
			} 
				if($insert2)
				{
				//fungsi upload foto ktp agen
				$this->load->library('upload');
				$name=$this->input->post('agen_name');
				$operational_name=$this->input->post('agen_operational_name');
				$agen_city=$this->input->post('agen_city');
				$agen_province=$this->input->post('agen_province');
				$sales=$this->session->userdata('name');
				$nmfile = $agen_city."-".$agen_province."-Foto KTP Agen".$operational_name."-".$name."-".$sales; 
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
				$insert3 =  $this->curl->simple_put($this->API.'/api/update_foto_ktp', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
					}
				} 
					if($insert3)
					{			
					//fungsi upload foto form pengajuan agen
					$this->load->library('upload');
					$name=$this->input->post('agen_name');
					$operational_name=$this->input->post('agen_operational_name');
					$agen_city=$this->input->post('agen_city');
					$agen_province=$this->input->post('agen_province');
					$sales=$this->session->userdata('name');
					$nmfile = $agen_city."-".$agen_province."-Foto Form Pengajuan Agen".$operational_name."-".$name."-".$sales; 
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
						$insert4 =  $this->curl->simple_put($this->API.'/api/update_foto_form_pengajuan_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
						}
					}	
						if($insert4)
						{
						//fungsi upload foto cover buku tabungan agen
						$this->load->library('upload');
						$name=$this->input->post('agen_name');
						$operational_name=$this->input->post('agen_operational_name');
						$agen_city=$this->input->post('agen_city');
						$agen_province=$this->input->post('agen_province');
						$sales=$this->session->userdata('name');
						$nmfile = $agen_city."-".$agen_province."-Foto Cover Buku Tabungan Agen".$operational_name."-".$name."-".$sales; 
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
							$insert5 =  $this->curl->simple_put($this->API.'/api/update_foto_cover_buku_tabungan', $datafoto, array(CURLOPT_BUFFERSIZE => 10)); 
							}
						}
							if($insert5)
							{
							//fungsi upload foto npwp atau surat keterangan
							$this->load->library('upload');
							$name=$this->input->post('agen_name');
							$operational_name=$this->input->post('agen_operational_name');
							$agen_city=$this->input->post('agen_city');
							$agen_province=$this->input->post('agen_province');
							$sales=$this->session->userdata('name');
							$nmfile = $agen_city."-".$agen_province."-Foto NPWP atau Surat Keterangan Tidak Punya Agen".$operational_name."-".$name."-".$sales; 
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
								$insert6 =  $this->curl->simple_put($this->API.'/api/update_foto_npwp_atau_surat_keterangan_tidak_punya', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
								}
							 }	
								if($insert6)
								{
								//fungsi upload foto surat keterangan usaha atau bapu
								$this->load->library('upload');
								$name=$this->input->post('agen_name');
								$operational_name=$this->input->post('agen_operational_name');
								$agen_city=$this->input->post('agen_city');
								$agen_province=$this->input->post('agen_province');
								$sales=$this->session->userdata('name');
								$nmfile = $agen_city."-".$agen_province."-Foto Surat Keterangan Usaha atau BAPU Agen".$operational_name."-".$name."-".$sales; 
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
									$insert7 =  $this->curl->simple_put($this->API.'/api/update_foto_surat_keterangan_usaha_atau_bapu', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
									}
								}	
									if($insert7)
									{
									 //fungsi upload foto instalasi mesin agen
									$this->load->library('upload');
									$name=$this->input->post('agen_name');
									$operational_name=$this->input->post('agen_operational_name');
									$agen_city=$this->input->post('agen_city');
									$agen_province=$this->input->post('agen_province');
									$sales=$this->session->userdata('name');
									$nmfile = $agen_city."-".$agen_province."-Foto Instalasi Agen".$operational_name."-".$name."-".$sales; 
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
										$insert8 =  $this->curl->simple_put($this->API.'/api/update_foto_instalasi_mesin_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
										}
									}
										if($insert8)
										{
										//fungsi upload foto training agen
										$this->load->library('upload');
										$name=$this->input->post('agen_name');
										$operational_name=$this->input->post('agen_operational_name');
										$agen_city=$this->input->post('agen_city');
										$agen_province=$this->input->post('agen_province');
										$sales=$this->session->userdata('name');
										$nmfile = $agen_city."-".$agen_province."-Foto Training Agen".$operational_name."-".$name."-".$sales; 
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
											$insert9 =  $this->curl->simple_put($this->API.'/api/update_foto_training_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
											}
										}	
											if($insert9)
											{
											//fungsi upload foto spanduk agen
											$this->load->library('upload');
											$name=$this->input->post('agen_name');
											$operational_name=$this->input->post('agen_operational_name');
											$agen_city=$this->input->post('agen_city');
											$agen_province=$this->input->post('agen_province');
											$sales=$this->session->userdata('name');
											$nmfile = $agen_city."-".$agen_province."-Foto Spanduk Agen".$operational_name."-".$name."-".$sales; 
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
												$insert10 =  $this->curl->simple_put($this->API.'/api/update_foto_spanduk_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
												}
											} 
												if($insert10)
												{
												//fungsi upload foto sertifikat agen
												$this->load->library('upload');
												$name=$this->input->post('agen_name');
												$operational_name=$this->input->post('agen_operational_name');
												$agen_city=$this->input->post('agen_city');
												$agen_province=$this->input->post('agen_province');
												$sales=$this->session->userdata('name');
												$nmfile = $agen_city."-".$agen_province."-Foto Spanduk Agen".$operational_name."-".$name."-".$sales; 
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
													$insert11 =  $this->curl->simple_put($this->API.'/api/update_foto_sertifikat_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
													}
												}
													if($insert11)
													{
													//fungsi upload foto pks agen
													$this->load->library('upload');
													$name=$this->input->post('agen_name');
													$operational_name=$this->input->post('agen_operational_name');
													$agen_city=$this->input->post('agen_city');
													$agen_province=$this->input->post('agen_province');
													$sales=$this->session->userdata('name');
													$nmfile = $agen_city."-".$agen_province."-Foto PKS Agen".$operational_name."-".$name."-".$sales; 
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
														$insert12 =  $this->curl->simple_put($this->API.'/api/update_foto_pks_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
														}
													} 
														if($insert12)
														{
														//fungsi upload foto aktifasi agen
														$this->load->library('upload');
														$name=$this->input->post('agen_name');
														$operational_name=$this->input->post('agen_operational_name');
														$agen_city=$this->input->post('agen_city');
														$agen_province=$this->input->post('agen_province');
														$sales=$this->session->userdata('name');
														$nmfile = $agen_city."-".$agen_province."-Foto Aktifasi Agen".$operational_name."-".$name."-".$sales; 
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
															$insert13 =  $this->curl->simple_put($this->API.'/api/update_foto_aktifasi_agen', $datafoto, array(CURLOPT_BUFFERSIZE => 10));
															}
														} 	
															if($insert12)
															{
																$this->session->set_flashdata('berhasil','Data berhasil disimpan');
															}	
															else
															{
																$this->session->set_flashdata('gagal','Data foto aktifasi gagal disimpan');
															}
														}	
														else
														{
															$this->session->set_flashdata('gagal','Data foto pks gagal disimpan');
														}
													}	
													else
													{
														$this->session->set_flashdata('gagal','Data foto sertifikat gagal disimpan');
													}
												}	
												else
												{
													$this->session->set_flashdata('gagal','Data foto spanduk gagal disimpan');
												}
											}	
											else
											{
												$this->session->set_flashdata('gagal','Data foto training gagal disimpan');
											}
										}	
										else
										{
											$this->session->set_flashdata('gagal','Data foto instalasi gagal disimpan');
										}
									}	
									else
									{
										$this->session->set_flashdata('gagal','Data foto surat keterangan usaha atau bapu gagal disimpan');
									}
								}	
								else
								{
									$this->session->set_flashdata('gagal','Data foto npwp atau surat keterangan tidak punya gagal disimpan');
								}
							}	
							else
							{
								$this->session->set_flashdata('gagal','Data foto cover buku tabungan gagal disimpan');
							}
						}	
						else
						{
							$this->session->set_flashdata('gagal','Data foto form pengajuan agen gagal disimpan');
						}
					}	
					else
					{
						$this->session->set_flashdata('gagal','Data foto ktp gagal disimpan');
					}
				}
				else
				{
					$this->session->set_flashdata('gagal','Data foto agen gagal disimpan');
				}
						
			}
			else
			{
				$this->session->set_flashdata('gagal','Data agen gagal disimpan');
			}	
			
			header('location:'.base_url().'agen');
	}
		
	function view_agen_item(){
	
		$data=array('title'=>"View Agent Item",
            'active_agen_list'=>"active"
			);
		$params = array('id_user'=>  $this->session->userdata('id_user'),'id_agen'=>  $this->input->post('id_agen')); 
		$data['agen_item_header'] = json_decode($this->curl->simple_get($this->API.'/api/get_agen_item_header',$params));  
		$data['agen_item'] = json_decode($this->curl->simple_get($this->API.'/api/get_agen_item',$params));  
		$data['jumlah_item_in'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_in',$params));
		$data['jumlah_item_out'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item_out',$params));
		$data['jumlah_item'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_item',$params));
		$data['jumlah_agen'] = json_decode($this->curl->simple_get($this->API.'/api/jumlah_agen',$params));
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_view_agen_item',$data);
        $this->load->view('element/v_footer');
	}
}
