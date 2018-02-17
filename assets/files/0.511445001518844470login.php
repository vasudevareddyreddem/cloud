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
<body class="login-page">
        <div class="mart-50">
            <div class="col-md-4 col-md-offset-4 login-design">
			<h3 class="text-center">CLOUD</h3>
				
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
				<div id="login_form" <?php if(isset($tab)&& $tab ==1 ||  isset($tab) && $tab ==''){ ?> style="" <?php }else{ ?>style="display:none;" <?php } ?>>
                <form action="<?php echo base_url('cloud/login_post'); ?>" id="sign_in" name="sign_in" method="POST">
                  
				<div class="form-group">
					<label class=" control-label">E-Mail</label>  
					<div class=" inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input name="email" id="email" placeholder="E-Mail Address" class="form-control"  type="text" autocomplete="off">
					</div>
				  </div>
				</div>
				<div class="form-group">
				  <label class=" control-label" >Password</label> 
					<div class=" inputGroupContainer">
					<div class="input-group">
				  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				  <input name="password" id="password" placeholder="Password" class="form-control"  type="password" autocomplete="off">
					</div>
				  </div>
				</div>
						<!-- Button -->
				<div class="form-group">
				     <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink" >
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
							<button type="submit" class=" btn btn btn-block btn-success" >Send </button>
                        </div>
                    </div>
				</div>		<!-- Button -->
				<div class="form-group">
				  <div class="col-xs-6">
                            <a href="javascript:void(0);" id="register_id" onclick="register()">Register Now!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                             <a href="javascript:void(0);" onclick="forgot_password()">Forgot Password?</a>
                        </div>
				</div>


				</form>
				</div>
				
				<div <?php if(isset($tab)&& $tab ==2){ ?> style="" <?php }else{ ?>style="display:none;"<?php } ?> id="register_form">
				   <form id="sign_up" name="sign_up" action="<?php echo base_url('cloud/register_post'); ?>" method="POST">

					<div class="form-group">
							<label class=" control-label">Name</label>  
							<div class=" inputGroupContainer">
							<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input  name="custname" id="custname" placeholder="Name" class="form-control"  type="text">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class=" control-label">E-Mail</label>  
						<div class=" inputGroupContainer">
						<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input id="email" name="email" placeholder="E-Mail Address" class="form-control"  type="text" autocomplete="off">
						</div>
						</div>
					</div>
					<div class="form-group">
						<label class=" control-label">Phone #</label>  
							<div class=" inputGroupContainer">
								<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
								<input name="mobile" id="mobile" placeholder="Mobile" class="form-control" type="text">
							</div>
						</div>
					</div>
					<div class="form-group">
						  <label class=" control-label" >Password</label> 
							<div class=" inputGroupContainer">
							<div class="input-group">
						  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						  <input name="password" id="password" placeholder="Password" class="form-control"  type="password" autocomplete="off">
							</div>
						  </div>
					</div>
					<div class="form-group">
						  <label class=" control-label" >Confirm Password</label> 
							<div class=" inputGroupContainer">
							<div class="input-group">
						  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						  <input name="confirmpwd" id="confirmpwd" placeholder=" confirm Password" class="form-control"  type="password" autocomplete="off">
							</div>
						  </div>
					</div>
					<div class="form-group">
						<div class="col-xs-4">
								<button class="btn btn-block bg-pink waves-effect" type="submit">Send</button>
							</div>
							<div class="col-xs-4">
							<a href="javascript:void(0);" onclick="login()" class="btn btn-block bg-pink waves-effect" type="submit">Cancel</a>
							</div>
					</div>
					<div class="col-md-6">
						   <a href="javascript:void(0);" onclick="login()">You already have a membership?</a>
                     </div>
					 
					 </form>
				</div>
				<div id="forgot_password"  style="display:none;">
					<div class="form-group">
						<label class=" control-label">E-Mail</label>  
							<div class=" inputGroupContainer">
								<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
								<input id="email" name="email" placeholder="E-Mail Address" class="form-control"  type="text">
								</div>
							</div>
					</div>
					<div class="form-group">
						<div class="col-xs-4">
								<button class="btn btn-block bg-pink waves-effect" type="submit">Send</button>
							</div>
							<div class="col-xs-4">
							<a href="javascript:void(0);" onclick="login()" class="btn btn-block bg-pink waves-effect" type="submit">Cancel</a>
							</div>
					</div>
				</div>
            </div>
        </div>
</body>
   <script src="<?php echo base_url(); ?>assets/vendor/plugins/jquery/jquery.min.js"></script>

  <script src="<?php echo base_url(); ?>assets/vendor/plugins/bootstrap/js/bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/bootstrapValidator.min.js"></script>
  
<script>
function register(){
		$('#login_form').hide();
		$('#register_form').show();
		$('#forgot_password').hide();
	}function login(){
		$('#register_form').hide();
		$('#login_form').show();
		$('#forgot_password').hide();
	}function forgot_password(){
		$('#register_form').hide();
		$('#login_form').hide();
		$('#forgot_password').show();
	}
	$(document).ready(function() {
    $('#sign_in').bootstrapValidator({
        
        fields: {
            email: {
               validators: {
					notEmpty: {
						message: 'Email is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
					}
				}
            },
             password: {
                validators: {
                     stringLength: {
                        min: 6,
                    },
                    notEmpty: {
                        message: 'Please supply your last name'
                    }
                }
            }
            }
        })
     
	});
	$(document).ready(function() {
    $('#sign_up').bootstrapValidator({
        
        fields: {
            custname: {
               validators: {
					notEmpty: {
						message: 'Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Name can only consist of alphanumaric, space and dot'
					}
				}
            },
             email: {
                validators: {
					notEmpty: {
						message: 'Email is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
					}
				}
            },mobile: {
              validators: {
					 notEmpty: {
						message: 'Mobile Number is required'
					},
                    regexp: {
					regexp:  /^[0-9]{10}$/,
					message:'Mobile Number must be 10 digits'
					}
                }
            },
			
			password: {
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
           
            confirmpwd: {
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

</html>