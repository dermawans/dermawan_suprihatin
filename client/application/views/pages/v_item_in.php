
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
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
        </div>
        <h2 class="panel-title">Item In</h2>
    </header>
    	
    <div class="panel-body">
        <div class="table-responsive">
        	<a href="<?php echo site_url('item_in/add_item_in')?>" class="btn btn-default btn-sm" data-toggle="modal"><i class="fa fa-plus-circle"></i> Add Data</a>
        <table class="table table-bordered table-striped table-condensed mb-none" id="datatable-tabletools" data-swf-path="<?php echo base_url(); ?>assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Receipt Number</th>
                    <th>Received Date</th>
                    <th>Received By</th>
                    <th>Given By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
             <?php
				$no=1;
				if(isset($item_in)){
					foreach($item_in as $row){
						?>
						<tr class="gradeX">
							<th><?php echo $no++; ?></th>
							<th><?php echo $row->id_item_in; ?></th>
							<th><?php echo date("d M Y",strtotime($row->date_in)); ?></th>
							<th><?php echo $row->agen_name; ?></th>
							<th><?php echo $row->delivery_service_name; ?></th> 
							<th>
								<?php echo form_open_multipart('item_in/view_item_in','id="wizard" class="form-horizontal"'); ?> 
                                     <input type="hidden" class="form-control" name="id_item_in" id="id_item_in" value="<?php echo $row->id_item_in; ?>" readonly>
                                     <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-folder-open"></i> View</button>
								<?php echo form_close(); ?> 
                                <?php echo form_open_multipart('item_in/add_item_item_in','id="wizard" class="form-horizontal"'); ?> 
                                     <input type="hidden" class="form-control" name="id_item_in" id="id_item_in" value="<?php echo $row->id_item_in; ?>" readonly>
                                     <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Add Item</button>
								<?php echo form_close(); ?> 
                                <?php echo form_open_multipart('item_in/print_item_in','id="wizard" class="form-horizontal"'); ?> 
                                     <input type="hidden" class="form-control" name="id_item_in" id="id_item_in" value="<?php echo $row->id_item_in; ?>" readonly>
                                     <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-print"></i> Print</button>
								<?php echo form_close(); ?> 
								<!--<a class="btn btn-danger btn-sm" href="<?php echo site_url('item_in/hapus/'.$row->id_item_in)?>"
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





