<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<form id="editform" name="editform" action="<?php echo base_url('profile/editpost'); ?>" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                    <h2><?php echo htmlentities($userdetails['u_name']);?> Edit Profile</h2>
                            </div>
                        </div>
                        <div class="body">
						<div class="row clearfix">
							<div class="col-md-2">
							<?php if($userdetails['u_profilepic']!=''){?>
							<img class="img-responsive thumbnail" src="<?php echo base_url('assets/users/'.$userdetails['u_profilepic']); ?>" alt="<?php echo htmlentities($userdetails['u_profilepic']);?>" />
							<?php }else{ ?>
							<img class="img-responsive thumbnail" src="<?php echo base_url('assets/users/user.png'); ?>"  alt="User" />
							<?php } ?>
							</div>
							<div class="col-md-8 card"><br>
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
						<label class=" control-label">DOB</label>  
							<div class="form-line">
										<label>Date of Birth</label>
										<?php if($userdetails['u_dob']!=''){ ?>
                                            <input type="text" id="dob" name="dob" class="datepicker form-control" placeholder="Please choose a date..." value="<?php echo htmlentities($userdetails['u_dob']);?> ">
										<?php }else{ ?>
										     <input type="text" id="dob" name="dob" class="datepicker form-control" placeholder="Please choose a date..." value="">

										<?php } ?>
                                        </div>
					</div>
					<div class="form-group">
						<label class=" control-label">GENDER</label>  
							<div class=" inputGroupContainer">
								<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
								<input name="mobile" id="mobile" placeholder="Mobile" class="form-control" type="text">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class=" control-label">Profile Pic</label>  
							<div class=" inputGroupContainer">
								<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
								<input name="mobile" id="mobile" placeholder="Mobile" class="form-control" type="text">
							</div>
						</div>
					</div>
								
									<button type="submit"  class="btn btn-primary pull-right ">Update</button>
									<div class="clearfix">&nbsp;</div>
									</br>
							</div>
						</div>
                 </div>
            </div>
			</form>
            </div>
            </div>
            </div>
  </section>
  <script>
  $(document).ready(function() {
    $('#editform').bootstrapValidator({
        
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
            },
			mobile: {
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
			gender: {
              validators: {
					 notEmpty: {
						message: 'gender is required'
					}
                }
            },
			image: {
              validators: {
					  
					regexp: {
					regexp: /\.(jpe?g|png|gif)$/i,
					message: 'Uploaded file is not a valid image. Only JPG, PNG and GIF files are allowed'
					}
				}
            },
			
           
            dob: {
					 validators: {
						 notEmpty: {
						message: 'Date of Birth is required'
					}
					}
				}
            }
        })
     
});
  </script>
