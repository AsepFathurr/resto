<div class="col-md-6 panel-info">
      
  		<div class="content-box-large heading">
			<div class="panel-title">Tambah Menu</div>
  			 <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <form method="post" action="<?php echo base_url('pesanan_kasir/transaksi_add_menu');?>">
                <fieldset>
                  <input type="hidden" name="id_transaksi" value="<?php echo $this -> uri -> segment(3,0);?>">
                  <div class="form-group">
                    <label>Pilih menu</label>
                    <select name="id_menu" class="form-control">
                      <?php foreach($data_menu as $menu):?>
                        <option value="<?php echo $menu -> id_menu;?> "><?php echo $menu -> nama_menu  ;?> </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Jumlah pesan (pcs)</label>
                      <input type="number"  class="form-control" value="1" required="" name="qty" />
                  </div>
                  <div class="form-group">
                      <label>Catatan pesanan</label>
                      <textarea class="form-control" placeholder="catatan pesanan" rows="3" name="cat_menu"></textarea>
                  </div>
                </fieldset>
                <div>
                    <button type="submit" class="btn btn-success" name="submit">
                      <i class="glyphicon glyphicon-floppy-saved"></i>
                      SIMPAN
                    </button>
                    <a href="<?php echo base_url('pesanan_kasir');?>" class="btn btn-default pull-right">
                      <i class="glyphicon glyphicon-chevron-left"></i>
                      KEMBALI
                    </a> 
                </div>
              </form>
            </div>
            <!-- col6 -->

          </div>

          <!-- row -->
  		</div>

	</div>
  <br><br><br><br><br><br><br><br>
</div>