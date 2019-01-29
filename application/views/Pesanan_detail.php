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
					<div class="panel-title">Detail Pesanan</div>
  				<div class="panel-body">
  					<table>
						<tr>
							<td class="col-xs-4"><b>Tgl pesan</b></td>
							<td class="col-xs-2">:</td>
							<td><?php echo date("d-F-Y H:i:s", strtotime($datas->tgl_transaksi));?></td>
						</tr>	
						<tr>
							<td class="col-xs-4"><b>Nomor meja</b></td>
							<td class="col-xs-2">:</td>
							<td><?php echo $datas->no_meja;?></td>
						</tr>	
					</table>
					<br>
					<table>
						<tr><td class="col-xs-4"><b>Menu pesanan</b></td></tr>
						<tr><td class="col-xs-4">
							<div class="col-xs-8">
							<table cellpadding="0" cellspacing="0" border="1" class="table table-bordered">
										<?php foreach($data_menu as $dtm):?>
										<?php if($dtm -> id_transaksi == $this->uri->segment(3)):?>
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
											<td width="15%" style="vertical-align: middle;">
												<?php 
													if($dtm->catatan_detail == null):
														echo "tidak ada catatan.";
													else:
														echo $dtm->catatan_detail;
													endif;
												?>
											</td>
										</tr>
										<?php endif;?>
										<?php endforeach;?>
									</table>
								</div>
						</td></tr>
					</table>
  				
  				</div>
  				<a href="<?php echo base_url('pesanan_kasir/transaksi_tambah_menu/').$datas->id_transaksi;?>" 
										class="btn  btn-info"
										>Tambah menu</a>
									<a href="<?php echo base_url('pesanan_kasir/transaksi_selesai/').$datas->id_transaksi;?>" 
										class="btn  btn-success"
										onclick="return confirm('Selesaikan transaksi?');"
										>Selesai transaksi</a>
									<a href="<?php echo base_url('pesanan_kasir/transaksi_batal/').$datas->id_transaksi;?>" 
									   class="btn btn-danger" 
									   onclick="return confirm('Batalkan pesanan?');">Batal transaksi</a>
									<a target="_blank" href="<?php echo base_url('pesanan_kasir/transaksi_cetak/').$datas->id_transaksi;?>" 
									   class="btn btn-primary" 
									  >Cetak struk</a>
									  <button onclick="window.history.go(-1); return false;" type="reset" class="btn btn-default ">
                      <i class="glyphicon glyphicon-chevron-left"></i>
                      KEMBALI
                    </button>
  			</div>
			

		</div>
</div>

		  	