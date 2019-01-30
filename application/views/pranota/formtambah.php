<!--Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Data Pranota
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
            <form action="<?=base_url()?>pranota/prosessimpan" role="form" method="post" class="form-horizontal">
              <div class="box-body">
                  
                  <div class="col-md-5">
                     <div class="form-group">
                       <label for="exampleInputEmail1">No Pranota</label>
                       <input type="text" class="form-control" readonly value="<?=$nopranota?>" name="nopranota" placeholder="Kode kapal">
                     </div>
                     <div class="form-group">
                       <label for="exampleInputEmail1">Tanggal Pranota</label>
                       <div class="input-group date">
                         <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                         </div>
                         <input type="text" class="form-control" required="" id="tglpranota" name="tglpranota">
                       </div>
                     </div>
                     <div class="form-group">
                       <label for="exampleInputEmail1">Customer</label>
                       <select class="form-control" id="kodecustomer" required="" name="kodecustomer" style="width: 100%;">
                         <option value="">--Pilih Customer--</option> 
                         <?php
                           foreach($customer as $p){
                         ?>
                         <option value="<?=$p->kodecustomer?>"><?=$p->namacustomer?></option> 
                         <?php
                           }
                         ?>
                       </select>
                     </div>  
                  </div>
                  <div class="col-md-1"></div>
                  <div class="col-md-5">
                     <div class="form-group">
                       <label for="exampleInputEmail1">Kapal</label>
                       <select class="form-control" id="kodekapal" required="" name="kodekapal" style="width: 100%;">
                         <option value="">--Pilih Kapal--</option> 
                         <?php
                           foreach($kapal as $p){
                         ?>
                         <option value="<?=$p->kodekapal?>"><?=$p->namakapal?></option> 
                         <?php
                           }
                         ?>
                       </select>
                     </div>  
                     
                     <div class="form-group">
                       <label for="exampleInputEmail1">Kade</label>
                       <select class="form-control" id="kade" required="" name="kade" style="width: 100%;">
                           <option value="">--Pilih Kade--</option> 
                           <option value="A">A</option> 
                           <option value="B">B</option> 
                           <option value="C">C</option> 
                           <option value="D">D</option> 
                           <option value="E">E</option> 
                           <option value="F">F</option> 
                           <option value="G">G</option> 
                           
                       </select>
                     </div>   
                     <div class="form-group">
                       <label for="exampleInputEmail1">Kegiatan</label>
                       <select class="form-control" id="kegiatan" required="" name="kegiatan" style="width: 100%;">
                           <option value="">--Pilih Kegiatan--</option> 
                           <option value="Import">Import</option> 
                           <option value="Eksport">Eksport</option> 
                           <option value="Muat Antar Pulau">Muat Antar Pulau</option> 
                           <option value="Bongkar Antar Pulau">Bongkar Antar Pulau</option> 
                       </select>
                     </div> 
                  </div>   
                  <div class="col-md-12">
                     <hr style=" height: 12px;
    border: 0;
    box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5)">
                  </div>
                  
                  <div class="col-md-3">
                     <div class="form-group">
                       <label for="exampleInputEmail1">Komoditi</label>
                       <select class="form-control" id="kodekomoditi" name="kodekomoditi" style="width: 100%;">
                           <option value="">--Pilih Komoditi--</option> 
                           <?php
                              foreach($komoditi as $p){
                           ?>
                           <option value="<?=$p->kodekomoditi?>"><?=$p->namakomoditi?></option> 
                           <?php
                              }
                           ?>
                       </select>
                     </div>   
                  </div>
                  <div class="col-md-1"></div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Kemasan</label>
                        <select class="form-control" id="kemasan" name="kemasan" style="width: 100%;">
                           <option value="">--Pilih Kemasan--</option> 
                           <option value="Break Bulk">Break Bulk</option>
                           <option value="Bag Cargo">Bag Cargo</option>
                           
                           <option value="Unitized">Unitized</option>
                           <option value="Curah Kering">Curah Kering</option>
                           <option value="Curah Cair">Curah Cair</option>
                           <option value="Tanpa Kemasan">Tanpa Kemasan</option>
                           <option value="Peti Kemas">Peti Kemas</option>
                           <option value="Curah Cair BBM">Curah Cair BBM</option>
                        </select>
                     </div>   
                  </div>  
                  
                  <div class="col-md-1"></div>
                  <div class="col-md-3">
                     <div class="form-group">
                     <label for="exampleInputEmail1">Satuan</label>
                        <select class="form-control" id="satuan" name="satuan">
                          <option value="">Pilih Satuan</option>
                          <option value="Ton" >Ton</option>
                          <option value="M3" >M3</option>
                          <option value="Box" >Box</option>
                          <option value="Ekor" >Ekor</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-1"></div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Tarif</label>
                        <select class="form-control" id="kodetarif"  name="kodetarif" style="width: 100%;">
                           <option value="">--Pilih Tarif--</option> 
                           <?php
                              foreach($tarif as $p){
                           ?>
                           <option value="<?=$p->kodetarif?>"><?=$p->uraian?></option> 
                           <?php
                              }
                           ?>
                        </select>
                     </div> 
                  </div>
                  <div class="col-md-1"></div>
                  <div class="col-md-2">
                     <div class="form-group">
                       <label for="exampleInputEmail1">Tarif</label>
                       <input type="text" class="form-control"  id="tarifsatuan" name="tarifsatuan" placeholder="Tarif Satuan">
                     </div>
                  </div>
                  <div class="col-md-1"></div>
                  <div class="col-md-2">
                     <div class="form-group">
                       <label for="exampleInputEmail1">Jumlah Komoditi</label>
                       <input type="text" class="form-control" id="jumlahkomoditipra" name="jumlahkomoditipra" placeholder="Jumlah">
                     </div>
                  </div>
                  <div class="4">
                     
                  </div>
                  <div class="col-md-12">
                     
                     <a href="#" class="btn btn-primary" onclick="tambahkankomo()">Tambahkan Komoditi</a>
                  </div>
                 
                 
                  <div class="col-md-12">
                     <div id="tampildetail"></div>
                     <hr style=" height: 12px;
 border: 0;
 box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5)">
                  </div>
               </div>
              
              <!-- /.box-body -->
              <div class="box-footer">
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