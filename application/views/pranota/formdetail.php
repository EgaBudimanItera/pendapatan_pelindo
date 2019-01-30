<!--Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Data Pranota
      </h1>
      <?php $this->load->view('template/breadcrumb')?>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Pranota</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" >
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            
            <div id="info-alert"><?=@$this->session->flashdata('msg')?></div>
            <!-- /.box-header -->
            <table class="table table-bordered table-striped">
                <tr>
                  <th>No Pranota</th>
                  <td><?=$listpranota->nopranota?></td>
                </tr> 
                <tr>
                  <th>Tanggal Pranota</th>
                  <td><?=$listpranota->tglpranota?></td>
                </tr> 
                <tr>
                  <th>Nama Kapal</th>
                  <td><?=$listpranota->namakapal?></td>
                </tr> 
                <tr>
                  <th>Nama Customer</th>
                  <td><?=$listpranota->namacustomer?></td>
                </tr> 
                <tr>
                  <th>Kade</th>
                  <td><?=$listpranota->kade?></td>
                </tr> 
                <tr>
                  <th>Kegiatan</th>
                  <td><?=$listpranota->kegiatan?></td>
                </tr> 
            </table>
          </div>
          <!-- /.box -->
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Pranota</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" >
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <div id="info-alert"><?=@$this->session->flashdata('msg')?></div>
            <!-- /.box-header -->
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Komoditi</th>
                  <th>Kemasan </th>
                  <th>Jumlah Pranota</th>
                  <th>Jumlah Nota</th>
                  
                  <th>Satuan</th>
                  <th>Tarif</th>
                  <th>Subtotal Pranota(Rp)</th>
                  <th>Subtotal Nota(Rp)</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no=1;
                  $total=0;
                  foreach($listdetpranota as $l){
                    $sub=$l->jumlahkomoditipra*$l->tarifsatuan;
                    $sub2=$l->jumlahkomoditirealtemp*$l->tarifsatuan;
                    
                ?>

                <tr>
                  <td><?=$no++?></td>
                  <td><?=$l->namakomoditi;?></td>
                  <td><?=$l->kemasan;?></td>
                  <td><?=$l->jumlahkomoditipra;?></td>
                  
                   <td><?=$l->jumlahkomoditirealtemp;?></td>
                  <td><?=$l->satuan;?></td>
                  <td align="Right"><?=number_format($l->tarifsatuan);?></td>
                  
                  <td align="Right"><?php echo number_format($sub)?></td>
                  <td align="Right"><?php echo number_format($sub2)?></td>
                  <td>
                    <a data-toggle="tooltip" data-placement="bottom" title="Masukkan Jumlah Komoditas Untuk Nota Real" class="btn btn-warning" href="<?=base_url()?>pranota/ubahjumlahnota/<?=$l->iddetpranota?>"><i class="fa fa-pencil"></i></a>
                  </td>
                </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
            <form action="<?=base_url()?>pranota/ubahpranota/<?=$listpranota->nopranota?>" role="form" method="post" class="form-horizontal">
              <div class="box-footer">
                  <button type="submit" class="btn btn-success pull-right">Simpan Nota</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper