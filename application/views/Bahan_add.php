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
                    <input class="form-control" placeholder="Contoh: Minyak goreng" type="text" required="" name="nama">
                  </div>
                  <div class="form-group">
                    <label>Harga</label>
                    <input class="form-control" placeholder="Contoh: 22000, *hanya angka" type="number" required="" name="harga" min="0">
                  </div>
                  <div class="form-group">
                    <label>Stock</label>
                    <input class="form-control" placeholder="Contoh: 10, *hanya angka" type="number" required="" name="stock" min="0">
                  </div>
                   <div class="form-group">
                    <label>Stock minimal</label>
                    <input class="form-control" placeholder="Contoh: 10, *hanya angka" type="number" required="" min="0" name="stock_minimal" value="">
                    <!-- <p class="help-block">Stok minimal utk memberi notifikasi jumlah stock.</p> -->
                  </div>
                  <div class="form-group">
                    <label>Satuan bahan</label>
                    <select name="satuan" class="form-control" required="">
                      <?php if(count($satuan)>1): ?>
                        <option value="">- pilih satuan-</option>
                        <?php foreach($satuan as $data):?>
                          <option value="<?php echo $data->id_satuan?>"><?php echo $data->nama_satuan?></option>
                        <?php endforeach;?>
                      <?php else: ?>
                         <option value="">- belum ada data satuan-</option>
                      <?php endif;?>
                    </select>
                  </div>
                  <div class="form-group">
                      <label>Catatan </label>
                      <textarea class="form-control" placeholder="Catatan jika ada (opsional)" rows="3" name="catatan"></textarea>
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

		  	