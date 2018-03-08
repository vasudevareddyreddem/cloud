<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                               <h2><?php echo htmlentities($userdetails['u_name']);?> Activity Logs</h2>
							</div><a href="<?php echo base_url('profile/clearlogs'); ?>">Clear</a>
                        </div>
						<?php if($this->session->flashdata('error')): ?>
						<div class="alert alert-warning alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<?php echo $this->session->flashdata('error');?>
						</div>
						<?php endif; ?>
						<?php if($this->session->flashdata('success')): ?>
						<div class="alert alert-success alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<?php echo $this->session->flashdata('success');?>
						</div>
						<?php endif; ?>
                        <div class="body">
						<div class="row clearfix">
							
							<div class="col-md-12 ">
								<table class="table table-hover">
									<tbody>
									  <tr>
										<th>Date</th>
										<th>Property</th>
										<th>Action</th>
										
									  </tr> 
									  <?php foreach($activity_logs as $list){ ?>
									  <tr>
										<td><?php echo date('M j h:i A',strtotime(htmlentities($list['create_at'])));?></td>
										<td><?php echo $list['f_name'].' '.$list['imag_org_name'].' '.$list['l_name']; ?>
										<?php if($list['f_name']!='' && $list['imag_org_name']=='' && $list['l_name']==''){
											echo "( Folder )"; 
										}else if($list['f_name']=='' && $list['imag_org_name']!='' && $list['l_name']==''){ 
											echo "( Image )"; 
										}else if($list['f_name']=='' && $list['imag_org_name']=='' && $list['l_name']!=''){
											echo "( Link )"; 
										}else{
											echo " User "; 
										}
										?>
										
										</td>
										<td><?php echo $list['action']; ?></td>
									  </tr>
									  <?php } ?>
									 
									   
									 
									  
									</tbody>
								  </table>
							</div>
							
						</div>
                </div>
            </div>
            </div>
            </div>
            </div>
   </section>
