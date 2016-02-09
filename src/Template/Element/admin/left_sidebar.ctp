 <!-- Sidebar statrt -->
        <div class="span2 sidebar-container">

            <div class="sidebar">

                <div class="navbar sidebar-toggle">
                    <div class="container">

                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>

                    </div>
                </div>

                <div class="nav-collapse collapse leftmenu">

                    <ul>
                        <?php if($userRole=='ADMIN'){

						?>
						
                        <li <?php if($active_class == 'dashboard') { ?>class="current" <?php } ?>><a class="dashboard smronju" href="<?php echo BASE_URL; ?>administrator/dashboard" title="Dashboard"><span><i class="fa fa-dashboard"></i> Dashboard</span></a></li>
                        
                        <li><a class="tables" href="<?php echo BASE_URL; ?>administrator/client"><span>View Clients</span></a>
                        <li><a class="tables" href="<?php echo BASE_URL; ?>administrator/trainer"><span>View Trainers</span></a>
                        <li><a class="widgets smronju" href="<?php echo BASE_URL; ?>administrator/user/add"><span>Add User</span></a></li>
                        </li>
                                
                        <li <?php if($active_class == 'schedule') { ?>class="current" <?php } ?>><a class="list" href="<?php echo BASE_URL; ?>administrator/schedule"><span><i class="fa fa-list-alt"></i> Schedule</span></a></li>
                                
                        <li <?php if($active_class == 'gyms') { ?>class="current" <?php } ?>><a class="list" href="<?php echo BASE_URL; ?>administrator/gyms"><span><i class="fa fa-male"></i> Gyms</span></a>
                        </li>
                                
                        <li <?php if($active_class == 'settings') { ?>class="current" <?php } ?>><a class="dashboard smronju" href="<?php echo BASE_URL; ?>administrator/settings" title="Dashboard"><span><i class="fa fa-cog"></i> Settings</span></a></li>


                        <?php } ?>

                    </ul>

                </div>

            </div>
        </div>

        <!-- Sidebar end -->
