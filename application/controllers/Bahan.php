<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bahan extends CI_Controller {

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
		$data['web'] 	= array( 'title'	  => 'Data bahan | Inventori Resto',
								 'aktif_menu' => 'data_bahan',
								 'page'		  => 'Bahan.php',
								 'is_trview'  => true,
								 'is_table'	  => true,
								);
		$data['user']	= array( 'name' 	  => $this -> user_name,
								 'level'	  => $this -> user_level	
								);
		$data['breadcrumb'] = array('Kategori');
		$data['table']	= $this -> Query -> getDataJoin('bahan','satuan','id_satuan') -> result();
		$this->load->view('Template',$data);
	}

	public function daftar_belanja()
	{
		$data['web'] 	= array( 'title'	  => 'Daftar belanja | Inventori Resto',
								 'aktif_menu' => 'belanja',
								 'page'		  => 'Bahan_belanja.php',
								 'is_trview'  => false,
								 'is_table'	  => true,
								);
		$data['user']	= array( 'name' 	  => $this -> user_name,
								 'level'	  => $this -> user_level	
								);
		$data['breadcrumb'] = array('Kategori');
		$data['table']	= $this -> Query -> getDataJoinOrderWhere('bahan','satuan','id_satuan','nama_bahan ASC','stock_bahan <= stock_minimal') -> result();
		$this->load->view('Template',$data);
	}

	public function add()
	{
		$data['web'] 	= array( 'title'	  => 'Tambah data bahan | Inventori Resto',
								 'aktif_menu' => 'data_bahan',
								 'page'		  => 'Bahan_add.php',
								 'is_trview'  => true,
								 'is_table'	  => true,
								);
		$data['user']	= array( 'name' 	  => $this -> user_name,
								 'level'	  => $this -> user_level	
								);
		$data['breadcrumb'] = array('Kategori');
		$data['satuan']	= $this -> Query -> getAllData('satuan') -> result();
		$this->load->view('Template',$data);

		#cek jika ada post submit
		if(isset($_POST['submit'])):
			$nama 		= $this -> input -> post("nama");
			$satuan 	= $this -> input -> post("satuan");
			$stock 		= $this -> input -> post("stock");
			$stock_min 	= $this -> input -> post("stock_minimal");
			$harga 		= $this -> input -> post("harga");
			$catatan 	= $this -> input -> post("catatan");
			$input_data = $this -> Query -> inputData(array( 'nama_bahan'=>$nama,
															 'harga_bahan'=>$harga,
															 'stock_bahan'=>$stock,
															 'stock_minimal'=>$stock_min,
															 'catatan_bahan'=>$catatan,
															 'id_satuan' => $satuan,
															 'tgl_input_bahan'=> date('Y-m-d H:i:s')
														 	),
													  'bahan');
			if($input_data):
				$this->flsh_msg('Sukses.','ok','data berhasil ditambah');
				redirect(base_url('bahan'));
			else:
				$this->flsh_msg('Gagal.','warning','data gagal ditambah');
			endif;
		endif;
	}

	public function edit()
	{
		#cek uri
		$id = $this->uri->segment(3,0); 
		if( $id == null):
			$this->flsh_msg('Gagal edit.','warning','id tidak ditemukan.');
			redirect(base_url('kategori'));
		else:
			$data['web'] 	= array( 'title'	  => 'Ubah data bahan | Inventori Resto',
									 'aktif_menu' => 'data_bahan',
									 'page'		  => 'Bahan_edit.php',
									 'is_trview'  => true,
									 'is_table'	  => false,
								);
			$data['user']	= array( 'name' 	  => $this -> user_name,
									 'level'	  => $this -> user_level	
									);
			$data['breadcrumb'] = array('Kategori');
			$data['data']	= $this -> Query -> getData(array('id_bahan'=>$id),'bahan') -> row();
			$data['satuan']	= $this -> Query -> getAllData('satuan') -> result();
			if(count($data['data']) < 1):
				$this->flsh_msg('Gagal edit.','warning','data tidak ditemukan.');
				redirect(base_url('bahan'));
			else:
				$this->load->view('Template',$data);
				#cek jika ada post submit
				if(isset($_POST['submit'])):
					$nama 		= $this -> input -> post("nama");
					$satuan 	= $this -> input -> post("satuan");
					$stock 		= $this -> input -> post("stock");
					$stock_min 	= $this -> input -> post("stock_minimal");
					$harga 		= $this -> input -> post("harga");
					$catatan 	= $this -> input -> post("catatan");
					$query  	= $this -> Query -> updateData( array('id_bahan'=>$id),
																array( 	 'nama_bahan'=>$nama,
																		 'harga_bahan'=>$harga,
																		 'stock_bahan'=>$stock,
																		 'stock_minimal'=>$stock_min,
																		 'catatan_bahan'=>$catatan,
																		 'id_satuan' => $satuan
																 	),
															  'bahan');
					if($query):
						$this->flsh_msg('Sukses.','ok','data berhasil diubah');
						redirect(base_url('bahan'));
					else:
						$this->flsh_msg('Gagal.','warning','data gagal diubah');
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
			redirect(base_url('bahan'));
		else:
			$data['bahan']	= $this -> Query -> getData(array('id_bahan'=>$id),'bahan') -> row();
			if(count($data['bahan']) < 1):
				$this->flsh_msg('Gagal edit.','warning','data tidak ditemukan.');
				redirect(base_url('bahan'));
			else:
				#query
				$query  	= $this -> Query -> delData(array('id_bahan'=>$id),
																  'bahan');
				if($query):
					$this->flsh_msg('Sukses.','ok','data berhasil dihapus');
					redirect(base_url('bahan'));
				else:
					$this->flsh_msg('Gagal.','warning','data gagal dihapus');
					redirect(base_url('bahan'));
				endif;
			endif;
		endif;
	}
}
