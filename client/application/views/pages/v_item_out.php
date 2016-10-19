 <section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
        </div>
        <h2 class="panel-title">Item Out</h2>
    </header>
     
    <div class="panel-body">
 		<a href="<?php echo site_url('item_out/add_item_out')?>" class="btn btn-default btn-sm" data-toggle="modal"><i class="fa fa-plus-circle"></i> Add Data</a>
        <div class="table-responsive">
        <table class="table table-bordered table-striped table-condensed mb-none" id="datatable-tabletools" data-swf-path="<?php echo base_url(); ?>assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Receipt Number</th>
                    <th>Send Date</th> 
                    <th>Given By</th>
                    <th>Receive By</th> 
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
             <?php
				$no=1;
				if(isset($item_out)){
					foreach($item_out as $row){
						?>
						<tr class="gradeX">
							<th><?php echo $no++; ?></th>
							<th><?php echo $row->id_item_out; ?></th>
							<th><?php echo date("d M Y",strtotime($row->date_out)); ?></th>
							<th><?php echo $row->delivery_service_name; ?></th>
							<th><?php echo $row->agen_name; ?> <br> <?php echo $row->agen_operational_name; ?></th> 
							<th>
								<?php echo form_open_multipart('item_out/view_item_out','id="wizard" class="form-horizontal"'); ?> 
                                     <input type="hidden" class="form-control" name="id_item_out" id="id_item_out" value="<?php echo $row->id_item_out; ?>" readonly>
                                     <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-folder-open"></i> View</button>
								<?php echo form_close(); ?> 
                                <?php echo form_open_multipart('item_out/add_item_item_out','id="wizard" class="form-horizontal"'); ?> 
                                     <input type="hidden" class="form-control" name="id_item_out" id="id_item_out" value="<?php echo $row->id_item_out; ?>" readonly>
                                     <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Add Item</button>
								<?php echo form_close(); ?> 
                                <?php echo form_open_multipart('item_out/print_item_out','id="wizard" class="form-horizontal"'); ?> 
                                     <input type="hidden" class="form-control" name="id_item_out" id="id_item_out" value="<?php echo $row->id_item_out; ?>" readonly>
                                     <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-print"></i> Print</button>
								<?php echo form_close(); ?> 
								<!--<a class="btn btn-danger btn-sm" href="<?php echo site_url('item_out/hapus/'.$row->id_item_out)?>"
								   onclick="return confirm('Anda Yakin ?');">
									<i class="fa fa-trash-o"></i> Hapus</a>--> 
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





