<section class="content-header"></section>
<div class="col-12">
	<div class="card">
	  <div class="easyui-panel" style="position:relative;overflow:auto;">
	    <div class="card-body">
	      <div class="easyui-layout">
	          <table id="dgGrid" title="<?= $title;?>" 
	            toolbar="#toolbar" 
	            class="easyui-datagrid" 
	            rowNumbers="true" 
	            pagination="true" 
	            url="<?= base_url('admin/getdistribution') ?>" 
	            pageSize="20" 
	            pageList="[10,20,50,75,100,125,150,200]" 
	            nowrap="true" 
	            singleSelect="true">
	              <thead>
	                  <tr>
	                     	<th field="distribution_date" width="10%">Date</th>
	                     	<th field="kode_barang" width="10%">Kode Item</th>
							<th field="category" width="10%">Category</th>
							<th field="Level_1" width="10%">Level 1</th>
							<th field="level_2" width="10%">Level 2</th>
							<th field="level_3" width="10%">Level 3</th>
							<th field="level_4" width="10%">Level 4</th>
							<th field="from_type" width="10%">From</th>
							<th field="from_name" width="20%">Name</th>
							<th field="to_type" width="10%">To</th>
							<th field="to_name" width="20%">Name</th>
							<th field="qty" width="10%">Quantity</th>
							<th field="inisial_kuantitas" width="10%">Qty</th>
							<th field="remark" width="10%">Remark</th>
	                  </tr>
	              </thead>
	          </table>
	          <div id="toolbar" style="padding: 10px">
	              <div class="row ml-1">
	                  <div class="col-sm-6">
	                  	<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="newForm()">Add</a>
	                  	<!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editForm()">Edit</a>
	                  	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="destroy()">Delete</a> -->
	                  </div>
	                  <div class="col-sm-6 pull-right">
	                      <input  id="search" placeholder="Please Enter Search a Level" style="width:60%;" align="right">
	                      <a href="javascript:void(0);"  id="btn_serach" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
	                  </div>
	              </div>
	          </div>
	        </div>
	    </div>
	  </div>
	  <!-- /.card-header -->
	  <!-- Dialog -->
	  <div id="dialog-form" class="easyui-window" title="Add New Distribution" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){
    						$(this).window('hcenter');}" style="width:100%;max-width:500px;padding:30px 60px;max-height:500px;overflow-y:auto;">
	      	<form id="ff" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
				<div style="margin-bottom:20px">
   					 <input class="easyui-textbox" id="tanggal" name="tanggal" type="date" style="width:100%" data-options="label:'Tanggal:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" id="no_req" name="no_req" style="width:100%" 
					       data-options="label:'Request Number:',required:false,valueField:'param_name',textField:'param_name'">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" id="dist_type" name="dist_type" style="width:100%" 
					       data-options="label:'Distribution type:',required:true,valueField:'param_name',textField:'param_name'">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" id="category" name="category" style="width:100%" 
					       data-options="label:'Category:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getCategoryParams') ?>'">
				</div>
				<div style="margin-bottom:20px">
   					 <input class="easyui-combobox" id="kode_barang" name="kode_barang" style="width:100%" 
         			  data-options="label:'Kode_barang:',required:true,valueField:'kode_barang',textField:'kode_barang',url:'<?= base_url('admin/getKodeBarang') ?>'">
				</div>
				<div style="margin-bottom:20px">
   				 <input class="easyui-textbox" id="inisial_kuantitas" editable="false" name="inisial_kuantitas" style="width:100%" data-options="label:'Quantity Unit:',required:false">
				</div>
				<div style="margin-bottom:20px">
   				 <input class="easyui-textbox" id="level_1" editable="false" name="level_1" style="width:100%" data-options="label:'level_1:',required:false">
				</div>
				<div style="margin-bottom:20px">
   				 <input class="easyui-textbox" id="level_2" editable="false" name="level_2" style="width:100%" data-options="label:'level_2:',required:false">
				</div>
					<div style="margin-bottom:20px">
   				 <input class="easyui-textbox" id="level_3" editable="false" name="level_3" style="width:100%" data-options="label:'level_3:',required:false">
				</div>
				<div style="margin-bottom:20px">
   				 <input class="easyui-textbox" id="level_4" editable="false" name="level_4" style="width:100%" data-options="label:'level_4:',required:false">
				</div>
				<div style="margin-bottom:20px">
   				 <textarea class="easyui-textbox" id="remark" name="remark" style="width:100%; height:100px;" data-options="label:'Distribution Note:',required:false,multiline:true,height:100"></textarea>
				</div>			
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" id="from" name="from" style="width:100%" 
					       data-options="label:'From:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getDistributionValue') ?>'">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" id="from_name" name="from_name" style="width:100%" 
					       data-options="label:'Name:',required:true,valueField:'wh_name',textField:'wh_name',url:'<?= base_url('') ?>'">
				</div>
				<div style="margin-bottom:20px">
   				 <input class="easyui-textbox" id="stok" editable="false" name="stok" style="width:100%" data-options="label:'stok:',required:false">
				</div>

				<div style="margin-bottom:20px">
					<input class="easyui-combobox" id="to" name="to" style="width:100%" 
					       data-options="label:'To:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getDistributionValue') ?>'">
				</div>

				<div style="margin-bottom:20px">
					<input class="easyui-combobox" id="to_name" name="to_name" style="width:100%" 
					       data-options="label:'Name:',required:true,valueField:'wh_name',textField:'wh_name',url:'<?= base_url('') ?>'">
				</div>
				<div style="margin-bottom:20px">
   				 <input class="easyui-numberbox" id="quantity" editable="true" name="quantity" style="width:100%" data-options="label:'quantity:',required:false">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" id="po_number" name="po_number" style="width:100%" 
					       data-options="label:'PO Number:',required:false,valueField:'param_name',textField:'param_name'">
				</div>
				
				</form>
				<div id="dialog-buttons">
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitForm()">Simpan</a>
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Batal</a>
				</div>
	   </div>
	</div>
</div>
<script type="text/javascript">


$(document).ready(function(){
    $('#dgGrid').datagrid({
        minHeight:410,
        maxHeight:520,
    });
    $('#search').keyup(function(event){
        if(event.keyCode == 13){
        $('#btn_serach').click();
        }
    });
});

function doSearch(){
	$('#dgGrid').datagrid('load',{
		search_data: $('#search').val()
	});
}

// function formatLink(value, row, index){
//     return '<a href="<?= base_url('admin/stock_details/') ?>' + row.id + '">Detail Stock</a>';
// }

var id_from='';
var from='';
var item_id='';
var id_to='';
var to='';

function submitForm(){
	// Ambil nilai dari elemen input
	var quantity = $('#quantity').numberbox('getValue');
	
	// Cek jika quantity adalah 0
	if (quantity == 0 || quantity == '') {
		Toast.fire({
			type: 'error',
			title: 'Quantity tidak boleh 0.'
		});
		return false; // Mencegah form submit
	}

	// Cek jika "from" dan "to" sama
	if (from == to && id_from == id_to) {
		Toast.fire({
			type: 'error',
			title: 'Tujuan distribusi tidak boleh sama dengan asal.'
		});
		return false; // Mencegah form submit
	}

	// Menambahkan variabel global ke dalam form sebelum submit
	$('#ff').append('<input type="hidden" name="id_from" value="'+id_from+'">');
	$('#ff').append('<input type="hidden" name="from" value="'+from+'">');
	$('#ff').append('<input type="hidden" name="item_id" value="'+item_id+'">');
	$('#ff').append('<input type="hidden" name="id_to" value="'+id_to+'">');
	$('#ff').append('<input type="hidden" name="to" value="'+to+'">');

	// Serialisasi form setelah semua field ditambahkan
	var string = $("#ff").serialize();

	// Submit form menggunakan EasyUI
	$('#ff').form('submit',{
		url: url,
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
			var result = eval('('+result+')');
			if (result.errorMsg){
				Toast.fire({
					type: 'error',
					title: ''+result.errorMsg+'.'
				});
			} else {
				Toast.fire({
					type: 'success',
					title: ''+result.message+'.'
				});
				$('#dialog-form').dialog('close');		// Close the dialog
				$('#dgGrid').datagrid('reload');		// Reload the grid
			}
		}
	});
}



function newForm(){
	$('#dialog-form').dialog('open').dialog('setTitle','Add New Distribution');
	$('#ff').form('clear');
	url = 'saveDistribution';
}

function editForm(){
	var row = $('#dgGrid').datagrid('getSelected');
		if (row){
			$('#dialog-form').dialog('open').dialog('setTitle','Edit Posisi' + row.posisi);
			$('#ff').form('load',row);
			url = 'updatePosisi?id='+row._id;
		}
}


$('#category').combobox({
    onSelect: function(record) {
		id_from='';
		from='';
		item_id='';
		id_to='';
		to='';

		$('#stok').textbox('setValue', '0');
		$('#level_1').textbox('setValue', '');
		$('#level_2').textbox('setValue', '');
		$('#level_3').textbox('setValue', '');
		$('#level_4').textbox('setValue', '');
		$('#remark').textbox('setValue', '');
		$('#inisial_kuantitas').textbox('setValue', '');
		$('#from').combobox('clear');
		$('#from_name').combobox('clear');
		$('#kode_barang').combobox('clear');

        var category = record.param_name; // Ambil nilai kategori yang dipilih
        // Reload combobox kode_barang berdasarkan category yang dipilih
        $('#kode_barang').combobox('reload', '<?= base_url('admin/getKodeBarang') ?>?category=' + category);
    }
});

$(document).ready(function(){

	$('#dist_type').combobox({
		textField: 'jenis',
		valueField: 'value',
		data: [
			{ 'jenis': 'Consumable', "value": 'Consumable' },
			{ 'jenis': 'Loan', "value": 'Loan' },
			{ 'jenis': 'Return', "value": 'Return' },
			{ 'jenis': 'Move', "value": 'Move' },
			{ 'jenis': 'New', "value": 'New' },
		]
  	});


    $('#kode_barang').combobox({
        onSelect: function(record){
			$('#stok').textbox('setValue', '0');
			$('#level_1').textbox('setValue', '');
		$('#level_2').textbox('setValue', '');
		$('#level_3').textbox('setValue', '');
		$('#level_4').textbox('setValue', '');
		$('#remark').textbox('setValue', '');
		$('#inisial_kuantitas').textbox('setValue', '');
			
			
            // Ambil category dari dropdown category
            var category = $('#category').combobox('getValue'); 
            
            // Panggil AJAX untuk mengambil data berdasarkan kode_barang dan category
            $.ajax({
                url: '<?= base_url("admin/getKodeBarangByKode") ?>',
                method: 'POST',
                data: { 
                    kode_barang: record.kode_barang,
                    category: category
                },
                dataType: 'json',
                success: function(data){
                    if (data) {
                        // Isi textboxes dengan data yang diambil
                        $('#category').textbox('setValue', data.category);
                        $('#inisial_kuantitas').textbox('setValue', data.inisial_kuantitas);
                        $('#level_1').textbox('setValue', data.level_1);
                        $('#level_2').textbox('setValue', data.level_2);
                        $('#level_3').textbox('setValue', data.level_3);
                        $('#level_4').textbox('setValue', data.level_4);
                        
						
						item_id = data.id;
                        // Setelah data barang diambil, lakukan pengecekan stok berdasarkan item_id
                        checkStock(data.id); // Fungsi ini untuk mengecek stok
                    } else {
                        console.log('Data not found');
                    }
                },
                error: function(){
                    console.log('Error fetching data');
                }
            });
        }
    });

 // Menambahkan fungsi untuk quantity
    $('#quantity').numberbox({
		
        onChange: function(newValue, oldValue) {
			var dist = $('#dist_type').combobox('getValue'); 
		
			if(dist == 'New'){
          
        } else{
			  // Ambil nilai dari textbox stok
            var stockValue = parseFloat($('#stok').textbox('getValue')) || 0; // Default ke 0 jika tidak ada

            // Periksa apakah quantity lebih dari stok
            if (newValue > stockValue) {
                alert('Quantity tidak boleh lebih dari stok yang tersedia: ' + stockValue);
                $('#quantity').numberbox('setValue', '0'); // Kembalikan ke nilai lama
            }

		}
	}

    });

});

$('#from').combobox({
    onSelect: function(record) {
		$('#stok').textbox('setValue', '0');
		$('#from_name').combobox('clear');
		
        var remark = record.remark; // Ambil nilai remark yang dipilih
		if(remark == 'tbl_user'){
			$('#from_name').combobox('options').valueField = 'nama'; 
			$('#from_name').combobox('options').textField = 'nama';
			 $('#from_name').combobox('reload', '<?= base_url('admin/getFromId') ?>?remark=' + remark);
			 from='employee_id';
			
		}else if (remark == 'wh_warehouse'){
			$('#from_name').combobox('options').valueField = 'wh_name'; 
			$('#from_name').combobox('options').textField = 'wh_name';
			 $('#from_name').combobox('reload', '<?= base_url('admin/getFromId') ?>?remark=' + remark);
			  from='warehouse_id';
			  
		}else if (remark == 'tbl_supplier'){
			$('#from_name').combobox('options').valueField = 'nama'; 
			$('#from_name').combobox('options').textField = 'nama';
			 $('#from_name').combobox('reload', '<?= base_url('admin/getFromId') ?>?remark=' + remark);
			  from='Supplier_id';
			  
		} else {
			alert("Kosong !!");
		}
		
    }
});

$('#to').combobox({
    onSelect: function(record) {
        var remark = record.remark; // Ambil nilai remark yang dipilih
		if(remark == 'tbl_user'){
			$('#to_name').combobox('options').valueField = 'nama'; 
			$('#to_name').combobox('options').textField = 'nama';
			 $('#to_name').combobox('reload', '<?= base_url('admin/getFromId') ?>?remark=' + remark);
			 to='employee_id';
		}else if (remark == 'wh_warehouse'){
			$('#to_name').combobox('options').valueField = 'wh_name'; 
			$('#to_name').combobox('options').textField = 'wh_name';
			 $('#to_name').combobox('reload', '<?= base_url('admin/getFromId') ?>?remark=' + remark);
			 to='warehouse_id';
		} else if (remark == 'tbl_supplier'){
			$('#to_name').combobox('options').valueField = 'nama'; 
			$('#to_name').combobox('options').textField = 'nama';
			 $('#to_name').combobox('reload', '<?= base_url('admin/getFromId') ?>?remark=' + remark);
			  to='Supplier_id';
			  
		}else {
			alert("Kosong !!");
		}
    }
});

$('#from_name').combobox({
    onSelect: function(record) {
		
		if (from == 'employee_id'){
			id_from = record._id;
		}else{
        id_from = record.id; // Ambil nilai remark yang dipilih
		}
		checkStock(item_id);
		
    }
});

$('#to_name').combobox({
    onSelect: function(record) {
		
		if (to == 'employee_id'){
			id_to = record._id;
		}else{
        id_to = record.id; // Ambil nilai remark yang dipilih
		}
		
		
    }
});

$('#dist_type').combobox({
    onSelect: function(record) {
	 $('#quantity').numberbox('setValue', '0');
		
    }
});

function checkStock(item_id) {
    // Asumsi id_from dan from sudah diisi di fungsi lain
	// alert('dari='+ from + ' id='+ id_from +' item_id='+item_id);
    $.getJSON('<?= base_url('admin/checkStock') ?>', {
        item_id: item_id, 
        id_from: id_from,  // Ambil id_from dari fungsi lain
        from: from         // Ambil 'from' dari fungsi lain
    }, function(data) {
		
        if (data && data.quantity) {
			
            // Menyetel nilai stok ke field 'Stok'
           $('#stok').textbox('setValue', data.quantity);
        } else {
            // Jika stok tidak ditemukan, tampilkan pesan dan reset field 'Stok'
            // alert('Stock not found');
           $('#stok').textbox('setValue', '0'); // Mengatur nilai ke 0 jika stok tidak ditemukan
        }
    });
}

</script>