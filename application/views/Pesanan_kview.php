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
								<!-- <th>Detail order</th> -->
								<th>Tgl order</th>
								<th>Jam order</th>
								<!-- <th>Catatan</th> -->
								<th width="17%">Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($table as $data):?>
							<tr class="odd gradeX">
								<td align="center" style="vertical-align: middle;"><h1><?php echo $data->no_meja?></h1></td>
								<td align="center" style="vertical-align: middle;"><?php echo date("d-F-Y", strtotime($data->tgl_transaksi));?></td>
								<td align="center" style="vertical-align: middle;"><?php echo date("H:i", strtotime($data->tgl_transaksi));?></td>
								<!-- <td><?php  if( $data->catatan  == null ) {echo '-';}else{echo $data->catatan; } ?></td> -->
								<td>
									<a href="<?php echo base_url('pesanan_kasir/transaksi_tambah_menu/').$data->id_transaksi;?>" 
										class="btn btn-xs btn-info"
										>Tambah menu</a><br><br>
									<a href="<?php echo base_url('pesanan_kasir/transaksi_selesai/').$data->id_transaksi;?>" 
										class="btn btn-xs btn-success"
										onclick="return confirm('Selesaikan transaksi?');"
										>Selesai transaksi</a><br><br>
									<a href="<?php echo base_url('pesanan_kasir/transaksi_detail/').$data->id_transaksi;?>" 
									   class="btn btn-xs btn-warning" 
									   >Detail transaksi</a><br><br>
									<a href="<?php echo base_url('pesanan_kasir/transaksi_batal/').$data->id_transaksi;?>" 
									   class="btn btn-xs btn-danger" 
									   onclick="return confirm('Batalkan pesanan?');">Batal transaksi</a>
									   <br><br>
									<a target="_blank" href="<?php echo base_url('pesanan_kasir/transaksi_cetak/').$data->id_transaksi;?>" 
									   class="btn btn-xs btn-primary" 
									  >Cetak struk</a>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
  				</div>
  			</div>
	

		</div>
</div>

		  	