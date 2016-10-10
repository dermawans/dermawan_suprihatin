<!-- start: page -->
<div class="row">
    <section class="panel panel-dark">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
            </div>

            <h2 class="panel-title">Edit Data User</h2>
        </header>
        <div class="panel-body">
        <!-- start form -->
        <?php echo form_open('profile/save','id="wizard" class="form-horizontal"'); ?> 
        <?php
        	foreach ($user as $row)
			{
		?>
		<div class="form-group">
        <label class="col-md-2 control-label">User ID</label>
         	<div class="col-md-3">
            	<input type="text" class="form-control" name="id_user" id="id_user" value="<?php echo $row->id_user; ?>" readonly>
        	</div>
        </div>
        
       	<div class="form-group">
        <label class="col-md-2 control-label">Name</label>
         	<div class="col-md-3">
            	<input type="text" class="form-control" name="name" id="name" value="<?php echo $row->name; ?>">
        	</div>
        </div>
        
        <div class="form-group">
        <label class="col-md-2 control-label">Email</label>
         	<div class="col-md-6">
            	<input type="text" class="form-control" name="email" id="email" value="<?php echo $row->email; ?>">
        	</div>
        </div>
        
        <div class="form-group">
        <label class="col-md-2 control-label">Change Password</label>
         	<div class="col-md-6">
                        <a href="#edit_password<?php echo $row->id_user; ?>" class="modal-with-form btn btn-sm btn-primary">Change</a>
        	</div>
        </div>
        
        <div class="panel-body">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check-circle"></i> Save</button>
            <a href="<?php echo site_url('dashboard')?>" class="btn btn-sm btn-default"><i class="icon-remove-sign"></i> Cancel</a>
        </div> 
        <?php
			}
		?>
        <?php echo form_close(); ?> 
        <!-- end form -->	
    </div>
    </section>
</div>               
<!-- end: page -->



<!-- Modal Form Change Password-->
<?php 
	if(isset($user)){
		foreach($user as $row1){
?>

<div id="edit_password<?php echo $row1->id_user; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open('profile/changepassword','id="wizard" class="form-horizontal"'); ?> 

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

