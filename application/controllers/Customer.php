<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

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
            'page' => 'customer/data',
            'link' => 'customer',
            'script'=>'',
            'list'=>$this->Pendapatan->list_data_all('ref_customer'),
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data customer' => base_url() . 'customer'),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function formtambah(){
        $data = array(
            'page' => 'customer/formtambah',
            'link' => 'customer',
            'script'=>'',
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data customer' => base_url() . 'customer',
                'Tambah Data' =>base_url(). 'customer/formtambah'
            ),
            'kodecustomer'=>$this->Pendapatan->kodecustomer(),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function formedit($kodecustomer){
        $data = array(
            'page' => 'customer/formedit',
            'link' => 'customer',
            'script'=>'',
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data customer' => base_url() . 'customer',
                'Edit Data' =>base_url(). 'customer/formedit'
            ),
            'list'=>$this->Pendapatan->ambil('kodecustomer',$kodecustomer,'ref_customer')->row(),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function prosessimpan(){
      $kodecustomer=$this->Pendapatan->kodecustomer();
      $namacustomer=$this->input->post('namacustomer',true);
      $alamatcustomer=$this->input->post('alamatcustomer',true);
      $npwpcustomer=$this->input->post('npwpcustomer',true);
      $data=array(
        'kodecustomer'=>$kodecustomer,
        'namacustomer'=>$namacustomer,
        'alamatcustomer'=>$alamatcustomer,
        'npwpcustomer'=>$npwpcustomer,
      );
      $simpan = $this->Pendapatan->simpan_data($data,'ref_customer');
      if($simpan){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil disimpan !</div>'
        );
            redirect(customer);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal disimpan !</div>'
        );
            redirect(customer/formtambah);
      }
    }

    public function prosesedit(){
      $kodecustomer=$this->input->post('kodecustomer',true);
      $namacustomer=$this->input->post('namacustomer',true);
      $alamatcustomer=$this->input->post('alamatcustomer',true);
      $npwpcustomer=$this->input->post('npwpcustomer',true);
       $data=array(
        'namacustomer'=>$namacustomer,
        'alamatcustomer'=>$alamatcustomer,
        'npwpcustomer'=>$npwpcustomer,
       ); 
       $edit= $this->Pendapatan->update('kodecustomer',$kodecustomer,'ref_customer',$data);  
       if($edit){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil diedit !</div>'
        );
            redirect(customer);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal diedit !</div>'
        );
            redirect(customer/formedit);
      }
    }

    public function proseshapus($kodecustomer){
       $hapus= $this->Pendapatan->hapus('kodecustomer',$kodecustomer,'ref_customer');  
       if($hapus){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil dihapus !</div>'
        );
            redirect(customer);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal dihapus !</div>'
        );
            redirect(customer);
      }   
    }
}