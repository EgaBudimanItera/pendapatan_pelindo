<!--Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Data Tarif
      </h1>
      <?php $this->load->view('template/breadcrumb')?>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Tarif</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" >
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            
            <div id="info-alert"><?=@$this->session->flashdata('msg')?></div>
            <!-- /.box-header -->
            <form action="<?=base_url()?>tarif/prosesedit" role="form" method="post" class="form-horizontal">
              <div class="box-body">
               <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Kode Tarif</label>
                  <input type="text" class="form-control" readonly value="<?=$list->kodetarif?>" name="kodetarif" placeholder="Kode tarif">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Uraian</label>
                  <textarea class="form-control" name="uraian"><?=$list->uraian?></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Satuan</label>
                  <select class="form-control" name="satuan">
                    <option value="">Pilih Satuan</option>
                    <option value="Ton" <?=$list->satuan == 'Ton' ? ' selected="selected"' : '';?>>Ton</option>
                    <option value="M3" <?=$list->satuan == 'M3' ? ' selected="selected"' : '';?>>M3</option>
                    <option value="Box" <?=$list->satuan == 'Box' ? ' selected="selected"' : '';?>>Box</option>
                    <option value="Ekor" <?=$list->satuan == 'Ekor' ? ' selected="selected"' : '';?>>Ekor</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tarif</label>
                   <input type="number" class="form-control" id="keterangan" value="<?=$list->tarif?>" name="tarif" placeholder="Tarif">
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