<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Colud</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="<?php echo base_url(); ?>assets/vendor/css/robotfont.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
	
    <link href="<?php echo base_url(); ?>assets/vendor/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/vendor/css/bootstrapValidator.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/vendor/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url(); ?>assets/vendor/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url(); ?>assets/vendor/plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/vendor/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url(); ?>assets/vendor/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/css/custom.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url(); ?>assets/vendor/css/themes/all-themes.css" rel="stylesheet" />
	 <script src="<?php echo base_url(); ?>assets/vendor/plugins/jquery/jquery.min.js"></script>
	 <link href="<?php echo base_url(); ?>assets/vendor/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="theme-red">
    
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?php echo base_url(); ?>">CLOUD-LOGO</a>
            </div>
			<?php if($this->session->flashdata('success')): ?>
				<div class="alert_msg1 animated slideInUp bg-succ">
				<?php echo $this->session->flashdata('success');?> &nbsp; <i class="glyphicon glyphicon-ok text-success ico_bac" aria-hidden="true"></i>
				</div>
			<?php endif; ?>
			<?php if($this->session->flashdata('error')): ?>
				<div class="alert_msg1 animated slideInUp bg-warn">
				<?php echo $this->session->flashdata('error');?> &nbsp; <i class="glyphicon glyphicon-ok text-success ico_bac" aria-hidden="true"></i>
				</div>
			<?php endif; ?>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-left m-l-100">
                    <!-- Call Search -->
					<li class="dropdown" >
                        <a href="javascript:void(0);" class="dropdown-toggle btn btn-blue-grey " data-toggle="dropdown" role="button">
                            Upload <span class="caret"></span>
                        </a>
						
						<ul class="dropdown-menu ">
							<li class="fileUpload">
							<a href="javascript:void(0);"><i class="material-icons">file_upload</i>
							<form id="imageadd" name="imageadd" action="<?php echo base_url('dashboard/filepost'); ?>" method="post" enctype="multipart/form-data">
							<?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
								<input type="hidden" name="pageid" value="<?php echo isset($page_id)?$page_id:'0'; ?>" />
								<input type="hidden" name="floderid" value="<?php echo isset($floder_id)?$floder_id:'0'; ?>" />
							
							<span type="file">File Upload</span>
							<input type="file" name="file" id="file" class="upload" onchange="file_upload()" />
							</form>
							</a>
							</li>
							<li role="seperator" class="divider"></li>
							<li class="fileUpload">
							<a href="javascript:void(0);"><i class="material-icons">folder</i><span>Folder Upload </span>
								<form id="multiimageadd" name="multiimageadd" action="<?php echo base_url('dashboard/multifilepost'); ?>" method="post" enctype="multipart/form-data">
								<?php $csrf = array(
											'name' => $this->security->get_csrf_token_name(),
											'hash' => $this->security->get_csrf_hash()
									); ?>
									<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
								<input type="hidden" name="pageid" value="<?php echo isset($page_id)?$page_id:'0'; ?>" />
								<input type="hidden" name="floderid" value="<?php echo isset($floder_id)?$floder_id:'0'; ?>" />
							
								   <input type="file" name="file[]" id="file" class="upload" onchange="multifile_upload()"  multiple="" directory="" webkitdirectory="" mozdirectory="">
								</form>
							</a>
							</li>
							
						</ul>
                    </li>
					<li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle btn btn-blue-grey" data-toggle="dropdown" role="button">
                            New <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li data-toggle="modal" data-target="#smallModal"><a ><i class="material-icons">folder</i>Folder</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">assignment</i>Doc</a></li>
							<li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">view_module</i>Excel</a></li>	
							<li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">style</i>
							PPT etc</a></li>
                            
                        </ul>
                    </li>
					<li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle btn btn-blue-grey" data-toggle="dropdown" role="button">
                            Upgrade Account </span>
                        </a>
                        
                    </li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy Doe</b> deleted account</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy</b> changed name</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> commented your post</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 4 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> updated status</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Settings updated</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Yesterday
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    
					<li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">person</i>
                            
                        </a>
                       
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?php echo base_url('profile'); ?>"><i class="material-icons">person</i>Personal Account</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">settings</i>Settings</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">open_in_browser</i>Upgrade</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">live_help</i>Help</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="<?php echo base_url('cloud/logout'); ?>"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
		<form id="createfloder" name="createfloder" action="<?php echo base_url('dashboard/flodername'); ?>" method="post">
			<?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
			<input type="hidden" name="pageid" value="<?php echo isset($page_id)?$page_id:0; ?>" />
			<input type="hidden" name="floderid" value="<?php echo isset($floder_id)?$floder_id:0; ?>" />
			<div class="modal-header">
				<h4 class="modal-title" id="smallModalLabel">Folder Name</h4>
			</div>
			<div class="modal-body">
			    <div class="form-group">
					<div class="form-line">
						<input type="text" id="flodername" name="flodername" class="form-control" placeholder="Create Folder Name" />
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-link waves-effect">SAVE </button>
				<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
			</div>
			</form>
		</div>
	</div>
</div>

<script>

function file_upload(){
	 document.getElementById("imageadd").submit();
	
}function multifile_upload(){
	 document.getElementById("multiimageadd").submit();
	
}
$(document).ready(function() {
    $('#createfloder').bootstrapValidator({
        
        fields: {
            flodername: {
               validators: {
					notEmpty: {
						message: 'Floder Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Name can only consist of alphanumaric, space and dot'
					}
				}
            }
            }
        })
     
	});
</script>
