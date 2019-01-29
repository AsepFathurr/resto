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

	    <form method="post">
	    <div class="col-md-3 panel-info">
	    	<div class="content-box-large heading">
		    	<div class="panel-title">Filter data</div>
		    	<div class="panel-body">
		    		<div class="form-group">
	                    <label>Tgl mulai transaksi</label>
	                    <input class="form-control"  type="date" required="" name="tgl_mulai" value="<?php echo $tgl_mulai;?>">
                  	</div>
		    		<div class="form-group">
	                    <label>Tgl akhir transaksi</label>
	                    <input class="form-control"  type="date" required="" name="tgl_selesai" value="<?php echo $tgl_selesai;?>" >
                  	</div>
                  	<div class="form-group">
                  		<button type="submit" class="btn btn-success btn-block" name="submit">
	                      <i class="glyphicon glyphicon-filter"></i>
	                      filter
	                    </button>
                  	</div>
		    	</div>
	   		</div>
	    </div>
	    </form>

		<div class="col-md-9 panel-info">
  			<div class="content-box-large heading">
					<div class="panel-title">Data transaksi</div>
  				<div class="panel-body">
  					<table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered" id="tablePesan" style="vertical-align: middle;">
						<thead>
							<tr>
								<th>Nomor meja</th>
								<th>Tgl transaksi</th>
								<th>Detail order</th>
							</tr>
						</thead>
						<tbody>
							<?php  $total_harian  = 0; foreach($table as $data):?>
							<tr class="odd gradeX">
								<td align="center" style="vertical-align: middle;"><?php echo $data->no_meja?></td>
								<td align="center" style="vertical-align: middle;"><?php echo date("d-F-Y H:i", strtotime($data->tgl_transaksi));?></td>

								<td>
									<table cellpadding="0" cellspacing="0" border="1" class="table table-bordered">
										<tr>
											<th>Status</th>
											<th>Menu</th>
											<th>Subtotal</th>

										</tr>
										<?php $total_belanja = 0; 
											 
											 foreach($data_menu as $dtm):?>
										<?php if($dtm -> id_transaksi == $data->id_transaksi):?>
										<tr>
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
											<td width="60%" style="vertical-align: middle;">
												<?php echo $dtm -> jumlah_beli.' ';?> <?php echo $dtm -> nama_menu;?>
											</td>
											<td width="40%" style="vertical-align: middle;">
												<?php 
													if($dtm->status == 'done'):
														$harga =  $dtm -> jumlah_beli * $dtm -> harga_menu;
													else:
														$harga = 0;
													endif;
													$total_belanja = $total_belanja + $harga;
												?>
												<?php echo "Rp ".number_format($harga,0,'.','.'); ?>
											</td>
											
										</tr>
										<?php endif;?>
										<?php endforeach;?>
										<tr>
											<td colspan="2" align="right">Total belanja</td>
											<td><?php 
													$total_harian  = $total_harian + $total_belanja; 
													echo "Rp ".number_format($total_belanja,0,'.','.'); ?></td>
										</tr>
										
									</table>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2" align="right">Total penghasilan : </td>
								<td><?php echo "Rp ".number_format($total_harian,0,'.','.'); ?></td>
							</tr>
						</tfoot>
					</table>
  				</div>
  			</div>
	

		</div>
</div>

		  	