<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                    <h2>Change Password</h2>
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
							<form id="changepassword" name="changepassword" action="<?php echo base_url('profile/changepasswordpost'); ?>" method="post" enctype="multipart/form-data">
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
