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
                    <li id="profil">
                        <a  href="<?php echo base_url('profil'); ?>"><i class="glyphicon glyphicon-user"></i> Profil</a>
                    </li id="sistem">
                    <li>
                        <a href="<?php echo base_url('login/do_logout'); ?>"><i class="glyphicon glyphicon-off"></i> Logout</a>
                    </li>
                </ul>