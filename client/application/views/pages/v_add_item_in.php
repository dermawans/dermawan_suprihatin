<!-- start: page -->
<div class="row">
    <section class="panel panel-dark">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
            </div>

            <h2 class="panel-title">Add Item In</h2>
        </header>
        <div class="panel-body">
        <!-- start form -->
        <?php echo form_open_multipart('item_in/save_item_in','id="wizard" class="form-horizontal"'); ?> 
        
		<div class="form-group">
        <label class="col-md-2 control-label">Date</label>
         	<div class="col-md-3">
            	<input type="text" name="date_in" id="date_in" class="form-control" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d") ;  ?>" readonly>
        	</div>
        </div>
        
		<div class="form-group">
        <label class="col-md-2 control-label">Receive Number</label>
         	<div class="col-md-3">
            	<input type="text" class="form-control" name="id_item_in" id="id_item_in" value="<?php echo $id_item_in; ?>" readonly>
        	</div>
        </div>
          
		<div class="form-group">
            <label class="col-md-2 control-label">Receive From</label>
            <div class="col-md-3">
                <select data-plugin-selectTwo class="form-control populate" id="id_sender" name="id_sender"  data-placeholder="Chose Given" required> 
                         	<option value=""></option>
                    <?php
                    if(isset($data_giver)){
                        foreach($data_giver as $row){
                            ?>
                            <option value="<?php echo $row->id_delivery_service;?>"><?php echo $row->delivery_service_name;?></option>
                        <?php
                        }
                    }
                    ?>
                </select>
            </div>
         </div>
         
		<div class="form-group">
            <label class="col-md-2 control-label">Receive By</label>
            <div class="col-md-3">
                <select data-plugin-selectTwo class="form-control populate" id="id_receiver" name="id_receiver"  data-placeholder="Chose Receiver" required> 
                    <option value=""></option>
                    <?php   
                    if(isset($data_inventory_agen)){
                        foreach($data_inventory_agen as $row){
                    ?>
                    <option value="<?php echo $row->id_agen;?>"><?php echo $row->agen_name;?></option>
                    <?php
                            }
                        } 
                    ?>
                </select>
            </div>
         </div>
            <input id="inputer" class="form-control" name="inputer" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly> 
        <div class="form-group">
            <label class="col-md-2 control-label">Note</label>
                <div class="col-md-4">
                	<textarea name="note" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize required></textarea>
                </div>
		</div> 
        <div class="panel-body">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check-circle"></i> Save</button>
            <a href="<?php echo site_url('item_in')?>" class="btn btn-sm btn-default"><i class="icon-remove-sign"></i> Cancel</a>
        </div> 
        <?php echo form_close(); ?> 
        <!-- end form -->	
       </div>
    </section>
</div>               
<!-- end: page -->
