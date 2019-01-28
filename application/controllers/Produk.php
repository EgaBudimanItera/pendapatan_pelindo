<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Mproduk');
	}
   
    public function index(){
        $data = array(
            'page' => 'produk/data',
            'link' => 'produk',
            'script'=>'',
            'list'=>$this->Mproduk->list_produk(),
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data produk' => base_url() . 'produk'),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function formtambah(){
        $data = array(
            'page' => 'produk/formtambah',
            'link' => 'produk',
            'script'=>'',
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data produk' => base_url() . 'produk',
                'Tambah Data' =>base_url(). 'produk/formtambah'
            ),
            'idproduk'=>$this->Mproduk->kode_produk(),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function formedit($id_produk){
        $data = array(
            'page' => 'produk/formedit',
            'link' => 'produk',
            'script'=>'',
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data produk' => base_url() . 'produk',
                'Edit Data' =>base_url(). 'produk/formedit'
            ),
            'list'=>$this->Mproduk->ambil_produk($id_produk)->row(),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function prosessimpan(){
      $idproduk=$this->Mproduk->kode_produk();
      $namaproduk=$this->input->post('namaproduk',true);
      $satuan=$this->input->post('satuan',true);
      $data=array(
        'idproduk'=>$idproduk,
        'namaproduk'=>$namaproduk,
        'satuan'=>$satuan,
      );
      $simpan = $this->Mproduk->simpan_produk($data);
      if($simpan){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil disimpan !</div>'
        );
            redirect(produk);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal disimpan !</div>'
        );
            redirect(produk/formtambah);
      }
    }

    public function prosesedit(){
       $idproduk=$this->input->post('idproduk',true);
       $namaproduk=$this->input->post('namaproduk',true);
       $satuan=$this->input->post('satuan',true);
       $data=array(
        'namaproduk'=>$namaproduk,
        'satuan'=>$satuan,
       ); 
       $edit= $this->Mproduk->ubah_produk($idproduk,$data);  
       if($edit){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil diedit !</div>'
        );
            redirect(produk);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal diedit !</div>'
        );
            redirect(produk/formedit);
      }
    }

    public function proseshapus($idproduk){
       $hapus= $this->Mproduk->hapus_produk($idproduk);  
       if($hapus){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil dihapus !</div>'
        );
            redirect(produk);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal dihapus !</div>'
        );
            redirect(produk);
      }   
    }
}