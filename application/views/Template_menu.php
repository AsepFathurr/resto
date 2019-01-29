 <ul class="nav">
                    <!-- Main menu -->
                    <li id="home">
                        <a href="<?php echo base_url();?>">
                            <i class="glyphicon glyphicon-home"></i> Beranda
                        </a>
                    </li>
                    <li id="pesanan">
                        <a href="<?php echo base_url('pesanan_kasir');?>"><i class="glyphicon glyphicon-shopping-cart"></i> Daftar pesanan</a>
                    </li>
                     <li id="belanja">
                        <a href="<?php echo base_url('bahan/daftar_belanja');?>"><i class="glyphicon glyphicon-briefcase"></i> Daftar belanja</a>
                    </li>
                    <li id="master_data" class="submenu <?php if($web['is_trview'] == true){echo "open";}?>">
                         <a href="#">
                            <i class="glyphicon glyphicon-hdd"></i> Master data
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>

                            <li id="data_menu"><a href="<?php echo base_url('menu');?>">Data Menu</a></li>
                            <li id="data_transaksi"><a href="<?php echo base_url('transaksi');?>">Data Transaksi</a></li>
                            <li id="data_kategori"><a href="<?php echo base_url('kategori');?>">Data Kategori</a></li>
                            <li id="data_bahan"><a href="<?php echo base_url('bahan');?>">Data Bahan</a></li>
                            <li id="data_satuan"><a href="<?php echo base_url('satuan');?>">Data Satuan</a></li>
                            <li id="data_meja"><a href="<?php echo base_url('meja');?>">Data Meja</a></li>
                            <li id="data_karyawan"><a href="<?php echo base_url('karyawan');?>">Data Karyawan</a></li>
                        </ul>
                    </li>
                    
                    <li id="profil">
                        <a  href="<?php echo base_url('profil'); ?>"><i class="glyphicon glyphicon-user"></i> Profil</a>
                    </li>
                     <li  id="sistem">
                        <a   href="<?php echo base_url('sistem'); ?>"><i class="glyphicon glyphicon-cog"></i> Pengaturan</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('logout'); ?>"><i class="glyphicon glyphicon-off"></i> Logout</a>
                    </li>
                </ul>