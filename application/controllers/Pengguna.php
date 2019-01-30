<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

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
            'page' => 'pengguna/data',
            'link' => 'pengguna',
            'script'=>'',
            'list'=>$this->Pendapatan->list_data_all('ref_pengguna'),
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data pengguna' => base_url() . 'pengguna'),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function formtambah(){
        $data = array(
            'page' => 'pengguna/formtambah',
            'link' => 'pengguna',
            'script'=>'',
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data pengguna' => base_url() . 'pengguna',
                'Tambah Data' =>base_url(). 'pengguna/formtambah'
            ),
           
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function formubahpassword(){
        $data = array(
            'page' => 'pengguna/formubahpassword',
            'link' => 'pengguna',
            'script'=>'',
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data pengguna' => base_url() . 'pengguna',
                'Tambah Data' =>base_url(). 'pengguna/formubahpassword'
            ),
            
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function prosessimpan(){
      $namapengguna=$this->input->post('namapengguna',true);
      // $passpengguna=$this->input->post('passpengguna',true);
      $aksespengguna=$this->input->post('aksespengguna',true);
      $data=array(
        'aksespengguna'=>$aksespengguna,
        'namapengguna'=>$namapengguna,
        'passpengguna'=>'123',
      );
      $simpan = $this->Pendapatan->simpan_data($data,'ref_pengguna');
      if($simpan){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil disimpan !</div>'
        );
            redirect(pengguna);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal disimpan !</div>'
        );
            redirect(pengguna/formtambah);
      }
    }

    public function prosesubahpassword(){
       $idpengguna=$this->input->post('idpengguna',true);
       $passpengguna=$this->input->post('passpengguna',true);
      
       $data=array(
        'passpengguna'=>$passpengguna,
       
       ); 
       $edit= $this->Pendapatan->update('idpengguna',$idpengguna,'ref_pengguna',$data);  
       if($edit){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil diedit !</div>'
        );
            redirect(pengguna);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal diedit !</div>'
        );
            redirect(pengguna/formedit);
      }
    }

    public function proseshapus($idpengguna){
       $hapus= $this->Pendapatan->hapus('idpengguna',$idpengguna,'ref_pengguna');  
       if($hapus){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil dihapus !</div>'
        );
            redirect(pengguna);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal dihapus !</div>'
        );
            redirect(pengguna);
      }   
    }
}