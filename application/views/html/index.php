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
														<li><a  data-toggle="modal" data-target="#defaultModal" >Share</a></li>
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
											
										<div class="pos-fav">
											<span class="glyphicon glyphicon-heart"></span>
										</div>
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
            <!-- Modals -->
			<div class="modal fade help-class-modal" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-site">
                            <h4 class="modal-title" id="defaultModalLabel">Sharing</h4>
                        </div>
                        <div class="modal-body pad-cus" style="padding-bottom:0px ;">
                           <div class="form-group ">
							<label>Share to another cloud account</label>
							<div class="">
								<select style="width:100%;" id="multiple" class="form-line select2-multiple" multiple>
									<optgroup label="Alaskan/Hawaiian Time Zone">
										<option value="AK">Alaska</option>
										<option value="HI">Hawaii</option>
									</optgroup>
									<optgroup label="Pacific Time Zone">
										<option value="CA">California</option>
										<option value="NV">Nevada</option>
										<option value="OR">Oregon</option>
										<option value="WA">Washington</option>
									</optgroup>
									<optgroup label="Mountain Time Zone">
										<option value="AZ">Arizona</option>
										<option value="CO">Colorado</option>
										<option value="ID">Idaho</option>
										<option value="MT">Montana</option>
										<option value="NE">Nebraska</option>
										<option value="NM">New Mexico</option>
										<option value="ND">North Dakota</option>
										<option value="UT">Utah</option>
										<option value="WY">Wyoming</option>
									</optgroup>
									<optgroup label="Central Time Zone">
										<option value="AL">Alabama</option>
										<option value="AR">Arkansas</option>
										<option value="IL">Illinois</option>
										<option value="IA">Iowa</option>
										<option value="KS">Kansas</option>
										<option value="KY">Kentucky</option>
										<option value="LA">Louisiana</option>
										<option value="MN">Minnesota</option>
										<option value="MS">Mississippi</option>
										<option value="MO">Missouri</option>
										<option value="OK">Oklahoma</option>
										<option value="SD">South Dakota</option>
										<option value="TX">Texas</option>
										<option value="TN">Tennessee</option>
										<option value="WI">Wisconsin</option>
									</optgroup>
									<optgroup label="Eastern Time Zone">
										<option value="CT">Connecticut</option>
										<option value="DE">Delaware</option>
										<option value="FL">Florida</option>
										<option value="GA">Georgia</option>
										<option value="IN">Indiana</option>
										<option value="ME">Maine</option>
										<option value="MD">Maryland</option>
										<option value="MA">Massachusetts</option>
										<option value="MI">Michigan</option>
										<option value="NH">New Hampshire</option>
										<option value="NJ">New Jersey</option>
										<option value="NY">New York</option>
										<option value="NC">North Carolina</option>
										<option value="OH">Ohio</option>
										<option value="PA">Pennsylvania</option>
										<option value="RI">Rhode Island</option>
										<option value="SC">South Carolina</option>
										<option value="VT">Vermont</option>
										<option value="VA">Virginia</option>
										<option value="WV">West Virginia</option>
									</optgroup>
								</select>
							</div>
                        </div>
						<br>
						<hr >
						<h4 class="text-center mart-neg"><span>OR</span></h4>
						<br>
							<div class="form-group">
								<div class="form-line ">
								<label>Enter email address,we will mail to them for you</label>
									<input type="email"  class="form-control" placeholder="Enter your email" />
								</div>
								<br>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-link waves-effect">SHARE</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
			
            
    </section>
