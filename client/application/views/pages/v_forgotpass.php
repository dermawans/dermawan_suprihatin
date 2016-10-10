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
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Forgot Password</h2>
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
    					
						<?php echo form_open('forgotpass/sendpass','class="form-horizontal"'); ?> 
							<div class="form-group mb-none">
								<div class="input-group">
									<input name="email" type="email" placeholder="E-mail" class="form-control input-lg" required/>
									<span class="input-group-btn">
										<button class="btn btn-primary btn-lg" type="submit">Reset!</button>
									</span>
								</div>
							</div>
							<hr>
							<p class="text-center mt-lg">Remembered? <a href="<?php echo site_url('login')?>">Sign In!</a>
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
		
		<!-- Specific Page Vendor -->
		<script src="<?php echo base_url('assets/vendor/jquery-validation/jquery.validate.js')?>"></script>
        
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo base_url('assets/javascripts/theme.js')?>"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo base_url('assets/javascripts/theme.custom.js')?>"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo base_url('assets/javascripts/theme.init.js')?>"></script>

	</body>
</html>