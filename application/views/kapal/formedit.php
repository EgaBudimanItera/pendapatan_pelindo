<!--Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Data Kapal
      </h1>
      <?php $this->load->view('template/breadcrumb')?>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Kapal</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" >
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            
            <div id="info-alert"><?=@$this->session->flashdata('msg')?></div>
            <!-- /.box-header -->
            <form action="<?=base_url()?>kapal/prosesedit" role="form" method="post" class="form-horizontal">
              <div class="box-body">
               <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Kode Kapal</label>
                  <input type="text" class="form-control" readonly value="<?=$list->kodekapal?>" name="kapalkodekapal" placeholder="Kode kapal">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama kapal</label>
                  <input type="text" class="form-control" id="namakapal" value="<?=$list->namakapal?>" required="" name="namakapal" placeholder="Nama kapal">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Keterangan</label>
                   <input type="text" class="form-control" id="keterangan" required="" value="<?=$list->keterangan?>" name="keterangan" placeholder="keterangan">
                </div>
               
               </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <button type="button" class="btn btn-warning" onclick="self.history.back()">
                  <i class="fa fa-chevron-left"></i> Kembali
                </button>
                  <button type="submit" class="btn btn-success pull-right">Simpan</button>
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