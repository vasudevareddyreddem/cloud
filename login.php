<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Login</title><!-- Favicon-->
    <!-- Custom Css -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/bootstrapValidator.min.css" rel="stylesheet">
    <script src="plugins/jquery/jquery.min.js"></script>
  <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="plugins/bootstrap/js/bootstrap.js"></script>
  <script src="js/bootstrapValidator.min.js"></script>
  
 

</head>

<body class="login-page">
        <div class="mart-50">
            <div class="col-md-4 col-md-offset-4 login-design">
			<h3 class="text-center">CLOUD</h3>

				<form class=" pad30 form-horizontal" action=" " method="post"  id="contact_form">
				
				<div class="form-group">
				  <label class=" control-label">First Name</label>  
				  <div class=" inputGroupContainer">
				  <div class="input-group">
				  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				  <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
					</div>
				  </div>
				</div>

				<!-- Text input-->

				<div class="form-group">
				  <label class=" control-label" >Last Name</label> 
					<div class=" inputGroupContainer">
					<div class="input-group">
				  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				  <input name="last_name" placeholder="Last Name" class="form-control"  type="text">
					</div>
				  </div>
				</div>

				<!-- Text input-->
					   <div class="form-group">
				  <label class=" control-label">E-Mail</label>  
					<div class=" inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
				  <input name="email" placeholder="E-Mail Address" class="form-control"  type="text">
					</div>
				  </div>
				</div>


				<!-- Text input-->
					   
				<div class="form-group">
				  <label class=" control-label">Phone #</label>  
					<div class=" inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
				  <input name="phone" placeholder="(845)555-1212" class="form-control" type="text">
					</div>
				  </div>
				</div>

				<!-- Text input-->
					  
				<div class="form-group">
				  <label class=" control-label">Address</label>  
					<div class=" inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
				  <input name="address" placeholder="Address" class="form-control" type="text">
					</div>
				  </div>
				</div>

				<!-- Text input-->
				 
				<div class="form-group">
				  <label class=" control-label">City</label>  
					<div class=" inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
				  <input name="city" placeholder="city" class="form-control"  type="text">
					</div>
				  </div>
				</div>

				<!-- Select Basic -->
				   
				<div class="form-group"> 
				  <label class=" control-label">State</label>
					<div class=" selectContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
					<select name="state" class="form-control selectpicker" >
					  <option value=" " >Please select your state</option>
					  <option>Alabama</option>
					  <option>Alaska</option>
					  <option >Arizona</option>
					  <option >Arkansas</option>
					  <option >California</option>
					  <option >Colorado</option>
					  <option >Connecticut</option>
					  <option >Delaware</option>
					  <option >District of Columbia</option>
					  <option> Florida</option>
					  <option >Georgia</option>
					
					</select>
				  </div>
				</div>
				</div>

				<!-- Text input-->

				<div class="form-group">
				  <label class=" control-label">Zip Code</label>  
					<div class=" inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
				  <input name="zip" placeholder="Zip Code" class="form-control"  type="text">
					</div>
				</div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class=" control-label">Website or domain name</label>  
				   <div class=" inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
				  <input name="website" placeholder="Website or domain name" class="form-control" type="text">
					</div>
				  </div>
				</div>

				<!-- radio checks -->
				 <div class="form-group">
										<label class=" control-label">Do you have hosting?</label>
										<div class="">
											<div class="radio">
												<label>
													<input type="radio" name="hosting" value="yes" /> Yes
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" name="hosting" value="no" /> No
												</label>
											</div>
										</div>
									</div>

				<!-- Text area -->
				  
				<div class="form-group">
				  <label class=" control-label">Project Description</label>
					<div class=" inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
							<textarea class="form-control" name="comment" placeholder="Project Description"></textarea>
				  </div>
				  </div>
				</div>

				<!-- Button -->
				<div class="form-group">
				  <label class=" control-label"></label>
				  <div class="">
					<button type="submit" class="btn btn-warning" >Send <span class="glyphicon glyphicon-send"></span></button>
				  </div>
				</div>


				</form>

            </div>
        </div>
</body>
<script>
	$(document).ready(function() {
    $('#contact_form').bootstrapValidator({
        
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

</html>