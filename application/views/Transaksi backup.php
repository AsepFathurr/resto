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
					<div class="panel-title">Data Pesanan</div>
  				<div class="panel-body">
  					
  					<a href="<?php echo base_url('pesanan/chef_view');?>" class="btn btn-md btn-primary">
				  		<i class="glyphicon glyphicon-eye-open"></i>
				  		Chef view
			  		</a>
			  		<br>
			  		<br>
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tablePesan">
						<thead>
							<tr>
								<th>Nomor meja</th>
								<th>Tgl order</th>
								<th>Jam order</th>
								<th>Detail order</th>
								<th>Catatan</th>
								<th>opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($table as $data):?>
							<tr class="odd gradeX">
								<td><?php echo $data->no_meja?></td>
								<td><?php echo date("d-F-Y", strtotime($data->tgl_transaksi));?></td>
								<td><?php echo date("H:i", strtotime($data->tgl_transaksi));?></td>
								<td>
									<ul>
										<?php foreach($data_menu as $dtm):?>
											<?php if($dtm->id_transaksi == $data -> id_transaksi):?>
												<li>
													<b><?php echo $dtm -> jumlah_beli.' pcs</b> '
													. $dtm -> nama_menu;?>
													<?php 
														switch ($dtm->status) {
															case 'cancel':
																echo '<span class="label label-default">batal pesan</span>';
																break;
															case 'done':
																echo '<span class="label label-success">selesai</span>';
																break;
															case 'wait':
																echo '<span class="label label-warning">menunggu</span>';
																break;
														}
													?>
												</li>
											<?php endif;?>
										<?php endforeach; ?>
									</ul>
								</td>
								<td><?php  if( $data->catatan  == null ) {echo '-';}else{echo $data->catatan; } ?></td>
								<td>
									<a href="<?php echo base_url('karyawan/delete/').$data->id_transaksi;?>" class="btn btn-xs btn-success" onClick="return confirm('Konfirmasi selesai pesanan.\nklik ok untuk melanjutkan');">
										selesai</i>
									</a>
									<a href="<?php echo base_url('karyawan/delete/').$data->id_transaksi;?>" class="btn btn-xs btn-danger" onClick="return confirm('batalkan pesanan?');">
										batal</i>
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

		  	