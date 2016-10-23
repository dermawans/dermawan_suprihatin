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
 <?php echo form_open_multipart('item_out/save_item_item_out','id="wizard" class="form-horizontal"'); ?> 
        <section class="panel panel-dark">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
            </div>

 		<?php 
        foreach($id_item_out as $row){
        ?>
            <h2 class="panel-title">Add Item For Receive Number 
			<?php if ($this->session->userdata('id_item_out')=="")
			{ echo $row->id_item_out; }
			else
			{echo $this->session->userdata('id_item_out');} 
			?>
            </h2>
        </header>
        <div class="panel-body">
        <!-- start form -->
        
		<div class="form-group">
        <label class="col-md-2 control-label">Date</label>
         	<div class="col-md-3">
            	<input type="text" name="date_in" id="date_out" class="form-control" value="<?php echo date("d M Y",strtotime($row->date_out)); ?>" readonly>
        	</div>
        </div>
        
		<div class="form-group">
        <label class="col-md-2 control-label">Receive Number</label>
         	<div class="col-md-3">
            	<input type="text" class="form-control" name="id_item_out" id="id_item_out" value="<?php echo $row->id_item_out; ?>" readonly>
        	</div>
        </div>
          
		<div class="form-group">
            <label class="col-md-2 control-label">Send By</label>
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
        
         <div class="form-group">
            <label class="col-md-2 control-label">Item</label>
                <div class="col-md-4"><select data-plugin-selectTwo class="form-control populate" id="id_item" name="id_item"  data-placeholder="Chose Item" required> 
                    <option value=""></option>
                    <?php
                    if(isset($item_not_out)){
                        foreach($item_not_out as $row){
                            ?>
                    <option value="<?php echo $row->id_item;?>"><?php echo $row->item_name;?> - <?php echo $row->sn;?></option>
                        <?php
                        }
                    }
                    ?>
                </select>
                </div>
		</div> 
        
        
           <input id="inputer" class="form-control" name="inputer" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly> 
        
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
