<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Images</h2>
            </div>
			<div id="sucessmsg" style="display:none;"></div>
           
            <!-- CPU Usage -->
			
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                       
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
														<li><a  onclick="getfileid('<?php echo $list->img_id; ?>');" data-toggle="modal" data-target="#defaultModal" >Share</a></li>
														<li><a  href="<?php echo base_url('assets/files/'.$list->img_name); ?>" download>Download</a></li>
														<li><a href="javascript:void(0);" onclick="addfavourites('<?php echo $list->img_id; ?>','<?php echo $cnt; ?>');" >Favourite</a></li>
														<li data-toggle="modal" data-target="#smallModal<?php echo $list->img_id; ?>"><a href="javascript:void(0);" >Rename</a></li>
														<li data-toggle="modal" data-target="#smallModalmove<?php echo $list->img_id; ?>"><a href="javascript:void(0);">Move</a></li>
														<li><a href="<?php echo base_url('dashboard/imgdelte/'.base64_encode($list->img_id).'/'.base64_encode( isset($page_id)?$page_id:'0').'/'.base64_encode(isset($floder_id)?$floder_id:'0')); ?>">Delete</a></li>
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
										
										<!-- moving--->
										<div class="modal fade" id="smallModalmove<?php echo $list->img_id; ?>" tabindex="-1" role="dialog">
										   <div class="modal-dialog modal-sm" role="document">
											  <div class="modal-content">
												 <form id="filemoving" name="filemoving" action="<?php echo base_url('images/filemoving'); ?>" method="post">
													<?php $csrf = array(
													   'name' => $this->security->get_csrf_token_name(),
													   'hash' => $this->security->get_csrf_hash()
													   ); ?>
													<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
													<input type="hidden" name="pageid" id="filemovepageid_id" value="" >
													<input type="hidden" name="floderid" id="filemovefloderid_id" value="" >
													<input type="hidden" name="moveimgid" id="filemoveimgid_id" value="" >
													<div class="modal-header bg-site">
															<h4 class="modal-title" id="smallModalLabel">Select</h4>
													</div>
													<div class="pad-15lr">
														<div class="row max-height-scroll"><br>
														<div class="col-lg-12 ">
														<ul class="demo-choose-skin">
														<?php $c=1;foreach($floder_name_list as $li){ ?>
															<a href="javascript:void(0);"  onclick="imggetmoveid('<?php echo $li->page_id; ?>','<?php echo $li->f_id; ?>','<?php echo $list->img_id; ?>','<?php echo $c; ?>');addtabactive('<?php echo $list->img_id; ?>','<?php echo $c; ?>');">
															<li id="movingtab<?php echo $c;?><?php echo $list->img_id;?>">
																<div class=""><i class="material-icons">folder</i></div>
																<span><?php echo htmlentities($li->f_name); ?></span>
															</li></a>
														<?php $c++;} ?>
																
															</ul>
														
														</div>
														</div>
													</div>
													<div class="modal-footer">
													   <button type="submit" class="btn btn-link waves-effect">Move </button>
													   <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
													</div>
												 </form>
											  </div>
										   </div>
										</div>
										<!-- filerename--->
										<div class="modal fade" id="smallModal<?php echo $list->img_id; ?>" tabindex="-1" role="dialog">
											<div class="modal-dialog modal-sm" role="document">
												<div class="modal-content">
													<form id="filerename" name="filerename" action="<?php echo base_url('dashboard/filerename'); ?>" method="post">
														<?php $csrf = array(
														'name' => $this->security->get_csrf_token_name(),
														'hash' => $this->security->get_csrf_hash()
														); ?>
															<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
															<input type="hidden" name="pageid" value="<?php echo isset($page_id)?$page_id:'0'; ?>" />
															<input type="hidden" name="floderid" value="<?php echo isset($floder_id)?$floder_id:'0'; ?>" />
															<input type="hidden" id="imagid" name="imagid" value="<?php echo $list->img_id; ?>" />
															<div class="modal-header">
															<h4 class="modal-title" id="smallModalLabel">Rename</h4>
														</div>
														<div class="modal-body">
															<div class="form-group">
															<div class="form-line">
															<input type="text" id="filerename" name="filerename" class="form-control" value="<?php echo htmlentities($list->imag_org_name); ?>" />
															</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-link waves-effect">SAVE </button>
															<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
														</div>
													</form>
												</div>
											</div>
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
	
	<script>

function imggetmoveid(pid,fid,imgid,id){
	 document.getElementById('filemovepageid_id').value=pid;
	 document.getElementById('filemovefloderid_id').value=fid;
	 document.getElementById('filemoveimgid_id').value=imgid;
}
	function addtabactive(imgid,id)
{
	$("#movingtab"+id+imgid).addClass("active");
	var cnt;
    var nt =<?php echo count($floder_name_list); ?>;
	//var cnt='';
	for(cnt = 1; cnt <= nt; cnt++){
		if(cnt!=id){
			$("#movingtab"+cnt+imgid).removeClass("active");
		}             
	}
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
   </script>
