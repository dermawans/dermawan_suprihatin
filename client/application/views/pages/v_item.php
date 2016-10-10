<!--========================= Content Wrapper ==============================-->
<!-- start: page -->

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
        <h2 class="panel-title">Item List</h2>
    </header>
    
    <div class="panel-body">
        <div class="table-responsive">
        <table class="table table-bordered table-striped table-condensed mb-none" id="datatable-tabletools" data-swf-path="<?php echo base_url(); ?>assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
            <thead>
                <tr>                                 
                    <th>No</th> 
                    <th>Category</th>
                    <th>Item Name</th>
                    <th>ESN</th>
                    <th>SN</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Content</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
             <?php
				$no=1;
				if(isset($item)){
					foreach ($item as $row)
						{	
						?>
                        <tr class="gradeX">
                            <th><?php echo $no++; ?></th>
                            <th><?php echo $row->category_name; ?></th>
                            <th><?php echo $row->item_name; ?></th>
                            <th><?php echo $row->esn; ?></th>
                            <th><?php echo $row->sn; ?></th>
                            <th><?php echo $row->total; ?></th>
                            <th><?php echo $row->status; ?></th>
                            <th><?php echo $row->contents; ?></th>
                            <th><?php echo $row->note; ?></th>
                            <th><a class="btn btn-default btn-sm" href="<?php echo site_url('item/view/'.$row->id_item)?>">
									<i class="fa fa-folder-open"></i> View</a>
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


<!-- end: page -->




