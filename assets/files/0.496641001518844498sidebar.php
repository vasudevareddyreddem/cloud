<?php //echo '<pre>';print_r($userdetails);exit; ?>
<section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
					<?php if($userdetails['u_profilepic']!=''){?>
                    <img src="<?php echo base_url('assets/users/'.$userdetails['u_profilepic']); ?>" width="48" height="48" alt="<?php echo htmlentities($userdetails['u_profilepic']);?>" />
					<?php }else{ ?>
					<img src="<?php echo base_url('assets/users/user.png'); ?>" width="48" height="48" alt="User" />
					<?php } ?>
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo htmlentities($userdetails['u_name']);?></div>
                    <div class="email"><?php echo htmlentities($userdetails['u_email']);?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?php echo base_url('profile'); ?>"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="index.php">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="pc.php" >
                            <i class="material-icons">important_devices</i>
                            <span>My Devices</span>
                        </a>
                        
                    </li> 
					<li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons"> insert_drive_file</i>
                            <span>Files</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Cards</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="pages/widgets/cards/basic.html">Basic</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/cards/colored.html">Colored</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/cards/no-header.html">No Header</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
					 <li class="">
                        <a href="#">
                            <i class="material-icons">dashboard</i>
                            <span>Images</span>
                        </a>
                    </li>
				
					 <li class="">
                        <a href="#">
                            <i class="material-icons">dashboard</i>
                            <span>Recent</span>
                        </a>
                    </li>
					 <li class="">
                        <a href="#">
                            <i class="material-icons">dashboard</i>
                            <span>Shared</span>
                        </a>
                    </li>
					 <li class="">
                        <a href="#">
                            <i class="material-icons">dashboard</i>
                            <span>Links</span>
                        </a>
                    </li>
					<li class="">
                        <a href="filecall.php">
                            <i class="material-icons">dashboard</i>
                            <span>File Call</span>
                        </a>
                    </li>
					<li class="">
                        <a href="#">
                            <i class="material-icons">dashboard</i>
                            <span>Recycle Bin</span>
                        </a>
                    </li>
					<li class="">
                        <a href="#">
                            <i class="material-icons">dashboard</i>
                            <span>Upgrade Storage</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                     <a href="javascript:void(0);">Cloud Website</a>.
                </div>
               
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
       
    </section>