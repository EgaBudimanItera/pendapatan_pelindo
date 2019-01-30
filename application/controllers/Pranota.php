<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pranota extends CI_Controller {

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
            'page' => 'pranota/data',
            'link' => 'pranota',
            'script'=>'',
            'list'=>$this->Pendapatan->list_data_all('vw_pranota1'),
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data pranota' => base_url() . 'pranota'),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function formtambah(){
        $data = array(
            'page' => 'pranota/formtambah',
            'link' => 'pranota',
            'script'=>'script/pranota_script',
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data pranota' => base_url() . 'pranota',
                'Tambah Data' =>base_url(). 'pranota/formtambah'
            ),
            'nopranota'=>$this->Pendapatan->nopranota(),
            'kapal'=>$this->Pendapatan->list_data_all('ref_kapal'),
            'customer'=>$this->Pendapatan->list_data_all('ref_customer'),
            'komoditi'=>$this->Pendapatan->list_data_all('ref_komoditi'),
            'tarif'=>$this->Pendapatan->list_data_all('ref_tarif'),
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function detail($nopranota){
        $data=array(
            'page' => 'pranota/formdetail',
            'link' => 'pranota',
            'script'=>'script/pranota_script',
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data pranota' => base_url() . 'pranota',
                'Detail Data' =>base_url(). 'pranota/detail'
            ),
            'listdetpranota'=>$this->Pendapatan->ambil('nopranota',$nopranota,'vw_pranota3')->result(),
            'listpranota'=>$this->Pendapatan->ambil('nopranota',$nopranota,'vw_pranota2')->row(),
        );
        
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function tabeldetailtemp(){
        //$id=$this->session->userdata('idpengguna');
        $id=1;
        $query="SELECT * FROM det_pranotatemp join ref_komoditi on(det_pranotatemp.kodekomoditi=ref_komoditi.kodekomoditi) where idpengguna='$id'";
        $data=array(
         'list'=>$this->Pendapatan->kueri($query)->result(),
        );
        $this->load->view('pranota/tempdata',$data);
    }

    public function tambahkomodititemp(){
        //$iduser=$this->session->userdata('idpengguna');
        $iduser=1;
        $data=array(
             'kodekomoditi'=>$this->input->post('kodekomoditi',true),
             'kemasan'=>$this->input->post('kemasan',true),
             'jumlahkomoditipra'=>$this->input->post('jumlahkomoditipra',true),
             'satuan'=>$this->input->post('satuan',true),
             'tarifsatuan'=>$this->input->post('tarifsatuan',true),
             'idpengguna'=>$iduser
        );

        $simpandetailtemp=$this->Pendapatan->simpan_data($data,'det_pranotatemp');
        if($simpandetailtemp){
            $this->session->set_flashdata(
                 'msg', 
                 '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil ditambah !</div>'
            );
            echo json_encode(array('status'=>'success'));
        }else{
            $this->session->set_flashdata(
                 'msg', 
                 '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal ditambah !</div>'
            );
            echo json_encode(array('status'=>'fail'));
        }
    }

    public function hapusdetail($id){
        $hapusdetailtemp=$this->Pendapatan->hapus('iddetpranota',$id,'det_pranotatemp');
        if($hapusdetailtemp){
         $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Data berhasil dihapus !</div>'
         );
         echo json_encode(array('status'=>'success'));
        }else{
         $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Data gagal dihapus !</div>'
         );
         echo json_encode(array('status'=>'fail'));
        }      
    }

    public function prosessimpan(){
        //$idpengguna=$this->session->userdata('idpengguna');
        $idpengguna=1;
        $query="SELECT COALESCE((SUM(jumlahkomoditipra*tarifsatuan)),0) AS total from det_pranotatemp where idpengguna='$idpengguna'";

        $totaltagihan=$this->Pendapatan->kueri($query)->row()->total;
        
        $nopranota=$this->Pendapatan->nopranota();
        $nojurnal=$this->Pendapatan->nojurnal();
        if($totaltagihan==0){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Warning!</strong> Simpan Data Gagal Karena Data Kosong </div>'
        );
        redirect(base_url().'pranota/formtambah'); //location
        }else{
            $datapranota=array(
                'nopranota'=>$nopranota,
                'tglpranota'=>date_format(date_create($this->input->post('tglpranota',true)),"Y-m-d"),
                'kodekapal'=>$this->input->post('kodekapal',true),
                'kodecustomer'=>$this->input->post('kodecustomer',true),
                'kade'=>$this->input->post('kade',true),
                'kegiatan'=>$this->input->post('kegiatan',true),
                'status'=>"Pranota",
            ); 

            $simpanpranota=$this->Pendapatan->simpan_data($datapranota,'pranota');

            $querytemp="SELECT * FROM det_pranotatemp join ref_komoditi on(det_pranotatemp.kodekomoditi=ref_komoditi.kodekomoditi) where idpengguna='$idpengguna'";
            $pranota_temp=$this->Pendapatan->kueri($querytemp)->result();

            $i=0;
            foreach ($pranota_temp as $row) {
                $ins[$i]['nopranota']           = $nopranota;
                $ins[$i]['kodekomoditi']        = $row->kodekomoditi;
                $ins[$i]['kemasan']             = $row->kemasan;
                $ins[$i]['jumlahkomoditipra']   = $row->jumlahkomoditipra;
                $ins[$i]['satuan']              =  $row->satuan;
                $ins[$i]['tarifsatuan']         = $row->tarifsatuan;
                $i++;  
            } 

            $datajpk=array(
                'nojurnal'=>$nojurnal,
                'tgljurnal'=>date_format(date_create($this->input->post('tglpranota',true)),"Y-m-d"),
                'Uraian'=>"Pranota No : ".$nopranota,
                'dkas'=>$totaltagihan,
                'khutang'=>0,
                'kpendmuka'=>$totaltagihan
            );

            $simpandet=$this->Pendapatan->insertbatch('det_pranota',$ins);

            $simpanjpk=$this->Pendapatan->simpan_data($datajpk,'jurnalpenerimaankas');

            $hapustem=$this->Pendapatan->hapus('idpengguna',$idpengguna,'det_pranotatemp');

            $querysaldokas="SELECT * FROM bukubesar where noakun='1110' order by idbb desc limit 1";
            $querysaldoutang="SELECT * FROM bukubesar where noakun='2115' order by idbb desc limit 1";

            $isikas=$this->Pendapatan->kueri($querysaldokas)->num_rows();
            if($isikas==0){
                $saldokas=0;
            }else{
                $saldokas=$this->Pendapatan->kueri($querysaldokas)->row()->saldo;
            }

            $isihutang=$this->Pendapatan->kueri($querysaldoutang)->num_rows();
            if($isihutang==0){
                $saldohutang=0;
            }else{
                $saldohutang=$this->Pendapatan->kueri($querysaldoutang)->row()->saldo;
            }

            $datakas=array(
                'tgltransaksi'=>date_format(date_create($this->input->post('tglpranota',true)),"Y-m-d"),
                'Uraian'=>"Pranota No : ".$nopranota,
                'nojurnal'=>$nojurnal,
                'noakun'=>"1110",
                'namaakun'=>"Kas",
                'debet'=>$totaltagihan,
                'kredit'=>0,
                'saldo'=>$totaltagihan+$saldokas,
            );

            $datautang=array(
                'tgltransaksi'=>date_format(date_create($this->input->post('tglpranota',true)),"Y-m-d"),
                'Uraian'=>"Pranota No : ".$nopranota,
                'nojurnal'=>$nojurnal,
                'noakun'=>"2115",
                'namaakun'=>"Pendapatan Diterima Dimuka",
                'debet'=>0,
                'kredit'=>$totaltagihan,
                'saldo'=>$totaltagihan+$saldohutang,
            );

            $simpankas=$this->Pendapatan->simpan_data($datakas,'bukubesar');
            $simpanutang=$this->Pendapatan->simpan_data($datautang,'bukubesar');

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $this->session->set_flashdata(
                'msg', 
                '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Warning!</strong> Simpan Data Pranota Gagal </div>'
            );
            }
            else
            {
                $this->db->trans_commit();
                $this->session->set_flashdata(
                'msg', 
                '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Succes</strong> Simpan Data Pranota Berhasil </div>'
            );
                redirect(base_url().'pranota');
            }

        }
    }

    public function ubahpranota($nopranota){
        $query="UPDATE det_pranota set jumlahkomoditireal=jumlahkomoditirealtemp where nopranota='$nopranota'";
        $update=$this->Pendapatan->kueri($query);
        $tglnota=date('Y-m-d');
        $query2="UPDATE pranota set status='Nota',tglnota='$tglnota' where nopranota='$nopranota'";
        $update2=$this->Pendapatan->kueri($query2);

        //masuk ke JU
        $query3="SELECT sum(jumlahkomoditireal*tarifsatuan) as totalbiaya,sum(jumlahkomoditipra*tarifsatuan)as totalpranota,det_pranota.* from det_pranota where nopranota='$nopranota' GROUP BY nopranota";
        $hasilreal=$this->Pendapatan->kueri($query3)->row()->totalbiaya;
        $hasilpranota=$this->Pendapatan->kueri($query3)->row()->totalpranota;

        $nojurnal=$this->Pendapatan->nojurnal();
        $nojurnalumum=$this->Pendapatan->nojurnalumum();

        if($hasilreal>$hasilpranota){
            //customer wajib menambah duit lg
            //kas
            //pendapatan diterima dimuka
            //       pendpatan

            //masuk ke JPK

            $datajpk=array(
                'nojurnal'=>$nojurnal,
                'tgljurnal'=>date('Y-m-d'),
                'Uraian'=>"Nota No : ".$nopranota,
                'dkas'=>$hasilreal-$hasilpranota,
                'dpendmuka'=>$hasilpranota,
                'kpendapatan'=>$hasilreal
            );

            $simpanjpk=$this->Pendapatan->simpan_data($datajpk,'jurnalpenerimaankas');

            $querysaldokas="SELECT * FROM bukubesar where noakun='1110' order by idbb desc limit 1";
            $querysaldopendapatandimuka="SELECT * FROM bukubesar where noakun='2115' order by idbb desc limit 1";
            $querysaldopendapatan="SELECT * FROM bukubesar where noakun='4110' order by idbb desc limit 1";
            
            $isikas=$this->Pendapatan->kueri($querysaldokas)->num_rows();
            if($isikas==0){
                $saldokas=0;
            }else{
                $saldokas=$this->Pendapatan->kueri($querysaldokas)->row()->saldo;
            }

            $isipendapatandimuka=$this->Pendapatan->kueri($querysaldopendapatandimuka)->num_rows();
            if($isipendapatandimuka==0){
                $saldopendapatandimuka=0;
            }else{
                $saldopendapatandimuka=$this->Pendapatan->kueri($querysaldopendapatandimuka)->row()->saldo;
            }

            $isipendapatan=$this->Pendapatan->kueri($querysaldopendapatan)->num_rows();
            if($isipendapatan==0){
                $saldopendapatan=0;
            }else{
                $saldopendapatan=$this->Pendapatan->kueri($querysaldopendapatan)->row()->saldo;
            }

            $datakas=array(
                'tgltransaksi'=>date("Y-m-d"),
                'Uraian'=>"Nota No : ".$nopranota,
                'nojurnal'=>$nojurnal,
                'noakun'=>"1110",
                'namaakun'=>"Kas",
                'debet'=>$hasilreal-$hasilpranota,
                'kredit'=>0,
                'saldo'=>$hasilreal-$hasilpranota+$saldokas,
            );

            $datapendapatandimuka=array(
                'tgltransaksi'=>date("Y-m-d"),
                'Uraian'=>"Nota No : ".$nopranota,
                'nojurnal'=>$nojurnal,
                'noakun'=>"2115",
                'namaakun'=>"Pendapatan Diterima Dimuka",
                'debet'=>$hasilpranota,
                'kredit'=>0,
                'saldo'=>$saldopendapatandimuka-$hasilpranota,
            );

            $datapendapatan=array(
                'tgltransaksi'=>date("Y-m-d"),
                'Uraian'=>"Nota No : ".$nopranota,
                'nojurnal'=>$nojurnal,
                'noakun'=>"4110",
                'namaakun'=>"Pendapatan",
                'debet'=>0,
                'kredit'=>$hasilreal,
                'saldo'=>$hasilreal+$saldopendapatan,
            );

            $simpankas=$this->Pendapatan->simpan_data($datakas,'bukubesar');
            $simpanpendapatandimuka=$this->Pendapatan->simpan_data($datapendapatandimuka,'bukubesar');
            $simpanpendapatan=$this->Pendapatan->simpan_data($datapendapatan,'bukubesar');
            

        }elseif($hasilreal=$hasilpranota){
            //customer tidak perlu nambah lg

            //pendapatan diterima dimuka
            //     pendapatan

            

            $datajpk=array(
                'nojurnal'=>$nojurnalumum,
                'tgljurnal'=>date('Y-m-d'),
                'Uraian'=>"Nota No : ".$nopranota,
                'namaakun'=>'Pendapatan Diterima Dimuka',
                'debet'=>$hasilpranota,
                'kredit'=>0
            );
            $simpanjpk=$this->Pendapatan->simpan_data($datajpk,'jurnalumum');

            $datajpk=array(
                'nojurnal'=>$nojurnalumum,
                'tgljurnal'=>date('Y-m-d'),
                'Uraian'=>"Nota No : ".$nopranota,
                'namaakun'=>'Pendapatan ',
                'debet'=>0,
                'kredit'=>$hasilreal
            );
            $simpanjpk=$this->Pendapatan->simpan_data($datajpk,'jurnalumum');


            $querysaldopendapatandimuka="SELECT * FROM bukubesar where noakun='2115' order by idbb desc limit 1";
            $querysaldopendapatan="SELECT * FROM bukubesar where noakun='4110' order by idbb desc limit 1";
            
            

            $isipendapatandimuka=$this->Pendapatan->kueri($querysaldopendapatandimuka)->num_rows();
            if($isipendapatandimuka==0){
                $saldopendapatandimuka=0;
            }else{
                $saldopendapatandimuka=$this->Pendapatan->kueri($querysaldopendapatandimuka)->row()->saldo;
            }

            $isipendapatan=$this->Pendapatan->kueri($querysaldopendapatan)->num_rows();
            if($isipendapatan==0){
                $saldopendapatan=0;
            }else{
                $saldopendapatan=$this->Pendapatan->kueri($querysaldopendapatan)->row()->saldo;
            }

            

            $datapendapatandimuka=array(
                'tgltransaksi'=>date("Y-m-d"),
                'Uraian'=>"Nota No : ".$nopranota,
                'nojurnal'=>$nojurnal,
                'noakun'=>"2115",
                'namaakun'=>"Pendapatan Diterima Dimuka",
                'debet'=>$hasilpranota,
                'kredit'=>0,
                'saldo'=>$saldopendapatandimuka-$hasilpranota,
            );

            $datapendapatan=array(
                'tgltransaksi'=>date("Y-m-d"),
                'Uraian'=>"Nota No : ".$nopranota,
                'nojurnal'=>$nojurnal,
                'noakun'=>"4110",
                'namaakun'=>"Pendapatan",
                'debet'=>0,
                'kredit'=>$hasilreal,
                'saldo'=>$hasilreal+$saldopendapatan,
            );

           
            $simpanpendapatandimuka=$this->Pendapatan->simpan_data($datapendapatandimuka,'bukubesar');
            $simpanpendapatan=$this->Pendapatan->simpan_data($datapendapatan,'bukubesar');

        }elseif($hasilreal<$hasilpranota){
            //customer mendapatkan uang pengembalian
            //pendapatan diterima dimuka
            //      kas
            //      pendapatan

            $datajpk=array(
                'nojurnal'=>$nojurnalumum,
                'tgljurnal'=>date('Y-m-d'),
                'Uraian'=>"Nota No : ".$nopranota,
                'namaakun'=>'Pendapatan Diterima Dimuka',
                'debet'=>$hasilpranota,
                'kredit'=>0
            );
            $simpanjpk=$this->Pendapatan->simpan_data($datajpk,'jurnalumum');
            $datajpk=array(
                'nojurnal'=>$nojurnalumum,
                'tgljurnal'=>date('Y-m-d'),
                'Uraian'=>"Nota No : ".$nopranota,
                'namaakun'=>'Kas',
                'debet'=>0,
                'kredit'=>$hasilpranota-$hasilreal,
            );
            $simpanjpk=$this->Pendapatan->simpan_data($datajpk,'jurnalumum');
            $datajpk=array(
                'nojurnal'=>$nojurnalumum,
                'tgljurnal'=>date('Y-m-d'),
                'Uraian'=>"Nota No : ".$nopranota,
                'namaakun'=>'Pendapatan',
                'debet'=>0,
                'kredit'=>$hasilreal,
            );
            $simpanjpk=$this->Pendapatan->simpan_data($datajpk,'jurnalumum');

            $querysaldokas="SELECT * FROM bukubesar where noakun='1110' order by idbb desc limit 1";
            $querysaldopendapatandimuka="SELECT * FROM bukubesar where noakun='2115' order by idbb desc limit 1";
            $querysaldopendapatan="SELECT * FROM bukubesar where noakun='4110' order by idbb desc limit 1";
            
            $isikas=$this->Pendapatan->kueri($querysaldokas)->num_rows();
            if($isikas==0){
                $saldokas=0;
            }else{
                $saldokas=$this->Pendapatan->kueri($querysaldokas)->row()->saldo;
            }

            $isipendapatandimuka=$this->Pendapatan->kueri($querysaldopendapatandimuka)->num_rows();
            if($isipendapatandimuka==0){
                $saldopendapatandimuka=0;
            }else{
                $saldopendapatandimuka=$this->Pendapatan->kueri($querysaldopendapatandimuka)->row()->saldo;
            }

            $isipendapatan=$this->Pendapatan->kueri($querysaldopendapatan)->num_rows();
            if($isipendapatan==0){
                $saldopendapatan=0;
            }else{
                $saldopendapatan=$this->Pendapatan->kueri($querysaldopendapatan)->row()->saldo;
            }

            $datakas=array(
                'tgltransaksi'=>date("Y-m-d"),
                'Uraian'=>"Nota No : ".$nopranota,
                'nojurnal'=>$nojurnal,
                'noakun'=>"1110",
                'namaakun'=>"Kas",
                'debet'=>0,
                'kredit'=>$hasilpranota-$hasilreal,
                'saldo'=>$saldokas-($hasilpranota-$hasilreal),
            );

            $datapendapatandimuka=array(
                'tgltransaksi'=>date("Y-m-d"),
                'Uraian'=>"Nota No : ".$nopranota,
                'nojurnal'=>$nojurnal,
                'noakun'=>"2115",
                'namaakun'=>"Pendapatan Diterima Dimuka",
                'debet'=>$hasilpranota,
                'kredit'=>0,
                'saldo'=>$saldopendapatandimuka-$hasilpranota,
            );

            $datapendapatan=array(
                'tgltransaksi'=>date("Y-m-d"),
                'Uraian'=>"Nota No : ".$nopranota,
                'nojurnal'=>$nojurnal,
                'noakun'=>"4110",
                'namaakun'=>"Pendapatan",
                'debet'=>0,
                'kredit'=>$hasilreal,
                'saldo'=>$hasilreal+$saldopendapatan,
            );

            $simpankas=$this->Pendapatan->simpan_data($datakas,'bukubesar');
            $simpanpendapatandimuka=$this->Pendapatan->simpan_data($datapendapatandimuka,'bukubesar');
            $simpanpendapatan=$this->Pendapatan->simpan_data($datapendapatan,'bukubesar');
        };

        if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $this->session->set_flashdata(
                'msg', 
                '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Warning!</strong> Simpan Data Pranota Gagal </div>'
            );
            }
            else
            {
                $this->db->trans_commit();
                $this->session->set_flashdata(
                'msg', 
                '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Succes</strong> Simpan Data Pranota Berhasil </div>'
            );
                redirect(base_url().'pranota');
        }
    }   

    public function ubahjumlahnota($iddet){
        $data=array(
            'page' => 'pranota/ubahjumlah',
            'link' => 'pranota',
            'script'=>'',
            'breadcrumb' => array(
                'Beranda' => base_url() . 'berandaadmin',
                'Data pranota' => base_url() . 'pranota',
                'Detail Data' =>base_url(). 'pranota/detail',
                'Ubah Jumlah'=>base_url().'pranota/ubahjumlahnota'
            ),
            'listdetpranota'=>$this->Pendapatan->ambil('iddetpranota',$iddet,'vw_pranota3')->row(),
            
        );
        
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebaradmin');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }

    public function prosesubahjumlah(){
        $iddetpranota=$this->input->post('iddetpranota',true);
        $nopranota=$this->input->post('nopranota',true);
        $data=array(
            'jumlahkomoditirealtemp'=>$this->input->post('jumlahkomoditirealtemp',true),
        );
        $ubah=$this->Pendapatan->update('iddetpranota',$iddetpranota,'det_pranota',$data);
        if($ubah){
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Success!</strong> Jumlah Berhasil Diubah !</div>'
        );
            redirect(base_url().'pranota/detail/'.$nopranota);
        }else{
            $this->session->set_flashdata(
            'msg', 
            '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Peringatan!</strong> Jumlah gagal diubah !</div>'
        );
            redirect(base_url().'pranota/ubahjumlahnota/'.$iddetpranota);
        }
    }

    public function cetakpranota($nopranota){
        $data=array(
            'listdetpranota'=>$this->Pendapatan->ambil('nopranota',$nopranota,'vw_pranota3')->result(),
            'listpranota'=>$this->Pendapatan->ambil('nopranota',$nopranota,'vw_pranota2')->row(),
        );

         $this->load->view('pranota/cetakpranota',$data);
    }
}