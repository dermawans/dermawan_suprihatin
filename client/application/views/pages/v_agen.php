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

<!-- untuk tampilin google maps
<section class="panel">
   <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
        </div>
        <h2 class="panel-title">Agent Locations</h2>
    </header>
     <div class="panel-body">
        <div class="table-responsive">
        <center>
        	<?php echo $map['js']; ?>
			<?php echo $map['html']; ?>
			<!--<iframe src="https://www.google.com/maps/d/u/0/embed?mid=1f2itnkKlGgQhNdqTmci6WYef-x8" width="1305" height="650"></iframe>--
		</center>
        </div>
    </div>   
</section>-->

<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
        </div>
        <h2 class="panel-title">Agen List</h2>
    </header>
    
    <div class="panel-body">
        <div class="table-responsive">
       	<a href="#add_agen" class="modal-with-form btn btn-sm btn-default"><i class="fa fa-plus-circle"></i> Add Agen</a> 
<!-- untuk kalau tambahin user sales        
		<?php 
            if ($this->session->userdata('level') == 'super_admin' or $this->session->userdata('level') == 'operation_admin') { 
        ?>
        <a href="#add_agen" class="modal-with-form btn btn-sm btn-dark"><i class="fa fa-plus-circle"></i> Add Agen</a>
        <?php }  
            if ($this->session->userdata('level') == 'sales') { 
        ?>
        <a href="#add_agen_by_sales" class="modal-with-form btn btn-sm btn-dark"><i class="fa fa-plus-circle"></i> Add Agen</a>
        <?php } ?>	           
-->
        <table class="table table-bordered table-striped table-condensed mb-none" id="datatable-tabletools" data-swf-path="<?php echo base_url(); ?>assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
            <thead>
                <tr>                                 
                    <th>No</th>
                    <th>No Unique Agent</th>
                    <th>Agent Type</th>
                    <th>City</th>
                    <th>Agent Name</th>
                    <th>Operational Name</th>
                    <th>Phone Number 1</th> 
                    <th>Operational Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
			//if ($this->session->userdata('level') == 'super_admin' or $this->session->userdata('level') == 'operation_admin' or $this->session->userdata('level') == 'inventory_admin') { 
				$no=1;
				if(isset($data_agen)){
					foreach($data_agen as $row){
						?>
                        <tr class="gradeX">
                            <th><?php echo $no++; ?></th>
                            <th><?php echo $row->no_unique_agen; ?></th>
                            <th><?php echo $row->agen_type; ?></th>
                            <th><?php echo $row->agen_city; ?></th>
                            <th><?php echo $row->agen_name; ?></th>
                            <th><?php echo $row->agen_operational_name; ?></th>
                            <th><?php echo $row->agen_phone_number_1; ?></th>
                            <th><?php echo $row->agen_operational_address; ?></th>
                            <th><?php echo $row->status; ?></th>
                            <th>
                            		<a class="modal-with-form btn btn-sm btn-default" href="#view_agen<?php echo $row->id_agen; ?>"><i class="fa fa-folder"></i> View</a>				
                                    <?php 
										if ($this->session->userdata('level') == 'super_admin' or $this->session->userdata('level') == 'operation_admin') { 
									?>
                                    <a class="modal-with-form btn btn-sm btn-default" href="#edit_agen<?php echo $row->id_agen; ?>"><i class="fa fa-pencil"></i> Edit&nbsp;&nbsp;</a>			 <?php } ?>	
                            </th>
						</tr>
					<?php }
				}
			//}
			?>
<!--  untuk sales          
            <?php 
			if ($this->session->userdata('level') == 'sales') { 
				$no=1;
				if(isset($data_agen_no_indepay)){
					foreach($data_agen_no_indepay as $row){
						?>
                        <tr class="gradeX">
                            <th><?php echo $no++; ?></th>
                            <th><?php echo $row->no_unique_agen; ?></th>
                            <th><?php echo $row->agen_type; ?></th>
                            <th><?php echo $row->agen_city; ?></th>
                            <th><?php echo $row->agen_name; ?></th>
                            <th><?php echo $row->agen_operational_name; ?></th>
                            <th><?php echo $row->agen_phone_number_1; ?></th>
                            <th><?php echo $row->agen_operational_address; ?></th>
                            <th><?php echo $row->status; ?></th>
                            <th>
                            		<a class="modal-with-form btn btn-sm btn-primary" href="#view_agen<?php echo $row->id_agen; ?>"><i class="fa fa-eye"></i> View</a>				
                                    <?php 
										if ($this->session->userdata('level') == 'sales' and  $row->status == 'Interested') 
										{ 
									?>
                                    <a class="modal-with-form btn btn-sm btn-primary" href="#proses_agen_to_kyc_collecting_by_sales<?php echo $row->id_agen; ?>"><i class="fa fa-pencil"></i> Process To KYC Collecting</a>			
                                    <?php } 
										if ($this->session->userdata('level') == 'sales' and  $row->status == 'KYC Collecting' and ($row->foto_agen == '' and $row->foto_ktp == '' or $row->foto_form_pengajuan_agen == '' or $row->foto_cover_buku_tabungan == '' or $row->foto_npwp_atau_surat_keterangan_tidak_punya == '' or $row->foto_surat_keterangan_usaha_atau_bapu == '')) 
										{ 
									?>
                                    <a class="modal-with-form btn btn-sm btn-primary" href="#add_kyc_by_sales<?php echo $row->id_agen; ?>"><i class="fa fa-pencil"></i> Add KYC Agent</a>			
                                    <?php } 
										if ($this->session->userdata('level') == 'sales' and  $row->status == 'KYC Collecting' and $row->foto_agen <> '' and $row->foto_ktp <> '' and $row->foto_form_pengajuan_agen <> '' and $row->foto_cover_buku_tabungan <> '' and $row->foto_npwp_atau_surat_keterangan_tidak_punya <> '' and $row->foto_surat_keterangan_usaha_atau_bapu <> '') 
										{ 
									?>
                                    <a class="modal-with-form btn btn-sm btn-primary" href="#proses_agen_to_kyc_colled_by_sales<?php echo $row->id_agen; ?>"><i class="fa fa-pencil"></i> Process To KYC Collected</a>	
                                    <?php }  
										if ($this->session->userdata('level') == 'sales' and  $row->status == 'Approve') 
										{ 
									?>
                                    <a class="modal-with-form btn btn-sm btn-primary" href="#proses_agen_to_installation_by_sales<?php echo $row->id_agen; ?>"><i class="fa fa-pencil"></i> Process To Install</a>			
                                    <?php } 
										if ($this->session->userdata('level') == 'sales' and  $row->status == 'Installing' and ($row->foto_instalasi_mesin_agen == '' and $row->foto_spanduk_agen == '' or $row->foto_sertifikat_agen == '' or $row->foto_pks_agen == '')) 
										{ 
									?>
                                    <a class="modal-with-form btn btn-sm btn-primary" href="#add_installation_photo_by_sales<?php echo $row->id_agen; ?>"><i class="fa fa-pencil"></i> Add Installation Photo</a>			
                                    <?php } 
										if ($this->session->userdata('level') == 'sales' and  $row->status == 'Installing' and $row->foto_instalasi_mesin_agen <> '' and $row->foto_spanduk_agen <> '' and $row->foto_sertifikat_agen <> '' and $row->foto_pks_agen <> '') 
										  { 
									?>
                                    <a class="modal-with-form btn btn-sm btn-primary" href="#proses_agen_to_training_by_sales<?php echo $row->id_agen; ?>"><i class="fa fa-pencil"></i> Process To Training</a>	
                                    <?php } 
										if ($this->session->userdata('level') == 'sales' and  $row->status == 'Training' and $row->foto_training_agen == '') 				 { 
									?>
                                    <a class="modal-with-form btn btn-sm btn-primary" href="#add_training_photo_by_sales<?php echo $row->id_agen; ?>"><i class="fa fa-pencil"></i> Add Training Photo</a>			
                                    <?php } 
										if ($this->session->userdata('level') == 'sales' and  $row->status == 'Training' and $row->foto_training_agen <> '') 				  { 
									?>
                                    <a class="modal-with-form btn btn-sm btn-primary" href="#proses_agen_to_activating_by_sales<?php echo $row->id_agen; ?>"><i class="fa fa-pencil"></i> Process To Activating</a>	
                                    <?php }  
										if ($this->session->userdata('level') == 'sales' and  $row->status == 'Active' and $row->foto_aktifasi_agen == '') 				 { 
									?>
                                    <a class="modal-with-form btn btn-sm btn-primary" href="#add_activating_photo_by_sales<?php echo $row->id_agen; ?>"><i class="fa fa-pencil"></i> Add Activating Photo</a>			
                                    <?php }?>		
                            </th>
						</tr>
					<?php }
				}
			}
			?>
-->
            </tbody>
        </table>
        </div>
    </div>
    
</section>



<!-- Modal Form Add Agen-->
<div id="add_agen" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open_multipart('agen/add_agen','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Add Agen</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate"> 
                        <input type="hidden" name="id_agen" class="form-control" value="<?php echo $id_agen;?>" readonly="readonly" required/>
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Type</label>
                    <div class="col-sm-6">
                        <select data-plugin-selectTwo class="form-control populate" id="agen_type" name="agen_type" placeholder="Chose Agen Type" required>
                        	<option value=""></option>
							<?php 
                            	if ($this->session->userdata('level') == 'operation_admin') { 
							?>
                            <option value="Laku">Laku</option>
							<option value="Duitt">Duitt</option>
							<?php 
								}
                            	if ($this->session->userdata('level') == 'super_admin') { 
								if(isset($data_master_agen_type)){
									foreach($data_master_agen_type as $type){
                                    ?>
                                    <option value="<?php echo $type->agen_type_name;?>"><?php echo $type->agen_type_name;?></option>
                                <?php
										}
									}
								}
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_name" class="form-control" placeholder="Type username..." required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-6">
                        <select data-plugin-selectTwo class="form-control populate" id="status" name="status" placeholder="Chose Status" required>
                        	<option value=""></option>
							<?php
                            if(isset($data_master_status_agen)){
                                foreach($data_master_status_agen as $status){
                                    ?>
                                    <option value="<?php echo $status->nama_status;?>"><?php echo $status->nama_status;?></option>
                                <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 1</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_1" class="form-control" placeholder="Type number..." data-plugin-masked-input data-input-mask="9999 9999 9999" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 2</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_2" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999" placeholder="Type number..."/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-6">
                        <textarea name="agen_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize required></textarea>
                    </div>
                </div>
                        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_city" class="form-control" placeholder="Type city..." required/>
                    </div>
                </div>
                   
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Province</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_province" class="form-control" placeholder="Type province..." required/>
                    </div>
                </div>
                      
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Longitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="longitude" class="form-control" placeholder="Type longitude..."  />
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Latitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="latitude" class="form-control" placeholder="Type province..."  />
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Code / Terminal ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="terminal_id" class="form-control" placeholder="Type ID..."  />
                    </div>
                </div>
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">No. Unique Agent</label>
                    <div class="col-sm-6">
                        <input type="text" name="no_unique_agen" class="form-control" placeholder="Type number..."  />
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Number</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_number" class="form-control" placeholder="Type number..."  />
                    </div>
                </div>
                          
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_name" class="form-control" placeholder="Type name..."  />
                    </div>
                </div>       
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_operational_name" class="form-control" placeholder="Type name..." required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Address</label>
                    <div class="col-sm-6">
                       <textarea name="agen_operational_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize required></textarea>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Nearest Branch</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_nearest_branch" class="form-control" placeholder="Type name..."/>
                    </div>
                </div>
                       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Note</label>
                    <div class="col-sm-6">
                        <textarea name="note"  class="summernote" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'></textarea>
                    </div>
                </div>
                
                <hr />
                <p>Interested Agent Report Image</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Front Side Agent</label>
                    <div class="col-sm-6">  
  		               <input type="file" class="form-control" name="filetampakdepanagen">
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Across Side Agent</label>
                    <div class="col-sm-6">  
  		               <input type="file" class="form-control" name="filetampakseberangagen">
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Right Side Agent</label>
                    <div class="col-sm-6">  
  		               <input type="file" class="form-control" name="filetampakkananagen">
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Left Side Agent</label>
                    <div class="col-sm-6">  
  		               <input type="file" class="form-control" name="filetampakkiriagen">
                    </div>
                </div>            
                       
                
                <hr />
                <p>KYC Agent</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Photograph</label>
                    <div class="col-sm-6">  
  		               <input type="file" class="form-control" name="filefotoagen">
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent ID Card (KTP)</label>
                    <div class="col-sm-6">  
  		               <input type="file" class="form-control" name="filektpagen">
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Registration Form</label>
                    <div class="col-sm-6">  
  		               <input type="file" class="form-control" name="fileformregistrasiagen">
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">BCA Cover Book Agent</label>
                    <div class="col-sm-6">  
  		               <input type="file" class="form-control" name="filecoverbukutabunganagen">
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">NPWP / Statement Letter</label>
                    <div class="col-sm-6">  
  		               <input type="file" class="form-control" name="filenpwpagen">
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Business Certificates / BAPU</label>
                    <div class="col-sm-6">  
  		               <input type="file" class="form-control" name="filesuratketeranganusahaagen">
                    </div>
                </div>            
                              
                <div class="form-group">
                        <div class="col-md-6">
                            <input id="inputer" class="form-control" name="inputer" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
<!-- Modal Form Add Agen-->


<!-- Modal Form Edit Agen-->
<?php 
	if(isset($data_agen)){
		foreach($data_agen as $row1){
?>

<div id="edit_agen<?php echo $row1->id_agen; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open_multipart('agen/save_agen','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Edit Agen</h2>
        </header>
        <div class="panel-body">
            
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">System ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_agen" class="form-control" value="<?php echo $row1->id_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_name" class="form-control"  value="<?php echo $row1->agen_name;?>"  required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-6">
                        <select data-plugin-selectTwo class="form-control populate" id="status" name="status" placeholder="Chose Status" required>
                        	<option value=""></option>
                             <?php
                            if(isset($data_master_status_agen)){
                                foreach($data_master_status_agen as $status){
                                    ?>
                                    <option value="<?php echo $status->nama_status;?>"><?php echo $status->nama_status;?></option>
                                <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Type</label>
                    <div class="col-sm-4">
                        <input type="text" name="agen_type" class="form-control"  value="<?php echo $row1->agen_type;?>" readonly="readonly"  required/>
                    </div>
                    <div class="col-sm-3">
                        <a href="#edit_agen_type<?php echo $row1->id_agen; ?>" class="modal-with-form btn btn-sm btn-primary">Change</a>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 1</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_1" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999"  value="<?php echo $row1->agen_phone_number_1;?>"  required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 2</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_2" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999" value="<?php echo $row1->agen_phone_number_2;?>" />
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-6">
                        <textarea name="agen_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize required><?php echo $row1->agen_address;?></textarea>
                    </div>
                </div>
                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_city" class="form-control" value="<?php echo $row1->agen_city;?>" required/>
                    </div>
                </div>
                   
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Province</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_province" class="form-control" value="<?php echo $row1->agen_province;?>" required/>
                    </div>
                </div>
                      
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Longitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="longitude" class="form-control" value="<?php echo $row1->longitude;?>" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Latitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="latitude" class="form-control" value="<?php echo $row1->latitude;?>" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Code / Terminal ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="terminal_id" class="form-control" value="<?php echo $row1->terminal_id;?>"  />
                    </div>
                </div>
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">No. Unique Agent</label>
                    <div class="col-sm-6">
                        <input type="text" name="no_unique_agen" class="form-control" value="<?php echo $row1->no_unique_agen;?>"  />
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Number</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_number" class="form-control" value="<?php echo $row1->virtual_account_number;?>"  />
                    </div>
                </div>
                          
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_name" class="form-control" value="<?php echo $row1->virtual_account_name;?>"  />
                    </div>
                </div>       
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_operational_name" class="form-control" value="<?php echo $row1->agen_operational_name;?>" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Address</label>
                    <div class="col-sm-6">
                       <textarea name="agen_operational_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize required><?php echo $row1->agen_operational_address;?></textarea>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Nearest Branch</label>
                    <span class="col-sm-6">
                    <input type="text" name="agen_nearest_branch" class="form-control" value="<?php echo $row1->agen_nearest_branch;?>" required/>
                    </span>
<div class="col-sm-6"></div>
                </div>
                                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Note</label>
                    <div class="col-sm-6">
                        <textarea name="note"  class="summernote" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'><?php echo $row1->note;?></textarea>
                    </div>
                </div>
                
                <hr />
                <p>Interested Agent Report Image</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Front Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_depan_agen==""){ ?>
  		               <input type="file" class="form-control"   name="filetampakdepanagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_depan_agen; ?>">
                       <?php } ?>
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Across Side Agent</label>
                    <div class="col-sm-6"> 
                       <?php if ($row1->foto_tampak_seberang_agen==""){ ?>
  		               <input type="file" class="form-control"   name="filetampakseberangagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_seberang_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Right Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kanan_agen==""){ ?>
  		               <input type="file" class="form-control"   name="filetampakkananagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kanan_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Left Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kiri_agen==""){ ?>
  		               <input type="file" class="form-control"   name="filetampakkiriagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kiri_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>      
                 
                
                <hr />
                <p>KYC Agent</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Photograph</label>
                    <div class="col-sm-6">
                       <?php if ($row1->foto_agen==""){ ?>
  		               <input type="file" class="form-control" name="filefotoagen"  >
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_agen; ?>">
                       <?php } ?>  
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent ID Card (KTP)</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_ktp==""){ ?>
  		               <input type="file" class="form-control" name="filektpagen"  >
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_ktp; ?>">
                       <?php } ?>   
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Registration Form</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_form_pengajuan_agen==""){ ?>
  		               <input type="file" class="form-control" name="fileformregistrasiagen"  >
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_form_pengajuan_agen; ?>">
                       <?php } ?>  
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">BCA Cover Book Agent</label>
                    <div class="col-sm-6">   
                       <?php if ($row1->foto_cover_buku_tabungan==""){ ?>
  		               <input type="file" class="form-control" name="filecoverbukutabunganagen"  >
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_cover_buku_tabungan; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">NPWP / Statement Letter</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_npwp_atau_surat_keterangan_tidak_punya==""){ ?>
  		               <input type="file" class="form-control" name="filenpwpagen"  >
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_npwp_atau_surat_keterangan_tidak_punya; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Business Certificates / BAPU</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->	foto_surat_keterangan_usaha_atau_bapu==""){ ?>
  		               <input type="file" class="form-control" name="filesuratketeranganusahaagen"  >
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->	foto_surat_keterangan_usaha_atau_bapu; ?>">
                       <?php } ?>  
                    </div>
                </div>            
                     
                 
                <hr />
                <p>Installation</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Installation</label>
                    <div class="col-sm-6">  
  		               <?php if ($row1->foto_instalasi_mesin_agen==""){ ?>
                       <input type="file" class="form-control"   name="fileinstalasiagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_instalasi_mesin_agen; ?>">
                       <?php } ?>
                    </div>
                </div>   
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">PKS (Cooperation Statement) Agent</label>
                    <div class="col-sm-6">  
                   	   <?php if ($row1->foto_pks_agen==""){ ?>
  		               <input type="file" class="form-control"   name="filetpksagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_pks_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Banner</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_spanduk_agen==""){ ?>
  		               <input type="file" class="form-control"   name="filespandukagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_spanduk_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Certificate</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_sertifikat_agen==""){ ?>
  		               <input type="file" class="form-control"   name="filesertifikatagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_sertifikat_agen; ?>">
                       <?php } ?>
                    </div>
                </div>
                 
                <hr />
                <p>Training</p>
                <hr />   
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Training</label>
                    <div class="col-sm-6">  
                   	   <?php if ($row1->foto_training_agen==""){ ?>
  		               <input type="file" class="form-control"   name="filetrainingagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_training_agen; ?>">
                       <?php } ?>
                    </div>
                </div>      
                 
                <hr />
                <p>Activating</p>
                <hr />
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Activating</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_aktifasi_agen==""){ ?>
  		               <input type="file" class="form-control"   name="filepembukaanagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_aktifasi_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                       
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input class="form-control" name="last_edit_by_1" value="<?php echo $row1->last_edit_by; ?>" type="hidden" readonly>
                            <input class="form-control" name="last_edit_by_2" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                            <input class="form-control" name="date_of_submit_to_bca" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d") ;  ?>" type="hidden" readonly>
                            <input class="form-control" name="date_of_approve_or_reject_or_canceled" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
    <?php }} ?>
<!-- Modal Form Edit Agen-->




<!-- Modal Form View Agen-->
<?php 
	if(isset($data_agen)){
		foreach($data_agen as $row1){
?>

<div id="view_agen<?php echo $row1->id_agen; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open_multipart('#','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">View Agen</h2>
        </header>
        <div class="panel-body">
            
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">System ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_agen" class="form-control" value="<?php echo $row1->id_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_name" class="form-control"  value="<?php echo $row1->agen_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-6">
                    
                        <input type="text" name="nama_status" class="form-control"  value="<?php echo $row1->status;?>" readonly="readonly" required/>
                     </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Type</label>
                    <div class="col-sm-4">
                        <input type="text" name="agen_type" class="form-control"  value="<?php echo $row1->agen_type;?>" readonly="readonly"  required/>
                    </div> 
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 1</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_1" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999"  value="<?php echo $row1->agen_phone_number_1;?>"  readonly="readonly"  required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 2</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_2" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999" value="<?php echo $row1->agen_phone_number_2;?>"  readonly="readonly"/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-6">
                        <textarea name="agen_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_address;?></textarea>
                    </div>
                </div>
                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_city" class="form-control" value="<?php echo $row1->agen_city;?>" readonly="readonly" required/>
                    </div>
                </div>
                   
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Province</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_province" class="form-control" value="<?php echo $row1->agen_province;?>" readonly="readonly" required/>
                    </div>
                </div>
                      
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Longitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="longitude" class="form-control" value="<?php echo $row1->longitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Latitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="latitude" class="form-control" value="<?php echo $row1->latitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Code / Terminal ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="terminal_id" class="form-control" value="<?php echo $row1->terminal_id;?>" readonly="readonly" required/>
                    </div>
                </div>
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">No. Unique Agent</label>
                    <div class="col-sm-6">
                        <input type="text" name="no_unique_agen" class="form-control" value="<?php echo $row1->no_unique_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Number</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_number" class="form-control" value="<?php echo $row1->virtual_account_number;?>"  readonly="readonly" required/>
                    </div>
                </div>
                          
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_name" class="form-control" value="<?php echo $row1->virtual_account_name;?>"  readonly="readonly" required/>
                    </div>
                </div>       
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_operational_name" class="form-control" value="<?php echo $row1->agen_operational_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Address</label>
                    <div class="col-sm-6">
                       <textarea name="agen_operational_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_operational_address;?></textarea>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Nearest Branch</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_nearest_branch" class="form-control" value="<?php echo $row1->agen_nearest_branch;?>" readonly="readonly" required/>
                    </div>
                </div>
                                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Note</label>
                    <div class="col-sm-6">
                       <textarea name="note" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->note;?></textarea> 
                    </div>
                </div>
                
                <hr />
                <p>Interested Agent Report Image</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Front Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_depan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_depan_agen; ?>">
                       <?php } ?>
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Across Side Agent</label>
                    <div class="col-sm-6"> 
                       <?php if ($row1->foto_tampak_seberang_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_seberang_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Right Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kanan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kanan_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Left Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kiri_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kiri_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>      
                  
                <hr />
                <p>KYC Agent</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Photograph</label>
                    <div class="col-sm-6">
                       <?php if ($row1->foto_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_agen; ?>">
                       <?php } ?>  
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent ID Card (KTP)</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_ktp==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_ktp; ?>">
                       <?php } ?>   
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Registration Form</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_form_pengajuan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_form_pengajuan_agen; ?>">
                       <?php } ?>  
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">BCA Cover Book Agent</label>
                    <div class="col-sm-6">   
                       <?php if ($row1->foto_cover_buku_tabungan==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_cover_buku_tabungan; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">NPWP / Statement Letter</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_npwp_atau_surat_keterangan_tidak_punya==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_npwp_atau_surat_keterangan_tidak_punya; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Business Certificates / BAPU</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_surat_keterangan_usaha_atau_bapu==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->	foto_surat_keterangan_usaha_atau_bapu; ?>">
                       <?php } ?>  
                    </div>
                </div>            
                   
                <hr />
                <p>Installation</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Installation</label>
                    <div class="col-sm-6">  
  		               <?php if ($row1->foto_instalasi_mesin_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_instalasi_mesin_agen; ?>">
                       <?php } ?>
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">PKS (Cooperation  Statement) Agent</label>
                    <div class="col-sm-6">  
                   	   <?php if ($row1->foto_pks_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_pks_agen; ?>">
                       <?php } ?>
                    </div>
                </div>         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Banner</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_spanduk_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_spanduk_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Certificate</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_sertifikat_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_sertifikat_agen; ?>">
                       <?php } ?>
                    </div>
                </div>  
                 
                <hr />
                <p>Training</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Training</label>
                    <div class="col-sm-6">  
                   	   <?php if ($row1->foto_training_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_training_agen; ?>">
                       <?php } ?>
                    </div>
                </div>   
                
                <hr />
                <p>Activating</p>
                <hr />      
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Activating</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_aktifasi_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_aktifasi_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                       
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input class="form-control" name="last_edit_by" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right"> 
                <?php echo form_open_multipart('agen/view_agen_item','id="wizard" class="form-horizontal"'); ?> 
                     <input type="hidden" class="form-control" name="id_agen" id="id_agen" value="<?php echo $row1->id_agen; ?>" readonly>
                     <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-folder-open"></i> View Agen Item</button>
                <?php echo form_close(); ?> 
                    <button class="btn btn-default btn-sm modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
    <?php }} ?>
<!-- Modal Form View Agen-->



<!-- Modal Form Agen Type-->
<?php 
	if(isset($data_agen)){
		foreach($data_agen as $row1){
?>

<div id="edit_agen_type<?php echo $row1->id_agen; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open('agen_list/change_agen_type','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Change Agen Type</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
            
            	<div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">System ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_agen" class="form-control" value="<?php echo $row1->id_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">New Type</label>
                    <div class="col-sm-6">
                        <select data-plugin-selectTwo class="form-control populate" id="agen_type" name="agen_type">
                            <?php
                            if(isset($data_master_agen_type))
                            {
                                foreach($data_master_agen_type as $at)
                                {
                            ?>
                                    <option value="<?php echo $at->agen_type_name;?>"><?php echo $at->agen_type_name;?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                 
                <div class="form-group">
                        <div class="col-md-6">
                            <input class="form-control" name="last_edit_by" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
<?php }} ?>

<!-- Modal Form Agen Type-->





<!-- Modal Form Add Agen By Sales-->
<div id="add_agen_by_sales" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open_multipart('agen_list/add_agen','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Add Agen</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate"> 
                        <input type="hidden" name="id_agen" class="form-control" value="<?php echo $id_agen;?>" readonly="readonly" required/>
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Type</label>
                    <div class="col-sm-6">
                        <select data-plugin-selectTwo class="form-control populate" id="agen_type" name="agen_type" placeholder="Chose Agen Type" required>
                        	<option value=""></option>
                            <option value="Laku">Laku</option>
							<option value="Duitt">Duitt</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_name" class="form-control" placeholder="Type username..." required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-6">
                        <input type="text" name="status" class="form-control" value="Interested" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 1</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_1" class="form-control" placeholder="Type number..." data-plugin-masked-input data-input-mask="9999 9999 9999" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 2</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_2" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999" placeholder="Type number..."/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-6">
                        <textarea name="agen_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize required></textarea>
                    </div>
                </div>
                        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_city" class="form-control" placeholder="Type city..." required/>
                    </div>
                </div>
                   
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Province</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_province" class="form-control" placeholder="Type province..." required/>
                    </div>
                </div>
                      
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Longitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="longitude" class="form-control" placeholder="Type longitude..."  />
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Latitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="latitude" class="form-control" placeholder="Type province..."  />
                        <input type="hidden" name="terminal_id" class="form-control" placeholder="Type ID..."  /> 
                        <input type="hidden" name="no_unique_agen" class="form-control" placeholder="Type number..."  /> 
                        <input type="hidden" name="virtual_account_number" class="form-control" placeholder="Type number..."  /> 
                        <input type="hidden" name="virtual_account_name" class="form-control" placeholder="Type name..."  />
                    </div>
                </div>       
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_operational_name" class="form-control" placeholder="Type name..." required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Address</label>
                    <div class="col-sm-6">
                       <textarea name="agen_operational_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize required></textarea>
                    </div>
                </div>
                  
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Nearest Branch</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_nearest_branch" class="form-control" placeholder="Type name..." required/>
                    </div>
                </div>
                       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Note</label>
                    <div class="col-sm-6">
                        <textarea name="note"  class="summernote" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'></textarea>
                    </div>
                </div>
                
                <hr />
                <p>Interested Agent Report Image</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Front Side Agent</label>
                    <div class="col-sm-6">  
  		               <input type="file" class="form-control" name="filetampakdepanagen" required>
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Across Side Agent</label>
                    <div class="col-sm-6">  
  		               <input type="file" class="form-control" name="filetampakseberangagen" required>
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Right Side Agent</label>
                    <div class="col-sm-6">  
  		               <input type="file" class="form-control" name="filetampakkananagen" required>
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Left Side Agent</label>
                    <div class="col-sm-6">  
  		               <input type="file" class="form-control" name="filetampakkiriagen" required>
                    </div>
                </div>            
                           
                <div class="form-group">
                        <div class="col-md-6">
                            <input id="date_of_interested" class="form-control" name="date_of_interested" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d") ;  ?>" type="hidden" readonly>
                            <input id="inputer" class="form-control" name="inputer" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
<!-- Modal Form Add Agen By Sales-->





<!-- Modal Form Proses TO KYC Collecting By Sales-->
<?php 
	if(isset($data_agen)){
		foreach($data_agen as $row1){
?>

<div id="proses_agen_to_kyc_collecting_by_sales<?php echo $row1->id_agen; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open_multipart('agen_list/proses_agen_to_kyc_collecting_by_sales','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Process To KYC Collecting</h2>
        </header>
        <div class="panel-body">
            
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">System ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_agen" class="form-control" value="<?php echo $row1->id_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_name" class="form-control"  value="<?php echo $row1->agen_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-6">
                        <input type="hidden" name="status" class="form-control"  value="KYC Collecting" readonly="readonly" required/>                        <input type="text" name="status1" class="form-control"  value="<?php echo $row1->status;?>" readonly="readonly" required/>
                     </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Type</label>
                    <div class="col-sm-4">
                        <input type="text" name="agen_type" class="form-control"  value="<?php echo $row1->agen_type;?>" readonly="readonly"  required/>
                    </div> 
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 1</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_1" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999"  value="<?php echo $row1->agen_phone_number_1;?>"  readonly="readonly"  required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 2</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_2" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999" value="<?php echo $row1->agen_phone_number_2;?>"  readonly="readonly"/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-6">
                        <textarea name="agen_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_address;?></textarea>
                    </div>
                </div>
                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_city" class="form-control" value="<?php echo $row1->agen_city;?>" readonly="readonly" required/>
                    </div>
                </div>
                   
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Province</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_province" class="form-control" value="<?php echo $row1->agen_province;?>" readonly="readonly" required/>
                    </div>
                </div>
                      
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Longitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="longitude" class="form-control" value="<?php echo $row1->longitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Latitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="latitude" class="form-control" value="<?php echo $row1->latitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Code / Terminal ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="terminal_id" class="form-control" value="<?php echo $row1->terminal_id;?>" readonly="readonly" required/>
                    </div>
                </div>
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">No. Unique Agent</label>
                    <div class="col-sm-6">
                        <input type="text" name="no_unique_agen" class="form-control" value="<?php echo $row1->no_unique_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Number</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_number" class="form-control" value="<?php echo $row1->virtual_account_number;?>"  readonly="readonly" required/>
                    </div>
                </div>
                          
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_name" class="form-control" value="<?php echo $row1->virtual_account_name;?>"  readonly="readonly" required/>
                    </div>
                </div>       
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_operational_name" class="form-control" value="<?php echo $row1->agen_operational_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Address</label>
                    <div class="col-sm-6">
                       <textarea name="agen_operational_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_operational_address;?></textarea>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Nearest Branch</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_nearest_branch" class="form-control" value="<?php echo $row1->agen_nearest_branch;?>" readonly="readonly" required/>
                    </div>
                </div>
                                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Note</label>
                    <div class="col-sm-6">
                        <textarea name="note" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->note;?></textarea>
                    </div>
                </div>
                
                <hr />
                <p>Interested Agent Report Image</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Front Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_depan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_depan_agen; ?>">
                       <?php } ?>
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Across Side Agent</label>
                    <div class="col-sm-6"> 
                       <?php if ($row1->foto_tampak_seberang_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_seberang_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Right Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kanan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kanan_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Left Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kiri_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kiri_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>      
                 
                
                
                <div class="form-group">
                        <div class="col-md-6">
                        <input type="hidden" name="last_edit_by_1" class="form-control" value="<?php echo $row1->last_edit_by;?>" readonly="readonly" required/>
                            <input class="form-control" name="last_edit_by_2" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">  
                	<button type="submit" class="btn btn-sm btn-primary">Process To KYC Collecting</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
    <?php }} ?>
<!-- Modal Form Proses TO KYC Collecting By Sales-->


<!-- Modal Form Add KYC Agen By Sales-->
<?php 
	if(isset($data_agen)){
		foreach($data_agen as $row1){
?>

<div id="add_kyc_by_sales<?php echo $row1->id_agen; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open_multipart('agen_list/add_kyc_by_sales','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Add KYC Agent</h2>
        </header>
        <div class="panel-body">
            
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">System ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_agen" class="form-control" value="<?php echo $row1->id_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_name" class="form-control"  value="<?php echo $row1->agen_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-6">
                    	<input type="text" name="status" class="form-control"  value="<?php echo $row1->status;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Type</label>
                    <div class="col-sm-4">
                        <input type="text" name="agen_type" class="form-control"  value="<?php echo $row1->agen_type;?>" readonly="readonly"  required/>
                    </div> 
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 1</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_1" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999"  value="<?php echo $row1->agen_phone_number_1;?>"  readonly="readonly"  required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 2</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_2" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999" value="<?php echo $row1->agen_phone_number_2;?>"  readonly="readonly"/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-6">
                        <textarea name="agen_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_address;?></textarea>
                    </div>
                </div>
                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_city" class="form-control" value="<?php echo $row1->agen_city;?>" readonly="readonly" required/>
                    </div>
                </div>
                   
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Province</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_province" class="form-control" value="<?php echo $row1->agen_province;?>" readonly="readonly" required/>
                    </div>
                </div>
                      
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Longitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="longitude" class="form-control" value="<?php echo $row1->longitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Latitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="latitude" class="form-control" value="<?php echo $row1->latitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Code / Terminal ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="terminal_id" class="form-control" value="<?php echo $row1->terminal_id;?>" readonly="readonly" required/>
                    </div>
                </div>
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">No. Unique Agent</label>
                    <div class="col-sm-6">
                        <input type="text" name="no_unique_agen" class="form-control" value="<?php echo $row1->no_unique_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Number</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_number" class="form-control" value="<?php echo $row1->virtual_account_number;?>"  readonly="readonly" required/>
                    </div>
                </div>
                          
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_name" class="form-control" value="<?php echo $row1->virtual_account_name;?>"  readonly="readonly" required/>
                    </div>
                </div>       
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_operational_name" class="form-control" value="<?php echo $row1->agen_operational_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Address</label>
                    <div class="col-sm-6">
                       <textarea name="agen_operational_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_operational_address;?></textarea>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Nearest Branch</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_nearest_branch" class="form-control" value="<?php echo $row1->agen_nearest_branch;?>" readonly="readonly" required/>
                    </div>
                </div>
                                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Note</label>
                    <div class="col-sm-6">
                        <textarea name="note" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->note;?></textarea>
                    </div>
                </div>
                
                <hr />
                <p>Interested Agent Report Image</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Front Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_depan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_depan_agen; ?>">
                       <?php } ?>
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Across Side Agent</label>
                    <div class="col-sm-6"> 
                       <?php if ($row1->foto_tampak_seberang_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_seberang_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Right Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kanan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kanan_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Left Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kiri_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kiri_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>      
                 
                
                <hr />
                <p>KYC Agent</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Photograph</label>
                    <div class="col-sm-6">
                       <?php if ($row1->foto_agen==""){ ?>
  		               <input type="file" class="form-control" name="filefotoagen"  >
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_agen; ?>">
                       <?php } ?>  
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent ID Card (KTP)</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_ktp==""){ ?>
  		               <input type="file" class="form-control" name="filektpagen"  >
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_ktp; ?>">
                       <?php } ?>   
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Registration Form</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_form_pengajuan_agen==""){ ?>
  		               <input type="file" class="form-control" name="fileformregistrasiagen"  >
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_form_pengajuan_agen; ?>">
                       <?php } ?>  
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">BCA Cover Book Agent</label>
                    <div class="col-sm-6">   
                       <?php if ($row1->foto_cover_buku_tabungan==""){ ?>
  		               <input type="file" class="form-control" name="filecoverbukutabunganagen"  >
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_cover_buku_tabungan; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">NPWP / Statement Letter</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_npwp_atau_surat_keterangan_tidak_punya==""){ ?>
  		               <input type="file" class="form-control" name="filenpwpagen"  >
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_npwp_atau_surat_keterangan_tidak_punya; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Business Certificates / BAPU</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->	foto_surat_keterangan_usaha_atau_bapu==""){ ?>
  		               <input type="file" class="form-control" name="filesuratketeranganusahaagen"  >
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->	foto_surat_keterangan_usaha_atau_bapu; ?>">
                       <?php } ?>  
                    </div>
                </div>            
                     
                
                <div class="form-group">
                        <div class="col-md-6">
                        <input type="hidden" name="last_edit_by_1" class="form-control" value="<?php echo $row1->last_edit_by;?>" readonly="readonly" required/>
                            <input class="form-control" name="last_edit_by_2" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">  
                	<button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
    <?php }} ?>
<!-- Modal Form Add KYC Agen By Sales-->


<!-- Modal Form KYC Collected By Sales-->
<?php 
	if(isset($data_agen)){
		foreach($data_agen as $row1){
?>

<div id="proses_agen_to_kyc_colled_by_sales<?php echo $row1->id_agen; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open_multipart('agen_list/proses_to_kyc_collected_by_sales','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Process To KYC Collected</h2>
        </header>
        <div class="panel-body">
            
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">System ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_agen" class="form-control" value="<?php echo $row1->id_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_name" class="form-control"  value="<?php echo $row1->agen_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-6">
                    	<input type="hidden" name="status" class="form-control"  value="KYC Collected" readonly="readonly" required/>
                    	<input type="text" name="status1" class="form-control"  value="<?php echo $row1->status;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Type</label>
                    <div class="col-sm-4">
                        <input type="text" name="agen_type" class="form-control"  value="<?php echo $row1->agen_type;?>" readonly="readonly"  required/>
                    </div> 
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 1</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_1" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999"  value="<?php echo $row1->agen_phone_number_1;?>"  readonly="readonly"  required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 2</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_2" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999" value="<?php echo $row1->agen_phone_number_2;?>"  readonly="readonly"/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-6">
                        <textarea name="agen_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_address;?></textarea>
                    </div>
                </div>
                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_city" class="form-control" value="<?php echo $row1->agen_city;?>" readonly="readonly" required/>
                    </div>
                </div>
                   
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Province</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_province" class="form-control" value="<?php echo $row1->agen_province;?>" readonly="readonly" required/>
                    </div>
                </div>
                      
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Longitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="longitude" class="form-control" value="<?php echo $row1->longitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Latitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="latitude" class="form-control" value="<?php echo $row1->latitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Code / Terminal ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="terminal_id" class="form-control" value="<?php echo $row1->terminal_id;?>" readonly="readonly" required/>
                    </div>
                </div>
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">No. Unique Agent</label>
                    <div class="col-sm-6">
                        <input type="text" name="no_unique_agen" class="form-control" value="<?php echo $row1->no_unique_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Number</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_number" class="form-control" value="<?php echo $row1->virtual_account_number;?>"  readonly="readonly" required/>
                    </div>
                </div>
                          
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_name" class="form-control" value="<?php echo $row1->virtual_account_name;?>"  readonly="readonly" required/>
                    </div>
                </div>       
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_operational_name" class="form-control" value="<?php echo $row1->agen_operational_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Address</label>
                    <div class="col-sm-6">
                       <textarea name="agen_operational_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_operational_address;?></textarea>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Nearest Branch</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_nearest_branch" class="form-control" value="<?php echo $row1->agen_nearest_branch;?>" readonly="readonly" required/>
                    </div>
                </div>
                                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Note</label>
                    <div class="col-sm-6">
                        <textarea name="note" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->note;?></textarea>
                    </div>
                </div>
                
                <hr />
                <p>Interested Agent Report Image</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Front Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_depan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_depan_agen; ?>">
                       <?php } ?>
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Across Side Agent</label>
                    <div class="col-sm-6"> 
                       <?php if ($row1->foto_tampak_seberang_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_seberang_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Right Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kanan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kanan_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Left Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kiri_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kiri_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>      
                 
                
                <hr />
                <p>KYC Agent</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Photograph</label>
                    <div class="col-sm-6">
                       <?php if ($row1->foto_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_agen; ?>">
                       <?php } ?>  
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent ID Card (KTP)</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_ktp==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_ktp; ?>">
                       <?php } ?>   
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Registration Form</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_form_pengajuan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_form_pengajuan_agen; ?>">
                       <?php } ?>  
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">BCA Cover Book Agent</label>
                    <div class="col-sm-6">   
                       <?php if ($row1->foto_cover_buku_tabungan==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_cover_buku_tabungan; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">NPWP / Statement Letter</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_npwp_atau_surat_keterangan_tidak_punya==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_npwp_atau_surat_keterangan_tidak_punya; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Business Certificates / BAPU</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->	foto_surat_keterangan_usaha_atau_bapu==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->	foto_surat_keterangan_usaha_atau_bapu; ?>">
                       <?php } ?>  
                    </div>
                </div>            
                     
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input class="form-control" name="date_of_kyc_collected" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d") ;  ?>" type="hidden" readonly>
                        <input type="hidden" name="last_edit_by_1" class="form-control" value="<?php echo $row1->last_edit_by;?>" readonly="readonly" required/>
                            <input class="form-control" name="last_edit_by_2" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">  
                	<button type="submit" class="btn btn-sm btn-primary">Process To KYC Collected</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
    <?php }} ?>
<!-- Modal Form KYC Collected By Sales-->


<!-- Modal Form Proses to install By Sales-->
<?php 
	if(isset($data_agen)){
		foreach($data_agen as $row1){
?>

<div id="proses_agen_to_installation_by_sales<?php echo $row1->id_agen; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open_multipart('agen_list/proses_to_installation_by_sales','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Process To Install</h2>
        </header>
        <div class="panel-body">
            
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">System ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_agen" class="form-control" value="<?php echo $row1->id_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_name" class="form-control"  value="<?php echo $row1->agen_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-6">
                    	<input type="hidden" name="status" class="form-control"  value="Installing" readonly="readonly" required/>
                    	<input type="text" name="status1" class="form-control"  value="<?php echo $row1->status;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Type</label>
                    <div class="col-sm-4">
                        <input type="text" name="agen_type" class="form-control"  value="<?php echo $row1->agen_type;?>" readonly="readonly"  required/>
                    </div> 
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 1</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_1" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999"  value="<?php echo $row1->agen_phone_number_1;?>"  readonly="readonly"  required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 2</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_2" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999" value="<?php echo $row1->agen_phone_number_2;?>"  readonly="readonly"/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-6">
                        <textarea name="agen_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_address;?></textarea>
                    </div>
                </div>
                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_city" class="form-control" value="<?php echo $row1->agen_city;?>" readonly="readonly" required/>
                    </div>
                </div>
                   
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Province</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_province" class="form-control" value="<?php echo $row1->agen_province;?>" readonly="readonly" required/>
                    </div>
                </div>
                      
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Longitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="longitude" class="form-control" value="<?php echo $row1->longitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Latitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="latitude" class="form-control" value="<?php echo $row1->latitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Code / Terminal ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="terminal_id" class="form-control" value="<?php echo $row1->terminal_id;?>" readonly="readonly" required/>
                    </div>
                </div>
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">No. Unique Agent</label>
                    <div class="col-sm-6">
                        <input type="text" name="no_unique_agen" class="form-control" value="<?php echo $row1->no_unique_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Number</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_number" class="form-control" value="<?php echo $row1->virtual_account_number;?>"  readonly="readonly" required/>
                    </div>
                </div>
                          
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_name" class="form-control" value="<?php echo $row1->virtual_account_name;?>"  readonly="readonly" required/>
                    </div>
                </div>       
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_operational_name" class="form-control" value="<?php echo $row1->agen_operational_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Address</label>
                    <div class="col-sm-6">
                       <textarea name="agen_operational_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_operational_address;?></textarea>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Nearest Branch</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_nearest_branch" class="form-control" value="<?php echo $row1->agen_nearest_branch;?>" readonly="readonly" required/>
                    </div>
                </div>
                                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Note</label>
                    <div class="col-sm-6">
                        <textarea name="note" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->note;?></textarea>
                    </div>
                </div>
                
                <hr />
                <p>Interested Agent Report Image</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Front Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_depan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_depan_agen; ?>">
                       <?php } ?>
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Across Side Agent</label>
                    <div class="col-sm-6"> 
                       <?php if ($row1->foto_tampak_seberang_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_seberang_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Right Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kanan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kanan_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Left Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kiri_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kiri_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>      
                 
                
                <hr />
                <p>KYC Agent</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Photograph</label>
                    <div class="col-sm-6">
                       <?php if ($row1->foto_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_agen; ?>">
                       <?php } ?>  
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent ID Card (KTP)</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_ktp==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_ktp; ?>">
                       <?php } ?>   
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Registration Form</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_form_pengajuan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_form_pengajuan_agen; ?>">
                       <?php } ?>  
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">BCA Cover Book Agent</label>
                    <div class="col-sm-6">   
                       <?php if ($row1->foto_cover_buku_tabungan==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_cover_buku_tabungan; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">NPWP / Statement Letter</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_npwp_atau_surat_keterangan_tidak_punya==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_npwp_atau_surat_keterangan_tidak_punya; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Business Certificates / BAPU</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->	foto_surat_keterangan_usaha_atau_bapu==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->	foto_surat_keterangan_usaha_atau_bapu; ?>">
                       <?php } ?>  
                    </div>
                </div>            
                     
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input class="form-control" name="date_of_install" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d") ;  ?>" type="hidden" readonly>
                        <input type="hidden" name="last_edit_by_1" class="form-control" value="<?php echo $row1->last_edit_by;?>" readonly="readonly" required/>
                            <input class="form-control" name="last_edit_by_2" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">  
                	<button type="submit" class="btn btn-sm btn-primary">Process To Install</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
    <?php }} ?>
<!-- Modal Form Proses to install By Sales-->


<!-- Modal Form Add Installation Photo By Sales-->
<?php 
	if(isset($data_agen)){
		foreach($data_agen as $row1){
?>

<div id="add_installation_photo_by_sales<?php echo $row1->id_agen; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open_multipart('agen_list/add_installation_photo_by_sales','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Add Installation Photo</h2>
        </header>
        <div class="panel-body">
            
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">System ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_agen" class="form-control" value="<?php echo $row1->id_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_name" class="form-control"  value="<?php echo $row1->agen_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-6">
                    	<input type="text" name="status" class="form-control"  value="<?php echo $row1->status;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Type</label>
                    <div class="col-sm-4">
                        <input type="text" name="agen_type" class="form-control"  value="<?php echo $row1->agen_type;?>" readonly="readonly"  required/>
                    </div> 
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 1</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_1" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999"  value="<?php echo $row1->agen_phone_number_1;?>"  readonly="readonly"  required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 2</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_2" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999" value="<?php echo $row1->agen_phone_number_2;?>"  readonly="readonly"/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-6">
                        <textarea name="agen_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_address;?></textarea>
                    </div>
                </div>
                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_city" class="form-control" value="<?php echo $row1->agen_city;?>" readonly="readonly" required/>
                    </div>
                </div>
                   
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Province</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_province" class="form-control" value="<?php echo $row1->agen_province;?>" readonly="readonly" required/>
                    </div>
                </div>
                      
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Longitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="longitude" class="form-control" value="<?php echo $row1->longitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Latitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="latitude" class="form-control" value="<?php echo $row1->latitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Code / Terminal ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="terminal_id" class="form-control" value="<?php echo $row1->terminal_id;?>" readonly="readonly" required/>
                    </div>
                </div>
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">No. Unique Agent</label>
                    <div class="col-sm-6">
                        <input type="text" name="no_unique_agen" class="form-control" value="<?php echo $row1->no_unique_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Number</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_number" class="form-control" value="<?php echo $row1->virtual_account_number;?>"  readonly="readonly" required/>
                    </div>
                </div>
                          
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_name" class="form-control" value="<?php echo $row1->virtual_account_name;?>"  readonly="readonly" required/>
                    </div>
                </div>       
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_operational_name" class="form-control" value="<?php echo $row1->agen_operational_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Address</label>
                    <div class="col-sm-6">
                       <textarea name="agen_operational_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_operational_address;?></textarea>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Nearest Branch</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_nearest_branch" class="form-control" value="<?php echo $row1->agen_nearest_branch;?>" readonly="readonly" required/>
                    </div>
                </div>
                                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Note</label>
                    <div class="col-sm-6">
                        <textarea name="note" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->note;?></textarea>
                    </div>
                </div>
                
                <hr />
                <p>Interested Agent Report Image</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Front Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_depan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_depan_agen; ?>">
                       <?php } ?>
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Across Side Agent</label>
                    <div class="col-sm-6"> 
                       <?php if ($row1->foto_tampak_seberang_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_seberang_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Right Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kanan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kanan_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Left Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kiri_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kiri_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>      
                 
                
                <hr />
                <p>KYC Agent</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Photograph</label>
                    <div class="col-sm-6">
                       <?php if ($row1->foto_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_agen; ?>">
                       <?php } ?>  
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent ID Card (KTP)</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_ktp==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_ktp; ?>">
                       <?php } ?>   
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Registration Form</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_form_pengajuan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_form_pengajuan_agen; ?>">
                       <?php } ?>  
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">BCA Cover Book Agent</label>
                    <div class="col-sm-6">   
                       <?php if ($row1->foto_cover_buku_tabungan==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_cover_buku_tabungan; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">NPWP / Statement Letter</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_npwp_atau_surat_keterangan_tidak_punya==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_npwp_atau_surat_keterangan_tidak_punya; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Business Certificates / BAPU</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->	foto_surat_keterangan_usaha_atau_bapu==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->	foto_surat_keterangan_usaha_atau_bapu; ?>">
                       <?php } ?>  
                    </div>
                </div>            
                     
                
                <hr />
                <p>Installation</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Installation</label>
                    <div class="col-sm-6">  
  		               <?php if ($row1->foto_instalasi_mesin_agen==""){ ?>
                       <input type="file" class="form-control"   name="fileinstalasiagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_instalasi_mesin_agen; ?>">
                       <?php } ?>
                    </div>
                </div>  
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">PKS (Cooperation Statement) Agent</label>
                    <div class="col-sm-6">  
                   	   <?php if ($row1->foto_pks_agen==""){ ?>
  		               <input type="file" class="form-control"   name="filetpksagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_pks_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Banner</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_spanduk_agen==""){ ?>
  		               <input type="file" class="form-control"   name="filespandukagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_spanduk_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Certificate</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_sertifikat_agen==""){ ?>
  		               <input type="file" class="form-control"   name="filesertifikatagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_sertifikat_agen; ?>">
                       <?php } ?>
                    </div>
                </div>        
                
                <div class="form-group">
                        <div class="col-md-6">
                        <input type="hidden" name="last_edit_by_1" class="form-control" value="<?php echo $row1->last_edit_by;?>" readonly="readonly" required/>
                            <input class="form-control" name="last_edit_by_2" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">  
                	<button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
    <?php }} ?>
<!-- Modal Form Add Installation Photo By Sales-->



<!-- Modal Form Proses to Training By Sales-->
<?php 
	if(isset($data_agen)){
		foreach($data_agen as $row1){
?>

<div id="proses_agen_to_training_by_sales<?php echo $row1->id_agen; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open_multipart('agen_list/proses_to_training_by_sales','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Process To Training</h2>
        </header>
        <div class="panel-body">
            
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">System ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_agen" class="form-control" value="<?php echo $row1->id_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_name" class="form-control"  value="<?php echo $row1->agen_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-6">
                    	<input type="hidden" name="status" class="form-control"  value="Training" readonly="readonly" required/>
                    	<input type="text" name="status1" class="form-control"  value="<?php echo $row1->status;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Type</label>
                    <div class="col-sm-4">
                        <input type="text" name="agen_type" class="form-control"  value="<?php echo $row1->agen_type;?>" readonly="readonly"  required/>
                    </div> 
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 1</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_1" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999"  value="<?php echo $row1->agen_phone_number_1;?>"  readonly="readonly"  required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 2</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_2" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999" value="<?php echo $row1->agen_phone_number_2;?>"  readonly="readonly"/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-6">
                        <textarea name="agen_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_address;?></textarea>
                    </div>
                </div>
                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_city" class="form-control" value="<?php echo $row1->agen_city;?>" readonly="readonly" required/>
                    </div>
                </div>
                   
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Province</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_province" class="form-control" value="<?php echo $row1->agen_province;?>" readonly="readonly" required/>
                    </div>
                </div>
                      
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Longitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="longitude" class="form-control" value="<?php echo $row1->longitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Latitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="latitude" class="form-control" value="<?php echo $row1->latitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Code / Terminal ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="terminal_id" class="form-control" value="<?php echo $row1->terminal_id;?>" readonly="readonly" required/>
                    </div>
                </div>
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">No. Unique Agent</label>
                    <div class="col-sm-6">
                        <input type="text" name="no_unique_agen" class="form-control" value="<?php echo $row1->no_unique_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Number</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_number" class="form-control" value="<?php echo $row1->virtual_account_number;?>"  readonly="readonly" required/>
                    </div>
                </div>
                          
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_name" class="form-control" value="<?php echo $row1->virtual_account_name;?>"  readonly="readonly" required/>
                    </div>
                </div>       
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_operational_name" class="form-control" value="<?php echo $row1->agen_operational_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Address</label>
                    <div class="col-sm-6">
                       <textarea name="agen_operational_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_operational_address;?></textarea>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Nearest Branch</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_nearest_branch" class="form-control" value="<?php echo $row1->agen_nearest_branch;?>" readonly="readonly" required/>
                    </div>
                </div>
                                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Note</label>
                    <div class="col-sm-6">
                        <textarea name="note" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->note;?></textarea>
                    </div>
                </div>
                
                <hr />
                <p>Interested Agent Report Image</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Front Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_depan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_depan_agen; ?>">
                       <?php } ?>
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Across Side Agent</label>
                    <div class="col-sm-6"> 
                       <?php if ($row1->foto_tampak_seberang_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_seberang_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Right Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kanan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kanan_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Left Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kiri_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kiri_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>      
                 
                
                <hr />
                <p>KYC Agent</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Photograph</label>
                    <div class="col-sm-6">
                       <?php if ($row1->foto_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_agen; ?>">
                       <?php } ?>  
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent ID Card (KTP)</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_ktp==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_ktp; ?>">
                       <?php } ?>   
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Registration Form</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_form_pengajuan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_form_pengajuan_agen; ?>">
                       <?php } ?>  
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">BCA Cover Book Agent</label>
                    <div class="col-sm-6">   
                       <?php if ($row1->foto_cover_buku_tabungan==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_cover_buku_tabungan; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">NPWP / Statement Letter</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_npwp_atau_surat_keterangan_tidak_punya==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_npwp_atau_surat_keterangan_tidak_punya; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Business Certificates / BAPU</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_surat_keterangan_usaha_atau_bapu==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->	foto_surat_keterangan_usaha_atau_bapu; ?>">
                       <?php } ?>  
                    </div>
                </div>            
                     
                
                <hr />
                <p>Installation Photo</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Installation</label>
                    <div class="col-sm-6">  
  		               <?php if ($row1->foto_instalasi_mesin_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_instalasi_mesin_agen; ?>">
                       <?php } ?>
                    </div>
                </div>  
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">PKS (Cooperation Statement) Agent</label>
                    <div class="col-sm-6">  
                   	   <?php if ($row1->foto_pks_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_pks_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Banner</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_spanduk_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_spanduk_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Certificate</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_sertifikat_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_sertifikat_agen; ?>">
                       <?php } ?>
                    </div>
                </div>        
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input class="form-control" name="date_of_training" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d") ;  ?>" type="hidden" readonly>
                        <input type="hidden" name="last_edit_by_1" class="form-control" value="<?php echo $row1->last_edit_by;?>" readonly="readonly" required/>
                            <input class="form-control" name="last_edit_by_2" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">  
                	<button type="submit" class="btn btn-sm btn-primary">Process To Training</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
    <?php }} ?>
<!-- Modal Form Proses to Training By Sales-->


<!-- Modal Form Add Training Photo By Sales-->
<?php 
	if(isset($data_agen)){
		foreach($data_agen as $row1){
?>

<div id="add_training_photo_by_sales<?php echo $row1->id_agen; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open_multipart('agen_list/add_training_photo_by_sales','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Add Training Photo</h2>
        </header>
        <div class="panel-body">
            
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">System ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_agen" class="form-control" value="<?php echo $row1->id_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_name" class="form-control"  value="<?php echo $row1->agen_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-6">
                    	<input type="text" name="status" class="form-control"  value="<?php echo $row1->status;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Type</label>
                    <div class="col-sm-4">
                        <input type="text" name="agen_type" class="form-control"  value="<?php echo $row1->agen_type;?>" readonly="readonly"  required/>
                    </div> 
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 1</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_1" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999"  value="<?php echo $row1->agen_phone_number_1;?>"  readonly="readonly"  required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 2</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_2" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999" value="<?php echo $row1->agen_phone_number_2;?>"  readonly="readonly"/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-6">
                        <textarea name="agen_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_address;?></textarea>
                    </div>
                </div>
                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_city" class="form-control" value="<?php echo $row1->agen_city;?>" readonly="readonly" required/>
                    </div>
                </div>
                   
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Province</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_province" class="form-control" value="<?php echo $row1->agen_province;?>" readonly="readonly" required/>
                    </div>
                </div>
                      
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Longitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="longitude" class="form-control" value="<?php echo $row1->longitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Latitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="latitude" class="form-control" value="<?php echo $row1->latitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Code / Terminal ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="terminal_id" class="form-control" value="<?php echo $row1->terminal_id;?>" readonly="readonly" required/>
                    </div>
                </div>
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">No. Unique Agent</label>
                    <div class="col-sm-6">
                        <input type="text" name="no_unique_agen" class="form-control" value="<?php echo $row1->no_unique_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Number</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_number" class="form-control" value="<?php echo $row1->virtual_account_number;?>"  readonly="readonly" required/>
                    </div>
                </div>
                          
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_name" class="form-control" value="<?php echo $row1->virtual_account_name;?>"  readonly="readonly" required/>
                    </div>
                </div>       
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_operational_name" class="form-control" value="<?php echo $row1->agen_operational_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Address</label>
                    <div class="col-sm-6">
                       <textarea name="agen_operational_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_operational_address;?></textarea>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Nearest Branch</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_nearest_branch" class="form-control" value="<?php echo $row1->agen_nearest_branch;?>" readonly="readonly" required/>
                    </div>
                </div>
                                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Note</label>
                    <div class="col-sm-6">
                        <textarea name="note" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->note;?></textarea>
                    </div>
                </div>
                
                <hr />
                <p>Interested Agent Report Image</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Front Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_depan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_depan_agen; ?>">
                       <?php } ?>
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Across Side Agent</label>
                    <div class="col-sm-6"> 
                       <?php if ($row1->foto_tampak_seberang_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_seberang_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Right Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kanan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kanan_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Left Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kiri_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kiri_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>      
                 
                
                <hr />
                <p>KYC Agent</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Photograph</label>
                    <div class="col-sm-6">
                       <?php if ($row1->foto_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_agen; ?>">
                       <?php } ?>  
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent ID Card (KTP)</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_ktp==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_ktp; ?>">
                       <?php } ?>   
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Registration Form</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_form_pengajuan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_form_pengajuan_agen; ?>">
                       <?php } ?>  
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">BCA Cover Book Agent</label>
                    <div class="col-sm-6">   
                       <?php if ($row1->foto_cover_buku_tabungan==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_cover_buku_tabungan; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">NPWP / Statement Letter</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_npwp_atau_surat_keterangan_tidak_punya==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_npwp_atau_surat_keterangan_tidak_punya; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Business Certificates / BAPU</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->	foto_surat_keterangan_usaha_atau_bapu==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->	foto_surat_keterangan_usaha_atau_bapu; ?>">
                       <?php } ?>  
                    </div>
                </div>            
                
                <hr />
                <p>Installation</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Installation</label>
                    <div class="col-sm-6">  
  		               <?php if ($row1->foto_instalasi_mesin_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_instalasi_mesin_agen; ?>">
                       <?php } ?>
                    </div>
                </div>  
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">PKS (Cooperation Statement) Agent</label>
                    <div class="col-sm-6">  
                   	   <?php if ($row1->foto_pks_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_pks_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Banner</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_spanduk_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_spanduk_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Certificate</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_sertifikat_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_sertifikat_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                
                
                <hr />
                <p>Training</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Training</label>
                    <div class="col-sm-6">  
                   	   <?php if ($row1->foto_training_agen==""){ ?>
  		               <input type="file" class="form-control"   name="filetrainingagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_training_agen; ?>">
                       <?php } ?>
                    </div>
                </div> 
                
                <div class="form-group">
                        <div class="col-md-6">
                        <input type="hidden" name="last_edit_by_1" class="form-control" value="<?php echo $row1->last_edit_by;?>" readonly="readonly" required/>
                            <input class="form-control" name="last_edit_by_2" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">  
                	<button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
    <?php }} ?>
<!-- Modal Form Add Training Photo By Sales-->


<!-- Modal Form Proses to activating By Sales-->
<?php 
	if(isset($data_agen)){
		foreach($data_agen as $row1){
?>

<div id="proses_agen_to_activating_by_sales<?php echo $row1->id_agen; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open_multipart('agen_list/proses_to_acivating_by_sales','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Process To Activating</h2>
        </header>
        <div class="panel-body">
            
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">System ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_agen" class="form-control" value="<?php echo $row1->id_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_name" class="form-control"  value="<?php echo $row1->agen_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-6">
                    	<input type="hidden" name="status" class="form-control"  value="Active" readonly="readonly" required/>
                    	<input type="text" name="status1" class="form-control"  value="<?php echo $row1->status;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Type</label>
                    <div class="col-sm-4">
                        <input type="text" name="agen_type" class="form-control"  value="<?php echo $row1->agen_type;?>" readonly="readonly"  required/>
                    </div> 
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 1</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_1" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999"  value="<?php echo $row1->agen_phone_number_1;?>"  readonly="readonly"  required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 2</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_2" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999" value="<?php echo $row1->agen_phone_number_2;?>"  readonly="readonly"/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-6">
                        <textarea name="agen_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_address;?></textarea>
                    </div>
                </div>
                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_city" class="form-control" value="<?php echo $row1->agen_city;?>" readonly="readonly" required/>
                    </div>
                </div>
                   
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Province</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_province" class="form-control" value="<?php echo $row1->agen_province;?>" readonly="readonly" required/>
                    </div>
                </div>
                      
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Longitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="longitude" class="form-control" value="<?php echo $row1->longitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Latitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="latitude" class="form-control" value="<?php echo $row1->latitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Code / Terminal ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="terminal_id" class="form-control" value="<?php echo $row1->terminal_id;?>" readonly="readonly" required/>
                    </div>
                </div>
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">No. Unique Agent</label>
                    <div class="col-sm-6">
                        <input type="text" name="no_unique_agen" class="form-control" value="<?php echo $row1->no_unique_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Number</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_number" class="form-control" value="<?php echo $row1->virtual_account_number;?>"  readonly="readonly" required/>
                    </div>
                </div>
                          
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_name" class="form-control" value="<?php echo $row1->virtual_account_name;?>"  readonly="readonly" required/>
                    </div>
                </div>       
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_operational_name" class="form-control" value="<?php echo $row1->agen_operational_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Address</label>
                    <div class="col-sm-6">
                       <textarea name="agen_operational_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_operational_address;?></textarea>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Nearest Branch</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_nearest_branch" class="form-control" value="<?php echo $row1->agen_nearest_branch;?>" readonly="readonly" required/>
                    </div>
                </div>
                                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Note</label>
                    <div class="col-sm-6">
                        <textarea name="note" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->note;?></textarea>
                    </div>
                </div>
                
                <hr />
                <p>Interested Agent Report Image</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Front Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_depan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_depan_agen; ?>">
                       <?php } ?>
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Across Side Agent</label>
                    <div class="col-sm-6"> 
                       <?php if ($row1->foto_tampak_seberang_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_seberang_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Right Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kanan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kanan_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Left Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kiri_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kiri_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>      
                  
                <hr />
                <p>KYC Agent</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Photograph</label>
                    <div class="col-sm-6">
                       <?php if ($row1->foto_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_agen; ?>">
                       <?php } ?>  
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent ID Card (KTP)</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_ktp==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_ktp; ?>">
                       <?php } ?>   
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Registration Form</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_form_pengajuan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_form_pengajuan_agen; ?>">
                       <?php } ?>  
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">BCA Cover Book Agent</label>
                    <div class="col-sm-6">   
                       <?php if ($row1->foto_cover_buku_tabungan==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_cover_buku_tabungan; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">NPWP / Statement Letter</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_npwp_atau_surat_keterangan_tidak_punya==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_npwp_atau_surat_keterangan_tidak_punya; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Business Certificates / BAPU</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_surat_keterangan_usaha_atau_bapu==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->	foto_surat_keterangan_usaha_atau_bapu; ?>">
                       <?php } ?>  
                    </div>
                </div>            
                      
                <hr />
                <p>Installation Photo</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Installation</label>
                    <div class="col-sm-6">  
  		               <?php if ($row1->foto_instalasi_mesin_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_instalasi_mesin_agen; ?>">
                       <?php } ?>
                    </div>
                </div>  
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">PKS (Cooperation Statement) Agent</label>
                    <div class="col-sm-6">  
                   	   <?php if ($row1->foto_pks_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_pks_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Banner</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_spanduk_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_spanduk_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Certificate</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_sertifikat_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_sertifikat_agen; ?>">
                       <?php } ?>
                    </div>
                </div>        
                
                <hr />
                <p>Training Photo</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Training</label>
                    <div class="col-sm-6">  
                   	   <?php if ($row1->foto_training_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_training_agen; ?>">
                       <?php } ?>
                    </div>
                </div> 
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input class="form-control" name="date_of_active" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d") ;  ?>" type="hidden" readonly>
                        <input type="hidden" name="last_edit_by_1" class="form-control" value="<?php echo $row1->last_edit_by;?>" readonly="readonly" required/>
                            <input class="form-control" name="last_edit_by_2" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">  
                	<button type="submit" class="btn btn-sm btn-primary">Process To Activating</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
    <?php }} ?>
<!-- Modal Form Proses to  activating By Sales-->


<!-- Modal Form Add Activating Photo By Sales-->
<?php 
	if(isset($data_agen)){
		foreach($data_agen as $row1){
?>

<div id="add_activating_photo_by_sales<?php echo $row1->id_agen; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open_multipart('agen_list/add_activating_photo_by_sales','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Add Activating Photo</h2>
        </header>
        <div class="panel-body">
            
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">System ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_agen" class="form-control" value="<?php echo $row1->id_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_name" class="form-control"  value="<?php echo $row1->agen_name;?>" readonly="readonly" required/>
                    </div>

                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-6">
                    	<input type="text" name="status" class="form-control"  value="<?php echo $row1->status;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Type</label>
                    <div class="col-sm-4">
                        <input type="text" name="agen_type" class="form-control"  value="<?php echo $row1->agen_type;?>" readonly="readonly"  required/>
                    </div> 
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 1</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_1" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999"  value="<?php echo $row1->agen_phone_number_1;?>"  readonly="readonly"  required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Phone Number 2</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_phone_number_2" class="form-control" data-plugin-masked-input data-input-mask="9999 9999 9999" value="<?php echo $row1->agen_phone_number_2;?>"  readonly="readonly"/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-6">
                        <textarea name="agen_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_address;?></textarea>
                    </div>
                </div>
                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_city" class="form-control" value="<?php echo $row1->agen_city;?>" readonly="readonly" required/>
                    </div>
                </div>
                   
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Province</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_province" class="form-control" value="<?php echo $row1->agen_province;?>" readonly="readonly" required/>
                    </div>
                </div>
                      
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Longitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="longitude" class="form-control" value="<?php echo $row1->longitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Latitude</label>
                    <div class="col-sm-6">
                        <input type="text" name="latitude" class="form-control" value="<?php echo $row1->latitude;?>" readonly="readonly" required/>
                    </div>
                </div>
                                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Code / Terminal ID</label>
                    <div class="col-sm-6">
                        <input type="text" name="terminal_id" class="form-control" value="<?php echo $row1->terminal_id;?>" readonly="readonly" required/>
                    </div>
                </div>
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">No. Unique Agent</label>
                    <div class="col-sm-6">
                        <input type="text" name="no_unique_agen" class="form-control" value="<?php echo $row1->no_unique_agen;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Number</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_number" class="form-control" value="<?php echo $row1->virtual_account_number;?>"  readonly="readonly" required/>
                    </div>
                </div>
                          
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Virtual Account Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="virtual_account_name" class="form-control" value="<?php echo $row1->virtual_account_name;?>"  readonly="readonly" required/>
                    </div>
                </div>       
                         
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_operational_name" class="form-control" value="<?php echo $row1->agen_operational_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agen Operational Address</label>
                    <div class="col-sm-6">
                       <textarea name="agen_operational_address" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->agen_operational_address;?></textarea>
                    </div>
                </div>
                             
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Nearest Branch</label>
                    <div class="col-sm-6">
                        <input type="text" name="agen_nearest_branch" class="form-control" value="<?php echo $row1->agen_nearest_branch;?>" readonly="readonly" required/>
                    </div>
                </div>
                                           
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Note</label>
                    <div class="col-sm-6">
                        <textarea name="note" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize readonly="readonly" required><?php echo $row1->note;?></textarea>
                    </div>
                </div>
                
                <hr />
                <p>Interested Agent Report Image</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Front Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_depan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_depan_agen; ?>">
                       <?php } ?>
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Across Side Agent</label>
                    <div class="col-sm-6"> 
                       <?php if ($row1->foto_tampak_seberang_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_seberang_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Right Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kanan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kanan_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Left Side Agent</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_tampak_kiri_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_tampak_kiri_agen; ?>">
                       <?php } ?> 
                    </div>
                </div>      
                 
                
                <hr />
                <p>KYC Agent</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Photograph</label>
                    <div class="col-sm-6">
                       <?php if ($row1->foto_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_agen; ?>">
                       <?php } ?>  
                    </div>
                </div> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent ID Card (KTP)</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_ktp==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_ktp; ?>">
                       <?php } ?>   
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Agent Registration Form</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_form_pengajuan_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_form_pengajuan_agen; ?>">
                       <?php } ?>  
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">BCA Cover Book Agent</label>
                    <div class="col-sm-6">   
                       <?php if ($row1->foto_cover_buku_tabungan==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_cover_buku_tabungan; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">NPWP / Statement Letter</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_npwp_atau_surat_keterangan_tidak_punya==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_npwp_atau_surat_keterangan_tidak_punya; ?>">
                       <?php } ?>  
                    </div>
                </div>        
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Business Certificates / BAPU</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_surat_keterangan_usaha_atau_bapu==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->	foto_surat_keterangan_usaha_atau_bapu; ?>">
                       <?php } ?>  
                    </div>
                </div>            
                
                <hr />
                <p>Installation</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Installation</label>
                    <div class="col-sm-6">  
  		               <?php if ($row1->foto_instalasi_mesin_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_instalasi_mesin_agen; ?>">
                       <?php } ?>
                    </div>
                </div>  
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">PKS (Cooperation Statement) Agent</label>
                    <div class="col-sm-6">  
                   	   <?php if ($row1->foto_pks_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_pks_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Banner</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_spanduk_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_spanduk_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Certificate</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_sertifikat_agen==""){ ?>
                       No Image
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_sertifikat_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                
                
                <hr />
                <p>Training</p>
                <hr /> 
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Training</label>
                    <div class="col-sm-6">  
                   	   <?php if ($row1->foto_training_agen==""){ ?>
  		               <input type="file" class="form-control"   name="filetrainingagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_training_agen; ?>">
                       <?php } ?>
                    </div>
                </div> 
                
                <hr />
                <p>Activating</p>
                <hr />
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Activating</label>
                    <div class="col-sm-6">  
                       <?php if ($row1->foto_aktifasi_agen==""){ ?>
  		               <input type="file" class="form-control"   name="filepembukaanagen">
                       <?php }
					   else{
					   ?>
                       <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row1->foto_aktifasi_agen; ?>">
                       <?php } ?>
                    </div>
                </div>       
                       
                
                <div class="form-group">
                        <div class="col-md-6">
                        <input type="hidden" name="last_edit_by_1" class="form-control" value="<?php echo $row1->last_edit_by;?>" readonly="readonly" required/>
                            <input class="form-control" name="last_edit_by_2" value="<?php echo $this->session->userdata('name') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="hidden" readonly>
                        </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">  
                	<button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
    <?php }} ?>
<!-- Modal Form Add Activating Photo By Sales-->
