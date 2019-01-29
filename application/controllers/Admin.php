<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		$page = null;
		if($this -> user_level == 'chef' or $this->user_level == 'waiter')
		{
			$page ="Other_beranda.php";
		}
		else
		{
			$page ="Admin_beranda.php";
		}
		$data['web'] 	= array( 'title'	  => 'Beranda admin | Inventori Resto',
								 'aktif_menu' => 'home',
								 'header'	  => 'Beranda',
								 'sub_header' => '',
								 'page'		  => $page,
								 'is_trview'  => false,
								 'is_table'   => false
								);
		$data['user']	= array( 'name' 	  => $this -> user_name,
								 'level'	  => $this -> user_level	
								);
		$data['breadcrumb'] = array('Beranda');
		$this->load->view('Template',$data);
	}
}
