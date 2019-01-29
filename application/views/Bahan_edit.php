<div class="row">
	<div class="col-md-6 panel-info">
      <?php if(isset($_SESSION['message'])): ?>
        <div class="col-xs-12 "  id="message">
        <!-- message -->
          <div class="callout <?php echo $this -> session->flashdata('message')['color'];?>">
            <h4><?php echo $this -> session->flashdata('message')['title'];?></h4>
            <p><?php echo $this->session->flashdata('message')['msg']; ?></p>
          </div>
        <!-- message end -->
      </div>
      <?php endif; ?>

  		<div class="content-box-large heading">
			<div class="panel-title">Tambah Bahan</div>
  			 <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <form method="post">
                <fieldset>
                  <div class="form-group">
                    <label>Nama bahan</label>
                    <input class="form-control" placeholder="Contoh: Minyak goreng" type="text" required="" name="nama" value="<?php echo $data->nama_bahan;?>">
                  </div>
                  <div class="form-group">
                    <label>Harga</label>
                    <input class="form-control" placeholder="Contoh: 22000, *hanya angka" type="number" min="0" required="" name="harga" value="<?php echo $data->harga_bahan;?>">
                  </div>
                  <div class="form-group">
                    <label>Stock  <?php if(isset($_GET['focus'])):echo "<i class='glyphicon glyphicon-exclamation-sign'></i> "; endif;?></label>
                    <input class="form-control" placeholder="Contoh: 10, *hanya angka" type="number" min="0" required="" name="stock" value="<?php echo $data->stock_bahan;?>"
                    <?php if(isset($_GET['focus'])):echo "autofocus"; endif;?>
                    >
                  </div>
                   <div class="form-group">
                    <label>Stock minimal</label>
                    <input class="form-control" placeholder="Contoh: 10, *hanya angka" type="number" min="0" required="" name="stock_minimal" value="<?php echo $data->stock_minimal;?>">

                    <!-- <p class="help-block">Stok minimal utk memberi notifikasi jumlah stock.</p> -->
                  </div>
                  <div class="form-group">
                    <label>Satuan bahan</label>
                    <select name="satuan" class="form-control" required="">
                      <?php if(count($satuan)>1): ?>
                        <?php foreach($satuan as $data2):?>
                          <?php if($data->id_satuan == $data2->id_satuan): ?>
                          <option selected value="<?php echo $data2->id_satuan?>">
                            <?php echo $data2->nama_satuan?>
                          </option>
                          <?php else: ?>
                            <option value="<?php echo $data2->id_satuan?>">
                              <?php echo $data2->nama_satuan?>
                            </option>
                          <?php endif;?>
                        <?php endforeach;?>
                      <?php else: ?>
                         <option value="">- belum ada data satuan-</option>
                      <?php endif;?>
                    </select>
                  </div>
                  <div class="form-group">
                      <label>Catatan </label>
                      <textarea class="form-control" placeholder="Catatan jika ada (opsional)" rows="3" name="catatan"> <?php echo $data->catatan_bahan?></textarea>
                  </div>
                </fieldset>
                <div>
                    <button type="submit" class="btn btn-success" name="submit">
                      <i class="glyphicon glyphicon-floppy-saved"></i>
                      SIMPAN
                    </button>
                    <button type="reset" class="btn btn-warning">
                      <i class="glyphicon glyphicon-repeat"></i>
                      RESET
                    </button>
                    <button onclick="window.history.go(-1); return false;" type="reset" class="btn btn-default pull-right">
                      <i class="glyphicon glyphicon-chevron-left"></i>
                      KEMBALI
                    </button>
                </div>
              </form>
            </div>
            <!-- col6 -->
          </div>
          <!-- row -->
  		</div>
	</div>
</div>

		  	