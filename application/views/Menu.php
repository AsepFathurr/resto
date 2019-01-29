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
					<div class="panel-title">Data menu</div>
  				<div class="panel-body">
  					
  					<a href="<?php echo base_url('menu/add');?>" class="btn btn-xs btn-primary">
				  		<i class="glyphicon glyphicon-plus"></i>
				  		TAMBAH DATA
			  		</a>
			  		<br>
			  		<br>
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
						<thead>
							<tr>
								<th>Nama menu</th>
								<th>Harga</th>
								<th>Kategori</th>
								<th>Tgl input</th>
								<th>opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($table as $data):?>
							<tr class="odd gradeX">
								<td><?php echo $data->nama_menu?></td>
								<td><?php echo "Rp ".number_format($data->harga_menu,'0','.','.'); ?></td>
								<td><?php echo $data->nama_kategori ?></td>
								<td><?php echo $data->tgl_input_menu ?></td>
								<td>
									

									<?php if($data->is_favorit == true):?>
										<a href="<?php echo base_url('menu/unfavorit/').$data->id_menu;?>" class="btn btn-xs btn-danger"
											 onClick="return confirm('Batalkan favorit?');"
										>
											<i class="glyphicon glyphicon-heart"></i>
										</a>
									<?php else:?>
										<a href="<?php echo base_url('menu/favorit/').$data->id_menu;?>" class="btn btn-xs btn-default" onClick="return confirm('Jadikan Favorit?');">
											<i class="glyphicon glyphicon-heart"></i>
										</a>
									<?php endif;?>

									<?php if($data->is_avaible == true):?>
										<a href="<?php echo base_url('menu/unview/').$data->id_menu;?>" class="btn btn-xs btn-default"
											 onClick="return confirm('Nonaktifkan produk?');"
										>
											<i class="glyphicon glyphicon-eye-close"></i>
										</a>
									<?php else:?>
										<a href="<?php echo base_url('menu/view/').$data->id_menu;?>" class="btn btn-xs btn-success" onClick="return confirm('Tampilkan produk?');">
											<i class="glyphicon glyphicon-eye-open"></i>
										</a>
									<?php endif;?>

									<a href="<?php echo base_url('menu/edit/').$data->id_menu;?>" class="btn btn-xs btn-primary">
										<i class="glyphicon glyphicon-edit"></i>
									</a>
									<a href="<?php echo base_url('menu/delete/').$data->id_menu;?>" class="btn btn-xs btn-danger" onClick="return confirm('Hapus data?');"><i class="glyphicon glyphicon-trash"></i></a>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
  				</div>
  			</div>
	

		</div>
</div>

		  	