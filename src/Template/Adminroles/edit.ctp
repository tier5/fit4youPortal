<div class="body-container span10">

            <div class="row-fluid">
                <div class="span12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL; ?>administrator/roles">Roles</a> <span class="divider">/</span>
                        </li>
                        <li>
                            <!--<a href="">EDit</a> <span class="divider">/</span>-->Edit
                        </li>
                    </ul>
                </div>
            </div>

            <span style="color:green;"><?= $this->Flash->render('positive') ?></span>
            <span style="color:red;"><?= $this->Flash->render('negative') ?></span>
            <div class="row-fluid">

                <div class="span12">
                    <section class="utopia-widget">
                        <div class="utopia-widget-title">
                            <img class="utopia-widget-icon" src="<?php echo BASE_URL; ?>backend/img/icons2/software24.png">
                            <span>Edit Roles</span>
                        </div>

                        
                        <form name="addFrm" id="addFrm" method="POST" action="">
                        <div class="utopia-widget-content">
                        
                        <div class="row-fluid">
                                                    
                        <div class="span6">
                            <div class="dataTables_filter" id="DataTables_Table_0_filter" style="margin-top: 4px; margin-right: 293px;"> 
                                <input type="text" value="<?php echo $roles->roleName; ?>" placeholder="Enter roles here" name="roleName" id="roleName" />
                                <input type="hidden" value="<?php echo $roles->roleName; ?>" placeholder="Enter roles here" name="old_roleName" />
                            </div>
                        </div>

                        </div>
                                    
                            <span style="color:green;"><?= $this->Flash->render('positive') ?></span>        
                            

                            <div class="row-fluid">
                                <div class="span6"> </div>
                                <div><input type="submit" name="subBtn" id="subBtn" value="Submit"></div>
                            </div>

                        </div>
                            
                        
                        </form>
                    </section>
                </div>
            </div>



</div>



