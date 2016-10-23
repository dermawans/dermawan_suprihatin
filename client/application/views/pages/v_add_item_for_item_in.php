<!-- start: page -->
<div class="row">
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
 <?php echo form_open_multipart('item_in/save_item_item_in','id="wizard" class="form-horizontal"'); ?> 
        <section class="panel panel-dark">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
            </div>

 		<?php 
        foreach($id_item_in as $row){
        ?>
            <h2 class="panel-title">Add Item For Receive Number 
			<?php if ($this->session->userdata('id_item_in')=="")
			{ echo $row->id_item_in; }
			else
			{echo $this->session->userdata('id_item_in');} 
			?>
            </h2>
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
           <input id="inputer" class="form-control" name="inputer" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly> 
        <table class="table table-bordered table-striped table-condensed mb-none">
            <thead>
                <tr>             
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
            	<tr class="gradeX"> 
                    <th><select data-plugin-selectTwo class="form-control populate" id="id_category" name="id_category"  data-placeholder="Chose Category" required> 
                         	<option value=""></option>
                    <?php
                    if(isset($data_category_item)){
                        foreach($data_category_item as $row){
                            ?>
                            <option value="<?php echo $row->id_category;?>"><?php echo $row->category_name;?></option>
                        <?php
                        }
                    }
                    ?>
                </select></th>
                    <th>
                        <input type="hidden" class="form-control" name="id_item" id="id_item" value="<?php echo $id_item; ?>" readonly>
                        <input type="text" class="form-control" name="item_name" id="item_name" required></th>
                    <th><input type="text" class="form-control" name="esn" id="esn"></th>
                    <th><input type="text" class="form-control" name="sn" id="sn" required></th>
                    <th><input type="text" class="form-control" name="total" id="total" required></th>
                    <th><input type="text" class="form-control" name="status" id="status" required></th>
                    <th><textarea name="contents" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize ></textarea></th>
                    <th><textarea name="note" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize ></textarea></th>
                </tr>
            </tbody>
        </table>
        <div class="panel-body">
            <button type="submit" class="btn btn-sm btn-primary">Save</button>
            <a href="<?php echo site_url('item_in')?>" class="btn btn-sm btn-default"><i class="icon-remove-sign"></i> Cancel</a>
        </div> 
					<?php } 
				?> 
        <!-- end form -->	
       </div>
    </section>
        <?php echo form_close(); ?> 
</div>               
<!-- end: page -->
