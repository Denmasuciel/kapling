
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title><?php echo $nama_program; ?></title>
	<link rel="icon" href="<?php echo base_url();?>assets/images/home2.png" type="image/x-icon" />
	<meta name="description" content="User login page" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.1.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.css" />
	<!-- text fonts -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/fonts.googleapis.com.css" />
	<!-- ace styles -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />
</head>

<body class="login-layout dark-login" OnLoad="document.login.username.focus();">
<div class="main-container">
<div class="main-content">
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<div class="login-container">
<div class="center">
	<h1>
		<i class="ace-icon fa fa-eye green"></i>
		<span class="red">Aplikasi R.Rapat</span><!-- <span class="white">&nbsp;&nbsp;DINKES GK</span> -->	
    </h1>
	<span class="white"><h5>DINKES GK</h5></span></div>

<div class="space-6"></div>
<div id="loading" style="text-align: center"></div>
<div class="position-relative">
	<div id="login-box" class="login-box visible widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<h5 class="header blue lighter bigger">
					<i class="ace-icon fa fa-coffee green"></i>
					Masukkan username dan password
				</h5>

						<div class="space-6"></div>
   			<?php echo form_open('login/index'); ?>
				<form name="form" id="loginF" method="post" action="" class="form-horizontal">
            	<fieldset>
					<?php 
                    $message = $this->session->flashdata('result_login');
                    echo $message == '' ? '' : '<p id="message">' . $message . '</p>';
                   ?>
						<div class="form-group">
						<label class="block clearfix">
							<span class="block input-icon input-icon-right">
								<?php echo form_input($username,set_value('username')); ?>
                   				<i class="ace-icon fa fa-user"></i>
                		    </span>		
            			</label>
						</div>
						
						<div class="form-group">
						<label class="block clearfix">
														<span class="block input-icon input-icon-right">
								<?php echo form_input($password); ?>
															<i class="ace-icon fa fa-lock"></i>														</span>						</label>
						</div>
						
						<div class="space"></div>

						<div class="clearfix">
						
							<div class="form-group">						
							<button class="width-35 pull-right btn btn-sm btn-primary">
								<i class="ace-icon fa fa-key"></i>
								<span class="bigger-110">Login</span>							
                                </button>
							<div>						</div>

						<div class="space-4"></div>
					</fieldset>
				</form>
           

<?php echo form_close(); ?>


				<h4 class="blue">&copy;Dinkes 2019</h4>
					</div><!-- /.widget-main -->

			<div class="toolbar clearfix">
				<div>
			    </div>

				<div>
					</div>
			</div>
		</div><!-- /.widget-body -->
	</div><!-- /.login-box -->
	




<!-- <div class="navbar-fixed-top align-right">
	<br />
	&nbsp;
	<a id="btn-login-dark" href="#">Dark</a>
	&nbsp;
	<span class="blue">/</span>
	&nbsp;
	<a id="btn-login-blur" href="#">Blur</a>
	&nbsp;
	<span class="blue">/</span>
	&nbsp;
	<a id="btn-login-light" href="#">Light</a>
&nbsp;&nbsp;&nbsp;</div> -->
</div>
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.main-content -->
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script src="<?php echo base_url();?>assets/js/jquery.2.1.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>

<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

<!--[if IE]>
<script type="text/javascript">
	window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {
		$(document).on('click', '.toolbar a[data-target]', function(e) {
			e.preventDefault();
			var target = $(this).data('target');
			$('.widget-box.visible').removeClass('visible');//hide others
			$(target).addClass('visible');//show target
		});
	});

	
	


	//you don't need this, just used for changing background
	jQuery(function($) {
		$('#btn-login-dark').on('click', function(e) {
			$('body').attr('class', 'login-layout');
			$('#id-text2').attr('class', 'white');
			$('#id-company-text').attr('class', 'blue');

			e.preventDefault();
		});
		$('#btn-login-light').on('click', function(e) {
			$('body').attr('class', 'login-layout light-login');
			$('#id-text2').attr('class', 'grey');
			$('#id-company-text').attr('class', 'blue');

			e.preventDefault();
		});
		$('#btn-login-blur').on('click', function(e) {
			$('body').attr('class', 'login-layout blur-login');
			$('#id-text2').attr('class', 'white');
			$('#id-company-text').attr('class', 'light-blue');

			e.preventDefault();
		});

	});
</script>
</body>
</html>
