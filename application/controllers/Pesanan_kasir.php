<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_kasir extends CI_Controller {

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
		$data['web'] 	= array( 'title'	  => 'Data pesanan  | Inventori Resto',
								 'aktif_menu' => 'pesanan',
								 'header'	  => 'Pesanan',
								 'sub_header' => '',
								 'page'		  => 'Pesanan_kview.php',
								 'is_trview'  => false,
								 'is_table'   => false
								);
		$data['user']	= array( 'name' 	  => $this -> user_name,
								 'level'	  => $this -> user_level	
								);
		$data['breadcrumb'] = array('Beranda');
		$data['table']		= $this -> Query -> getDataTransWait() -> result();
		$data['data_menu'] 	= $this -> Query -> getDataMenuFromTrans() -> result();
		$this->load->view('Template',$data);
		// print_r($data['table']);
		// echo $data['table'];
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

	public function transaksi_detail()
	{
		$id_transaksi = $this -> uri -> segment(3,0);
		$data['web'] 	= array( 'title'	  => 'Data pesanan  | Inventori Resto',
								 'aktif_menu' => 'pesanan',
								 'header'	  => 'Pesanan',
								 'sub_header' => '',
								 'page'		  => 'Pesanan_detail.php',
								 'is_trview'  => false,
								 'is_table'   => false
								);
		$data['user']	= array( 'name' 	  => $this -> user_name,
								 'level'	  => $this -> user_level	
								);
		$data['breadcrumb'] = array('Beranda');
		$data['datas']		= $this -> Query -> getDataJoinOrderWhere('transaksi','meja','id_meja','transaksi.tgl_transaksi DESC',array('id_transaksi'=>$id_transaksi)) -> row();
		$data['data_menu'] 	= $this -> Query -> getDataMenuFromTrans() -> result();
		$this->load->view('Template',$data);
	}

	public function transaksi_batal()
	{
		// $id_trans = $this -> input -> get('id_trans');
		$id_trans = $this -> uri -> segment(3,0);
		if(!isset($id_trans) or $id_trans ==''):
			$this->flsh_msg('Gagal.','warning','id transaksi tidak ditemukan.');
			redirect(base_url('pesanan_kasir'));
		else:
			$update_transaksi = $this -> Query -> updateData(array('id_transaksi'=>'done'));
			$data_t = $this -> Query -> getData(array('id_transaksi'=>$id_trans),'transaksi_detail') -> result();
			foreach($data_t as $val):
				$update = $this -> Query -> updateData(array('id_transaksi_detail'=>$val->id_transaksi_detail),
													   array('status'=>'cancel'),'transaksi_detail');
			endforeach;
			$this->flsh_msg('Sukses.','ok','Berhasil mengubah status transaksi.');
			redirect(base_url('pesanan_kasir'));
		endif;
	}

	public function transaksi_selesai()
	{
		// $id_trans = $this -> input -> get('id_trans');
		$id_trans = $this -> uri -> segment(3,0);
		if(!isset($id_trans) or $id_trans ==''):
			$this->flsh_msg('Gagal.','warning','id transaksi tidak ditemukan.');
			redirect(base_url('pesanan_kasir'));
		else:
			$data_t = $this -> Query -> getData(array('id_transaksi'=>$id_trans),'transaksi_detail') -> result();
			$update_transaksi = $this -> Query -> updateData(array('id_transaksi'=>$id_trans),array('status_trans'=>'done'),'transaksi');
			foreach($data_t as $val):
				$update = $this -> Query -> updateData(array('id_transaksi_detail'=>$val->id_transaksi_detail),
													   array('status'=>'done'),'transaksi_detail');
				$updt_bahan = $this -> updateBahan($val->id_menu,$val->jumlah_beli);
			endforeach;
			$this->flsh_msg('Sukses.','ok','Berhasil mengubah status transaksi.');
			redirect(base_url('pesanan_kasir'));
		endif;
	}

	public function transaksi_cetak()
	{
		$id_trans = $this -> uri -> segment(3,0);
		if(!isset($id_trans) or $id_trans ==''):
			$this->flsh_msg('Gagal.','warning','id transaksi tidak ditemukan.');
			redirect(base_url('pesanan_kasir'));
		else:
			$data['sistem']	   = $this -> Query -> getData(array('id_sistem'=>'1'),'sistem') -> row();
			$data['transaksi'] = $this -> Query -> getData(array('id_transaksi'=>$id_trans),'transaksi') -> row();
			$data['data_transaksi'] = $this -> Query -> getDataJoinWhere('transaksi_detail','menu','id_menu',array('id_transaksi'=>$id_trans)) -> result();
			$this->load->view('Pesanan_cetak.php',$data);
		endif;
	}

	public function transaksi_tambah_menu()
	{
		$id_trans = $this -> uri -> segment(3,0);
		if(!isset($id_trans) or $id_trans ==''):
			$this->flsh_msg('Gagal.','warning','id transaksi tidak ditemukan.');
			redirect(base_url('pesanan_kasir'));
		else:
			$data['transaksi']	 = $this -> Query -> getData(array('id_transaksi'=>$id_trans),'transaksi') -> row();
			if(count($data['transaksi']) < 1):
				$this->flsh_msg('Gagal.','warning','Transaksi tidak ditemukan.');
				redirect(base_url('pesanan_kasir'));
			else:
				$data['data_menu'] = $this -> Query -> GetAllData('menu') -> result();
				$data['web'] 	= array( 'title'	  => 'Data pesanan  | Inventori Resto',
								 'aktif_menu' => 'pesanan',
								 'header'	  => 'Pesanan',
								 'sub_header' => '',
								 'page'		  => 'Pesanan_tview.php',
								 'is_trview'  => false,
								 'is_table'   => false
								);
				$data['user']	= array( 'name' 	  => $this -> user_name,
								 		 'level'	  => $this -> user_level	
										);
				$this->load->view('Template',$data);
			endif;
		endif;
	}

	public function transaksi_add_menu()
	{
		$id_menu 		= $this -> input -> post('id_menu');
		$id_transaksi 	= $this -> input -> post('id_transaksi');
		$qty 			= $this -> input -> post('qty');
		$cat 			= $this -> input -> post('cat_menu');

		if($id_menu == '' or $id_transaksi =='' or $qty ==''):
			$this->flsh_msg('Gagal.','warning','data transaksi tidak lengkap.');
			redirect(base_url('pesanan_kasir'));
		else:
 			if(count($this->Query->getData(array('id_transaksi'=>$id_transaksi),'transaksi')) < 1):
				$this->flsh_msg('Gagal.','warning','transaksi tidak ditemukan.');
				redirect(base_url('pesanan_kasir'));
			else:
				$data_input = array( 'id_transaksi'=>$id_transaksi,
									 'id_menu'=>$id_menu,
									 'jumlah_beli'=>$qty,
									 'status'=>'wait',
									 'catatan_detail'=>$cat
									);
				if($this -> Query -> inputData($data_input,'transaksi_detail')):
					$this->flsh_msg('Ok.','ok','berhasil update menu transaksi.');
					redirect(base_url('pesanan_kasir'));
				else:
					$this->flsh_msg('Gagal.','warning','kesalahan pada database.');
					redirect(base_url('pesanan_kasir'));
				endif;
			endif;
		endif;
	}

	public function updateBahan($id_menu,$qty)
	{
		// $id_menu = $this -> input -> post('id_menu');
		// $qty 	 = $this -> input -> post('qty');
		$menu    = $this -> Query -> getData(array('id_menu'=>$id_menu),'menu') -> row();
		if(count($menu)>=1):
			$bahan = $this -> Query -> getDataBahanFromMenu(array('menu_has_bahan.id_menu'=>$id_menu)) -> result();
			if(count($bahan)>=1):
				foreach($bahan as $bhn):
					$min_stock 	 = $bhn -> stock_bahan - (($bhn -> quantity) * $qty) ;
					$data_update = array('stock_bahan'=> $min_stock);
					$updt = $this -> Query -> updateData(array('id_bahan'=>$bhn->id_bahan),$data_update,'bahan');
				endforeach;
			else:
				$data['status'] = 'failed';
				$data['msg']	= 'menu tidak ditemukan';
			endif;
		else:
		endif;
	}
}
