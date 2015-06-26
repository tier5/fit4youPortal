<div class="body-container span10">

            <div class="row-fluid">
                <div class="span12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="/admin/dashboard">Admin</a> <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="">Roles</a> <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="">Add</a> <span class="divider">/</span>
                        </li>
                    </ul>
                </div>
            </div>

            <span style="color:green;"><?= $this->Flash->render('positive') ?></span>
            
            <div class="row-fluid">

                <div class="span12">
                    <section class="utopia-widget">
                        <div class="utopia-widget-title">
                            <img class="utopia-widget-icon" src="<?php echo BASE_URL; ?>backend/img/icons2/software24.png">
                            <span>Add Roles</span>
                        </div>

                        
                        <form name="addFrm" id="addFrm" method="POST" action="">
                        <div class="utopia-widget-content">
                        
                        <div class="row-fluid">
                                                    
                        <div class="span6">
                            <div class="dataTables_filter" id="DataTables_Table_0_filter" style="margin-top: 4px; margin-right: 293px;"> 
                                <input type="text" placeholder="Enter roles here" name="roleName" id="roleName" value="<?php //echo $searchKey; ?>" />
                            </div>
                        </div>

                        </div>
                                    
                            <span style="color:red;"><?= $this->Flash->render('negative') ?></span>        

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



