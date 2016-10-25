<!-- start: page -->
<div class="row"> 
        <section class="panel panel-dark">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
            </div>

 		<?php 
        foreach($item_in_header as $row){
        ?>
            <h2 class="panel-title">View Item In</h2>
        </header>
        <div class="panel-body">
        <!-- start form -->
        
		<div class="form-group">
        <label class="col-md-2 control-label">Date</label>
         	<div class="col-md-3">
            	<input type="text" name="date_in" id="date_in" class="form-control" value="<?php echo date("d M Y",strtotime($row->date_in)); ?>" readonly>
        	</div>
        </div>
        
		<div class="form-group">
        <label class="col-md-2 control-label">Receive Number</label>
         	<div class="col-md-3">
            	<input type="text" class="form-control" name="id_item_in" id="id_item_in" value="<?php echo $row->id_item_in; ?>" readonly>
        	</div>
        </div>
          
		<div class="form-group">
            <label class="col-md-2 control-label">Receive From</label>
            <div class="col-md-3">
            	<input type="text" class="form-control" name="sender_name" id="sender_name" value="<?php echo $row->delivery_service_name; ?>" readonly>   	<input type="hidden" class="form-control" name="id_sender" id="id_sender" value="<?php echo $row->id_delivery_service; ?>" readonly>
            </div>
         </div>
         
		<div class="form-group">
            <label class="col-md-2 control-label">Receive By</label>
            <div class="col-md-3">
            	<input type="text" class="form-control" name="receiver_name" id="receiver_name" value="<?php echo $row->agen_name; ?>" readonly>
            	<input type="hidden" class="form-control" name="id_receiver" id="id_receiver" value="<?php echo $row->id_agen; ?>" readonly>
            </div>
         </div>
         
         <div class="form-group">
            <label class="col-md-2 control-label">Note</label>
                <div class="col-md-4">
                	<textarea id="textareaAutosize" class="form-control" data-plugin-textarea-autosize required readonly="readonly"><?php echo $row->note; ?></textarea>
                </div>
		</div> 
        <hr />
        <table class="table table-bordered table-striped table-condensed mb-none" id="datatable-tabletools">
            <thead>
                <tr>             
                    <th>No</th>
                    <th>ID Item</th>
                    <th>Category</th>
                    <th>Item Name</th>
                    <th>ESN</th>
                    <th>SN</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Content</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=1; foreach($item_in_data as $row1){ ?>
            	<tr class="gradeX">
                    <th><?php echo $no; ?></th> 
                    <th><?php echo $row1->id_item_master_item; ?></th>
                    <th><?php echo $row1->category_name; ?></th>
                    <th><?php echo $row1->item_name; ?></th>
                    <th><?php echo $row1->esn; ?></th>
                    <th><?php echo $row1->sn; ?></th>
                    <th><?php echo $row1->total; ?></th>
                    <th><?php echo $row1->status; ?></th>
                    <th><?php echo $row1->contents; ?></th>
                    <th><?php echo $row1->master_item_note; ?></th>  
                </tr>
            <?php $no++; } ?>
            </tbody>
        </table>
        <div class="panel-body"> 
            <a href="<?php echo site_url('item_in')?>" class="btn btn-sm btn-default"><i class="icon-remove-sign"></i> Back</a>
        </div> 
					<?php } 
				?> 
        <!-- end form -->	
       </div>
    </section> 
</div>               
<!-- end: page -->

             