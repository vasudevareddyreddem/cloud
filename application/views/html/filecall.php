<head>
 <script src="plugins/jquery/jquery.min.js"></script>

</head>
<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
						<div class="header">
							<div class="row clearfix">
									<h2>File Call</h2>
							</div>
							
						</div>
						<div class="body">
							<div class="row clearfix">
								<div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="<?php if(isset($tab) && $tab==''){ echo "active"; } ?> "><a href="#home" data-toggle="tab">Call a File</a></li>
                                <li role="presentation" class="<?php if(isset($tab) && $tab==2){ echo "active"; } ?> "><a href="#profile" data-toggle="tab">Your Calls (n)</a></li>
                                <li role="presentation" class="<?php if(isset($tab) && $tab==3){ echo "active"; } ?> "><a href="#messages" data-toggle="tab">Other Calls(n)</a></li>
                                
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in <?php if(isset($tab) && $tab==''){ echo "active"; } ?>" id="home">
								<form id="filecall" name="filecall" action="<?php echo base_url('filecall/addrequest'); ?>" method="post" >
										<div class="col-md-6 col-md-offset-3 mart-20">
											<div class="form-group">
												<div class="form-group">
													<div class="form-line">
														<label>What are you calling?</label>
														<input type="text" id="calling" name="calling" class="form-control" placeholder=" Like File name or Folder name" />
													</div>
												</div>
												
											</div>
											<div class="form-group">
												<div class="form-group">
													<div class="form-line">
														<label>Where do you want to store? (By default File Calls folder in my files)</label>
														<input type="text" class="form-control" placeholder="File Call" readonly="true"/>
													</div>
												</div>
												
											</div>
											<div id="nextcon" style="display:none">
												<div class="form-group">
												<div class="form-group">
													<div class="form-line">
														<label>Share to another cloud account</label>
														  <select style="width:100%" id="multiple" name="filecalling[]"  class="form-line select2-multiple" multiple>
																<?php foreach($all_users_list as $list){ ?>
																<option value="<?php echo $list['u_id']; ?>"><?php echo $list['u_name']; ?></option>
																<?php } ?>
														  </select>
													</div>
												</div>
												
											</div>
											<div class="form-group">
												<div class="form-group">
													<div class="form-line">
														<label>Enter email address,we will mail to them for you</label>
														<input type="email" id="calling_email_id" name="calling_email_id" class="form-control" placeholder="Email Address"/>
													</div>
												</div>
												
											</div>
											<button type="submit" class="btn btn-primary btn-sm">Submit</button>
											</div>
											<div>
											<br><br>
											<a id="nextbtn" class="btn btn-primary btn-sm">Next</a>
											</div>
											
										</div>
										</form>
                                    
                                </div>
                                <div role="tabpanel" class="tab-pane fade in  <?php if(isset($tab) && $tab==2){ echo "active"; } ?>" id="profile">
                                    <b>Profile Content</b>
                                    <p>
                                        Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                        Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                        pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                        sadipscing mel.
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in  <?php if(isset($tab) && $tab==3){ echo "active"; } ?>" id="messages">
                                    <?php foreach($all_notofication_lists as $list){ ?>
									
														<div class="menu-info">
															<h4><?php echo htmlentities($list['u_name']).' request for File calling  name is '. htmlentities($list['f_c_calling']); ?></h4>
															<?php if($list['u_id']!= $userdetails['u_id']){ ?>
																<?php if($list['f_c_request']==0){ ?>
																<a data-toggle="modal"  data-target="#smallModalfilecall" onclick="sendrequest_id('<?php echo $list['u_id']; ?>','<?php echo $list['filecall_id']; ?>');" >proceed</a>
																<a href="<?php echo base_url('filecall/requestaccept/'.base64_encode($list['filecall_id']).'/'.base64_encode(2)); ?>">decline</a>
																<?php }else{ ?>
																		<p><?php if($list['f_c_request']==1){ echo "Accepted";}else if($list['f_c_request']==2){ echo "declined"; }else{ echo "In progress";} ?></p>
																<?php } ?>
															<?php }else{ ?>
															<p><?php if($list['f_c_request']==1){ echo "Accepted";}else if($list['f_c_request']==2){ echo "declined"; }else{ echo "In progress";} ?></p>
															<?php } ?>
															<p>
																<i class="material-icons">access_time</i><?php echo date('M j h:i A',strtotime(htmlentities($list['filecall_created_at'])));?>
															</p>
														</div>
									
									<?php } ?>
                                </div>
                                
                            </div>
                        </div>
							</div>
							  
						</div>
					</div>
				</div>
            </div>
        </div>
		<!-- filecall -->
		<div class="modal fade" id="smallModalfilecall"  role="dialog">
			<div class="modal-dialog" role="document">
												<div class="modal-content">
												 <div class="modal-header bg-site">
													<h4 class="modal-title" id="defaultModalLabel">Sharing</h4>
												 </div>
												 <form action="<?php echo base_url('filecall/fiilecalling'); ?>" id="filecall" name="filecall" method="post">
												 <?php $csrf = array(
															'name' => $this->security->get_csrf_token_name(),
															'hash' => $this->security->get_csrf_hash()
													); ?>
												<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
												<input type="hidden" id="filecalling_id" name="filecalling_id" value="" />
												<input type="hidden" id="filecalled_id" name="filecalled_id" value="" />
												 <div class="modal-body pad-cus" style="padding-bottom:0px ;">
													<div class="row ">
													<div class="col-md-8 ">
													<div class="form-group ">
													   <label>Share to another cloud account</label>
													  
														  <select style="width:100%" id="multiple" name="filesharing"  class="form-line select2-multiple" >
																<option> Select </option>
																<?php foreach($folder_data as $list){ ?>
																<option value="<?php echo $list['f_id'].'/'.'folder'; ?>"><?php echo $list['f_name']; ?></option>
																<?php } ?>
																<?php foreach($file_data as $li){ ?>
																<option value="<?php echo $li['img_id'].'/'.'file'; ?>"><?php echo $li['imag_org_name']; ?></option>
																<?php } ?>
														  </select>
														 
													</div>
													</div>
													<div class="col-md-2 ">
													<style>.bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) { width: 150px;border: 1px solid #ddd;
}
													</style>
													<div class="form-group " style="width:100px;">
													   <label>&nbsp;</label>
														  <select  name="permissions" id="permissions" style="width:100px;" >
																<option value="Read">READ</option>
																<option value="Write">WRITE</option>
														  </select>
													</div>
													</div>
													</div>
													
													<div class="form-group">
													   
													   <div class="modal-footer ">
														  <button type="submit" class="btn btn-link waves-effect">SHARE</button>
														  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
													   </div>
													</div>
												 </div>
												 </form>
												</div>
												</div>
		</div>
		<!-- filecall -->
            <!-- #END# CPU Usage -->
            
    </section>
<script>
function sendrequest_id(id,ids){
	document.getElementById('filecalling_id').value=id;
	document.getElementById('filecalled_id').value=ids;
	}
$(document).ready(function(){
    $("#nextbtn").click(function(){
        $("#nextcon").toggle();
    });
});
$(document).ready(function() {
    $('#filecall').bootstrapValidator({
        
        fields: {
            calling: {
               validators: {
					notEmpty: {
						message: 'Calling Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Name can only consist of alphanumaric, space and dot'
					}
				}
            },
			multiple: {
               validators: {
					notEmpty: {
						message: 'Select share acount is required'
					}
				}
            }
            }
        })
     
	});
</script>
