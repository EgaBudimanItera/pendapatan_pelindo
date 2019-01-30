<!--Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Nota
      </h1>
      <?php $this->load->view('template/breadcrumb')?>
    </section>

    <!-- Main content -->
    <section class="content">
         <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">List Nota</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <div class="widget-body">
                <a href="<?=base_url()?>pranota/formtambah" class="btn btn-danger">Tambah Data Nota</a>
              </div>  
            </div>
            <div class="box-body">
             <div id="info-alert"><?=@$this->session->flashdata('msg')?></div> 
            </div>
            <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No Pranota</th>
                      <th>Tanggal</th>
                      <th>Nama Kapal</th>
                      <th>Nama Customer</th>
                      <th>Kade</th>
                      <th>Kegiatan</th>
                      <th>Total Biaya</th>
                      <th>PPN(10%)</th>
                      <th>Total Tagihan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      foreach($list as $l){
                    ?>
                    <tr>
                      <td><?=$no++;?></td>
                      <td><?=$l->nopranota?></td>
                      <td><?=$l->tglpranota?></td>
                      <td><?=$l->namakapal?></td>
                      <td><?=$l->namacustomer?></td>
                      <td><?=$l->kade?></td>
                      <td><?=$l->kegiatan?></td>
                      <td align="right"><?=number_format($l->totalbiaya)?></td>
                      <td align="right"><?=number_format($l->totalbiaya/10)?></td>
                      <td align="right"><?=number_format($l->totalbiaya+($l->totalbiaya/10))?></td>
                      <td>
                        <a data-toggle="tooltip" data-placement="bottom" title="Detail Pranota" class="btn btn-warning" href="<?=base_url()?>nota/detail/<?=$l->nopranota?>"><i class="fa fa-pencil"></i></a>
                        
                      </td>
                    </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper