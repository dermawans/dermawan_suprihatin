<!DOCTYPE html>
<html lang="en" class="fixed"> 
 
<head>

<!-- Basic -->
<meta charset="utf-8"/>

<title><?php echo $title?></title>  
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>  

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- Web Fonts  -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

<!-- Vendor CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.css')?>" /> 

<!-- Theme CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/theme.css')?>" />

<!-- Skin CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/skins/default.css')?>" />

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/theme-custom.css')?>">

<!-- Head Libs -->
<script src="<?php echo base_url('assets/vendor/modernizr/modernizr.js')?>"></script>
</head>

<body>

		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="/" class="logo pull-left">
					<!--<img src="<?php echo base_url('assets/images/logo.png')?>" height="54" alt="Logo" />-->
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Reset Password</h2>
					</div>
					<div class="panel-body">
                    <!-- NOTIF -->
            <?php
					$berhasil = $this->session->flashdata('berhasil');
					$gagal = $this->session->flashdata('gagal');
					if($berhasil){
						echo '<p class="alert alert-info text-center">'.$berhasil .'</p>';
					}
					if($gagal){
						echo '<p class="alert alert-danger text-center">'.$gagal .'</p>';
					}
					?>
			<?php
            $message = $this->session->flashdata('notif');
            if($message){
                echo '<p class="alert alert-danger text-center">'.$message .'</p>';
            }?>
    					
						<?php echo form_open('forgotpass/reset','class="form-horizontal"'); ?> 
							<div class="form-group mb-lg">
								<div class="input-group input-group-icon">
									<input name="id_user" type="hidden" value="<?php echo $this->uri->segment(3); ?>" class="form-control input-lg" autofocus  required/>
                                    <input name="tokencode" type="hidden" value="<?php echo $this->uri->segment(4); ?>" class="form-control input-lg" autofocus  required/>
                                    <input name="newtokencode" type="hidden" value="<?php echo $this->uri->segment(4).date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ; ?>" class="form-control input-lg" autofocus  required/>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">New Password</label>  
								</div>
								<div class="input-group input-group-icon">
									<input name="password" type="password" class="form-control input-lg" required/>
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>
							                            
							<div class="form-group mb-lg">
								<div class="clearfix">
									<button type="submit" class="btn btn-primary hidden-xs">Reset</button> 
								</div>
							</div> 
						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2016.</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="<?php echo base_url('assets/vendor/jquery/jquery.js')?>"></script>
		<script src="<?php echo base_url('assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js')?>"></script>
		<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.js')?>"></script>  
		<script src="<?php echo base_url('assets/vendor/jquery-placeholder/jquery.placeholder.js')?>"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo base_url('assets/javascripts/theme.js')?>"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo base_url('assets/javascripts/theme.custom.js')?>"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo base_url('assets/javascripts/theme.init.js')?>"></script>

	</body>
</html>