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
					<div class="panel-title">Data bahan</div>
  				<div class="panel-body">
  					
  					<a href="<?php echo base_url('bahan/add');?>" class="btn btn-xs btn-primary">
				  		<i class="glyphicon glyphicon-plus"></i>
				  		TAMBAH DATA
			  		</a>
			  		<br>
			  		<br>
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
						<thead>
							<tr>
								<th>Nama bahan</th>
								<th>Harga</th>
								<th>Stock</th>
								<th>Tgl input</th>
								<th>opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($table as $data):?>
							<tr class="odd gradeX">
								<td><?php echo $data->nama_bahan ?></td>
								<td><?php echo "Rp ".number_format($data->harga_bahan,0,'.','.');  ?></td>
								<td>
									<?php if($data->stock_bahan <= $data->stock_minimal):?>
										<a href="<?php echo base_url('bahan/edit/').$data->id_bahan."?focus=restock";?>" class="btn btn-xs btn-info" title="bahan hampir habis, silahkan lakukan restock." onClick="return confirm('bahan hampir habis, ingin melakukan restock?');">
											<i class="glyphicon glyphicon-info-sign"></i>
										</a>
									<?php endif;?>
									<?php echo number_format($data->stock_bahan,0,'.','.').' '.$data->nama_satuan; ?>
									
								</td>
								<td><?php echo $data->tgl_input_bahan ?></td>
								<td>
									<a href="<?php echo base_url('bahan/edit/').$data->id_bahan;?>" class="btn btn-xs btn-primary">
										<i class="glyphicon glyphicon-edit"></i>
									</a>
									<a href="<?php echo base_url('bahan/delete/').$data->id_bahan;?>" class="btn btn-xs btn-danger" onClick="return confirm('Hapus data?');">
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

		  	