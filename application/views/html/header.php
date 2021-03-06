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
			<?php if(validation_errors()):?>
				<div class="alert_msg1 animated slideInUp bg-warn">
				<?php echo validation_errors(); ?> &nbsp; <i class="glyphicon glyphicon-ok text-success ico_bac" aria-hidden="true"></i>
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
					<?php if(isset($notofication_list) && count($notofication_list)>0){ ?>
								<li class="dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
										<i class="material-icons">notifications</i>
										<span class="label-count"><?php if(isset($notofication_uread_count['unreadcount']) && $notofication_uread_count['unreadcount']>0){ ?><?php echo $notofication_uread_count['unreadcount']; ?><?php } ?></span>
									</a>
									<ul class="dropdown-menu">
										<li class="header">NOTIFICATIONS</li>
										<li class="body">
											<ul class="menu">
											<?php foreach($notofication_list as $list){ ?>
												<li>
													<a href="javascript:void(0);">
														<div class="icon-circle bg-blue-grey">
															<i class="material-icons">comment</i>
														</div>
														
													
														<div class="menu-info">
															<h4><?php echo htmlentities($list['u_name']).' request for File calling  name is '. htmlentities($list['f_c_calling']); ?></h4>
															<?php if($list['u_id']!= $userdetails['u_id']){ ?>
															<?php if($list['f_c_request']==0){ ?>
															<a href="<?php echo base_url('filecall/index/'.base64_encode(3)); ?>">proceed</a>
															<a href="<?php echo base_url('filecall/requestaccept/'.base64_encode($list['filecall_id']).'/'.base64_encode(2)); ?>">decline</a>
															<?php }  }else{ ?>
															<p><?php if($list['f_c_request']==1){ echo "Accepted";}else if($list['f_c_request']==2){ echo "declined"; } ?></p>
															<?php } ?>
															<p>
																<i class="material-icons">access_time</i><?php echo date('M j h:i A',strtotime(htmlentities($list['filecall_created_at'])));?>
															</p>
														</div>
														
													   
													</a>
												</li>
											<?php } ?>
											</ul>
										</li>
										<li class="footer">
											<a href="<?php echo base_url('filecall/index/'.base64_encode(3)); ?>">View All Notifications</a>
										</li>
									</ul>
								</li>
                    <?php } ?>
					<li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">person</i>
                            
                        </a>
                       
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?php echo base_url('profile'); ?>"><i class="material-icons">person</i>Personal Account</a></li>
                            <li><a href="<?php echo base_url('profile/changepassword'); ?>"><i class="material-icons">person</i>Change Password</a></li>
                           
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
	<!-- sharing--->
											<div class="modal fade help-class-modal" id="defaultModal" tabindex="-1" role="dialog">
												<div class="modal-dialog" role="document">
												<div class="modal-content">
												 <div class="modal-header bg-site">
													<h4 class="modal-title" id="defaultModalLabel">Sharing</h4>
												 </div>
												 <form action="<?php echo base_url('images/filesharing'); ?>" id="sharingfile" name="sharingfile" method="post">
												 <?php $csrf = array(
															'name' => $this->security->get_csrf_token_name(),
															'hash' => $this->security->get_csrf_hash()
													); ?>
												<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
												<input type="hidden" id="sharingfile_id" name="sharingfile_id" value="" />
												<input type="hidden" id="yes" name="yes" value="0" />
												<input type="hidden" name="pageid" value="<?php echo isset($page_id)?$page_id:0; ?>" />
												<input type="hidden" name="floderid" value="<?php echo isset($floder_id)?$floder_id:0; ?>" />
												 <div class="modal-body pad-cus" style="padding-bottom:0px ;">
													<div class="row ">
													<div class="col-md-8 ">
													<div class="form-group ">
													   <label>Share to another cloud account</label>
													  
														  <select style="width:100%" id="multiple" name="filesharing[]"  class="form-line select2-multiple" multiple>
																<?php foreach($all_users_list as $list){ ?>
																<option value="<?php echo $list['u_id']; ?>"><?php echo $list['u_name']; ?></option>
																<?php } ?>
														  </select>
														 
													</div>
													</div>
													<div class="col-md-2 ">
													<style>.bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) { width: 150px;border: 1px solid #ddd;
}
													</style>
													<div class="form-group " style="width:100px;">
													   <label>&nbsp;</label>
														  <select  name="permissions" id="permissions" style="width:100px;" >
																<option value="Read">READ</option>
																<option value="Write">WRITE</option>
														  </select>
													</div>
													</div>
													</div>
													
													<br>
													<hr >
													<h4 class="text-center mart-neg"><span>OR</span></h4>
													<br>
													<div class="form-group">
													   <div class="form-line ">
														  <label>Enter email address,we will mail to them for you</label>
														  <input type="email" id="sharingnotification" name="sharingnotification" class="form-control" placeholder="Enter your email" />
													   </div>
													   <br>
													   <div class="modal-footer ">
														  <button type="submit" class="btn btn-link waves-effect">SHARE</button>
														  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
													   </div>
													</div>
												 </div>
												 </form>
												</div>
												</div>
											</div>


<script>
function getfileid(id){
	  document.getElementById('sharingfile_id').value=id;
}function getfloderid(id){
	  document.getElementById('sharingfile_id').value=id;
	  document.getElementById('yes').value=1;
}function getlinkid(id){
	  document.getElementById('sharingfile_id').value=id;
	  document.getElementById('yes').value=2;
}
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
