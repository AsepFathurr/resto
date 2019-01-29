<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct() 
 	{
    	parent::__construct();
		
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('Query');
    	$this->load->library('form_validation');
    	

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
				$color = 'callout-success';
				break;
			case 'warning':
				$color = 'callout-warning';
				break;
			case 'danger':
				$color = 'callout-danger';
				break;
			default:
				$color = 'callout-info';
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
		$data['web'] 	= array( 'title'	  => 'Transaksi  | Inventori Resto',
								 'aktif_menu' => 'data_transaksi',
								 'header'	  => '',
								 'sub_header' => '',
								 'page'		  => 'Transaksi.php',
								 'is_trview'  => true,
								 'is_table'   => true
								);
		$data['user']	= array( 'name' 	  => $this -> user_name,
								 'level'	  => $this -> user_level	
								);
		$data['breadcrumb'] = array('Beranda');
		$data['tgl_mulai'] 		= $this -> input -> post('tgl_mulai');
		$data['tgl_selesai']	= $this -> input -> post('tgl_selesai');
		if($data['tgl_mulai'] == '' or $data['tgl_selesai'] == ''):
			// jika tanggal kosong / tidak ada post
			$data['tgl_mulai'] 	 = date('Y-m-d');
			$data['tgl_selesai'] = date('Y-m-d', strtotime('+1 day'));
			$data['table']		 = $this -> Query -> getDataTransaksiFilter($data['tgl_mulai'],$data['tgl_selesai']) -> result();
		else:
			// jika tanggal ada / terdapat post
			$data['table']		 = $this -> Query -> getDataTransaksiFilter($data['tgl_mulai'],$data['tgl_selesai']) -> result();
		endif;
		
		$data['data_menu'] 	= $this -> Query -> getDataMenuFromTrans() -> result();
		$this->load->view('Template',$data);
	}

	public function chef_view()
	{
		$data['web'] 	= array( 'title'	  => 'Data pesanan  | Inventori Resto',
								 'aktif_menu' => 'pesanan',
								 'header'	  => 'Pesanan',
								 'sub_header' => '',
								 'page'		  => 'Pesanan_cview.php',
								 'is_trview'  => false,
								 'is_table'   => false
								);
		$data['user']	= array( 'name' 	  => $this -> user_name,
								 'level'	  => $this -> user_level	
								);
		$data['breadcrumb'] = array('Beranda');
		$data['table']		= $this -> Query -> getDataJoinOrder('transaksi','meja','id_meja','transaksi.tgl_transaksi DESC') -> result();
		$data['data_menu'] 	= $this -> Query -> getDataMenuFromTrans() -> result();
		$this->load->view('Template',$data);
	}
}
