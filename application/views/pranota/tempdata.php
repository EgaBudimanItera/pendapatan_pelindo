<div id="info-alert1">
    <?=@$this->session->flashdata('msg')?>
</div>
<table class="data-table table table-bordered table-striped" >
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Komoditi</th>
      <th>Kemasan </th>
      
      <th>Jumlah</th>
      <th>Satuan</th>
      <th>Tarif</th>
      <th>Subtotal (Rp)</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $no=1;
      $total=0;
      foreach($list as $l){
        $sub=$l->jumlahkomoditipra*$l->tarifsatuan;
    ?>
    <tr>
      <td><?=$no++;?></td>
      <td><?=$l->namakomoditi;?></td>
      <td><?=$l->kemasan;?></td>
      
      <td><?=$l->jumlahkomoditipra;?></td>
      <td><?=$l->satuan;?></td>
      <td align="Right"><?=number_format($l->tarifsatuan);?></td>
      
      <td align="Right"><?php echo number_format($sub)?></td>
      <td>
         <center>
          <a href="#" style="color:#DAA520; text-decoration:none;" onclick="if(confirm('Apakah anda yakin?')) hapustemp('<?=$l->iddetpranota?>');">
            <button type="button" class="btn btn-danger">
              <i class="fa fa-trash"></i>                      
            </button>
          </a> 
        </center>
      </td>
    </tr>
    
    <?php
      $total=$total+($l->jumlahkomoditipra*$l->tarifsatuan);
      }
    ?>
    <tr>
      <td colspan="4" align="Left">Total Biaya</td>
      <td colspan="3" align="Right"><?php echo number_format($total)?></td>
      <td>&nbsp</td>
    </tr>
  </tbody>
</table>

<script type="text/javascript">
  $(document).ready(function(){
    $("#info-alert1").fadeTo(2000,50).slideUp(50,function(){
          $("#info-alert1").slideUp(50);
      });
  });
</script>