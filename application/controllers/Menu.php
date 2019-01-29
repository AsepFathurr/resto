<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct() 
 	{
    	parent::__construct();
		
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('Query');
    	$this -> user_name  = $_SESSION['user_nama'];
    	$this -> user_level = $_SESSION['user_level'];
    	$this -> user_id    = $_SESSION['user_id'];
    	date_default_timezone_set('Asia/Jakarta');

    	#cek login
    	if(isset($_SESSION['user_is_login']) and $_SESSION['user_is_login']== true):
	    	$this -> user_name  = $_SESSION['user_nama'];
	    	$this -> user_level = $_SESSION['user_level'];
	    	$this -> user_id    = $_SESSION['user_id']; 
	    else:
	    	$this -> flsh_msg('Perhatian!','warning','anda harus login untuk mengakses halaman tersebut');
			redirect(base_url('login')); 
    	endif;
	}

	public function flsh_msg($title,$type,$msg)
	{
		$color = '';

		switch ($type) {
			case 'ok':
				$color = 'alert-success';
				break;
			case 'warning':
				$color = 'alert-warning';
				break;
			case 'danger':
				$color = 'alert-danger';
				break;
			default:
				$color = 'alert-info';
				break;
		}

		$flash_message = array( 'title' => $title,
								'color' => $color,
								'msg'   => $msg
							  );
		$this->session->set_flashdata('message',$flash_message);
	}


	public function index()
	{
		$data['web'] 	= array( 'title'	  => 'Data menu | Inventori Resto',
								 'aktif_menu' => 'data_menu',
								 'page'		  => 'Menu.php',
								 'is_trview'  => true,
								 'is_table'	  => true,
								);
		$data['user']	= array( 'name' 	  => $this -> user_name,
								 'level'	  => $this -> user_level	
								);
		$data['breadcrumb'] = array('Kategori');
		$data['table']	= $this -> Query -> getDataJoin('menu','menu_kategori','id_menu_kategori') -> result();
		$this->load->view('Template',$data);
	}

	public function add()
	{
		$data['web'] 	= array( 'title'	  => 'Tambah menu / resep | Inventori Resto',
								 'aktif_menu' => 'data_menu',
								 'page'		  => 'Menu_add.php',
								 'is_trview'  => true,
								 'is_table'	  => true,
								);
		$data['user']	= array( 'name' 	  => $this -> user_name,
								 'level'	  => $this -> user_level	
								);
		$data['breadcrumb'] = array('Kategori');
		$data['satuan']		= $this -> Query -> getAllData('satuan') -> result();
		$data['kategori']	= $this -> Query -> getAllData('menu_kategori') -> result();
		$this->load->view('Template',$data);

		#cek jika ada post submit
		if(isset($_POST['submit'])):
			#input data 
			$image_url 	= 'default_menu.jpg';
			if(empty($_FILES['userfile']['name'])):
				  $image_url 	= 'default_cover.jpg';
			else:
				$config['upload_path']   = './assets/images/produk';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']      = '4000';
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('userfile',FALSE)):
					// uplaod gagal gunakan default cover
					$image_url 	= 'default_menu.jpg';
				else:
				 	$upload_data = $this->upload->data(); 
				 	$image_url = $upload_data['file_name'];
				endif;
			endif;	
			$kategori  = $this -> input -> post('kategori');
			$nama 	   = $this -> input -> post('nama');
			$harga 	   = $this -> input -> post('harga');
			$stock 	   = $this -> input -> post('stock');
			$catatan   = $this -> input -> post('catatan');	
			$data_to_input = array(	'id_menu_kategori'=>$kategori,
									'nama_menu' => $nama,
									'foto_menu' => $image_url,
									'harga_menu'=> $harga,
									'catatan_menu' => $catatan,
									'tgl_input_menu' => date('Y-m-d H:i:s'),
									'stock_menu' => $stock, 
									'is_favorit' => false,
									'is_avaible' => true
									);
			$query = $this -> Query -> inputDataGetLastID($data_to_input,'menu');
			if($query['is_insert'] == true):
				$id_menu = $query['id'];
				$qty_bahan = $_POST['bahan_qty'];
				foreach($_POST['bahan'] as $key => $value):
					$insert_resep = $this -> Query -> inputData(array( 'id_menu'=>$id_menu,
																	   'id_bahan'=>$value,
																	   'quantity'=>$qty_bahan[$key]
																	 ),'menu_has_bahan'); 
				endforeach;
				$this->flsh_msg('Success.','ok','berhasil tambah data.');
				redirect(base_url('menu'));
			else:
				$this->flsh_msg('Gagal.','warning','Gagal tambah data kesalahan pada database.');
				redirect(base_url('menu'));
			endif;
		endif;
	}


	public function edit()
	{
		#cek uri
		$id = $this->uri->segment(3,0); 
		if( $id == null):
			$this->flsh_msg('Gagal edit.','warning','id tidak ditemukan.');
			redirect(base_url('menu'));
		else:
			$data['web'] 	= array( 'title'	  => 'Ubah menu | Inventori Resto',
									 'aktif_menu' => 'data_menu',
									 'page'		  => 'menu_edit.php',
									 'is_trview'  => true,
									 'is_table'	  => false,
								);
			$data['user']	= array( 'name' 	  => $this -> user_name,
									 'level'	  => $this -> user_level	
									);
			$data['breadcrumb'] = array('Kategori');
			$data['data']		= $this -> Query -> getData(array('id_menu'=>$id),'menu') -> row();
			$data['kategori']	= $this -> Query -> getAllData('menu_kategori') -> result();
			$data['bahan']		= $this -> Query -> getDataJoin('bahan','satuan','id_satuan') -> result();
			$data['bahan_menu']	= $this -> Query -> getDataBahanFromMenu(array('menu_has_bahan.id_menu'=>$id)) -> result();

			if(count($data['data']) < 1):
				$this->flsh_msg('Gagal edit.','warning','data tidak ditemukan.');
				redirect(base_url('menu'));
			else:
				$this->load->view('Template',$data);
				#cek jika ada post submit
				if(isset($_POST['submit'])):
				#input data 
				// $image_url 	= 'default_menu.jpg';
				if(empty($_FILES['userfile']['name'])):
					  $image_url 	= 'default_menu.jpg';
					  $is_upload 	= false;
				else:
					$config['upload_path']   = './assets/images/produk';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']      = '4000';
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload('userfile',FALSE)):
						// uplaod gagal gunakan default cover
						$image_url 	= 'default_menu.jpg';
						$is_upload 	= false;
					else:
					 	$upload_data = $this->upload->data(); 
					 	$image_url = $upload_data['file_name'];
					 	$is_upload 	= true;
					endif;
				endif;	
					// $data_to_query = array();
					$kategori  = $this -> input -> post('kategori');
					$nama 	   = $this -> input -> post('nama');
					$harga 	   = $this -> input -> post('harga');
					$stock 	   = $this -> input -> post('stock');
					$catatan   = $this -> input -> post('catatan');	
					if($is_upload == true):
						$data_to_query = array(	'id_menu_kategori'=>$kategori,
												'nama_menu' => $nama,
												'foto_menu' => $image_url,
												'harga_menu'=> $harga,
												'catatan_menu' => $catatan,
												'stock_menu' => $stock, 
												);
					else:
						$data_to_query = array(	'id_menu_kategori'=>$kategori,
												'nama_menu' => $nama,
												'harga_menu'=> $harga,
												'catatan_menu' => $catatan,
												'stock_menu' => $stock, 
												);
					endif;
					$query  	= $this -> Query -> updateData( array('id_menu'=>$id),
																$data_to_query,
															  'menu');
					if($query):
						$qty_bahan = $_POST['bahan_qty'];
						#delete first
						$delete = $this -> Query -> delData(array('id_menu'=>$id),'menu_has_bahan');
						foreach($_POST['bahan'] as $key => $value):
							$insert_resep = $this -> Query -> inputData(array( 'id_menu'=>$id,
																			   'id_bahan'=>$value,
																			   'quantity'=>$qty_bahan[$key]
																			 ),'menu_has_bahan'); 
						endforeach;
						// print_r($this->input->post());
						$this->flsh_msg('Sukses.','ok','data berhasil diubah');
						redirect(base_url('menu'));
					else:
						$this->flsh_msg('Gagal.','warning','data gagal diubah');
						redirect(base_url('menu'));
					endif;
				endif;
			endif;
		endif;
	}

	public function delete()
	{
		#cek uri
		$id = $this->uri->segment(3,0); 
		if( $id == null):
			$this->flsh_msg('Gagal menghapus.','warning','id tidak ditemukan.');
			redirect(base_url('menu'));
		else:
			$data['menu']	= $this -> Query -> getData(array('id_menu'=>$id),'menu') -> row();
			if(count($data['menu']) < 1):
				$this->flsh_msg('Gagal edit.','warning','data tidak ditemukan.');
				redirect(base_url('menu'));
			else:
				#query
				$query  	= $this -> Query -> delData(array('id_menu'=>$id),'menu');
				if($query):
					$this->flsh_msg('Sukses.','ok','data berhasil dihapus');
					redirect(base_url('menu'));
				else:
					$this->flsh_msg('Gagal.','warning','data gagal dihapus');
					redirect(base_url('menu'));
				endif;
			endif;
		endif;
	}

	public function favorit()
	{
		#cek uri
		$id = $this->uri->segment(3,0); 
		if( $id == null):
			$this->flsh_msg('Gagal menghapus.','warning','id tidak ditemukan.');
			redirect(base_url('menu'));
		else:
			$data['menu']	= $this -> Query -> getData(array('id_menu'=>$id),'menu') -> row();
			if(count($data['menu']) < 1):
				$this->flsh_msg('Gagal edit.','warning','data tidak ditemukan.');
				redirect(base_url('menu'));
			else:
				#query
				$query  	= $this -> Query -> updateData(array('id_menu'=>$id),array('is_favorit'=>true),'menu');
				if($query):
					$this->flsh_msg('Sukses.','ok','berhasil menambahkan menu favorit');
					redirect(base_url('menu'));
				else:
					$this->flsh_msg('Gagal.','warning','gagal ubah favorit');
					redirect(base_url('menu'));
				endif;
			endif;
		endif;
	}

	public function unfavorit()
	{
		#cek uri
		$id = $this->uri->segment(3,0); 
		if( $id == null):
			$this->flsh_msg('Gagal menghapus.','warning','id tidak ditemukan.');
			redirect(base_url('menu'));
		else:
			$data['menu']	= $this -> Query -> getData(array('id_menu'=>$id),'menu') -> row();
			if(count($data['menu']) < 1):
				$this->flsh_msg('Gagal edit.','warning','data tidak ditemukan.');
				redirect(base_url('menu'));
			else:
				#query
				$query  	= $this -> Query -> updateData(array('id_menu'=>$id),array('is_favorit'=>false),'menu');
				if($query):
					$this->flsh_msg('Sukses.','ok','berhasil ubah favorit');
					redirect(base_url('menu'));
				else:
					$this->flsh_msg('Gagal.','warning','gagal ubah favorit');
					redirect(base_url('menu'));
				endif;
			endif;
		endif;
	}
	
	public function view()
	{
		#cek uri
		$id = $this->uri->segment(3,0); 
		if( $id == null):
			$this->flsh_msg('Gagal menghapus.','warning','id tidak ditemukan.');
			redirect(base_url('menu'));
		else:
			$data['menu']	= $this -> Query -> getData(array('id_menu'=>$id),'menu') -> row();
			if(count($data['menu']) < 1):
				$this->flsh_msg('Gagal edit.','warning','data tidak ditemukan.');
				redirect(base_url('menu'));
			else:
				#query
				$query  	= $this -> Query -> updateData(array('id_menu'=>$id),array('is_avaible'=>true),'menu');
				if($query):
					$this->flsh_msg('Sukses.','ok','produk ditampilkan favorit');
					redirect(base_url('menu'));
				else:
					$this->flsh_msg('Gagal.','warning','gagal menampilkan produk');
					redirect(base_url('menu'));
				endif;
			endif;
		endif;
	}

	public function unview()
	{
		#cek uri
		$id = $this->uri->segment(3,0); 
		if( $id == null):
			$this->flsh_msg('Gagal menghapus.','warning','id tidak ditemukan.');
			redirect(base_url('menu'));
		else:
			$data['menu']	= $this -> Query -> getData(array('id_menu'=>$id),'menu') -> row();
			if(count($data['menu']) < 1):
				$this->flsh_msg('Gagal edit.','warning','data tidak ditemukan.');
				redirect(base_url('menu'));
			else:
				#query
				$query  	= $this -> Query -> updateData(array('id_menu'=>$id),array('is_avaible'=>false),'menu');
				if($query):
					$this->flsh_msg('Sukses.','ok','produk disembunyikan');
					redirect(base_url('menu'));
				else:
					$this->flsh_msg('Gagal.','warning','gagal sembunyikan produk');
					redirect(base_url('menu'));
				endif;
			endif;
		endif;
	}




	public function add_resep()
	{
		$data_bahan = $this -> Query -> getDataJoin('bahan','satuan','id_satuan') -> result();
		$number = $this->input->post('number');
		$html = '
              <div class="form-group col-xs-8">
                <label>Bahan '.$number.'</label>
                <select  onchange="imChange('.$number.')" class="form-control bahan'.$number.'" name="bahan[]"  required="" 
                	
                	>
                  <option value="">- pilih bahan -</option>
                 
                ';
       	// looping
             foreach ($data_bahan as $bahan):
             	$html.='<option data-satuan="'.$bahan->nama_satuan.'"
             					data-no="'.$number.'"
             					value="'.$bahan->id_bahan.'"
             			>
             		   '.$bahan->nama_bahan.

             		   '</option>';
             endforeach;
        // looping
        $html .='</select>
              </div>';

        $html .= '
        
        <div class="form-group col-xs-4">
        	<label>Jumlah</label>
              <div class="input-group ">
			    <input  type="number" class="form-control bahan_qty_'.$number.'" name="bahan_qty[]" placeholder="jumlah"
			    	pattern="[0-9]+([\,|\.][0-9]+)?"
			    	step="any"
			    	title="input dapat berupa angka / pecahan, gunakan tanda comma (,) atau titik(.) jika input berupa pecahan." 
			    >
			    <span class="input-group-addon bahan_satuan_'.$number.'" >(satuan)</span>
			  </div>
              ';
        $return_array = array('status'=>'ok','html'=>$html);
        echo json_encode($return_array);
	}
}
