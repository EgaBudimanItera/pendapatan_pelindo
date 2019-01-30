<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Nota extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('Pendapatan'));
        // if($this->session->userdata('status') != "login"){
        //     echo '<script>alert("Maaf, anda harus login terlebih dahulu");window.location = "'.base_url().'";</script>';
        // }else{
        //     $namauser = $this->session->userdata('namauser');
        //     $where=array('namauser'=>$namauser);
        //     $cek=$this->Persediaan->cek_login($where)->num_rows(); 
        //     if($cek == 0){
        //         echo '<script>alert("User tidak ditemukan di database");window.location = "'.base_url().'";</script>';
        //     }
        // }   
	}
   
    public function index(){
        $data = array(
            'page' => 'nota/data',
            'link' => 'nota',
            'script'=>'',
            'list'=>$this->Pendapatan->list_data_all('vw_nota1'),
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data Nota' => base_url() . 'nota'),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function detail($nopranota){
        $data=array(
            'page' => 'nota/formdetail',
            'link' => 'nota',
            'script'=>'script/pranota_script',
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data nota' => base_url() . 'nota',
                'Detail Data' =>base_url(). 'nota/detail'
            ),
            'listdetpranota'=>$this->Pendapatan->ambil('nopranota',$nopranota,'vw_pranota3')->result(),
            'listpranota'=>$this->Pendapatan->ambil('nopranota',$nopranota,'vw_pranota2')->row(),
        );
        
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }
}