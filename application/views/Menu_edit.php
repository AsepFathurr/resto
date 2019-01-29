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
                    <label>Ganti foto menu</label>
                    <input class="form-control" type="file" name="userfile">
                  </div>
                  <div class="form-group">
                    <label>Nama menu</label>
                    <input class="form-control" placeholder="Contoh : ayam geprek" type="text" required="" name="nama" value="<?php echo $data->nama_menu; ?>">
                  </div>
                  <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control">
                      <option value="">- pilih kategori -</option>
                      <?php foreach($kategori as $data2): ?>
                        <?php if($data2->id_menu_kategori == $data->id_menu_kategori):?>
                        <option selected value="<?php echo $data2->id_menu_kategori?>">
                          <?php echo $data2->nama_kategori?>
                        </option>
                        <?php else: ?>
                        <option  value="<?php echo $data2->id_menu_kategori?>">
                          <?php echo $data2->nama_kategori?>
                        </option>
                        <?php endif;?>
                      <?php endforeach;?>
                      
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Harga jual (rupiah)</label>
                    <input class="form-control" placeholder="(hanya angka) Contoh : 12500" type="number" required="" name="harga" value="<?php echo $data->harga_menu?>" min="0">
                  </div>
                  <div class="form-group">
                    <label>Stock (pcs)</label>
                    <input class="form-control" placeholder="(hanya angka) Contoh : 12" type="number" required="" name="stock" value="<?php echo $data->stock_menu?>" min="0">
                  </div>
                  
                  <div class="form-group">
                      <label>Catatan  / deskripsi menu</label>
                      <textarea class="form-control" placeholder="(opsional) Contoh: Ayam goreng krispi dengan geprek pedas. " rows="5" name="catatan"><?php echo $data->catatan_menu?></textarea>
                  </div>
                
              
             
            </div>
            <!-- col4 -->

            <div class="col-xs-8">
              <legend>Resep menu</legend>
              <div class="form-group col-xs-12">
                <button type="button" id="btn_add" class="btn btn-xs btn-primary"> tambah bahan</button>
              </div>
              <div id="resep">
              <?php 
              if(count($bahan_menu)>1):
              $no = 1;
              foreach($bahan_menu as $bhn):?>

              <div class="form-group col-xs-8">
                <label>Bahan <?php echo $no;?></label>
                <select onchange="imChange(<?php echo $no;?>)" class="form-control bahan<?php echo $no;?>" name="bahan[]" required="">
                    <?php foreach($bahan as $bhan):?>
                      <?php if($bhan -> id_bahan == $bhn->id_bahan):?>
                        <option data-satuan="<?php echo $bhan->nama_satuan ?>" 
                                data-no="<?php echo $no?>" 
                                value="<?php echo $bhan->id_bahan?>"
                                selected>
                                  <?php echo $bhan->nama_bahan?>
                        </option>
                        <?php else: ?>
                        <option data-satuan="<?php echo $bhan->nama_satuan ?>" 
                                data-no="<?php echo $no?>" 
                                value="<?php echo $bhan->id_bahan?>"
                                >
                                  <?php echo $bhan->nama_bahan?>
                        </option>
                      <?php endif; ?>
                    <?php endforeach;?>
                </select>
              </div>

              <div class="form-group col-xs-4">
                  <label>Jumlah</label>
                      <div class="input-group ">
                  <input type="number" 
                         class="form-control bahan_qty_<?php echo $no;?>" 
                         name="bahan_qty[]" 
                         placeholder="jumlah" 
                         pattern="[0-9]+([\,|\.][0-9]+)?" 
                         step="any" 
                         min="0"
                         value="<?php echo $bhn->quantity?>"
                         title="input dapat berupa angka / pecahan, gunakan tanda comma (,) atau titik(.) jika input berupa pecahan.">
                  <span class="input-group-addon bahan_satuan_<?php echo $no;?>"><?php echo $bhn->nama_satuan;?></span>
                </div>
              </div>

            <?php 
                  $no++;
                  endforeach;
                endif;
            ?>

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
		  	