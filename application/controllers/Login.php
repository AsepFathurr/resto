<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() 
 	{
    	parent::__construct();
		
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('Query');
    	date_default_timezone_set('Asia/Jakarta');
    
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
		$this->load->view('Login.php');
	}

	public function do_login()
	{
		$u = $this -> input -> post('username');
		$p = $this -> input -> post('password');
		$verif = $this -> Query -> getData(array('username'=>$u,'password'=>$p),'karyawan') -> row();
		if(count($verif) < 1):
				$this -> flsh_msg('Gagal login','warning','username / password salah.');
				redirect(base_url('login'));
				// echo 'gagal login';
		else:
				$session = array(
				  'user_nama'    	=> $verif -> nama_karyawan,
				  'user_id'	  		=> $verif -> id_karyawan,
				  'user_is_login'   => TRUE,
				  'user_level'		=> $verif -> jabatan
				);
				$this -> session -> set_userdata($session);
				$this -> flsh_msg('Welcome','ok','Selamat datang '.$verif->nama_karyawan);
				redirect(base_url());
				// print_r($session);
		endif;
	}

	public function do_logout()
	{
		session_destroy();
		redirect(base_url('login'));
	}
}
