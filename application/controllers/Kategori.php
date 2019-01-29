<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct() 
 	{
    	parent::__construct();
		
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('Query');
    	$this->load->library('form_validation');
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
		$data['web'] 	= array( 'title'	  => 'Kategori menu | Inventori Resto',
								 'aktif_menu' => 'data_kategori',
								 'page'		  => 'Kategori.php',
								 'is_trview'  => true,
								 'is_table'	  => true,
								);
		$data['user']	= array( 'name' 	  => $this -> user_name,
								 'level'	  => $this -> user_level	
								);
		$data['breadcrumb'] = array('Kategori');
		$data['kategori']	= $this -> Query -> getAllData('menu_kategori') -> result();
		$this->load->view('Template',$data);
	}

	public function add()
	{
		$data['web'] 	= array( 'title'	  => 'Tambah Kategori menu | Inventori Resto',
								 'aktif_menu' => 'data_kategori',
								 'page'		  => 'Kategori_add.php',
								 'is_trview'  => true,
								 'is_table'	  => true,
								);
		$data['user']	= array( 'name' 	  => $this -> user_name,
								 'level'	  => $this -> user_level	
								);
		$data['breadcrumb'] = array('Kategori');
		$data['kategori']	= $this -> Query -> getAllData('menu_kategori') -> result();
		$this->load->view('Template',$data);

		#cek jika ada post submit
		if(isset($_POST['submit'])):
			$nama 		= $this -> input -> post("nama");
			$catatan 	= $this -> input -> post("catatan");
			$input_data = $this -> Query -> inputData(array( 'nama_kategori'=>$nama,
															 'catatan_kategori'=>$catatan,
															 'tgl_input_kategori'=> date('Y-m-d H:i:s')
														 	),
													  'menu_kategori');
			if($input_data):
				$this->flsh_msg('Sukses.','ok','data berhasil ditambah');
				redirect(base_url('kategori'));
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
			$data['web'] 	= array( 'title'	  => 'Ubah Kategori menu | Inventori Resto',
									 'aktif_menu' => 'data_kategori',
									 'page'		  => 'Kategori_edit.php',
									 'is_trview'  => true,
									 'is_table'	  => false,
								);
			$data['user']	= array( 'name' 	  => $this -> user_name,
									 'level'	  => $this -> user_level	
									);
			$data['breadcrumb'] = array('Kategori');
			$data['kategori']	= $this -> Query -> getData(array('id_menu_kategori'=>$id),'menu_kategori') -> row();
			if(count($data['kategori']) < 1):
				$this->flsh_msg('Gagal edit.','warning','data tidak ditemukan.');
				redirect(base_url('kategori'));
			else:
				$this->load->view('Template',$data);
				#cek jika ada post submit
				if(isset($_POST['submit'])):
					$nama 		= $this -> input -> post("nama");
					$catatan 	= $this -> input -> post("catatan");
					$sekarang 	= date('Y-m-d H:i:s');
					$query  	= $this -> Query -> updateData(	  array('id_menu_kategori'=>$id),
																  array( 'nama_kategori'=>$nama,
																		 'catatan_kategori'=>$catatan
																	 	),
																  'menu_kategori');
					if($query):
						$this->flsh_msg('Sukses.','ok','data berhasil diubah');
						redirect(base_url('kategori'));
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
			redirect(base_url('kategori'));
		else:
			$data['kategori']	= $this -> Query -> getData(array('id_menu_kategori'=>$id),'menu_kategori') -> row();
			if(count($data['kategori']) < 1):
				$this->flsh_msg('Gagal edit.','warning','data tidak ditemukan.');
				redirect(base_url('kategori'));
			else:
				#query
				$query  	= $this -> Query -> delData(array('id_menu_kategori'=>$id),
																  'menu_kategori');
				if($query):
					$this->flsh_msg('Sukses.','ok','data berhasil dihapus');
					redirect(base_url('kategori'));
				else:
					$this->flsh_msg('Gagal.','warning','data gagal dihapus');
					redirect(base_url('kategori'));
				endif;
			endif;
		endif;
	}
}
