<html>
	<head>
		<title>Item In Print</title>
		<!-- Web Fonts  -->
		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.css')?>" />

		<!-- Invoice Print Style -->
		<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/invoice-print.css')?>" />

    </head>
	<body>

	<?php
      if(isset($item_in_header)){
      foreach($item_in_header as $row){
    ?>
		<div class="invoice">
			<header class="clearfix">
				<div class="row">
					<div class="col-sm-8 mt-md">
                            <h2 class="h2 mt-none mb-sm text-dark text-weight-bold">Receipt Item In</h2>
                            <h4 class="h4 m-none text-dark text-weight-bold">Receipt Number : <br><?php echo $row->id_item_in; ?></h4>
                        </div>
                        <div class="col-sm-4 text-right mt-md mb-md">
                            <address class="ib mr-xlg">
                                <br />
                               	<div class="ib">
                               		<img src="<?php echo base_url()?>assets/images/logo.png" alt="Indepay Logo" width="232px" height="78px"/>
                                </div>
                            </address>
                        </div>
                    </div>
                </header>
                <div class="bill-info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="bill-to">
                                <p class="h5 mb-xs text-dark text-weight-semibold">To : </p>
                                <address>
                                    <?php echo $row->agen_name; ?><br />              
                                </address>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bill-data text-right">
                                <p class="mb-none">
                                    <span class="text-dark">Receive Date : </span>
                                    <span class="value"><?php echo date("d M Y",strtotime($row->date_in)); ?></span>
                                </p>
                                <p class="mb-none">
                                    <span class="text-dark">Given By : </span>
                                    <span class="value"><?php echo$row->delivery_service_name; ?></span>
                                </p>
                                <p class="mb-none">
                                    <span class="text-dark">Note : </span>
                                    <span class="value"><?php echo$row->note; ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="table-responsive">
                    <table class="table invoice-items">
                        <thead>
                            <tr class="h4 text-dark">                                                
                                <th id="cell-id" class="text-weight-semibold">No</th> 
                                <th id="cell-id" class="text-weight-semibold">Category</th>
                                <th id="cell-id" class="text-weight-semibold">Item Name</th>
                                <th id="cell-id" class="text-weight-semibold">ESN</th>
                                <th id="cell-id" class="text-weight-semibold">SN</th>
                                <th id="cell-id" class="text-weight-semibold">Total</th>
                                <th id="cell-id" class="text-weight-semibold">Status</th>
                                <th id="cell-id" class="text-weight-semibold">Contents</th>
                                <th id="cell-id" class="text-weight-semibold">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; foreach($item_in_data as $row1){
							?>
							<tr>
								<th><?php echo $no; ?></th> 
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
                </div>
            </div>
		<?php }
        }
        ?>       
        
        
		<script>
			window.print();
		</script>
    </body>
</html>
       
