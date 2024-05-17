<?php
session_start();
error_reporting(0);
include "timeout.php";

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==0){
  header('location:logout.php');
}
else{
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<link href=css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}

    else{

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Adaro System</title>

		<meta name="description" content="Static &amp; Dynamic Tables" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

	<body>
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="#" class="brand">
						<small>
							<i class="icon-leaf"></i>
							ADARO System
						</small>
					</a><!--/.brand-->

					<ul class="nav ace-nav pull-right">
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
								<?php echo $_SESSION[namalengkap] ?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li class="divider"></li>
								<li>
									<a href="logout.php">
										<i class="icon-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<div class="sidebar" id="sidebar"> <?php    if ($_SESSION[leveluser]=='admin'){ ?>
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<a href="?module=info"><button class="btn btn-small btn-success">
							<i class="icon-bell"></i>
						</button></a>

						<a href="?module=surat_masuk"><button class="btn btn-small btn-info">
							<i class="icon-pencil"></i>
						</button></a>

						<a href="?module=admin&act=pegawai"><button class="btn btn-small btn-warning">
							<i class="icon-group"></i>
						</button></a>

						<a href="?module=kategori"><button class="btn btn-small btn-danger">
							<i class="icon-cogs"></i>
						</button></a>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!--#sidebar-shortcuts-->
<?php }?>
				<ul class="nav nav-list">
                 <li>
						<a href="?module=home">
							<i class="icon-dashboard"></i>
							<span class="menu-text"> Beranda</span>
						</a>
					</li>
            <?php    if ($_SESSION[leveluser]=='admin'){ ?>
                <li>
						<a href="?module=admin">
							<i class="icon-lock"></i>
							<span class="menu-text"> Administrator</span>
						</a>
					</li>
					
					<li>
						<a href="?module=admin&act=pegawai">
							<i class="icon-group"></i>
							<span class="menu-text"> Pegawai</span>
						</a>
					</li> <?php }?>
                    <li>
						<a href="?module=kategori">
							<i class="icon-flag"></i>
							<span class="menu-text"> Kategori</span>
						</a>
					</li>
                    <li>
						<a href="?module=rak">
							<i class="icon-folder-open"></i>
							<span class="menu-text"> Rak</span>
						</a>
					</li>
						<li>
						<a href="?module=surat_masuk">
							<i class="icon-edit"></i>
							<span class="menu-text"> Surat Masuk </span>

							
						</a>

						
					
						<li>
						<a href="?module=surat_keluar" >
							<i class="icon-edit"></i>
							<span class="menu-text"> Surat Keluar </span>

							
						</a>

						
                    
                    
                     <li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-book"></i>
							<span class="menu-text"> Laporan </span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href="?module=laporan_surat_masuk">
									<i class="icon-double-angle-right"></i>
									Surat Masuk
								</a>
							</li>
                            <li>
								<a href="?module=laporan_surat_keluar">
									<i class="icon-double-angle-right"></i>
									Surat Keluar
								</a>
							</li>
                            </ul>
					</li>
                    
                    
                    
					<li>
						<a href="?module=info">
							<i class="icon-bell"></i>
							<span class="menu-text"> Informasi</span>
						</a>
					</li>
				</ul><!--/.nav-list-->

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li></li>
					</ul><!--.breadcrumb-->
				  <!--#nav-search-->
			  </div>
				<div class="page-content">
				  <!--/.page-header-->
<div class="row-fluid">
<div class="span12">
							<!--PAGE CONTENT BEGINS-->
							<!--/row-->
		  <div class="row-fluid">
								<h3 class="header smaller lighter blue">
								  <?php include "content_admin.php"; ?>
</h3>
		  </div>

							<div id="modal-table" class="modal hide fade" tabindex="-1">
								<div class="modal-header no-padding">
									<div class="table-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										Results for "Latest Registered Domains"
									</div>
								</div>

								

								<div class="modal-footer">
									<button class="btn btn-small btn-danger pull-left" data-dismiss="modal">
										<i class="icon-remove"></i>
										Close
									</button>

									<div class="pagination pull-right no-margin">
										<ul>
											<li class="prev disabled">
												<a href="#">
													<i class="icon-double-angle-left"></i>
												</a>
											</li>

											<li class="active">
												<a href="#">1</a>
											</li>

											<li>
												<a href="#">2</a>
											</li>

											<li>
												<a href="#">3</a>
											</li>

											<li class="next">
												<a href="#">
													<i class="icon-double-angle-right"></i>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div><!--PAGE CONTENT ENDS-->
	    </div><!--/.span-->
				  </div><!--/.row-fluid-->
	      </div><!--/.page-content-->
		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>

		<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
                    "aaSorting":[[0, "asc"]],
                });
            })
			
		</script>
	</body>
</html>
<?php
}
}

?>