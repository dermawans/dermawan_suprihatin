<!--========================= Content Wrapper ==============================-->
<?php
$berhasil = $this->session->flashdata('berhasil');
$gagal = $this->session->flashdata('gagal');
if($berhasil){
	echo '<p class="alert alert-info text-center">'.$berhasil .'</p>';
}
if($gagal){
	echo '<p class="alert alert-danger text-center">'.$gagal .'</p>';
}
?>
<!-- start: page -->
<div class="row">
    <section class="panel panel-dark">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
            </div>
            <h2 class="panel-title">Master Data</h2>
        </header>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="tabs">
                    <ul class="nav nav-tabs">
                    <?php if ($this->session->userdata('level') == 'super_admin') { ?>
                        <li class="active">
                            <a href="#user" data-toggle="tab">User</a>
                        </li>
                        <li>
                            <a href="#level_user" data-toggle="tab"> level User</a>
                        </li>
                        <li>
                            <a href="#category" data-toggle="tab">Category</a>
                        </li>
                        <li>
                            <a href="#delivery_service" data-toggle="tab">Delivery Service</a>
                        </li>
                        <li>
                            <a href="#agen_type" data-toggle="tab">Agen Type</a>
                        </li>
                        <li>
                            <a href="#status_agen" data-toggle="tab">Status Agen</a>
                        </li>
                    <?php } ?> 
                    <?php if ($this->session->userdata('level') == 'operation_admin') { ?>
                        <li class="active">
                            <a href="#user" data-toggle="tab">User</a>
                        </li>
                        <li>
                            <a href="#delivery_service" data-toggle="tab">Delivery Service</a>
                        </li>
                    <?php } ?>
                    </ul>
                    <div class="tab-content">
                    	
                        <!--awal tab user-->
                        <div id="user" class="tab-pane active">
                            <!--user-->
                            <section class="panel">
                                <header class="panel-heading">
                                    <div class="panel-actions">
                                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
                                    </div>
                                    <h2 class="panel-title">User</h2>
                                </header>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-condensed mb-none" id="datatable-tabletools">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>level</th>
                                                <th>Username</th>
                                                <th>name</th>
                                                <th>Date Create</th>
                                                <th>Las Login</th>
                                                <th>
                                                 <?php if ($this->session->userdata('level') == 'super_admin') 
												 { ?>
                                                <a href="#add_user" class="modal-with-form btn btn-sm btn-dark"><i class="fa fa-plus-circle"></i> Add User</a>									 
                                                <?php } ?>
                                                </th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if ($this->session->userdata('level') == 'super_admin') { ?>
                                        <?php
                                            $no=1;
                                            if(isset($data_master_user)){
                                                foreach($data_master_user as $row){
                                        ?>
                                                <tr class="gradeX">
                                                    <th><?php echo $no++; ?></th>
                                                    <th><?php echo $row->level; ?></th>
                                                    <th><?php echo $row->username; ?></th>
                                                    <th><?php echo $row->name; ?></th>
                                                    <th><?php echo $row->date_create; ?></th> 
                                                    <th><?php echo $row->last_login; ?></th> 
                                                    <th><a href="#edit_user<?php echo $row->id_user; ?>" class="modal-with-form btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a></th>
                                                </tr>
                                                <?php }
                                            }
                                            ?>                                             
                                        <?php } ?>
                                        <?php if ($this->session->userdata('level') <> 'super_admin') { ?>
                                        <?php
                                            $no=1;
                                            if(isset($data_master_user_no_sudo)){
                                                foreach($data_master_user_no_sudo as $row5){
                                        ?>
                                                <tr class="gradeX">
                                                    <th><?php echo $no++; ?></th>
                                                    <th><?php echo $row5->level; ?></th>
                                                    <th><?php echo $row5->username; ?></th>
                                                    <th><?php echo $row5->name; ?></th>
                                                    <th><?php echo $row5->date_create; ?></th> 
                                                    <th><?php echo $row5->last_login; ?></th> 
                                                    <th><a href="#edit_user<?php echo $row5->id_user; ?>" class="modal-with-form btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a></th>
                                                </tr>
                                                <?php }
                                            }
                                            ?>                                             
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </section>
                            <!--user-->
                        </div>
                        <!--akhir tab user-->
                        
                        <!--awal tab level user-->
                        <div id="level_user" class="tab-pane">
                            <div class="panel-body">
                            <!--level User-->
                            <section class="panel">
                                <header class="panel-heading">
                                    <div class="panel-actions">
                                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
                                    </div>
                                    <h2 class="panel-title">level User</h2>
                                </header>
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-condensed mb-none">
                                        <thead>
                                            <tr>
                                                <th>No</th> 
                                                <th>level name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
                                            $no=1;
                                            if(isset($data_master_level_user)){
                                                foreach($data_master_level_user as $row){
                                                    ?>
                                                    <tr class="gradeX">
                                                        <th><?php echo $no++; ?></th> 
                                                        <th><?php echo $row->level_name; ?></th>
                                                    </tr>
                                                <?php }
                                            }
                                            ?> 
                                        </tbody>
                                    </table>
                                    </div>
                                </section>
                            <!--level User-->
                            </div>
                        </div>
                        <!--akhir tab level user-->
                                             
                        <!--awal tab category-->
                        <div id="category" class="tab-pane">
                            <div class="panel-body">
                            <!--Category-->
                                <section class="panel">
                                    <header class="panel-heading">
                                        <div class="panel-actions">
                                            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
                                        </div>
                                        <h2 class="panel-title">Category</h2>
                                    </header>
                                        <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-condensed mb-none">
                                            <thead>
                                                <tr>
                                                    <th>No</th> 
                                                    <th>Category name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php
                                                $no=1;
                                                if(isset($data_master_category)){
                                                    foreach($data_master_category as $row){
                                                        ?>
                                                        <tr class="gradeX">
                                                            <th><?php echo $no++; ?></th> 
                                                            <th><?php echo $row->category_name; ?></th>
                                                        </tr>
                                                    <?php }
                                                }
                                                ?> 
                                            </tbody>
                                        </table>
                                        </div>
                                </section>
                            <!--Category-->
                            </div>
                        </div>
                        <!--akhir tab Category-->
                                                
                        <!--awal tab delivery service-->
                        <div id="delivery_service" class="tab-pane">
                            <!--delivery service-->
                            <section class="panel">
                                <header class="panel-heading">
                                    <div class="panel-actions">
                                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
                                    </div>
                                    <h2 class="panel-title">Delivery Service</h2>
                                </header>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-condensed mb-none">
                                        <thead>
                                            <tr>
                                                <th>No</th> 
                                                <th>Delvery Service name</th>
                                                <th><a href="#add_delivery_service" class="modal-with-form btn btn-sm btn-dark"><i class="fa fa-plus-circle"></i> Add Data</a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
                                            $no=1;
                                            if(isset($data_master_delivery_service)){
                                                foreach($data_master_delivery_service as $row){
                                                    ?>
                                                    <tr class="gradeX">
                                                        <th><?php echo $no++; ?></th> 
                                                        <th><?php echo $row->delivery_service_name; ?></th> 
                                                        <th><a href="#edit_delivery_service<?php echo $row->id_delivery_service; ?>" class="modal-with-form btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a></th>
                                                    </tr>
                                                <?php }
                                            }
                                            ?> 
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </section>
                            <!--delivery service-->
                        </div>
                        <!--akhir tab delivery service-->
                        
                        <!--awal tab agen type-->
                        <div id="agen_type" class="tab-pane">
                            <!--agen type-->
                            <section class="panel">
                                <header class="panel-heading">
                                    <div class="panel-actions">
                                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
                                    </div>
                                    <h2 class="panel-title">Agen Type</h2>
                                </header>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-condensed mb-none">
                                        <thead>
                                            <tr>
                                                <th>No</th> 
                                                <th>Agen Type name</th>
                                                <th><a href="#add_agen_type" class="modal-with-form btn btn-sm btn-dark"><i class="fa fa-plus-circle"></i> Add Data</a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
                                            $no=1;
                                            if(isset($data_master_agen_type)){
                                                foreach($data_master_agen_type as $row){
                                                    ?>
                                                    <tr class="gradeX">
                                                        <th><?php echo $no++; ?></th> 
                                                        <th><?php echo $row->agen_type_name; ?></th> 
                                                        <th><a href="#edit_agen_type<?php echo $row->id_agen_type; ?>" class="modal-with-form btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a></th>
                                                    </tr>
                                                <?php }
                                            }
                                            ?> 
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </section>
                            <!--agen type-->
                        </div>
                        <!--akhir tab agen type-->
                        
                        <!--awal tab agen status-->
                        <div id="status_agen" class="tab-pane">
                            <!--status type-->
                            <section class="panel">
                                <header class="panel-heading">
                                    <div class="panel-actions">
                                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
                                    </div>
                                    <h2 class="panel-title">Agen Status</h2>
                                </header>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-condensed mb-none">
                                        <thead>
                                            <tr>
                                                <th>No</th> 
                                                <th>Agen Status name</th>
                                                <th><a href="#add_status_agen" class="modal-with-form btn btn-sm btn-dark"><i class="fa fa-plus-circle"></i> Add Data</a>
                                                </th>
                                                <th>Color Picker</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
                                            $no=1;
                                            if(isset($data_master_status_agen)){
                                                foreach($data_master_status_agen as $row){
                                                    ?>
                                                    <tr class="gradeX">
                                                        <th><?php echo $no++; ?></th> 
                                                        <th><?php echo $row->nama_status; ?></th> 
                                                        <th><a href="#edit_status_agen<?php echo $row->id_status_agen; ?>" class="modal-with-form btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a> 
                        								</th>	
                                                        <th class="col-sm-2"><input type="text" data-plugin-colorpicker class="colorpicker-default form-control" value="#8fff00"/>	
                                                        </th>
                                                    </tr>
                                                <?php }
                                            }
                                            ?> 
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </section>
                            <!--status type-->
                        </div>
                        <!--akhir tab agen status-->
                        
                	</div>
                </div>
            </div>
        </div>
    </section>
</div>
                    
<!-- end: page -->


<!-- Modal Form Add Delivery Service -->
<div id="add_status_agen" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open('master_data/add_status_agen','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Add Agen Status</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Status name</label>
                    <div class="col-sm-6">
                        <input type="text" name="nama_status" class="form-control" placeholder="Type status..." required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Background Color <br /><span>Type without "#"</span></label>
                    <div class="col-sm-6">
                        <input type="text" name="warna_lingkaran" class="form-control" placeholder="chose from color picker.." required>	
                	</div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Font Color <br /><span>Type without "#"</span></label>
                    <div class="col-sm-6">
                        <input type="text" name="warna_huruf_dalam_lingkaran" class="form-control" placeholder="chose from color picker.." required>	
                	</div>
                </div>
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input id="inputer" class="form-control" name="inputer" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
<!-- Modal Form Add Delivery Service -->


<!-- Modal Form Edit Delivery Service -->
<?php 
	if(isset($data_master_status_agen)){
		foreach($data_master_status_agen as $row1){
?>

<div id="edit_status_agen<?php echo $row1->id_status_agen; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open('master_data/save_status_agen','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Edit Status Agen</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">ID Status Agen</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_status_agen" class="form-control" value="<?php echo $row1->id_status_agen; ?>" readonly="readonly" required/>
                    </div>
                </div>
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Status name</label>
                    <div class="col-sm-6">
                        <input type="text" name="nama_status" class="form-control"  value="<?php echo $row1->nama_status; ?>"  required/>
                    </div>
                </div>
                
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Background Color <br /><span>Type without "#"</span></label>
                    <div class="col-sm-6">
                        <input type="text" name="warna_lingkaran" class="form-control" placeholder="chose from color picker.." value="<?php echo $row1->warna_lingkaran; ?>" required>	
                	</div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Font Color <br /><span>Type without "#"</span></label>
                    <div class="col-sm-6">
                        <input type="text" name="warna_huruf_dalam_lingkaran" class="form-control" placeholder="chose from color picker.."  value="<?php echo $row1->warna_huruf_dalam_lingkaran; ?>" required>	
                	</div>
                </div>
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input id="last_edit_by" class="form-control" name="last_edit_by" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
                
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
    <?php }} ?>
<!-- Modal Form Edit Status Agen -->




<!-- Modal Form Add Delivery Service -->
<div id="add_delivery_service" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open('master_data/add_delivery_service','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Add Delivery Service</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Delivery Service name</label>
                    <div class="col-sm-6">
                        <input type="text" name="delivery_service_name" class="form-control" placeholder="Type name..." required/>
                    </div>
                </div>
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input id="inputer" class="form-control" name="inputer" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
<!-- Modal Form Add Delivery Service -->


<!-- Modal Form Edit Delivery Service -->
<?php 
	if(isset($data_master_delivery_service)){
		foreach($data_master_delivery_service as $row1){
?>

<div id="edit_delivery_service<?php echo $row1->id_delivery_service; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open('master_data/save_delivery_service','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Edit Delivery Service</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">ID Delivery Service</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_delivery_service" class="form-control" value="<?php echo $row1->id_delivery_service; ?>" readonly="readonly" required/>
                    </div>
                </div>
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Delivery Service name</label>
                    <div class="col-sm-6">
                        <input type="text" name="delivery_service_name" class="form-control"  value="<?php echo $row1->delivery_service_name; ?>"  required/>
                    </div>
                </div>
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input id="last_edit_by" class="form-control" name="last_edit_by" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
                
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
    <?php }} ?>
<!-- Modal Form Edit Delivery Service -->


<!-- Modal Form Add Agen Type -->
<div id="add_agen_type" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open('master_data/add_agen_type','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Add Agen Type</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Type name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_type_name" class="form-control" placeholder="Type name..." required/>
                    </div>
                </div>
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input id="inputer" class="form-control" name="inputer" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
<!-- Modal Form Add Agen Type-->


<!-- Modal Form Edit Agen Type-->
<?php 
	if(isset($data_master_agen_type)){
		foreach($data_master_agen_type as $row1){
?>

<div id="edit_agen_type<?php echo $row1->id_agen_type; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open('master_data/save_agen_type','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Edit Agen Type</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Type</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_agen_type" class="form-control" value="<?php echo $row1->id_agen_type; ?>" readonly="readonly" required/>
                    </div>
                </div>
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Type name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_type_name" class="form-control"  value="<?php echo $row1->agen_type_name; ?>"  required/>
                    </div>
                </div>
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input id="last_edit_by" class="form-control" name="last_edit_by" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
                
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
    <?php }} ?>
<!-- Modal Form Edit Agen Type-->

<!-- Modal Form Add User-->
<div id="add_user" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open('master_data/add_user','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Add User</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">ID User</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_user" class="form-control" value="<?php echo $id_user;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">level</label>
                    <div class="col-sm-6">
                        <select data-plugin-selectTwo class="form-control populate" id="level" name="level" placeholder="Chose level" required>
                    				<option value=""></option>
                            <?php
                            if(isset($data_master_level_user)){
                                foreach($data_master_level_user as $lev){
                                    ?>
                                    <option value="<?php echo $lev->level_name;?>"><?php echo $lev->level_name;?></option>
                                <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Id Agen</label>
                    <div class="col-sm-6">
                    <select data-plugin-selectTwo class="form-control populate" id="id_agen" name="id_agen" placeholder="Chose Agen">
                    				<option value=""></option>
                            <?php
                            if(isset($data_master_agen)){
                                foreach($data_master_agen as $agen){
                                    ?>
                                    <option value="<?php echo $agen->id_agen;?>"><?php echo $agen->agen_name;?></option>
                                <?php
                                }
                            }
                            ?>
                    </select>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Email</label>
                    <div class="col-sm-6">
                        <input type="email" name="email" class="form-control" placeholder="Type email..." required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" placeholder="Type name..." required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Username</label>
                    <div class="col-sm-6">
                        <input type="text" name="username" class="form-control" placeholder="Type username..." required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Password</label>
                    <div class="col-sm-6">
                        <input type="password" name="password" class="form-control" required minimumInputLength="6" >
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Date Create</label>
                    <div class="col-sm-6">
                        <input type="text" name="date_create" class="form-control" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" required readonly="readonly" placeholder="Type password...">
                    </div>
                </div>
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input id="inputer" class="form-control" name="created" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
<!-- Modal Form Add User-->


<!-- Modal Form Edit User-->
<?php 
	if(isset($data_master_user)){
		foreach($data_master_user as $row1){
?>

<div id="edit_user<?php echo $row1->id_user; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open('master_data/save_user','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Edit User</h2>
        </header>
        <div class="panel-body">
            
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">ID User</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_user" class="form-control" value="<?php echo $row1->id_user;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">level</label>
                    <div class="col-sm-4">
                        <input type="text" name="level" class="form-control"  value="<?php echo $row1->level;?>" readonly="readonly"  required/>
                    </div>
                    <?php if ($this->session->userdata('level') == 'super admin') { ?>
                    <div class="col-sm-3">
                        <a href="#edit_level<?php echo $row1->id_user; ?>" class="modal-with-form btn btn-sm btn-primary">Change</a>
                    </div>
                    <?php } ?>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Username</label>
                    <div class="col-sm-6">
                        <input type="text" name="username" class="form-control"  value="<?php echo $row1->username;?>"  required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Password</label>
                    <div class="col-sm-6">
                        <a href="#edit_password<?php echo $row1->id_user; ?>" class="modal-with-form btn btn-sm btn-primary">Change</a>
                    </div>
                </div>
                  
                <div class="form-group">
                        <div class="col-md-6">
                            <input class="form-control" name="last_edit" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
    <?php }} ?>
<!-- Modal Form Edit User-->


<!-- Modal Form Change Password-->
<?php 
	if(isset($data_master_user)){
		foreach($data_master_user as $row1){
?>

<div id="edit_password<?php echo $row1->id_user; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open('master_data/change_password','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Change Password</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">New Password</label>
                    <div class="col-sm-6">
                        <input type="password" name="password" class="form-control" required/>
                    </div>
                </div>
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input id="inputer" class="form-control" name="id_user" value="<?php echo $row1->id_user; ?>" type="hidden" readonly>
                        </div>
                </div>
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input class="form-control" name="last_edit" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
<?php }} ?>

<!-- Modal Form Change Password-->


<!-- Modal Form Change level-->
<?php 
	if(isset($data_master_user)){
		foreach($data_master_user as $row1){
?>

<div id="edit_level<?php echo $row1->id_user; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open('master_data/change_level','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Change level</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">New level</label>
                    <div class="col-sm-6">
                        <select data-plugin-selectTwo class="form-control populate" id="level" name="level" placeholder="Chose level">
                                    <option value=""></option>
                            <?php
                            if(isset($data_master_level_user))
                            {
                                foreach($data_master_level_user as $lev)
                                {
                            ?>
                                    <option value="<?php echo $lev->level_name;?>"><?php echo $lev->level_name;?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input id="inputer" class="form-control" name="id_user" value="<?php echo $row1->id_user; ?>" type="hidden" readonly>
                        </div>
                </div>
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input class="form-control" name="last_edit" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
<?php }} ?>

<!-- Modal Form Change level-->
