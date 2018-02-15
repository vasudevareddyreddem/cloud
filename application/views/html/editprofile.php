<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                    <h2><?php echo htmlentities($userdetails['u_name']);?> Edit Profile</h2>
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
							<div class="col-md-2">
							<?php if($userdetails['u_profilepic']!=''){?>
							<img class="img-responsive thumbnail" src="<?php echo base_url('assets/users/'.$userdetails['u_profilepic']); ?>" alt="<?php echo htmlentities($userdetails['u_profilepic']);?>" />
							<?php }else{ ?>
							<img class="img-responsive thumbnail" src="<?php echo base_url('assets/users/user.png'); ?>"  alt="User" />
							<?php } ?>
							</div>
							<form id="editform" name="editform" action="<?php echo base_url('profile/editpost'); ?>" method="post" enctype="multipart/form-data">
								<?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							
							<div class="col-md-8 card"><br>
								<div class="row">	
								<div class="col-md-6">
									 <div class="form-group">
										 <div class="input-group form-line ">
										 <label class=" control-label">Name</label>
                                            <input type="text" id="custname" name="custname" class="form-control" value="<?php echo htmlentities($userdetails['u_name']);?>" placeholder="Enter your Name" />
                                        </div>
                                    </div>
								</div>
								<div class="col-md-6">
									 <div class="form-group">
                                        <div class="form-line ">
										<label>Email</label>
                                            <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlentities($userdetails['u_email']);?>" placeholder="Enter your Email" />
                                        </div>
                                    </div>
								</div>
								</div>
								<div class="row">
								<div class="col-md-6">
									 <div class="form-group">
                                        <div class="form-line ">
										<label>Mobile</label>
                                            <input type="text" id="mobile" name="mobile" class="form-control" value="<?php echo htmlentities($userdetails['u_mobile']);?>"  />
                                        </div>
                                    </div>
								</div>
								<div class="col-md-6">
									 <div class="form-group">
                                        <div class="form-line ">
										<label>Date of Birth</label>
											<?php if($userdetails['u_dob']!=''){ ?>
                                            <input type="text" id="dob" name="dob" class="datepicker form-control" placeholder="Please choose a date..." value="<?php echo htmlentities($userdetails['u_dob']);?> ">
										<?php }else{ ?>
										     <input type="text" id="dob" name="dob" class="datepicker form-control" placeholder="Please choose a date..." value="">

										<?php } ?>                                        </div>
                                    </div>
								</div>
								</div>
								<div class="row">
									
								<div class="col-md-6">
									 <div class="form-group">
                                        <div class="form-line ">
										<label>Gender</label>
									<select class="form-control show-tick" id="gender" name="gender">
                                        <option value="">-- Please select Gender --</option>
                                        <?php if($userdetails['u_gender']=='Male'){ ?>
										<option value="Male" selected>Male</option>
                                        <option value="Female">Female</option>
										<?php }if($userdetails['u_gender']=='Female'){?>
										<option value="Male">Male</option>
                                        <option value="Female" selected>Female</option>
										<?php }else{ ?>
										<option value="Male">Male</option>
                                        <option value="Female">Female</option>
										<?php } ?>
                                        
                                    </select>
                                        </div>
                                    </div>
								</div>
								<div class="col-md-6">
									 <div class="form-group">
                                        <div class="form-line ">
										<label>Profile Pic</label>
                                            <input type="file" id="file" name="file" class="form-control"  />
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
			file: {
              validators: {
					  
					regexp: {
					regexp: /\.(jpe?g|png|gif)$/i,
					message: 'Uploaded file is not a valid image. Only JPG, PNG and GIF files are allowed'
					}
				}
            }
            }
        })
     
});

</script>
