<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
			
			 <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                               
                                    <h2>Recently opened</h2>
									<ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                     <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Share</a></li>
                                        <li><a href="javascript:void(0);">Download</a></li>
                                        <li><a href="javascript:void(0);">Favourite</a></li>
                                        <li><a href="javascript:void(0);">Rename</a></li>
                                        <li><a href="javascript:void(0);">Move</a></li>
                                        <li><a href="javascript:void(0);">Copy</a></li>
                                        <li><a href="javascript:void(0);">Delete</a></li>
                                    </ul>
                                </li>
                            </ul>
                               
                                
                            </div>
                            
                        </div>
                        <div class="body">
						<div class="row clearfix">
						
						<?php foreach($file_data as $list){ ?>
								<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
									<div class="card">
									<ul class="header-dropdown m-r--5">
												<li class="dropdown">
													<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
														<i class="material-icons pull-right pad20">more_vert</i>
													</a>
													 <ul class="dropdown-menu pull-right">
														<li><a href="javascript:void(0);">Share</a></li>
														<li><a target="_blank" href="<?php echo base_url('assets/files/'.$list->img_name); ?>">Download</a></li>
														<li><a href="javascript:void(0);">Favourite</a></li>
														<li><a href="javascript:void(0);">Rename</a></li>
														<li><a href="javascript:void(0);">Move</a></li>
														<li><a href="javascript:void(0);">Copy</a></li>
														<li><a href="javascript:void(0);">Delete</a></li>
													</ul>
												</li>
											</ul>
										<div class="folder-img">
											<img class="img-responsive" src="<?php echo base_url('assets/files/'.$list->img_name); ?>" alt="<?php echo htmlentities($list->imag_org_name); ?>">
										</div>
										<div class="header help-class folder-ti">
												<label > &nbsp; <?php echo htmlentities($list->imag_org_name); ?></label>
											
										
										</div>
									  
									   
									</div>
								</div>
				
						<?php } ?>
						<?php foreach($recen_floder_data as $fnames){ ?>
											<a href="<?php echo base_url('dashboard/page/'.base64_encode(1).'/'.base64_encode($fnames->f_id)); ?>"><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="info-box bg-pink hover-expand-effect">
									<div class="icon">
										<i class="material-icons">folder</i>
									</div>
									<div class="content">
										<div class="text"><h3><?php echo htmlentities($fnames->f_name); ?></h3></div>
										
									</div>
								</div>
							</div>
							</a>
						<?php } ?>
				
				

               
            </div>
                          
                </div>
            </div>
            </div>
            </div>
			<!--floder-->
			 <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                               
                                    <h2>Floder list</h2>
									 </div>
                            
                        </div>
                        <div class="body">
						<div class="row clearfix">
						
						<?php foreach($floder_data as $fnames){ ?>
											<a href="<?php echo base_url('dashboard/page/'.base64_encode(1).'/'.base64_encode($fnames->f_id)); ?>"><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="info-box bg-pink hover-expand-effect">
									<div class="icon">
										<i class="material-icons">folder</i>
									</div>
									<div class="content">
										<div class="text"><h3><?php echo htmlentities($fnames->f_name); ?></h3></div>
										
									</div>
								</div>
							</div>
							</a>
						<?php } ?>
					</div>
                 </div>
            </div>
            </div>
            </div>
			<!--floder-->
		
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
			
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                              <h2>File list</h2>
							</div>
                        </div>
                        <div class="body">
						<div class="row clearfix">
						
						<?php foreach($file_data as $list){ ?>
								<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
									<div class="card">
									<ul class="header-dropdown m-r--5">
												<li class="dropdown">
													<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
														<i class="material-icons pull-right pad20">more_vert</i>
													</a>
													 <ul class="dropdown-menu pull-right">
														<li><a href="javascript:void(0);">Share</a></li>
														<li><a target="_blank" href="<?php echo base_url('assets/files/'.$list->img_name); ?>">Download</a></li>
														<li><a href="javascript:void(0);">Favourite</a></li>
														<li><a href="javascript:void(0);">Rename</a></li>
														<li><a href="javascript:void(0);">Move</a></li>
														<li><a href="javascript:void(0);">Copy</a></li>
														<li><a href="javascript:void(0);">Delete</a></li>
													</ul>
												</li>
											</ul>
										<div class="folder-img">
											<img class="img-responsive" src="<?php echo base_url('assets/files/'.$list->img_name); ?>" alt="<?php echo htmlentities($list->imag_org_name); ?>">
										</div>
										<div class="header help-class folder-ti">
												<label > &nbsp; <?php echo htmlentities($list->imag_org_name); ?></label>
										</div>
									</div>
								</div>
						<?php } ?>
				</div>
               </div>
            </div>
            </div>
            </div>
			
			
            </div>
            <!-- #END# CPU Usage -->
            
    </section>
