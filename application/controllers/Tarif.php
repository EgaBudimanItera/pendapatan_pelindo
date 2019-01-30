<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tarif extends CI_Controller {

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
            'page' => 'tarif/data',
            'link' => 'tarif',
            'script'=>'',
            'list'=>$this->Pendapatan->list_data_all('ref_tarif'),
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data tarif' => base_url() . 'tarif'),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function formtambah(){
        $data = array(
            'page' => 'tarif/formtambah',
            'link' => 'tarif',
            'script'=>'',
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data tarif' => base_url() . 'tarif',
                'Tambah Data' =>base_url(). 'tarif/formtambah'
            ),
            'kodetarif'=>$this->Pendapatan->kodetarif(),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function formedit($kodetarif){
        $data = array(
            'page' => 'tarif/formedit',
            'link' => 'tarif',
            'script'=>'',
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data tarif' => base_url() . 'tarif',
                'Edit Data' =>base_url(). 'tarif/formedit'
            ),
            'list'=>$this->Pendapatan->ambil('kodetarif',$kodetarif,'ref_tarif')->row(),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function prosessimpan(){
      $kodetarif=$this->Pendapatan->kodetarif();
      $uraian=$this->input->post('uraian',true);
      $satuan=$this->input->post('satuan',true);
      $tarif=$this->input->post('tarif',true);
      $data=array(
        'kodetarif'=>$kodetarif,
        'uraian'=>$uraian,
        'satuan'=>$satuan,
        'tarif'=>$tarif
      );
      $simpan = $this->Pendapatan->simpan_data($data,'ref_tarif');
      if($simpan){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil disimpan !</div>'
        );
            redirect(tarif);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal disimpan !</div>'
        );
            redirect(tarif/formtambah);
      }
    }

    public function prosesedit(){
      $kodetarif=$this->input->post('kodetarif',true);
      $uraian=$this->input->post('uraian',true);
      $satuan=$this->input->post('satuan',true);
      $tarif=$this->input->post('tarif',true);
       $data=array(
        'uraian'=>$uraian,
        'satuan'=>$satuan,
        'tarif'=>$tarif
       ); 
       $edit= $this->Pendapatan->update('kodetarif',$kodetarif,'ref_tarif',$data);  
       if($edit){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil diedit !</div>'
        );
            redirect(tarif);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal diedit !</div>'
        );
            redirect(tarif/formedit);
      }
    }

    public function proseshapus($kodetarif){
       $hapus= $this->Pendapatan->hapus('kodetarif',$kodetarif,'ref_tarif');  
       if($hapus){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil dihapus !</div>'
        );
            redirect(tarif);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal dihapus !</div>'
        );
            redirect(tarif);
      }   
    }

    public function gettarif($kodetarif){
        $data=$this->Pendapatan->ambil('kodetarif',$kodetarif,'ref_tarif')->row_array();
        echo json_encode($data);
    }
}   