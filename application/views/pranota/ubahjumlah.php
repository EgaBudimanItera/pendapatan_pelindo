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
            <form action="<?=base_url()?>pranota/prosesubahjumlah" role="form" method="post" class="form-horizontal">
               <div class="box-body">
                  <div class="col-md-6">
                     <div class="form-group">
                       <label for="exampleInputEmail1">No Pranota</label>
                       <input type="text" class="form-control" readonly value="<?=$listdetpranota->nopranota?>" name="nopranota" placeholder="Kode kapal">
                       <input type="hidden" class="form-control" readonly value="<?=$listdetpranota->iddetpranota?>" name="iddetpranota" placeholder="Kode kapal">
                     </div>
                     <div class="form-group">
                       <label for="exampleInputEmail1">Nama Komoditi</label>
                       <input type="text" class="form-control" readonly value="<?=$listdetpranota->namakomoditi?>" name="namakomoditi" placeholder="Kode kapal">
                     </div>
                     <div class="form-group">
                       <label for="exampleInputEmail1">Jumlah Komoditi Saat Pranota</label>
                       <input type="text" class="form-control" readonly value="<?=$listdetpranota->jumlahkomoditipra?>" name="jumlahkomoditipra" placeholder="Kode kapal">
                     </div>
                     <div class="form-group">
                       <label for="exampleInputEmail1">Jumlah Komoditi Real Untuk Nota</label>
                       <input type="number" class="form-control" value="<?=$listdetpranota->jumlahkomoditirealtemp?>" name="jumlahkomoditirealtemp" placeholder="Kode kapal">
                     </div>
                     <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right">Simpan</button>
                     </div> 
                  </div> 
                 
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