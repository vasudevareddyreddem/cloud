<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <?php echo isset($breadcoums)?$breadcoums:''; ?>
            </div>
			<div id="sucessmsg" style="display:none;"></div>
            <!-- Widgets -->
           
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
			
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                               <h2> <?php echo isset($flodername['f_name'])?$flodername['f_name']:''; ?> Floder</h2>
							</div>
                         </div>
                        <div class="body">
						<div class="row clearfix">
						<?php //echo '<pre>';print_r($file_data);exit; ?>
						<?php $cnt=1;foreach($file_data as $list){ ?>
								<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
									<div class="card">
									<ul class="header-dropdown m-r--5">
												<li class="dropdown">
													<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
														<i class="material-icons pull-right pad20">more_vert</i>
													</a>
													 <ul class="dropdown-menu pull-right">
														<li><a  href="<?php echo base_url('assets/files/'.$list->img_name); ?>" download>Download</a></li>
														<li><a href="<?php echo base_url('recyclebin/imgdelte/'.base64_encode($list->img_id)); ?>">Delete</a></li>
													</ul>
												</li>
											</ul>
										<div class="folder-img">
											<img class="img-responsive" src="<?php echo base_url('assets/files/'.$list->img_name); ?>" alt="<?php echo htmlentities($list->imag_org_name); ?>">
											
										</div>
										<div class="header help-class folder-ti">
												<label > &nbsp; <?php echo htmlentities($list->imag_org_name); ?></label>
												<?php if(isset($list->yes) && $list->yes==1){ ?>
													<div class="pos-fav" id="addfavouriteids<?php echo $list->img_id; ?><?php echo $cnt; ?>">
														<span class="glyphicon glyphicon-heart"></span>
													</div>
												<?php }else{?>
													<div class="pos-fav" id="addfavouriteids<?php echo $list->img_id; ?><?php echo $cnt; ?>" style="display:none;">
														<span class="glyphicon glyphicon-heart"></span>
													</div>
												<?php }	?>
										
										</div>
										
										
									
									  
									   
									</div>
								</div>
				
						<?php $cnt++;} ?>
				
				 </div>
                          
                </div>
            </div>
            </div>
            </div>
            </div>
            <!-- #END# CPU Usage -->
	
            
    </section>
