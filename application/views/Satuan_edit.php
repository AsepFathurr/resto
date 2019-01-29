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
			<div class="panel-title">Tambah Data Satuan berat</div>
  			 <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <form method="post">
                <fieldset>
                  <div class="form-group">
                    <label>Nama satuan</label>
                    <input class="form-control" placeholder="Contoh : Kilogram" type="text" required="" name="nama" value="<?php echo $edit->nama_satuan?>">
                  </div>
                  <div class="form-group">
                      <label>Catatan satuan</label>
                      <textarea class="form-control" placeholder="catatan satuan" rows="3" name="catatan"><?php echo $edit->catatan_satuan?></textarea>
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

		  	