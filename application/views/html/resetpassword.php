<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Login</title><!-- Favicon-->
    <!-- Custom Css -->
    <link href="<?php echo base_url(); ?>assets/vendor/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/css/bootstrapValidator.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
   
 

</head>
<body>
<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                    <h2>Reset Password</h2>
                            </div>
                        </div>
						<?php if($this->session->flashdata('error')): ?>
						<div class="alert alert-warning alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<?php echo $this->session->flashdata('error');?>
						</div>
					<?php endif; ?>
					<?php if(validation_errors()):?>
					<div class="alert alert-warning alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<?php echo validation_errors(); ?></div>
					<?php  endif;?>
                        <div class="body">
						<div class="row clearfix">
							
							<form id="changepassword" name="changepassword" action="<?php echo base_url('profile/resetpasswordpost'); ?>" method="post" enctype="multipart/form-data">
								<?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="col-md-8 card"><br>
								<div class="row">	
								<div class="col-md-12">
									 <div class="form-group">
										 <div class="input-group form-line ">
										 <label class=" control-label">Old Password</label>
                                            <input type="password" id="oldpassword" name="oldpassword" class="form-control" value="" placeholder="Enter Old Password" />
                                        </div>
                                    </div>
								</div>
								<div class="col-md-12">
									 <div class="form-group">
                                        <div class="form-line ">
										<label>New Password</label>
                                            <input type="password" id="password" name="password" class="form-control" value="" placeholder="Enter New Password" />
                                        </div>
                                    </div>
								</div>
								</div>
								<div class="row">
								<div class="col-md-12">
									 <div class="form-group">
                                        <div class="form-line ">
										<label>Confirm Password</label>
                                            <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" value="" placeholder="Enter Confirm Password"/>
                                        </div>
                                    </div>
								</div>
								</div>
								
								
									<button type="submit" class="btn btn-warning  pull-right" >Update <span class="glyphicon glyphicon-send"></span></button>
									</br>
									</br>
									
								
							</div>
							</form>
						</div>
                 </div>
            </div>
			
            </div>
            </div>
            </div>
  </section>
  </body>
   <script src="<?php echo base_url(); ?>assets/vendor/plugins/jquery/jquery.min.js"></script>

  <script src="<?php echo base_url(); ?>assets/vendor/plugins/bootstrap/js/bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/bootstrapValidator.min.js"></script>
  </html>
 <script>
 
	 $(document).ready(function() {
    $('#changepassword').bootstrapValidator({
        
        fields: {
            oldpassword: {
                validators: {
					notEmpty: {
						message: 'Old Password is required'
					},
					stringLength: {
                        min: 6,
                        message: 'Old Password  must be at least 6 characters'
                    },
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~'"\\|=^?$%*)(_+-]*$/,
					message: 'Old Password wont allow <>[]'
					}
				}
            }, password: {
                validators: {
					notEmpty: {
						message: 'Password is required'
					},
					stringLength: {
                        min: 6,
                        message: 'Password  must be at least 6 characters'
                    },
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~'"\\|=^?$%*)(_+-]*$/,
					message: 'Password wont allow <>[]'
					}
				}
            },
           
            confirmpassword: {
					 validators: {
						 notEmpty: {
						message: 'Confirm Password is required'
					},
					identical: {
						field: 'password',
						message: 'password and confirm Password do not match'
					}
					}
				}
            }
        })
     
});

</script>
