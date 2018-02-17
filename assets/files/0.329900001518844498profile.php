<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                               <h2><?php echo htmlentities($userdetails['u_name']);?> Profile</h2>
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
							<div class="col-md-8 card">
								<table class="table table-hover">
									<tbody>
									  <tr>
										<th>Name</th>
										<td><?php echo htmlentities($userdetails['u_name']);?></td>
									  </tr>
									  <tr>
										<th>Email</th>
										<td><?php echo htmlentities($userdetails['u_email']);?></td>
									  </tr>
									  <tr>
										<th>Phone</th>
										<td><?php echo htmlentities($userdetails['u_mobile']);?></td>
									  </tr>  
									  <tr>
										<th>Date of Birth</th>
										<td><?php echo htmlentities($userdetails['u_dob']);?></td>
									  </tr> 
									  <tr>
										<th>Gender</th>
										<td><?php echo htmlentities($userdetails['u_gender']);?></td>
									  </tr>
									</tbody>
								  </table>
							</div>
							<div>
								&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url('profile/edit'); ?>" class="btn btn-warning">Edit</a>
							</div>
						</div>
                </div>
            </div>
            </div>
            </div>
            </div>
   </section>
