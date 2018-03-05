<section class="content">
        <div class="container-fluid">
           
			<div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                    <h2>My Devices </h2>
                            </div>
                            
                        </div>
                        <div class="body">
						<div class="row text-center ">
							<div class="col-md-offset-5 col-md-2">
							<?php if($userdetails['u_barcode_image']!=''){?>
								<img class="img-responsive thumbnail" src="<?php echo base_url('assets/userbarcodes/'.$userdetails['u_barcode_image']); ?>" alt="<?php echo htmlentities($userdetails['u_barcode']);?>">
								<h4>Barcode:<span class="text-primary"><?php echo htmlentities($userdetails['u_barcode']);?></span></h4>
							<?php }else{ ?>
								<img class="img-responsive thumbnail" src="images/barcode.png" alt="barcode">
								<h4>Barcode:<span class="text-primary">xxxxxxxxxx</span></h4>
							<?php } ?>
							</div>
						</div>
						
				   </div>
				</div>
			</div>
		</div>
</section>
