
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
table {
    border-collapse: collapse;
}
td.garis {
  border-bottom: 1pt solid black;
}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pranota</title>
</head>
<body onload="window.print()"  >
	<table width="100%" border="1px" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="20%" align="center" rowspan="3"><img src="<?=base_url()?>assets/logo.png" width="100%" height="20%"></td>
						<td width="80%" align="center">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="center"><strong><font size="5">PT Pelabuhan Indonesia II (Persero)</font></strong></td>
									
								</tr>
								<tr>
									<td align="center"><font size="4">Jl. Yos Sudarso No. 337, Panjang Kota Bandar Lampung</font></td>
								</tr>
								<tr>
									<td align="center"><font size="4">Telp 0721 31146</font></td>
								</tr>
							</table>
						</td>
					</tr>
					
				</table>	
			</td>
		</tr>
		<tr>
			<td >
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						
						<td align="center" colspan="5"><strong>PRANOTA ANGKUTAN LANGSUNG</strong></td>
						
					</tr>
					<tr>
						<td colspan="5">&nbsp</td>
					</tr>
					<tr>
						<td width="30%">&nbsp</td>
						<td width="10%" align="left">Nomor Nota</td>
						<td width="5%" align="center">:</td>
						<td width="35%" align="left"><?=$listpranota->nopranota?></td>
						<td width="15%">&nbsp</td>
					</tr>

					<tr>
						<td width="30%">&nbsp</td>
						<td width="10%" align="left">Pemilik/Pemakai Jasa</td>
						<td width="5%" align="center">:</td>
						<td width="35%" align="left"><?=$listpranota->namacustomer?></td>
						<td width="15%">&nbsp</td>
					</tr>

					<tr>
						<td width="30%">&nbsp</td>
						<td width="10%" align="left">Alamat</td>
						<td width="5%" align="center">:</td>
						<td width="35%" align="left"><?=$listpranota->alamatcustomer?></td>
						<td width="15%">&nbsp</td>
					</tr>

					<tr>
						<td width="30%">&nbsp</td>
						<td width="10%" align="left">NPWP</td>
						<td width="5%" align="center">:</td>
						<td width="35%" align="left"><?=$listpranota->npwpcustomer?></td>
						<td width="15%">&nbsp</td>
					</tr>

					<tr>
						<td width="30%">&nbsp</td>
						<td width="10%" align="left">Nama Kapal</td>
						<td width="5%" align="center">:</td>
						<td width="35%" align="left"><?=$listpranota->namakapal?></td>
						<td width="15%">&nbsp</td>
					</tr>
					<tr>
						<td width="30%">&nbsp</td>
						<td width="10%" align="left">Kade</td>
						<td width="5%" align="center">:</td>
						<td width="35%" align="left"><?=$listpranota->kade?></td>
						<td width="15%">&nbsp</td>
					</tr>

					<tr>
						<td width="30%">&nbsp</td>
						<td width="10%" align="left">Kegiatan</td>
						<td width="5%" align="center">:</td>
						<td width="35%" align="left"><?=$listpranota->kegiatan?></td>
						<td width="15%">&nbsp</td>
					</tr>
					<tr>
						<td colspan="5">&nbsp</td>
					</tr>
					<tr>
						<td width="100%" colspan="5" align="center">
							<table width="90%" border="1px" cellpadding="0" cellspacing="0">
								<tr>
									<td align="center" width="5%"><b>No</b></td>
									<td align="center" width="15%"><b>Jenis Komoditi</b></td>
									<td align="center" width="10%"><b>Kemasan</b></td>
									<td align="center" width="10%"><b>Jumlah</b></td>
									<td align="center" width="10%"><b>Satuan</b></td>
									<td align="center" width="10%"><b>Tarif</b></td>
									<td align="center" width="15%"><b>Biaya</b></td>
								</tr>
								<?php
									$no=1;
				                  	$total=0;
				                  	foreach($listdetpranota as $l){
				                    	
				                    	$sub2=$l->jumlahkomoditireal*$l->tarifsatuan;
				                ?>
				                <tr>
				                	<td align="center"><?=$no++?></td>
				                	<td><?=$l->namakomoditi?></td>
				                	<td><?=$l->kemasan?></td>
				                	<td align="center"><?=$l->jumlahkomoditireal?></td>
				                	<td align="center">

				                		<?=$l->satuan?>
				                			
				                	</td>
				                	<td align="right"><?=number_format($l->tarifsatuan)?></td>
				                	<td align="right"><?=number_format($l->tarifsatuan*$l->jumlahkomoditireal)?></td>
				                </tr>
				                <?php
				                   $total=$total+$sub2;
				                    }
								?>
								
								
							</table>
							<table width="90%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td align="center" width="5%">&nbsp</td>
									<td align="center" width="15%">&nbsp</td>
									<td align="center" width="10%">&nbsp</td>
									<td align="center" width="10%">&nbsp</td>
									<td align="center" width="10%">&nbsp</td>
									<td align="center" width="10%">&nbsp</td>
									<td align="center" width="15%">&nbsp</td>
								</tr>
								<tr>
									<td colspan="6" align="right">Administrasi</td>
									<td align="right">0</td>
								</tr>
								<tr>
									<td colspan="6" align="right">Jumlah</td>
									<td align="right"><?=number_format($total)?></td>
								</tr>
								<tr>
									<td colspan="6" align="right">Ppn 10%</td>
									<td align="right"><?=number_format($total*10/100)?></td>
								</tr>
								<tr>
									<td colspan="6" align="right">Jumlah Tagihan</td>
									<td align="right"><?=number_format($total+($total*10/100))?></td>
								</tr>
								<tr>
									<td colspan="8">&nbsp</td>
								</tr>
								<tr>
									<td colspan="4" align="right">&nbsp</td>
									<td align="center" colspan="4">Panjang, <?=date('d-M-Y')?></td>
								</tr>
								<tr>
									<td colspan="4" align="right">&nbsp</td>
									<td align="center" colspan="4">Asisten Manager PKBU</td>
								</tr>
								<tr>
									<td colspan="8">&nbsp</td>
								</tr>
								<tr>
									<td colspan="8">&nbsp</td>
								</tr>
								<tr>
									<td colspan="8">&nbsp</td>
								</tr>
								<tr>
									<td colspan="4" align="right">&nbsp</td>
									<td align="center" colspan="4">(..........................)</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="5">&nbsp</td>
					</tr>
				</table>
				
			</td>
		</tr>

	</table>
</body>
</html>