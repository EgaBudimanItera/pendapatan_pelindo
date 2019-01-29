<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
	}
   
    public function index(){
        $data = array(
            'page' => 'contoh',
            'link' => 'produk',
            'script'=>'',
            
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data produk' => base_url() . 'produk'),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }
}