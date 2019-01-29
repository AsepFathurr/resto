<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

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
		$data['web'] 	= array( 'title'	  => 'Data Karyawan | Inventori Resto',
								 'aktif_menu' => 'data_karyawan',
								 'page'		  => 'Karyawan.php',
								 'is_trview'  => true,
								 'is_table'	  => true,
								);
		$data['user']	= array( 'name' 	  => $this -> user_name,
								 'level'	  => $this -> user_level	
								);
		$data['table']	= $this -> Query -> getAllData('karyawan') -> result();
		$this->load->view('Template',$data);
	}

	public function add()
	{
		$data['web'] 	= array( 'title'	  => 'Tambah karyawan meja | Inventori Resto',
								 'aktif_menu' => 'data_karyawan',
								 'page'		  => 'karyawan_add.php',
								 'is_trview'  => true,
								 'is_table'	  => false,
								);
		$data['user']	= array( 'name' 	  => $this -> user_name,
								 'level'	  => $this -> user_level	
								);
		$data['breadcrumb'] = array('Kategori');
		$this->load->view('Template',$data);

		#cek jika ada post submit
		if(isset($_POST['submit'])):
			$nama 		= $this -> input -> post("nama");
			$telp 		= $this -> input -> post("telp");
			$username 	= $this -> input -> post("username");
			$password 	= $this -> input -> post("password");
			$jabatan 	= $this -> input -> post("jabatan");


			#cek apakah nama / username / password kosong
			if($nama =='' or $username=='' or $password =='' or $jabatan ==''):
				$this->flsh_msg('Gagal','warning','Data tidak lengkap');
				redirect(base_url('karyawan'));
			else:
				$input_data = $this -> Query -> inputDataDetail(array( 'nama_karyawan'=>$nama,
															 'telp_karyawan'=>$telp,
															 'username'=>$username,
															 'password'=>$password,
															 'jabatan' =>$jabatan,	
															 'tgl_input_karyawan'=> date('Y-m-d H:i:s')
														 	),
													  'karyawan');
				if($input_data['error']['message']==null):
					$this->flsh_msg('Sukses.','ok','data berhasil ditambah');
					redirect(base_url('karyawan'));
				else:
					$this->flsh_msg('Gagal.','warning','data gagal ditambah '.$input_data['error']['message']);
				endif;
			endif;
		endif;
	}

	public function edit()
	{
		#cek uri
		$id = $this->uri->segment(3,0); 
		if( $id == null):
			$this->flsh_msg('Gagal edit.','warning','id tidak ditemukan.');
			redirect(base_url('karyawan'));
		else:
			$data['web'] 	= array( 'title'	  => 'Ubah karyawan | Inventori Resto',
									 'aktif_menu' => 'data_karyawan',
									 'page'		  => 'karyawan_edit.php',
									 'is_trview'  => true,
									 'is_table'	  => false,
								);
			$data['user']	= array( 'name' 	  => $this -> user_name,
									 'level'	  => $this -> user_level	
									);
			$data['breadcrumb'] = array('Kategori');
			$data['edit']	= $this -> Query -> getData(array('id_karyawan'=>$id),'karyawan') -> row();
			if(count($data['edit']) < 1):
				$this->flsh_msg('Gagal edit.','warning','data tidak ditemukan.');
				redirect(base_url('karyawan'));
			else:
				$this->load->view('Template',$data);
				#cek jika ada post submit
				if(isset($_POST['submit'])):
						$nama 		= $this -> input -> post("nama");
						$telp 		= $this -> input -> post("telp");
						$username 	= $this -> input -> post("username");
						$password 	= $this -> input -> post("password");
						$jabatan 	= $this -> input -> post("jabatan");
					$query  	= $this -> Query -> updateDataDetail(	 array('id_karyawan'=>$id),
																 array( 'nama_karyawan'=>$nama,
																 'telp_karyawan'=>$telp,
																 'username'=>$username,
																 'password'=>$password,
																 'jabatan' =>$jabatan,	
																 'tgl_input_karyawan'=> date('Y-m-d H:i:s')
															 	),
																  'karyawan');
					if($query['error']['message']==null):
						$this->flsh_msg('Sukses.','ok','data berhasil diubah');
						redirect(base_url('karyawan'));
					else:
						$this->flsh_msg('Gagal.','warning','data ubah data :  '.$query['error']['message']);
						redirect(base_url('karyawan'));
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
			redirect(base_url('karyawan'));
		else:
			$data['delete']	= $this -> Query -> getData(array('id_karyawan'=>$id),'karyawan') -> row();
			if(count($data['delete']) < 1):
				$this->flsh_msg('Gagal edit.','warning','data tidak ditemukan.');
				redirect(base_url('karyawan'));
			else:
				#query
				$query  	= $this -> Query -> delData(array('id_karyawan'=>$id),
																  'karyawan');
				if($query):
					$this->flsh_msg('Sukses.','ok','data berhasil dihapus');
					redirect(base_url('karyawan'));
				else:
					$this->flsh_msg('Gagal.','warning','data gagal dihapus');
					redirect(base_url('karyawan'));
				endif;
			endif;
		endif;
	}
}
