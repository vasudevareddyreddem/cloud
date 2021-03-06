
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
                  	<?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							
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
						<?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							
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
						  <label class=" control-label" >Security Question</label> 
							<div class=" inputGroupContainer">
									<select class="form-control show-tick dropdown" onchange="questions_answer1('this.value')" id="questions1" name="questions1">
                                        <option value="">-- Please select --</option>
										<?php foreach($questions_list as $list){ ?>
										<option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
										<?php } ?>
                                    </select>
							</div>
					</div>
					<div class="form-group" id="ans1" style="display:none">
							<div class=" inputGroupContainer">
								<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
								<input id="answer1" name="answer1" onkeyup="buttonenable();" placeholder="" class="form-control" autocomplete="off"  type="text">
								</div>
							</div>
					</div>
					<span id="ques2" style="display:none">
						<div class="form-group">
						  <label class=" control-label">&nbsp;</label>
								<div class=" inputGroupContainer">
										<select class="form-control show-tick dropdown" onchange="questions_answer2('this.value')" id="questions2" name="questions2">
											<option value="">-- Please select --</option>
											<?php foreach($questions_list as $list){ ?>
											<option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
											<?php } ?>
										</select>
								</div>
						</div>
						<div class="form-group" id="ans2" style="display:none">
								<div class=" inputGroupContainer">
									<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
									<input id="answer2" name="answer2" onkeyup="buttonenable();" placeholder="" class="form-control" autocomplete="off"  type="text">
									</div>
								</div>
						</div>
					</span>
					<span id="ques3" style="display:none">
						<div class="form-group">
						  <label class=" control-label">&nbsp;</label>
								<div class=" inputGroupContainer">
										<select class="form-control show-tick dropdown" onchange="questions_answer3('this.value')" id="questions3" name="questions3">
											<option value="">-- Please select --</option>
											<?php foreach($questions_list as $list){ ?>
											<option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
											<?php } ?>
										</select>
								</div>
						</div>
						<div class="form-group" id="ans3" style="display:none">
								<div class=" inputGroupContainer">
									<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
									<input id="answer3" name="answer3" onkeyup="buttonenable();" placeholder="" class="form-control" autocomplete="off"  type="text">
									</div>
								</div>
						</div>
					</span>
					<div class="form-group">
						<div class="col-xs-4">
								<button class="btn btn-block bg-pink waves-effect" id="Buttonregister" type="submit">Send</button>
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
				<form id="forgotpass" name="forgotpass" action="<?php echo base_url('cloud/forgotpassword'); ?>" method="post">
						<?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							
					<div class="form-group">
						<label class=" control-label">E-Mail</label>  
							<div class=" inputGroupContainer">
								<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
								<input id="email" name="email" placeholder="E-Mail Address" class="form-control" autocomplete="off"  type="text">
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
					<div class="form-group">
						<label class=" control-label">E-Mail</label>  
							<div class=" inputGroupContainer">
								<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
								<input id="email" name="email" placeholder="E-Mail Address" class="form-control" autocomplete="off"  type="text">
								</div>
							</div>
					</div>
					</form>
				</div>
            </div>
        </div>
</body>
   <script src="<?php echo base_url(); ?>assets/vendor/plugins/jquery/jquery.min.js"></script>

  <script src="<?php echo base_url(); ?>assets/vendor/plugins/bootstrap/js/bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/bootstrapValidator.min.js"></script>
  
<script>
function buttonenable(){
	document.getElementById("Buttonregister").disabled = false;
}
function questions_answer1(val){
	if(val!=''){
		$('#ans1').show();
		$('#ques2').show();
	}else{
		$('#ans1').hide();
	}
}
function questions_answer2(val){
	if(val!=''){
		$('#ans2').show();
		$('#ques3').show();
	}else{
		$('#ans2').hide();
	}
}
function questions_answer3(val){
	if(val!=''){
		$('#ans3').show();
	}else{
		$('#ans3').hide();
	}
}
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
    $('#forgotpass').bootstrapValidator({
        
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
            }
            }
        })
     
	});
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
				},
				answer1: {
              validators: {
					 notEmpty: {
						message: 'Answer is required'
					},
                    regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Answer can only consist of alphanumaric, space and dot'
					}
                }
            },
			questions1: {
              validators: {
					 notEmpty: {
						message: 'Question is required'
					}
                }
            },
			answer2: {
              validators: {
					 notEmpty: {
						message: 'Answer is required'
					},
                    regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Answer can only consist of alphanumaric, space and dot'
					}
                }
            },
			questions2: {
              validators: {
					 notEmpty: {
						message: 'Question is required'
					}
                }
            },
			questions3: {
              validators: {
					 notEmpty: {
						message: 'Question is required'
					}
                }
            },
			answer3: {
              validators: {
					 notEmpty: {
						message: 'Answer is required'
					},
                    regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Answer can only consist of alphanumaric, space and dot'
					}
                }
            }
			
            }
        })
     
});


</script>

</html>