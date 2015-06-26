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
                        <?php if($userRole=='ADMIN'){ ?>


                        <li <?php if($active_class == 'dashboard') { ?>class="current" <?php } ?>><a class="dashboard smronju" href="<?php echo BASE_URL; ?>administrator/dashboard" title="Dashboard"><span>Dashboard</span></a></li>
                        
                         <li <?php if($active_class == 'roles') { ?>class="current" <?php } ?>><a class="list" href="javascript:void(0)"><span>Roles</span></a>
                            <ul class="dropdown">
                                <li><a class="tables" href="<?php echo BASE_URL; ?>administrator/roles"><span>View Roles</span></a>
                                <li><a class="widgets smronju" href="<?php echo BASE_URL; ?>administrator/roles/add"><span>Add Role</span></a></li>
                            </ul>
                        </li> 
                        
                        <li <?php if($active_class == 'gyms') { ?>class="current" <?php } ?>><a class="list" href="javascript:void(0)"><span>Gyms</span></a>
                            <ul class="dropdown">
                                <li><a class="tables" href="<?php echo BASE_URL; ?>administrator/gyms"><span>View Gyms</span></a>
                                <li><a class="widgets smronju" href="<?php echo BASE_URL; ?>administrator/gyms/add"><span>Add Gym</span></a></li>
                            </ul>
                        </li>

                        <li <?php if($active_class == 'user') { ?>class="current" <?php } ?>><a class="list" href="javascript:void(0)"><span>Users</span></a>
                            <ul class="dropdown">
                                <li><a class="tables" href="<?php echo BASE_URL; ?>administrator/client"><span>View Clients</span></a>
                                <li><a class="tables" href="<?php echo BASE_URL; ?>administrator/trainer"><span>View Trainers</span></a>
                                <li><a class="widgets smronju" href="<?php echo BASE_URL; ?>administrator/user/add"><span>Add User</span></a></li>
                            </ul>
                        </li>

                        <?php } ?>

                    </ul>

                </div>

            </div>
        </div>

        <!-- Sidebar end -->
