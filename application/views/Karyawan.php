<div class="row">
		<?php if(isset($_SESSION['message'])): ?>
		        <div class="col-xs-12 "  id="message">
		        <!-- message -->
		        <div class="alert <?php echo $this -> session->flashdata('message')['color'];?>">
				  <strong><?php echo $this -> session->flashdata('message')['title'];?></strong> 
				  <?php echo $this->session->flashdata('message')['msg']; ?>
				</div>
		        <!-- message end -->
		      </div>
	    <?php endif; ?>

		<div class="col-md-12 panel-info">


  			<div class="content-box-large heading">
					<div class="panel-title">Data karyawan</div>
  				<div class="panel-body">
  					
  					<a href="<?php echo base_url('karyawan/add');?>" class="btn btn-xs btn-primary">
				  		<i class="glyphicon glyphicon-plus"></i>
				  		TAMBAH DATA
			  		</a>
			  		<br>
			  		<br>
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
						<thead>
							<tr>
								<th>Nama</th>
								<th>No.telp</th>
								<th>Username</th>
								<th>Jabatan</th>
								<th>Tgl input</th>
								<th>Tgl login terakhir</th>
								<th>opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($table as $data):?>
							<tr class="odd gradeX">
								<td><?php echo $data->nama_karyawan?></td>
								<td><?php echo $data->telp_karyawan ?></td>
								<td><?php echo $data->username ?></td>
								<td><?php echo $data->jabatan ?></td>
								<td><?php echo $data->tgl_input_karyawan ?></td>
								<td><?php echo $data->tgl_login_terakhir ?></td>
								<td>
									<a href="<?php echo base_url('karyawan/edit/').$data->id_karyawan;?>" class="btn btn-xs btn-primary">
										<i class="glyphicon glyphicon-edit"></i>
									</a>
									<a href="<?php echo base_url('karyawan/delete/').$data->id_karyawan;?>" class="btn btn-xs btn-danger" onClick="return confirm('Hapus data?');">
										<i class="glyphicon glyphicon-trash"></i>
									</a>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
  				</div>
  			</div>
	

		</div>
</div>

		  	