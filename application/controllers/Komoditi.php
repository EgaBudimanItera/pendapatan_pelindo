<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Komoditi extends CI_Controller {

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
            'page' => 'komoditi/data',
            'link' => 'komoditi',
            'script'=>'',
            'list'=>$this->Pendapatan->list_data_all('ref_komoditi'),
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data komoditi' => base_url() . 'komoditi'),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function formtambah(){
        $data = array(
            'page' => 'komoditi/formtambah',
            'link' => 'komoditi',
            'script'=>'',
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data komoditi' => base_url() . 'komoditi',
                'Tambah Data' =>base_url(). 'komoditi/formtambah'
            ),
            'kodekomoditi'=>$this->Pendapatan->kodekomoditi(),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function formedit($kodekomoditi){
        $data = array(
            'page' => 'komoditi/formedit',
            'link' => 'komoditi',
            'script'=>'',
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data komoditi' => base_url() . 'komoditi',
                'Edit Data' =>base_url(). 'komoditi/formedit'
            ),
            'list'=>$this->Pendapatan->ambil('kodekomoditi',$kodekomoditi,'ref_komoditi')->row(),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function prosessimpan(){
      $kodekomoditi=$this->Pendapatan->kodekomoditi();
      $namakomoditi=$this->input->post('namakomoditi',true);
     
      $data=array(
        'kodekomoditi'=>$kodekomoditi,
        'namakomoditi'=>$namakomoditi,
        
      );
      $simpan = $this->Pendapatan->simpan_data($data,'ref_komoditi');
      if($simpan){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil disimpan !</div>'
        );
            redirect(komoditi);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal disimpan !</div>'
        );
            redirect(komoditi/formtambah);
      }
    }

    public function prosesedit(){
      $kodekomoditi=$this->input->post('kodekomoditi',true);
      $namakomoditi=$this->input->post('namakomoditi',true);
     
       $data=array(
        'namakomoditi'=>$namakomoditi,
        
       ); 
       $edit= $this->Pendapatan->update('kodekomoditi',$kodekomoditi,'ref_komoditi',$data);  
       if($edit){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil diedit !</div>'
        );
            redirect(komoditi);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal diedit !</div>'
        );
            redirect(komoditi/formedit);
      }
    }

    public function proseshapus($kodekomoditi){
       $hapus= $this->Pendapatan->hapus('kodekomoditi',$kodekomoditi,'ref_komoditi');  
       if($hapus){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil dihapus !</div>'
        );
            redirect(komoditi);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal dihapus !</div>'
        );
            redirect(komoditi);
      }   
    }
}