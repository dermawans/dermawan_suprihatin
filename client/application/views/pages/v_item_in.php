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
							<th><?php echo $row->id_item_in_master_item_in; ?></th>
							<th><?php echo date("d M Y",strtotime($row->date_in)); ?></th>
							<th><?php echo $row->agen_name; ?></th>
							<th><?php echo $row->delivery_service_name; ?></th> 
							<th>
								<a class="btn btn-default btn-sm" href="<?php echo site_url('item_in/detail_item_in/'.$row->id_item_in)?>">
									<i class="fa fa-folder-open"></i> View</a>
								<!--<a class="btn btn-default btn-sm" href="<?php echo site_url('item_in/detail_item_in/'.$row->id_item_in)?>">
									<i class="fa fa-pencil"></i> Edit</a>
								<a class="btn btn-danger btn-sm" href="<?php echo site_url('item_in/hapus/'.$row->id_item_in)?>"
								   onclick="return confirm('Anda Yakin ?');">
									<i class="fa fa-trash-o"></i> Hapus</a>-->
								<a class="btn btn-default btn-sm" href="<?php echo site_url('item_in/print_item_in/'.$row->id_item_in)?>" target="_blank">
                                <i class="fa fa-print"></i> Print</a>
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





