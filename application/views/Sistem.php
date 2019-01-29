<form method="post">
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
			<div class="panel-title">Ubah data resto</div>
  			 <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
          
                <fieldset>
                  <div class="form-group">
                    <label>Nama Resto</label>
                    <input class="form-control" type="text" required="" name="nama" value="<?php echo $edit->nama_resto?>" >
                  </div>
                  <div class="form-group">
                    <label>Telp resto </label>
                    <input class="form-control"  type="text" required="" value="<?php echo $edit->telp_resto?>" name="telp">
                  </div> 
                  <div class="form-group">
                    <label>Alamat resto</label>
                    <textarea class="form-control" rows="4" name="alamat"><?php echo $edit->alamat_resto;  ?></textarea>
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
             
            </div>
            <!-- col6 -->

          </div>

          <!-- row -->
  		</div>

	</div>
   &nbsp;
             &nbsp;
             <br>
             <br>
             <br>
             <br>
             <br>
             
</div>
 </form>

		  	