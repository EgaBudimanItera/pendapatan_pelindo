<script type="text/javascript">
	$(document).ready(function(){
		loadTable();

		//untuk event onclick barang
	  	$("#kodetarif").change(function () {     
	        var kode = $(this).val()
	      	$.ajax({
	          	url: "<?=base_url()?>tarif/gettarif/"+kode,
	          	type: 'GET',
	          	success: function(res) {
	              	var res_ = JSON.parse(res);
	              	$('#tarifsatuan').val(res_.tarif);
	        	}
	      	})
	  	});

	  	

	});

	function loadTable() {
          $('#tampildetail').load('<?=base_url()?>pranota/tabeldetailtemp',function(){})
    };

    function tambahkankomo(){
        var kodekomoditi=$('#kodekomoditi').val();
        var kemasan=$('#kemasan').val();
        var satuan=$('#satuan').val();
       
       	var jumlahkomoditipra=$('#jumlahkomoditipra').val();
       	var tarifsatuan=$('#tarifsatuan').val();
   		if(kodekomoditi==""||kemasan==""||satuan==""||jumlahkomoditipra==""||tarifsatuan==""){
   			alert("Lengkapi Data Komoditi");
   		}else{
   			$.ajax({
            type: 'POST',
            url: '<?=base_url()?>pranota/tambahkomodititemp',
            data: 'kodekomoditi='+kodekomoditi+'&kemasan='+kemasan+'&satuan='+satuan+'&jumlahkomoditipra='+jumlahkomoditipra+'&tarifsatuan='+tarifsatuan,
            dataType: 'JSON',
            success: function(msg){
                loadTable();
            	$('#kodekomoditi').val(null).trigger('change');
            	$('#kodetarif').val(null).trigger('change');
            	$('#kemasan').val(null).trigger('change');
            	$('#satuan').val(null).trigger('change');
            	document.getElementById("jumlahkomoditipra").value="";
           		document.getElementById("tarifsatuan").value = "";
            	
            }
      	});
   		}
   		
       	
    };
    
    


    function hapustemp(id) {
        $.ajax({
            url: "<?=base_url()?>pranota/hapusdetail/"+id,
            type: "GET",
            dataType: 'JSON',
            success: function(msg) {
                if(msg.status == 'success'){
                    loadTable();                    
                }else if(msg.status == 'fail'){
                   loadTable();
                   alert('gagal hapus data');
                }
            }
        })
    } ;
</script>