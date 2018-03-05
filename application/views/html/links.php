<style>
a:hover {
 cursor:pointer;
}
</style>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Links</h2>
            </div>
			<div id="sucessmsg" style="display:none;"></div>
           
            <!-- CPU Usage -->
			
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                       
                        <div class="body">
						<div class="row clearfix">
							<form id="addlink" name="addlink" action="<?php echo base_url('links/addlink'); ?>" method="post" enctype="multipart/form-data">
								<?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="col-md-12 card"><br>
								<div class="row">	
								<div class="col-md-10">
									 <div class="form-group">
										 <div class="input-group form-line ">
										 <label class=" control-label">Link</label>
                                            <input type="text" id="link" name="link" class="form-control" value="" placeholder="Add LInk" />
                                        </div>
                                    </div>
								</div>
								<div class="col-md-2">
									<button type="submit" class="btn btn-warning  pull-right" >Add <span class="glyphicon glyphicon-send"></span></button>

								</div>
								</div>
									
								
							</div>
							</form>
						</div>
						<div class="row clearfix">
						
						<?php //echo '<pre>';print_r($file_data);exit; ?>
						<?php $cnt=1;foreach($links_list as $list){ ?>
								<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
									<div class="card">
									<ul class="header-dropdown m-r--5">
												<li class="dropdown">
													<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
														<i class="material-icons pull-right pad20">more_vert</i>
													</a>
													 <ul class="dropdown-menu pull-right">
														<li><a  onclick="getlinkid('<?php echo $list['l_id']; ?>');" data-toggle="modal" data-target="#defaultModal" >Share</a></li>
														<li><a href="javascript:void(0);" onclick="addfavourites('<?php echo $list['l_id']; ?>','<?php echo $cnt; ?>');" >Favourite</a></li>
														<li data-toggle="modal"  data-target="#smallModallink"><a  href="javascript:void(0);" onclick="getlinkname('<?php echo $list['l_id']; ?>','<?php echo $list['l_name']; ?>');" >Edit</a></li>
														<li><a href="<?php echo base_url('links/linkdelte/'.base64_encode($list['l_id'])); ?>">Delete</a></li>
													
													</ul>
												</li>
											</ul>
										<div class="header help-class folder-ti">
												<a target="_blank" href="<?php echo $list['l_name']; ?>"><?php echo htmlentities($list['l_name']); ?></a>
												<label > <?php echo date('M j h:i A',strtotime(htmlentities($list['l_created_at'])));?></label>
												<?php if(isset($list['yes']) && $list['yes']==1){ ?>
													<div class="pos-fav" id="addfavouriteids<?php echo $list['l_id']; ?><?php echo $cnt; ?>">
														<span class="glyphicon glyphicon-heart"></span>
													</div>
												<?php }else{?>
													<div class="pos-fav" id="addfavouriteids<?php echo $list['l_id']; ?><?php echo $cnt; ?>" style="display:none;">
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
				<div class="modal fade" id="smallModallink" tabindex="-1" role="dialog">
											<div class="modal-dialog modal-sm" role="document">
												<div class="modal-content">
													<form id="editlink" name="editlink" action="<?php echo base_url('links/linkedit'); ?>" method="post">
														<?php $csrf = array(
														'name' => $this->security->get_csrf_token_name(),
														'hash' => $this->security->get_csrf_hash()
														); ?>
															<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
															<input type="hidden" id="linkid" name="linkid" value="" />
															<div class="modal-header">
															<h4 class="modal-title" id="smallModalLabel">Edit</h4>
														</div>
														<div class="modal-body">
															<div class="form-group">
															<div class="form-line">
															<input type="text" id="linkname" name="linkname" class="form-control" value="" />
															</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-link waves-effect">Update </button>
															<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
														</div>
													</form>
												</div>
											</div>
										</div>
            </div>
            <!-- #END# CPU Usage -->
            
    </section>
	
	<script>
	function getlinkname(lid,lname){
		document.getElementById('linkid').value=lid;
		document.getElementById('linkname').value=lname;
		
	}

function addfavourites(id,val){
				jQuery.ajax({
				url: "<?php echo site_url('dashboard/addfavourite');?>",
				type: 'post',
				data: {
					form_key : window.FORM_KEY,
					item_id: id,
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'

					},
				dataType: 'JSON',
					success: function (data) {
							if(data.msg==0){
								window.location='<?php echo base_url(""); ?>'; 
							}else{
							jQuery('#sucessmsg').show();
							//alert(data.msg);
							if(data.msg==2){
							$('#sucessmsg').show('');
							$('#addfavouriteids'+id+val).hide();
							$('#sucessmsg').html('<div class="alert_msg1 animated slideInUp bg-succ"> File Successfully Remove  to Favourite &nbsp; <i class="glyphicon glyphicon-ok text-success ico_bac" aria-hidden="true"></i></div>');  
							
							}
							if(data.msg==1){
							$('#sucessmsg').show('');
								$('#addfavouriteids'+id+val).show();
								$('#sucessmsg').html('<div class="alert_msg1 animated slideInUp bg-succ"> File Successfully added  to Favourite &nbsp; <i class="glyphicon glyphicon-ok text-success ico_bac" aria-hidden="true"></i></div>');  
							}
							}
				}
			});
   	}
	$(document).ready(function() {
    $('#addlink').bootstrapValidator({
        
        fields: {
            link: {
               validators: {
					notEmpty: {
						message: 'Link is required'
					}
				}
            }
            }
        })
     
	});
   </script>
