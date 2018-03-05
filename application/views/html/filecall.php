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
                                <li role="presentation" class="active"><a href="#home" data-toggle="tab">Call a File</a></li>
                                <li role="presentation"><a href="#profile" data-toggle="tab">Your Calls (n)</a></li>
                                <li role="presentation"><a href="#messages" data-toggle="tab">Other Calls(n)</a></li>
                                
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home">
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
											<a id="nextbtn" class="btn btn-primary btn-sm">See more</a>
											</div>
											
										</div>
										</form>
                                    
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile">
                                    <b>Profile Content</b>
                                    <p>
                                        Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                        Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                        pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                        sadipscing mel.
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="messages">
                                    <b>Message Content</b>
                                    <p>
                                        Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                        Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                        pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                        sadipscing mel.
                                    </p>
                                </div>
                                
                            </div>
                        </div>
							</div>
							  
						</div>
					</div>
				</div>
            </div>
        </div>
            <!-- #END# CPU Usage -->
            
    </section>
<script>
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
