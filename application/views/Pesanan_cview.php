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
  					
  					<table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered" id="tablePesan" style="vertical-align: middle;">
						<thead>
							<tr>
								<th>Nomor meja</th>
								<th>Detail order</th>
								<th>Tgl order</th>
								<th>Jam order</th>
								<th>Catatan</th>
							
							</tr>
						</thead>
						<tbody>
							<?php foreach($table as $data):?>
							<tr class="odd gradeX">
								<td align="center" style="vertical-align: middle;"><h1><?php echo $data->no_meja?></h1></td>
								<td>
									<table cellpadding="0" cellspacing="0" border="1" class="table table-bordered">
										<?php foreach($data_menu as $dtm):?>
										<?php if($dtm -> id_transaksi == $data->id_transaksi):?>
										<tr>
											<td><image  class="covers" src="<?php echo base_url('assets/images/produk/'.$dtm->foto_menu);?>"></image></td>
											<td width="60%" style="vertical-align: middle;">
												<?php echo $dtm -> nama_menu;?>
											</td>
											<td width="10%" style="vertical-align: middle;"><?php echo 'x'.$dtm -> jumlah_beli;?></td>
											<td style="vertical-align: middle;">
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
											</td>
										</tr>
										<?php endif;?>
										<?php endforeach;?>
									</table>
								</td>
								<td align="center" style="vertical-align: middle;"><?php echo date("d-F-Y", strtotime($data->tgl_transaksi));?></td>
								<td align="center" style="vertical-align: middle;"><?php echo date("H:i", strtotime($data->tgl_transaksi));?></td>
								<td><?php  if( $data->catatan  == null ) {echo '-';}else{echo $data->catatan; } ?></td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
  				</div>
  			</div>
	

		</div>
</div>

		  	