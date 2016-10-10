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
        <h2 class="panel-title">Profile</h2>
    </header>
    
    <div class="panel-body">
        <div class="table-responsive">
        <table class="table table-bordered table-striped table-condensed mb-none">
            <thead>
                <tr>                                 
                    <th>No</th> 
                    <th>User ID</th>
                    <th>User Level</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
             <?php
				$no=1;
				if(isset($user)){
					foreach ($user as $row)
						{	
						?>
                        <tr class="gradeX">
                            <th><?php echo $no++; ?></th>
                            <th><?php echo $row->id_user; ?></th>
                            <th><?php echo $row->level; ?></th>
                            <th><?php echo $row->name; ?></th>
                            <th><?php echo $row->email; ?></th>
                            <th><a class="btn btn-info btn-sm" href="<?php echo site_url('profile/edit/'.$row->id_user)?>">
									<i class="fa fa-pencil"></i> Edit</a>
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




