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
			<div class="panel-title">Edit data karyawan</div>
  			 <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <form method="post">
                <fieldset>
                  <div class="form-group">
                    <label>Nama karyawan</label>
                    <input class="form-control" placeholder="Contoh : A1" type="text" required="" 
                    value="<?php echo $edit->nama_karyawan?>" name="nama">
                  </div>
                  <div class="form-group">
                    <label>No.telp karyawan</label>
                    <input class="form-control" placeholder="(hanya angka) Contoh : 089123819" type="number" required="" name="telp" value="<?php echo $edit->telp_karyawan?>">
                  </div>
                  <div class="form-group">
                    <label>Jabatan</label>
                    <select name="jabatan" class="form-control" required="">
                      <option value="chef" <?php if($edit->jabatan =='chef'){echo 'selected';}?>> Chef / koki </option>
                      <option value="waiter" <?php if($edit->jabatan =='waiter'){echo 'selected';}?>> Waiter / Waitress </option>;
                      <option value="manajer" <?php if($edit->jabatan =='manajer'){echo 'selected';}?>> Manajer </option>
                      <option value="owner" <?php if($edit->jabatan =='owner'){echo 'selected';}?>> Owner </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" placeholder="input username" type="text" required="" name="username" value="<?php echo $edit->username?>">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" placeholder="input password" type="text" required="" name="password" value="<?php echo $edit->password?>">
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

		  	