
<!-- start: page -->
<div class="row"> 
        <section class="panel panel-dark">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
            </div>

 		<h2 class="panel-title">View Agen Item</h2>
        </header>
        <div class="panel-body">
        <!-- start form -->
        <?php 
		foreach($agen_item_header as $row){
       	if(empty($row->id_agen))
		{
		echo "<p>Data not found</p>";
		}
		else
		{
		?>
		<div class="form-group">
        <label class="col-md-2 control-label">Date Receive</label>
         	<div class="col-md-3">
            	<input type="text" name="date_out" id="date_out" class="form-control" value="<?php echo date("d M Y",strtotime($row->date_out)); ?>" readonly>
        	</div>
        </div>
        
		<div class="form-group">
        <label class="col-md-2 control-label">Receive Number</label>
         	<div class="col-md-3">
            	<input type="text" class="form-control" name="id_item_out" id="id_item_out" value="<?php echo $row->id_item_out; ?>" readonly>
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
            <div class="col-md-4">
            	<input type="text" class="form-control" name="receiver_name" id="receiver_name" value="<?php echo $row->agen_name; ?> - <?php echo $row->agen_operational_name; ?>" readonly>
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
            <?php $no=1; foreach($agen_item as $row1){ ?>
            	<tr class="gradeX">
                    <th><?php echo $no; ?></th>  
                    <th><?php echo $row1->item_name; ?></th>
                    <th><?php echo $row1->esn; ?></th>
                    <th><?php echo $row1->sn; ?></th>
                    <th><?php echo $row1->total; ?></th>
                    <th><?php echo $row1->status; ?></th>
                    <th><?php echo $row1->contents; ?></th>
                    <th><?php echo $row1->note_item; ?></th>  
                </tr>
            <?php $no++; } ?>
            </tbody>
        </table>
        <div class="panel-body"> 
            <a href="<?php echo site_url('agen')?>" class="btn btn-sm btn-default"><i class="icon-remove-sign"></i> Back</a>
        </div> 
        <!-- end form -->	
		<?php 
		}
		}
        ?>
       </div>
    </section> 
</div>               
<!-- end: page -->
