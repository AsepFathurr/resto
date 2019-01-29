<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

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
		#cek uri
			$id = $_SESSION['user_id'];
			$data['web'] 	= array( 'title'	  => 'Ubah profil | Inventori Resto',
									 'aktif_menu' => 'profil',
									 'page'		  => 'Profil.php',
									 'is_trview'  => false,
									 'is_table'	  => false,
								);
			$data['user']	= array( 'name' 	  => $this -> user_name,
									 'level'	  => $this -> user_level	
									);
			$data['edit']	= $this -> Query -> getData(array('id_karyawan'=>$id),'karyawan') -> row();
			if(count($data['edit']) < 1):
				$this->flsh_msg('Gagal edit.','warning','data tidak ditemukan.');
				redirect(base_url('kategori'));
			else:
				$this->load->view('Template',$data);
				#cek jika ada post submit
				if(isset($_POST['submit'])):
						$nama 		= $this -> input -> post("nama");
						$telp 		= $this -> input -> post("telp");
						$password 	= $this -> input -> post("password");
						$query  	= $this -> Query -> updateDataDetail(	 array('id_karyawan'=>1),
																 array( 'nama_karyawan'=>$nama,
																 'telp_karyawan'=>$telp,
																 'password'=>$password
															 	),
																  'karyawan');
					if($query['error']['message']==null):
						$this->flsh_msg('Sukses.','ok','data berhasil diubah');
						redirect(base_url('profil'),'refresh');
					else:
						$this->flsh_msg('Gagal.','warning','data ubah data :  '.$query['error']['message']);
						redirect(base_url('profil'),'refresh');
					endif;
				endif;
			endif;
	}

	
}
