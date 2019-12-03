<script>
var mins = 15 * 60;//10 menit logout otomatis jika tidak ada aktifitas
var active = setTimeout("warn()",(mins*1000));

function logout()
{
	location='<?php echo site_url('login/logout'); ?>';	
}

function warn()
{
	var stay = confirm('Sesion anda akan habis(selama 10 menit tidak ada aktifitas), tekan OK untuk lanjut.');	
	if(stay)
	{
		clearTimeout(active);
		mins = 15 * 60;
		active = setTimeout("logout()",(mins*1000));
	}
	else
	{
		logout();
	}
}
</script>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>Dashboard - Admin</title>

	<meta name="description" content="overview &amp; stats" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<link rel="icon" href="<?php echo base_url();?>assets/images/home2.png" type="image/x-icon" />
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/layout.css">-->
<link href="<?php echo base_url();?>assets/css/fonts/stylesheet.css" rel="stylesheet" type="text/css" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/4.1.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.custom.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace.min.css" id="main-ace-style" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/color.css"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dataTables.jqueryui.css"> 
	
	

	<script src="<?php echo base_url(); ?>assets/js/jquery-1.8.3.min.js" type="text/javascript"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/css/ckeditor/ckeditor.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.easyui.min.js"></script> 
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datagrid-detailview.js"></script>  
	<script src="<?php echo base_url(); ?>assets/js/ace-extra.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/time.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/js/sts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js" type="text/javascript"></script>    
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js" type="text/javascript"></script> 
<!-- <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.js" type="text/javascript"></script>  -->

  
   <script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.min.js"></script>

<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<!-- inline scripts related to this page -->

   
	
    <style>

		.preload-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1000;
    background-color:#000;opacity:0.4;filter:alpha(opacity=40);
}
#preloader_7 {
    display: block;
    position: relative;
    left: 50%;
    top: 50%;
    width: 150px;
    height: 150px;
    margin: -75px 0 0 -75px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #3498db;

    -webkit-animation: spin 2s linear infinite; /* Chrome, Opera 15+, Safari 5+ */
    animation: spin 2s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */

    z-index: 1001;
}

    #preloader_7:before {
        content: "";
        position: absolute;
        top: 5px;
        left: 5px;
        right: 5px;
        bottom: 5px;
        border-radius: 50%;
        border: 3px solid transparent;
        border-top-color: #e74c3c;

        -webkit-animation: spin 3s linear infinite; /* Chrome, Opera 15+, Safari 5+ */
        animation: spin 3s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */
    }

    #preloader_7:after {
        content: "";
        position: absolute;
        top: 15px;
        left: 15px;
        right: 15px;
        bottom: 15px;
        border-radius: 50%;
        border: 3px solid transparent;
        border-top-color: #f9c922;

        -webkit-animation: spin 1.5s linear infinite; /* Chrome, Opera 15+, Safari 5+ */
          animation: spin 1.5s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */
    }

    @-webkit-keyframes spin {
        0%   { 
            -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */
            -ms-transform: rotate(0deg);  /* IE 9 */
            transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */
        }
        100% {
            -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
            -ms-transform: rotate(360deg);  /* IE 9 */
            transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */
        }
    }
    @keyframes spin {
        0%   { 
            -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */
            -ms-transform: rotate(0deg);  /* IE 9 */
            transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */
        }
        100% {
            -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
            -ms-transform: rotate(360deg);  /* IE 9 */
            transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */
        }
    }

	</style>    

</head>

<body class="no-skin">
<!-- Preloader -->
	<script type="text/javascript">
	
$(window).load(function() { $(".preload-wrapper").fadeOut("slow"); });

$( window ).resize(function() {
      $('.easyui-datagrid').datagrid('resize');      
});


	</script>
<div class="preload-wrapper">
    <div id="preloader_7"></div>
 
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
	
</div>
<div id="navbar" class="navbar navbar-default navbar-fixed-top" >
<!--<script type="text/javascript">
	try{ace.settings.check('navbar' , 'fixed')}catch(e){}
</script>
-->
<div class="navbar-container" id="navbar-container">
<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
	<span class="sr-only">Toggle sidebar</span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</button>

<div class="navbar-header pull-left">
	<a href="#" class="navbar-brand">
		<small>
			<i class="fa fa-eye"></i>
			DINKES
		</small>
	</a>
</div>

<div class="navbar-buttons navbar-header pull-right" role="navigation">
<ul class="nav ace-nav">
<li class="light-blue">
	<a data-toggle="dropdown" href="#" class="dropdown-toggle">
		<img class="nav-user-photo" src="<?php echo base_url();?>assets/images/home2.png" alt="Photo" />
								<span class="user-info">
									<small>Welcome,<br/><?php echo $this->session->userdata('nama_lengkap');?></small>
								
								</span>

		<i class="ace-icon fa fa-caret-down"></i>
	</a>

	<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
		
		<li>
			<a href="<?php echo base_url();?>index.php/login/logout" id="logout" onClick="return confirm('Apakah Anda yakin akan keluar sistem?')">
				<i class="ace-icon fa fa-power-off"></i>
				Logout
			</a>
		</li>
        
	</ul>
</li>
</ul>
</div>

</div><!-- /.navbar-container -->
</div>

<div class="main-container " id="main-container">
<script type="text/javascript">
	try{ace.settings.check('main-container' , 'fixed')}catch(e){}
</script>

<div id="sidebar" class="sidebar responsive sidebar-fixed">
<!--<script type="text/javascript">
	try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
</script>
-->


<?php if ($level == "admin"){?>

<ul class="nav nav-list"><!-- Menu Sidebar -->
<li class="">
	<a href="<?php echo base_url();?>index.php/home">
		<i class="menu-icon fa fa-tachometer"></i>
		<span class="menu-text"> Dashboard </span>
	</a>
	<b class="arrow"></b>
</li>

<li class=""><!-- Data Master -->
	<a href="#" class="dropdown-toggle">
		<i class="menu-icon fa fa-cogs"></i>
		<span class="menu-text"> Data Master </span>
		<b class="arrow fa fa-angle-down"></b>
	</a>
	<b class="arrow"></b>

	<ul class="submenu">
		<li class=" ">
			<a href="<?php echo base_url();?>index.php/master">
				<i class="menu-icon fa fa-caret-right"></i>
				Data-data Master
			</a>
			<b class="arrow"></b>
		</li>
	</ul>
    
    
</li>


<li class=""><!-- Sarana dan Prasranan -->
	<a href="#" class="dropdown-toggle">
		<i class="menu-icon fa fa-credit-card"></i>
		<span class="menu-text"> Sarana & Prasarana </span>
		<b class="arrow fa fa-angle-down"></b>
	</a>
	<b class="arrow"></b>
	<ul class="submenu">
		

		<li class="">
			<a href="<?php echo base_url();?>index.php/kapling">
				<i class="menu-icon fa fa-caret-right"></i>
				Kapling Ruangan
			</a>

			<b class="arrow"></b>
		</li>

		
               
        </ul>
        </li>



<li class=""><!-- Logout -->
	<a href="<?php echo base_url();?>index.php/login/logout" onClick="return confirm('Apakah Anda yakin akan keluar sistem?')">
		<i class="menu-icon fa fa-external-link"></i>
		<span class="menu-text"> Log out </span>
	</a>
	<b class="arrow"></b>
</li>

</ul><!-- /.nav-list -->

<?php }else{?>

<ul class="nav nav-list"><!-- Menu Sidebar -->
<li class="">
	<a href="<?php echo base_url();?>index.php/home">
		<i class="menu-icon fa fa-tachometer"></i>
		<span class="menu-text"> Dashboard </span>
	</a>
	<b class="arrow"></b>
</li>

<li class="">
	<a href="<?php echo base_url();?>index.php/kapling">
		<i class="menu-icon fa fa-folder-open"></i>
		<span class="menu-text"> Kapling R.Rapat  </span>
	</a>
	<b class="arrow"></b>
</li>

<li class=""><!-- Logout -->
	<a href="<?php echo base_url();?>index.php/login/logout" onClick="return confirm('Apakah Anda yakin akan keluar sistem?')">
		<i class="menu-icon fa fa-external-link"></i>
		<span class="menu-text"> Log out </span>
	</a>
	<b class="arrow"></b>
</li>

</ul><!-- /.nav-list -->
<?php }?>


<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
	<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
</div>

<script type="text/javascript">
	try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
</script>
</div>

<div class="main-content">
<div class="breadcrumbs" id="breadcrumbs">
	<script type="text/javascript">
		try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
	</script>

	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="<?php echo base_url();?>index.php/home">Home</a>
		</li>
		<li class="active"><?php echo $judul; ?></li> 
	</ul><!-- /.breadcrumb -->
	
	<small>
	<i class="icon-double-angle-right"></i>
	<span id="dates"><span id="the-day">Hari, 00 Bulan 0000</span> <span id="the-time">00:00:00</span> </span>
	</small>
</div>


<div class="page-content">
<div class="ace-settings-container" id="ace-settings-container">
	<!-- <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
		<i class="ace-icon fa fa-cog bigger-150"></i>
	</div> -->

	<div class="ace-settings-box clearfix" id="ace-settings-box">
		<div class="pull-left width-50">
			<div class="ace-settings-item">
				<div class="pull-left">
					<select id="skin-colorpicker" class="hide">
						<option data-skin="skin-2" value="#C6487E">#C6487E</option>
						<option data-skin="skin-1" value="#222A2D">#222A2D</option>
						<option data-skin="no-skin" value="#438EB9">#438EB9</option>
						<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
					</select>
				</div>
				<span>&nbsp; Choose Skin</span>
			</div>

			<div class="ace-settings-item">
				<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
				<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
			</div>

			<div class="ace-settings-item">
				<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
				<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
			</div>

			<div class="ace-settings-item">
				<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
				<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
			</div>

			
			<div class="ace-settings-item">
				<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
				<label class="lbl" for="ace-settings-add-container">
					Inside
					<b>.container</b>
				</label>
			</div>
		</div><!-- /.pull-left -->

	<div class="pull-left width-50">
			<div class="ace-settings-item">
				<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
				<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
			</div>

			
		</div><!-- /.pull-left -->
	</div><!-- /.ace-settings-box -->
 </div><!-- /.ace-settings-container -->

<div class="page-content-area">


<div class="row">
<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS -->
<?php echo $content; ?>

<!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.page-content-area -->
</div><!-- /.page-content -->
</div><!-- /.main-content -->

<div class="footer footer-fixed">
	<div class="footer-inner">
		<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">DINKES</span>
							&copy; 2019
						</span>

			&nbsp; &nbsp;
						<span class="action-buttons">
							
						</span>
		</div>
	</div>
</div>

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
	<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>
</div>


</body>
</html>

