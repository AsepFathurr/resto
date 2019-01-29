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
					<div class="panel-title">Data kategori</div>
  				<div class="panel-body">
  					
  					<a href="<?php echo base_url('kategori/add');?>" class="btn btn-xs btn-primary">
				  		<i class="glyphicon glyphicon-plus"></i>
				  		TAMBAH DATA
			  		</a>
			  		<br>
			  		<br>
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
						<thead>
							<tr>
								<th>Kategori</th>
								<th>Catatan</th>
								<th>Tgl input</th>
								<th>opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($kategori as $data):?>
							<tr class="odd gradeX">
								<td><?php echo $data->nama_kategori ?></td>
								<td><?php echo $data->catatan_kategori ?></td>
								<td><?php echo $data->tgl_input_kategori ?></td>
								<td>
									<a href="<?php echo base_url('kategori/edit/').$data->id_menu_kategori;?>" class="btn btn-xs btn-primary">
										<i class="glyphicon glyphicon-edit"></i>
									</a>
									<a href="<?php echo base_url('kategori/delete/').$data->id_menu_kategori;?>" class="btn btn-xs btn-danger" onClick="return confirm('Hapus data?');">
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

		  	