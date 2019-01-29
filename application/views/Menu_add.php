<form method="post" enctype="multipart/form-data">
<div class="row">
	<div class="col-md-12 panel-info">
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
			<div class="panel-title">Tambah menu</div>
  			 <div class="panel-body">
          <div class="row">
            <div class="col-xs-4">
              
                  <legend>Data menu</legend>
                  <div class="form-group">
                    <label>Foto menu</label>
                    <input class="form-control" type="file" required="" name="userfile">
                  </div>
                  <div class="form-group">
                    <label>Nama menu</label>
                    <input class="form-control" placeholder="Contoh : ayam geprek" type="text" required="" name="nama">
                  </div>
                  <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control">
                      <option value="">- pilih kategori -</option>
                      <?php foreach($kategori as $data): ?>
                        <option value="<?php echo $data->id_menu_kategori?>"><?php echo $data->nama_kategori?></option>
                      <?php endforeach;?>
                      
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Harga jual (rupiah)</label>
                    <input class="form-control" placeholder="(hanya angka) Contoh : 12500" type="number" required="" name="harga" min="0">
                  </div>
                   <div class="form-group">
                    <label>Stock menu (pcs)</label>
                    <input class="form-control" placeholder="(hanya angka) Contoh : 15" type="number" required="" name="stock" min="0">
                  </div>

                  <div class="form-group">
                      <label>Catatan  / deskripsi menu</label>
                      <textarea class="form-control" placeholder="(opsional) Contoh: Ayam goreng krispi dengan geprek pedas. " rows="5" name="catatan"></textarea>
                  </div>
                
              
             
            </div>
            <!-- col4 -->

            <div class="col-xs-8">
              <legend>Resep menu</legend>
              <div class="form-group col-xs-12">
                <button type="button" id="btn_add" class="btn btn-xs btn-primary"> tambah bahan</button>
              </div>
              <div id="resep">
               

              </div>
            <!-- col8 -->
          </div>  
          </div>
          <!-- row -->
  		  
      </div>
       <div class="panel-footer">
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

	</div>
   
</div>

        </form>
		  	