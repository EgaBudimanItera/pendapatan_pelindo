<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kapal extends CI_Controller {

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
            'page' => 'kapal/data',
            'link' => 'kapal',
            'script'=>'',
            'list'=>$this->Pendapatan->list_data_all('ref_kapal'),
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data kapal' => base_url() . 'kapal'),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function formtambah(){
        $data = array(
            'page' => 'kapal/formtambah',
            'link' => 'kapal',
            'script'=>'',
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data kapal' => base_url() . 'kapal',
                'Tambah Data' =>base_url(). 'kapal/formtambah'
            ),
            'kodekapal'=>$this->Pendapatan->kodekapal(),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function formedit($kodekapal){
        $data = array(
            'page' => 'kapal/formedit',
            'link' => 'kapal',
            'script'=>'',
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data kapal' => base_url() . 'kapal',
                'Edit Data' =>base_url(). 'kapal/formedit'
            ),
            'list'=>$this->Pendapatan->ambil('kodekapal',$kodekapal,'ref_kapal')->row(),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function prosessimpan(){
      $kodekapal=$this->Pendapatan->kodekapal();
      $namakapal=$this->input->post('namakapal',true);
      $keterangan=$this->input->post('keterangan',true);
      $data=array(
        'kodekapal'=>$kodekapal,
        'namakapal'=>$namakapal,
        'keterangan'=>$keterangan,
      );
      $simpan = $this->Pendapatan->simpan_data($data,'ref_kapal');
      if($simpan){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil disimpan !</div>'
        );
            redirect(kapal);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal disimpan !</div>'
        );
            redirect(kapal/formtambah);
      }
    }

    public function prosesedit(){
       $kodekapal=$this->input->post('kodekapal',true);
       $namakapal=$this->input->post('namakapal',true);
       $keterangan=$this->input->post('keterangan',true);
       $data=array(
        'namakapal'=>$namakapal,
        'keterangan'=>$keterangan,
       ); 
       $edit= $this->Pendapatan->update('kodekapal',$kodekapal,'ref_kapal',$data);  
       if($edit){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil diedit !</div>'
        );
            redirect(kapal);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal diedit !</div>'
        );
            redirect(kapal/formedit);
      }
    }

    public function proseshapus($kodekapal){
       $hapus= $this->Pendapatan->hapus('kodekapal',$kodekapal,'ref_kapal');  
       if($hapus){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil dihapus !</div>'
        );
            redirect(kapal);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal dihapus !</div>'
        );
            redirect(kapal);
      }   
    }
}