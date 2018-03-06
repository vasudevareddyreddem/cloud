<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Login</title>
    <!-- Favicon-->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
	<!-- Bootstrap Core Css -->
    <link href="<?php echo base_url(); ?>assets/vendor/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
	<!-- Custom Css -->
    <link href="<?php echo base_url(); ?>assets/vendor/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/css/bootstrapValidator.min.css" rel="stylesheet">
   

</head>


<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>CLOUD</b></a>
           
        </div>
        <div class="card">
            <div class="body">
				<div id="login_form" >
                <form action="<?php echo base_url('cloud/login_post'); ?>" id="sign_in" name="sign_in" method="POST">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" autocomplete="off" class="form-control" id="email" name="email" placeholder="Email Address" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" autocomplete="off" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="javascript:void(0);" onclick="register()">Register Now!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                             <a href="javascript:void(0);" onclick="forgot_password()">Forgot Password?</a>
                        </div>
                    </div>
                </form>
				</div>
				<div id="forgot_password"  style="display:none;">
					<form id="forgt">
						<div class="msg">Forgot Password</div>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">person</i>
							</span>
							<div class="form-line">
								<input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4">
								<button class="btn btn-block bg-pink waves-effect" type="submit">Send</button>
							</div>
							<div class="col-xs-4">
							<a href="javascript:void(0);" onclick="login()" class="btn btn-block bg-pink waves-effect" type="submit">Cancel</a>
							</div>
						</div>
					</form>
				</div>
				<div style="display:none;" id="register_form">
                <form id="sign_up" name="sign_up" action="<?php echo base_url('cloud/register_post'); ?>" method="POST">
                    <div class="msg">Register a new membership</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="custemail" name="custemail" placeholder="Name"  autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" autocomplete="off" class="form-control" id="email" name="email" placeholder="Email Address" >
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" autocomplete="off" class="form-control" id="password" name="password" minlength="6" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" autocomplete="off" class="form-control" id="confirmpwd" name="confirmpwd" minlength="6" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>

                    <div class="m-t-25 m-b--5 align-center">
                         <a href="javascript:void(0);" onclick="login()">You already have a membership?</a>
                    </div>
                </form>
				</div>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url(); ?>assets/vendor/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url(); ?>assets/vendor/plugins/bootstrap/js/bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendor/js/pages/forms/form-validation.js"></script>
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
            first_name: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Please supply your first name'
                    }
                }
            },
             last_name: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your last name'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address'
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your phone number'
                    },
                    phone: {
                        country: 'US',
                        message: 'Please supply a vaild phone number with area code'
                    }
                }
            },
            address: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Please supply your street address'
                    }
                }
            },
            city: {
                validators: {
                     stringLength: {
                        min: 4,
                    },
                    notEmpty: {
                        message: 'Please supply your city'
                    }
                }
            },
            state: {
                validators: {
                    notEmpty: {
                        message: 'Please select your state'
                    }
                }
            },
            zip: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your zip code'
                    },
                    zipCode: {
                        country: 'US',
                        message: 'Please supply a vaild zip code'
                    }
                }
            },
            comment: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 200,
                        message:'Please enter at least 10 characters and no more than 200'
                    },
                    notEmpty: {
                        message: 'Please supply a description of your project'
                    }
                    }
                }
            }
        })
     
});


</script>

</script>
    </script>
</body>

</html>