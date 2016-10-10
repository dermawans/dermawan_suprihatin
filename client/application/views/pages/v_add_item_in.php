<?php if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'inventory_admin') { 
?>
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
            <label class="col-md-2 control-label">Receiver</label>
            <div class="col-md-3">
                <select data-plugin-selectTwo class="form-control populate" id="id_agen" name="id_agen"  data-placeholder="Chose Receiver" required> 
                    <option value=""></option>
                    <?php   
                    if(isset($data_agen)){
                        foreach($data_agen as $row){
                    ?>
                    <option value="<?php echo $row->id_agen;?>"><?php echo $row->agen_name;?></option>
                    <?php
                            }
                        } 
                    ?>
                </select>
            </div>
         </div>
          
		<div class="form-group">
            <label class="col-md-2 control-label">Giver</label>
            <div class="col-md-3">
                <select data-plugin-selectTwo class="form-control populate" id="id_delivery_service" name="id_delivery_service"  data-placeholder="Chose Given" required> 
                         	<option value=""></option>
                    <?php
                    if(isset($data_delivery_service)){
                        foreach($data_delivery_service as $row){
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
            <label class="col-md-2 control-label">Creator</label>
                <div class="col-md-4">
                    <input id="inputer" class="form-control" name="inputer" value="<?php echo $this->session->userdata('NAME') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="text" readonly>
                </div>
		</div>
        
        
		<div class="form-group">
            <label class="col-md-2 control-label">Note</label>
                <div class="col-md-4">
                	<textarea name="note_ii" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize required></textarea>
                </div>
		</div>
        
        <hr />
        
    <div class="panel-body">
        <div class="table-responsive">
        <input type="button" name="add_item_in" value="Add Item In" id="add_item_in" class="btn btn-xs btn-dark">
        <table class="table table-bordered table-striped table-condensed mb-none">
            <thead>
            <tr>
                <th>No</th> 
                <th>Category</th>
                <th>Item Name</th>
                <th>ESN</th>
                <th>SN</th>
                <th>Total</th>
                <th>Status</th>
                <th>Contents</th>
                <th colspan="2">Note</th>
            </tr>
            </thead>
            <tbody id="container">
<!-- nanti rows nya muncul di sini -->            
            </tbody>
        </table>
        
        
        <div class="panel-body">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check-circle"></i> Save</button>
            <a href="<?php echo site_url('item_in')?>" class="btn btn-sm btn-default"><i class="icon-remove-sign"></i> Cancel</a>
        </div> 
        <?php echo form_close(); ?> 
        <!-- end form -->	
        </div>
        </div>
    </div>
    </section>
</div>               
<!-- end: page -->
<?php }
?>