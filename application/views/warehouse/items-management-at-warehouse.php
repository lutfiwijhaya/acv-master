<style>
	/* CSS untuk Tata Letak Grid Form */
	.form-grid-container {
		display: flex;
		/* Menggunakan flexbox untuk membagi menjadi kolom utama */
		gap: 30px;
		/* Jarak antara kolom kiri dan kanan */

		margin-bottom: 10px;
	}

	.form-column {
		flex: 1;
		/* Setiap kolom mengambil ruang yang sama */
		min-width: 350px;
		/* Lebar minimum untuk setiap kolom agar tidak terlalu sempit */
	}

	.form-group {
		margin-bottom: 5px;
		/* Jarak antar setiap input field */
	}

	/* Pastikan komponen EasyUI mengisi lebar penuh dari kolom mereka */
	.easyui-textbox,
	.easyui-combobox,
	.easyui-numberbox {
		width: 100% !important;
	}

	/* Penyesuaian untuk lebar label EasyUI */
	/* Ini penting agar label tidak terlalu panjang dan input bisa sejajar */
	.textbox-label {
		width: 130px !important;
		/* Sesuaikan lebar label sesuai kebutuhan. Ini akan mendorong input */
		text-align: right;
		/* Rata kanan label agar sejajar dengan input */
		padding-right: 10px;
		/* Jarak antara label dan input */
	}

	/* Memastikan input field (bagian teks) EasyUI memenuhi sisa ruang setelah label */
	/* Nilai calc() harus disesuaikan dengan lebar label + padding label */


	/* Untuk elemen dengan ikon seperti datebox atau combobox dengan panah */
	.textbox-button-right {
		width: 28px !important;
		/* Lebar standar tombol ikon EasyUI */
	}

	.combo-arrow {
		width: 20px !important;
		/* Lebar standar panah combobox EasyUI */
	}


	/* Jika ada input tertentu yang harus mengambil lebar penuh baris */
	.form-group.full-width {
		flex-basis: 100%;
		/* Memastikan elemen ini mengambil lebar penuh container flex */
	}

	/* Penyesuaian lebar dialog secara keseluruhan */
	#dialog-form-dist {
		padding: 10px;
		/* Sesuaikan padding agar lebih proporsional */
		max-width: 1500px !important;
		/* Sesuaikan lebar maksimum untuk menampung 2 kolom besar */
	}

	#dialog-buttons {
		text-align: right;
		padding-top: 15px;
		/* Jarak atas untuk tombol */
	}
</style>

<script type="text/javascript" src="assets/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/admin/easyui/themes/jquery.easyui.min.js"></script>
<script type="text/javascript" src="assets/admin/js/jquery.easyui.datagrid.filter.js"></script>



<section class="content-header"></section>
<div class="col-12">
	<div class="card">
		<div class="easyui-panel" style="position:relative;overflow:auto;">
			<div class="card-body">
				<div class="easyui-layout">
					<table id="dgGrid" title="<?= $title; ?>"
						toolbar="#toolbar"
						class="easyui-datagrid"
						rowNumbers="true"
						pagination="true"
						url="<?= base_url('admin/getStockwarehouse/' . rawurlencode($idwarehouse)) ?>"
						pageSize="20"
						pageList="[10,20,50,75,100,125,150,200]"
						nowrap="true"
						singleSelect="true">
						<thead>
							<tr>
								<th field="id" hidden="true" width="10%">Kode Item</th>
								<th field="kode_barang" width="6%">Kode Item</th>
								<th field="category" width="10%">Category</th>
								<th field="Level_1" width="10%">Level 1</th>
								<th field="level_2" width="10%">Level 2</th>
								<th field="level_3" width="10%">Level 3</th>
								<th field="level_4" hidden="true" width="10%">Level 4</th>
								<th field="total_quantity" width="5%">Quantity</th>
								<th field="inisial_kuantitas" width="5%">Qty</th>
								<th field="remark" width="15%">Remark</th>
								<th field="link_serials" width="10%" formatter="formatLinkSerial">Serial Number</th>
								<th field="link_barang" width="10%" formatter="formatLink">Detail Stock</th>
								<!-- <th field="link_set" width="10%" formatter="formatLinkset">Detail Set</th> -->
								<th field="path_foto" width="10%" formatter="formatAction">Foto</th>
							</tr>
						</thead>
					</table>

					<div id="toolbar" style="padding: 10px">
						<div class="row ml-1">
							<div class="col-sm-6">
								<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="adddistin()">In</a>
								<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="adddistout()">Out</a>
								<!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="">Request</a> -->
								<!-- <a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-reload" plain="false" onclick="">Request Status</a> <span style="margin-left: 10px; vertical-align: middle;"> -->
								<input type="checkbox" id="filterQty" onchange="doSearch()" style="vertical-align: middle; margin-right: 5px;">
								<label for="filterQty" style="display: inline; font-weight: normal;">Quantity > 0</label>
								</span>

							</div>

							<div class="col-sm-6 pull-right">
								<input id="search" placeholder="Please Enter Search a Level" style="width:60%;" align="right">
								<a href="javascript:void(0);" id="btn_serach" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.card-header -->
		<!-- Dialog -->
		<div id="dialog-form" class="easyui-window" title="Add New Menu" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){
    						$(this).window('hcenter');}" style="width:100%;max-width:500px;padding:30px 60px;max-height:500px;overflow-y:auto;">
			<form id="ff" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="kode_barang" editable="false" name="kode_barang" style="width:100%" data-options="label:'Kode Barang :',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" id="category" name="category" style="width:100%"
						data-options="label:'Category :',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('') ?>'">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" id="level_1" name="level_1" style="width:100%"
						data-options="label:'Level 1 :',required:true,valueField:'param_name',textField:'param_name',url:'',">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" id="level_2" name="level_2" style="width:100%"
						data-options="label:'Level 2 :',required:true,valueField:'param_name',textField:'param_name',url:''">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" id="level_3" name="level_3" style="width:100%"
						data-options="label:'Level 3 :',required:true,valueField:'param_name',textField:'param_name',url:''">
				</div>

				<!-- <div style="margin-bottom:20px">
					<input class="easyui-combobox" id="level_4" name="level_4" style="width:100%"
						data-options="label:'Level 4:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getLevel4Params') ?>'">
				</div> -->

				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="level_4" name="level_4" style="width:100%"
						data-options="label:'Serial Number :',required:true">
				</div>

				<div style="margin-bottom:20px">
					<label for="remark">Remark :</label><br>
					<textarea name="remark" id="remark" style="width:100%; height:100px;"></textarea>
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" name="inisial_kuantitas" style="width:100%"
						data-options="label:'Inisial Kuantitas :',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getInisialKuantitasParams') ?>'">
				</div>
				<div style="margin-bottom:20px">
					<label for="foto">Upload Foto:</label>
					<input id="foto" name="foto" type="file" style="width:100%" data-options="label:'Upload Foto :',required:true">
					<small style="display:block; color:#666;">Hanya file foto Maks 200kb (jpg, jpeg, png)</small>
				</div>
			</form>
			<div id="dialog-buttons">
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitForm()">Simpan</a>
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Batal</a>
			</div>
		</div>
	</div>
</div>



<div id="dialog-form-dist-out" class="easyui-window" title="Add New Distribution" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){
                            $(this).window('hcenter');}" style="width:100%;max-width:850px;padding:30px;max-height:600px;overflow-y:auto;">
	<form id="ff-dist-out" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
		<div class="form-grid-container">
			<div class="form-column">

				<div class="form-group">
					<input class="easyui-textbox" id="category-dist-out" editable="false" name="category" style="width:100%"
						data-options="label:'Category:',required:true,valueField:'param_name',textField:'param_name',url:''">
				</div>

				<div class="form-group">
					<input class="easyui-textbox" id="kode_barang-dist-out" editable="false" name="kode_barang" style="width:100%"
						data-options="label:'Kode Barang:',required:true,valueField:'kode_barang',textField:'kode_barang',url:''">
				</div>
				<div class="form-group">
					<input class="easyui-textbox" id="inisial_kuantitas-dist-out" editable="false" name="inisial_kuantitas" style="width:100%" data-options="label:'Quantity Unit:',required:false">
				</div>
				<div class="form-group">
					<input class="easyui-textbox" id="level_1-dist-out" editable="false" name="level_1" style="width:100%" data-options="label:'Level 1:',required:false">
				</div>
				<div class="form-group">
					<input class="easyui-textbox" id="level_2-dist-out" editable="false" name="level_2" style="width:100%" data-options="label:'Level 2:',required:false">
				</div>
				<div class="form-group">
					<input class="easyui-textbox" id="level_3-dist-out" editable="false" name="level_3" style="width:100%" data-options="label:'Level 3:',required:false">
				</div>
				<div class="form-group">
					<input class="easyui-textbox" id="level_4-dist-out" editable="false" name="level_4" style="width:100%" data-options="label:'Level 4:',required:false">
				</div>
			</div>

			<div class="form-column">

				<!-- <div class="form-group">
                    <input class="easyui-combobox" id="from-dist" name="from" style="width:100%"
                        data-options="label:'From:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getDistributionValue') ?>'">
                </div> -->
				<!-- <div class="form-group">
                    <input class="easyui-combobox" id="from_name-dist" name="from_name" style="width:100%"
                        data-options="label:'Name (From):',required:true,valueField:'wh_name',textField:'wh_name',url:''">
                </div> -->
				<div class="form-group">
					<input class="easyui-textbox" id="tanggal-out" name="tanggal" type="date" style="width:100%" data-options="label:'Tanggal:',required:true">
				</div>
				<div class="form-group">
					<input class="easyui-textbox" id="no_req-dist-out" name="no_req" style="width:100%"
						data-options="label:'Request Number:',required:false">
				</div>
				<div class="form-group">
					<input class="easyui-combobox" id="dist_type-dist-out" name="dist_type" style="width:100%"
						data-options="label:'Distribution Type:',required:true,valueField:'param_name',textField:'param_name'">
				</div>
				<div class="form-group">
					<input class="easyui-textbox" id="stok-dist-out" editable="false" name="stok" style="width:100%" data-options="label:'Stok:',required:false">
				</div>
				<div class="form-group">
					<input class="easyui-combobox" id="to-dist-out" name="to" style="width:100%"
						data-options="label:'To:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getDistributionValue') ?>'">
				</div>
				<div class="form-group">
					<input class="easyui-combobox" id="to_name-dist-out" name="to_name" style="width:100%"
						data-options="label:'Name (To):',required:true,valueField:'wh_name',textField:'wh_name',url:''">
				</div>
				<div class="form-group">
					<input class="easyui-numberbox" id="quantity-dist-out" editable="true" name="quantity" style="width:100%" data-options="label:'Quantity:',required:false">
				</div>
				<textarea class="easyui-textbox" id="remark-dist-out" name="remark" style="width:100%; height:100px;" data-options="label:'Distribution Note:',required:false,multiline:true,height:100"></textarea>
				<!-- <div class="form-group">
                    <input class="easyui-textbox" id="po_number-dist" name="po_number" style="width:100%"
                        data-options="label:'PO Number:',required:false">
                </div> -->
			</div>
		</div>
		<!-- <div class="form-group full-width">
            <textarea class="easyui-textbox" id="remark-dist" name="remark" style="width:100%; height:100px;" data-options="label:'Distribution Note:',required:false,multiline:true,height:100"></textarea>
        </div> -->
	</form>
	<div id="dialog-buttons" style="text-align: right; padding-top: 10px;">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitFormDistout()">Simpan</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form-dist-out').dialog('close')">Batal</a>
	</div>
</div>



<div id="dialog-form-dist-in" class="easyui-window" title="Add New Distribution" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){
                            $(this).window('hcenter');}" style="width:100%;max-width:850px;padding:30px;max-height:600px;overflow-y:auto;">
	<form id="ff-dist-in" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
		<div class="form-grid-container">
			<div class="form-column">

				<div class="form-group">
					<input class="easyui-textbox" id="category-dist-in" editable="false" name="category" style="width:100%"
						data-options="label:'Category:',required:true,valueField:'param_name',textField:'param_name',url:''">
				</div>
				<div class="form-group">
					<input class="easyui-textbox" id="kode_barang-dist-in" editable="false" name="kode_barang" style="width:100%"
						data-options="label:'Kode Barang:',required:true,valueField:'kode_barang',textField:'kode_barang',url:''">
				</div>
				<div class="form-group">
					<input class="easyui-textbox" id="inisial_kuantitas-dist-in" editable="false" name="inisial_kuantitas" style="width:100%" data-options="label:'Quantity Unit:',required:false">
				</div>
				<div class="form-group">
					<input class="easyui-textbox" id="level_1-dist-in" editable="false" name="level_1" style="width:100%" data-options="label:'Level 1:',required:false">
				</div>
				<div class="form-group">
					<input class="easyui-textbox" id="level_2-dist-in" editable="false" name="level_2" style="width:100%" data-options="label:'Level 2:',required:false">
				</div>
				<div class="form-group">
					<input class="easyui-textbox" id="level_3-dist-in" editable="false" name="level_3" style="width:100%" data-options="label:'Level 3:',required:false">
				</div>
				<div class="form-group">
					<input class="easyui-textbox" id="level_4-dist-in" editable="false" name="level_4" style="width:100%" data-options="label:'Level 4:',required:false">
				</div>
			</div>


			<div class="form-column">
				<div class="form-group">
					<input class="easyui-textbox" id="tanggal-in" name="tanggal" type="date" style="width:100%" data-options="label:'Tanggal:',required:true">
				</div>
				<div class="form-group">
					<input class="easyui-textbox" id="no_req-dist-in" name="no_req" style="width:100%"
						data-options="label:'Request Number:',required:false">
				</div>
				<div class="form-group">
					<input class="easyui-combobox" id="dist_type-dist-in" name="dist_type" style="width:100%"
						data-options="label:'Distribution Type:',required:true,valueField:'param_name',textField:'param_name'">
				</div>
				<div class="form-group">
					<input class="easyui-textbox" id="stok-dist-in" editable="false" name="stok" style="width:100%" data-options="label:'Stok:',required:false">
				</div>
				<div class="form-group">
					<input class="easyui-combobox" id="from-dist-in" name="from" style="width:100%"
						data-options="label:'From:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getDistributionValue') ?>'">
				</div>
				<div class="form-group">
					<input class="easyui-combobox" id="from_name-dist-in" name="from_name" style="width:100%"
						data-options="label:'Name (From):',required:true,valueField:'wh_name',textField:'wh_name',url:''">
				</div>
				<!-- <div class="form-group">
                    <input class="easyui-combobox" id="to-dist" name="to" style="width:100%"
                        data-options="label:'To:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getDistributionValue') ?>'">
                </div>
                <div class="form-group">
                    <input class="easyui-combobox" id="to_name-dist" name="to_name" style="width:100%"
                        data-options="label:'Name (To):',required:true,valueField:'wh_name',textField:'wh_name',url:''">
                </div> -->
				<div class="form-group">
					<input class="easyui-numberbox" id="quantity-dist-in" editable="true" name="quantity" style="width:100%" data-options="label:'Quantity:',required:false">
				</div>
				<textarea class="easyui-textbox" id="remark-dist-in" name="remark" style="width:100%; height:100px;" data-options="label:'Distribution Note:',required:false,multiline:true,height:100"></textarea>
				<!-- <div class="form-group">
                    <input class="easyui-textbox" id="po_number-dist" name="po_number" style="width:100%"
                        data-options="label:'PO Number:',required:false">
                </div> -->
			</div>
		</div>
		<!-- <div class="form-group full-width">
            <textarea class="easyui-textbox" id="remark-dist" name="remark" style="width:100%; height:100px;" data-options="label:'Distribution Note:',required:false,multiline:true,height:100"></textarea>
        </div> -->
	</form>
	<div id="dialog-buttons" style="text-align: right; padding-top: 10px;">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitFormDist()">Simpan</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form-dist').dialog('close')">Batal</a>
	</div>
</div>

<script type="text/javascript">
	var id_from = '';
	var from = '';
	var item_id = '';
	var id_to = '';
	var to = '';
	var idWarehouseDariPHP = "<?= rawurlencode($idwarehouse) ?>";
	var from = "1";

	$(document).ready(function() {


		$('#dgGrid').datagrid({
			minHeight: 410,
			maxHeight: 700,
		});

		$('#search').keyup(function(event) {
			if (event.keyCode == 13) {
				$('#btn_serach').click();
			}
		});

		$('#dist_type-dist-out').combobox({
			textField: 'jenis',
			valueField: 'value',
			data: [{
					'jenis': 'Consumable',
					"value": 'Consumable'
				},
				{
					'jenis': 'Loan',
					"value": 'Loan'
				},
				{
					'jenis': 'Return',
					"value": 'Return'
				},
				{
					'jenis': 'Move',
					"value": 'Move'
				},
				{
					'jenis': 'New',
					"value": 'New'
				},
			]
		});

		$('#dist_type-dist-in').combobox({
			textField: 'jenis',
			valueField: 'value',
			data: [{
					'jenis': 'Consumable',
					"value": 'Consumable'
				},
				{
					'jenis': 'Loan',
					"value": 'Loan'
				},
				{
					'jenis': 'Return',
					"value": 'Return'
				},
				{
					'jenis': 'Move',
					"value": 'Move'
				},
				{
					'jenis': 'New',
					"value": 'New'
				},
			]
		});

		$('#quantity-dist').numberbox({

			onChange: function(newValue, oldValue) {
				var dist = $('#dist_type-dist').combobox('getValue');

				if (dist == 'New') {

				} else {
					// Ambil nilai dari textbox stok
					var stockValue = parseFloat($('#stok-dist').textbox('getValue')) || 0; // Default ke 0 jika tidak ada

					// Periksa apakah quantity lebih dari stok
					if (newValue > stockValue) {
						alert('Quantity tidak boleh lebih dari stok yang tersedia: ' + stockValue);
						$('#quantity-dist').numberbox('setValue', '0'); // Kembalikan ke nilai lama
					}

				}
			}

		});





	});

	function submitFormDistout() {
		// Ambil nilai dari elemen input
		var quantity = $('#quantity-dist-out').numberbox('getValue');

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
		$('#ff-dist-out').append('<input type="hidden" name="id_from" value="' + id_from + '">');
		$('#ff-dist-out').append('<input type="hidden" name="from" value="' + from + '">');
		$('#ff-dist-out').append('<input type="hidden" name="item_id" value="' + item_id + '">');
		$('#ff-dist-out').append('<input type="hidden" name="id_to" value="' + id_to + '">');
		$('#ff-dist-out').append('<input type="hidden" name="to" value="' + to + '">');


		// Serialisasi form setelah semua field ditambahkan
		var string = $("#ff-dist-out").serialize();


		// Submit form menggunakan EasyUI
		$('#ff-dist-out').form('submit', {
			url: url,
			onSubmit: function() {
				return $(this).form('validate');
			},

			success: function(result) {
				var result = eval('(' + result + ')');
				if (result.errorMsg) {
					Toast.fire({
						type: 'error',
						title: '' + result.errorMsg + '.'
					});
				} else {
					Toast.fire({
						type: 'success',
						title: '' + result.message + '.'
					});
					$('#dialog-form-dist-out').dialog('close'); // Close the dialog
					$('#dgGrid').datagrid('reload');
				}
			}
		});
	}

	function adddistout() {

		var row = $('#dgGrid').datagrid('getSelected');
		if (row) {
			id_from = '';
			from = '';
			item_id = '';
			id_to = '';
			to = '';
			$('#dialog-form-dist-out').dialog('open').dialog('setTitle', 'Distribute Item');

			$('#ff-dist-out').form('clear');
			$('#category-dist-out').textbox('setValue', row.category);
			$('#kode_barang-dist-out').textbox('setValue', row.kode_barang);
			$('#inisial_kuantitas-dist-out').textbox('setValue', row.inisial_kuantitas);
			$('#level_1-dist-out').textbox('setValue', row.Level_1);
			$('#level_2-dist-out').textbox('setValue', row.level_2);
			$('#level_3-dist-out').textbox('setValue', row.level_3);

			item_id = row.id;
			url = '<?php echo base_url('admin/saveDistribution'); ?>';

			from = 'warehouse_id';


			if (from == 'employee_id') {
				id_from = idWarehouseDariPHP;
			} else {
				id_from = idWarehouseDariPHP; // Ambil nilai remark yang dipilih
			}
			checkStock(item_id);
		}
	}

	function adddistin() {
		var row = $('#dgGrid').datagrid('getSelected');
		if (row) {
			id_from = '';
			from = '';
			item_id = '';
			id_to = '';
			to = '';
			$('#dialog-form-dist-in').dialog('open').dialog('setTitle', 'Distribute Item');
			$('#ff-dist-in').form('clear');
			$('#category-dist-in').textbox('setValue', row.category);
			$('#kode_barang-dist-in').textbox('setValue', row.kode_barang);
			$('#inisial_kuantitas-dist-in').textbox('setValue', row.inisial_kuantitas);
			$('#level_1-dist-in').textbox('setValue', row.Level_1);
			$('#level_2-dist-in').textbox('setValue', row.level_2);
			$('#level_3-dist-in').textbox('setValue', row.level_3);
			$('#level_4-dist-in').textbox('setValue', row.level_4);
			item_id = row.id;
			url = '<?php echo base_url('admin/saveDistribution'); ?>';
		}
	}


	$('#dist_type-dist-out').combobox({
		onSelect: function(record) {
			$('#quantity-dist').numberbox('setValue', '0');

		}
	});


	// $('#category-dist').combobox({
	// 	onSelect: function(record) {
	// 		id_from = '';
	// 		from = '';
	// 		item_id = '';
	// 		id_to = '';
	// 		to = '';

	// 		$('#stok-dist').textbox('setValue', '0');
	// 		$('#level_1-dist').textbox('setValue', '');
	// 		$('#level_2-dist').textbox('setValue', '');
	// 		$('#level_3-dist').textbox('setValue', '');
	// 		$('#level_4-dist').textbox('setValue', '');
	// 		$('#remark-dist').textbox('setValue', '');
	// 		$('#inisial_kuantitas-dist').textbox('setValue', '');
	// 		$('#from-dist').combobox('clear');
	// 		$('#from_name-dist').combobox('clear');
	// 		$('#kode_barang-dist').combobox('clear');

	// 		var category = record.param_name; // Ambil nilai kategori yang dipilih
	// 		// Reload combobox kode_barang berdasarkan category yang dipilih
	// 		$('#kode_barang-dist').combobox('reload', '<?= base_url('admin/getKodeBarang') ?>?category=' + category);
	// 	}
	// });

	$('#from-dist-in').combobox({
		onSelect: function(record) {
			$('#stok-dist-in').textbox('setValue', '0');
			$('#from_name-dist-in').combobox('clear');

			var remark = record.remark; // Ambil nilai remark yang dipilih
			if (remark == 'tbl_user') {
				$('#from_name-dist-in').combobox('options').valueField = 'nama';
				$('#from_name-dist-in').combobox('options').textField = 'nama';
				$('#from_name-dist-in').combobox('reload', '<?= base_url('admin/getFromId') ?>?remark=' + remark);
				from = 'employee_id';

			} else if (remark == 'wh_warehouse') {
				$('#from_name-dist-in').combobox('options').valueField = 'wh_name';
				$('#from_name-dist-in').combobox('options').textField = 'wh_name';
				$('#from_name-dist-in').combobox('reload', '<?= base_url('admin/getFromId') ?>?remark=' + remark);
				from = 'warehouse_id';

			} else if (remark == 'tbl_supplier') {
				$('#from_name-dist-in').combobox('options').valueField = 'nama';
				$('#from_name-dist-in').combobox('options').textField = 'nama';
				$('#from_name-dist-in').combobox('reload', '<?= base_url('admin/getFromId') ?>?remark=' + remark);
				from = 'Supplier_id';

			} else {
				alert("Kosong !!");
			}

		}
	});



	$('#to-dist-out').combobox({
		onSelect: function(record) {
			var remark = record.remark; // Ambil nilai remark yang dipilih
			if (remark == 'tbl_user') {
				$('#to_name-dist-out').combobox('options').valueField = 'nama';
				$('#to_name-dist-out').combobox('options').textField = 'nama';
				$('#to_name-dist-out').combobox('reload', '<?= base_url('admin/getFromId') ?>?remark=' + remark);
				to = 'employee_id';
			} else if (remark == 'wh_warehouse') {
				$('#to_name-dist-out').combobox('options').valueField = 'wh_name';
				$('#to_name-dist-out').combobox('options').textField = 'wh_name';
				$('#to_name-dist-out').combobox('reload', '<?= base_url('admin/getFromId') ?>?remark=' + remark);
				to = 'warehouse_id';
			} else if (remark == 'tbl_supplier') {
				$('#to_name-dist-out').combobox('options').valueField = 'nama';
				$('#to_name-dist-out').combobox('options').textField = 'nama';
				$('#to_name-dist-out').combobox('reload', '<?= base_url('admin/getFromId') ?>?remark=' + remark);
				to = 'Supplier_id';

			} else {
				alert("Kosong !!");
			}
		}
	});

	$('#from_name-dist-in').combobox({

		onSelect: function(record) {
			from = 'warehouse_id';

			if (from == 'employee_id') {
				id_from = record._id;
			} else {
				id_from = record.id; // Ambil nilai remark yang dipilih
			}
			checkStock(item_id);

		}
	});

	$('#to_name-dist-out').combobox({
		onSelect: function(record) {

			if (to == 'employee_id') {
				id_to = record._id;
			} else {
				id_to = record.id; // Ambil nilai remark yang dipilih
			}


		}
	});


	function checkStock(item_id) {
		// Asumsi id_from dan from sudah diisi di fungsi lain
		// alert('dari='+ from + ' id='+ id_from +' item_id='+item_id);

		$.getJSON('<?= base_url('admin/checkStock') ?>', {
			item_id: item_id,
			id_from: id_from, // Ambil id_from dari fungsi lain
			from: from // Ambil 'from' dari fungsi lain
		}, function(data) {

			if (data && data.quantity) {

				// Menyetel nilai stok ke field 'Stok'
				$('#stok-dist-out').textbox('setValue', data.quantity);
				$('#stok-dist-in').textbox('setValue', data.quantity);
			} else {
				// Jika stok tidak ditemukan, tampilkan pesan dan reset field 'Stok'
				// alert('Stock not found');
				$('#stok-dist-out').textbox('setValue', '0');
				$('#stok-dist-in').textbox('setValue', '0'); // Mengatur nilai ke 0 jika stok tidak ditemukan
			}
		});
	}



	function doSearch() {
		var search = $('#search').val();
		var filterQty = $('#filterQty').is(':checked') ? 1 : 0;

		$('#dgGrid').datagrid('load', {
			search_data: search,
			filter_qty: filterQty
		});
	}


	function formatLink(value, row, index) {
		return '<a href="<?= base_url('admin/stock_details/') ?>' + row.id + '">Detail Stock</a>';
	}

	function formatLinkSerial(value, row, index) {
    return '<a href="<?= base_url('admin/serials/') ?>' + row.id 
        + '/' + from
        + '/' + idWarehouseDariPHP
        + '">Detail Serials</a>';
}




	// function formatLinkset(value, row, index){
	//     return '<a href="<?= base_url('admin/setitem/') ?>' + row.id + '">Detail Set</a>';
	// }


	function formatLinkset(value, row, index) {
		// Ganti 'your-url-here' dengan URL yang diinginkan
		return '<a href="<?= base_url('admin/setitem2') ?>">Detail Set</a>';
	}




	function submitForm() {
		var fileInput = document.getElementById('foto');
		if (fileInput.files.length > 0) {
			var fileSize = fileInput.files[0].size; // ukuran file dalam byte
			var maxSize = 200 * 1024; // 200 KB dalam byte

			if (fileSize > maxSize) {
				alert('Ukuran file tidak boleh lebih dari 200KB');
				return false; // menghentikan submit form jika ukuran file terlalu besar
			}
		}

		$('#ff').form('submit', {
			url: url,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(result) {
				var result = eval('(' + result + ')');
				if (result.errorMsg) {
					Toast.fire({
						type: 'error',
						title: '' + result.errorMsg + '.'
					});
				} else {
					Toast.fire({
						type: 'success',
						title: '' + result.message + '.'
					});
					$('#dialog-form').dialog('close'); // close the dialog
					$('#dgGrid').datagrid('reload');
				}
			}
		});
	}

	function newForm() {
		$('#dialog-form').dialog('open').dialog('setTitle', 'Add New Item');
		$('#ff').form('clear');
		url = 'saveItem';
	}


	function delete_item() {
		var row = $('#dgGrid').datagrid('getSelected');
		if (row) {
			$.messager.confirm('Confirm', 'Are you sure you want to delete ? ' + row.kode_barang, function(r) {
				if (r) {
					$.post('delete_item', {
						id: row.id
					}, function(result) {
						if (result.errorMsg) {
							Toast.fire({
								type: 'error',
								title: '' + result.errorMsg + '.'
							})
						} else {
							Toast.fire({
								type: 'success',
								title: '' + result.message + '.'
							})
							$('#dgGrid').datagrid('reload');
						}
					}, 'json');
				}
			});
		}
	}


	function editForm() {
		var row = $('#dgGrid').datagrid('getSelected');
		if (row) {
			$('#dialog-form').dialog('open').dialog('setTitle', 'Edit Item ' + row.kode_barang);
			$('#ff').form('load', row);

			// Set combobox level_1 dengan nilai yang sesuai dari data row
			$('#level_1').combobox('setValue', row.Level_1);

			// Untuk level_2, lakukan reload berdasarkan level_1 yang terpilih
			$('#level_2').combobox('reload', '<?= base_url('admin/getLevel2Params') ?>?level_1=' + row.Level_1);

			// Disable kode_barang saat mode edit


			// URL untuk submit form update
			url = 'updateItem?id=' + row.id;
		}

	}






	// Variabel global untuk menyimpan status level 1, 2, 3, dan 4
	var statusCategory = '';
	var statusLevel1 = '';
	var statusLevel2 = '';
	var statusLevel3 = '';
	var statusLevel4 = '';


	$('#category').combobox({
		onSelect: function(record) {

			var paramName = record.param_name;
			var paramst = record.status;
			var row = $('#dgGrid').datagrid('getSelected');

			// Simpan status level 1 ke variabel global
			statusCategory = paramst;

			// Set nilai kode_barang jika tidak sedang dalam mode edit
			if (!row) {
				$('#kode_barang').textbox('setValue', statusCategory);
			}

			// Jika update item, tetap pertahankan nilai kode_barang dari row yang dipilih
			if (url === 'updateItem?id=' + row?.id) {
				$('#kode_barang').textbox('setValue', row.kode_barang);
			}

			// Reload level_2 berdasarkan level 1 yang dipilih
			$('#level_1').combobox('reload', '<?= base_url('admin/getLevel1Params') ?>?Category=' + paramName);
		}
	});


	$('#level_1').combobox({
		onSelect: function(record) {

			var paramName = record.param_name;
			var paramst = record.status;
			var row = $('#dgGrid').datagrid('getSelected');

			// Simpan status level 1 ke variabel global
			statusLevel1 = paramst;

			// Gabungkan status level 1 dan level 2 untuk menghasilkan kode_barang
			var combinedStatus = statusCategory + '-' + statusLevel1;

			// Set nilai kode_barang jika tidak sedang dalam mode edit
			if (!row) {
				$('#kode_barang').textbox('setValue', combinedStatus);
			}

			// Jika update item, tetap pertahankan nilai kode_barang dari row yang dipilih
			if (url === 'updateItem?id=' + row?.id) {
				$('#kode_barang').textbox('setValue', row.kode_barang);
			}

			// Reload level_2 berdasarkan level 1 yang dipilih
			$('#level_2').combobox('reload', '<?= base_url('admin/getLevel2Params') ?>?level_1=' + paramName);
		}
	});

	$('#level_2').combobox({
		onSelect: function(record) {
			var paramName = record.param_name;
			var paramst = record.status;
			var row = $('#dgGrid').datagrid('getSelected');

			// Simpan status level 2 ke variabel global
			statusLevel2 = paramst;

			// Gabungkan status level 1 dan level 2 untuk menghasilkan kode_barang
			var combinedStatus = statusCategory + '-' + statusLevel1 + '-' + statusLevel2;

			// Set nilai kode_barang dengan gabungan status level 1 dan 2
			if (!row) {
				$('#kode_barang').textbox('setValue', combinedStatus);
			}

			// Jika update item, tetap pertahankan nilai kode_barang dari row yang dipilih
			if (url === 'updateItem?id=' + row?.id) {
				$('#kode_barang').textbox('setValue', row.kode_barang);
			}

			// Reload level_3 berdasarkan level 2 yang dipilih
			$('#level_3').combobox('reload', '<?= base_url('admin/getLevel3Params') ?>?level_2=' + paramName);
		}
	});

	$('#level_3').combobox({
		onSelect: function(record) {
			var paramName = record.param_name;
			var paramst = record.status;
			var row = $('#dgGrid').datagrid('getSelected');

			// Simpan status level 3 ke variabel global
			statusLevel3 = paramst;

			// Gabungkan status level 1, 2, dan 3 untuk menghasilkan kode_barang
			var combinedStatus = statusCategory + '-' + statusLevel1 + '-' + statusLevel2 + '-' + statusLevel3;

			// Set nilai kode_barang dengan gabungan status level 1, 2, dan 3
			if (!row) {
				$('#kode_barang').textbox('setValue', combinedStatus);
			}

			// Jika update item, tetap pertahankan nilai kode_barang dari row yang dipilih
			if (url === 'updateItem?id=' + row?.id) {
				$('#kode_barang').textbox('setValue', row.kode_barang);
			}

			// Reload level_4 berdasarkan level 3 yang dipilih
			// $('#level_4').combobox('reload', '<?= base_url('admin/getLevel4Params') ?>?level_3=' + paramName);
		}
	});

	$('#level_4').textbox({
		onChange: function(value) {
			var row = $('#dgGrid').datagrid('getSelected');

			// Simpan input level 4 ke variabel global
			statusLevel4 = value;

			// Gabungkan status semua level
			var combinedStatus = statusCategory + '-' + statusLevel1 + '-' + statusLevel2 + '-' + statusLevel3 + '-' + statusLevel4;

			// Jika tidak sedang update, isi kode_barang dengan kombinasi
			if (!row) {
				$('#kode_barang').textbox('setValue', combinedStatus);
			}

			// Jika sedang update, tetap gunakan nilai yang ada di row
			if (url === 'updateItem?id=' + row?.id) {
				$('#kode_barang').textbox('setValue', row.kode_barang);
			}
		}
	});


	// $('#level_4').combobox({
	// 	onSelect: function(record) {
	// 		var paramName = record.param_name;
	// 		var paramst = record.status;
	// 		var row = $('#dgGrid').datagrid('getSelected');

	// 		// Simpan status level 4 ke variabel global
	// 		statusLevel4 = paramst;

	// 		// Gabungkan status level 1, 2, 3, dan 4 untuk menghasilkan kode_barang
	// 		var combinedStatus =statusCategory + '-' +  statusLevel1 + '-' + statusLevel2 + '-' + statusLevel3 + '-' + statusLevel4;

	// 		// Set nilai kode_barang dengan gabungan status level 1, 2, 3, dan 4
	// 		if (!row) {
	// 			$('#kode_barang').textbox('setValue', combinedStatus);
	// 		}

	// 		// Jika update item, tetap pertahankan nilai kode_barang dari row yang dipilih
	// 		if (url === 'updateItem?id=' + row?.id) {
	// 			$('#kode_barang').textbox('setValue', row.kode_barang);
	// 		}
	// 	}
	// });






	function formatFoto(value, row, index) {
		if (value) {
			return '<img src="' + value + '" style="width:50px;height:50px;">'; // Thumbnail foto
		} else {
			return 'No Image'; // Jika tidak ada gambar
		}
	}

	function formatAction(value, row, index) {
		if (row.path_foto) {
			return '<a href="javascript:void(0);" onclick="showPhoto(\'' + row.path_foto + '\')">Tampilkan</a>';
		} else {
			return 'No Image';
		}
	}

	function showPhoto(photoUrl) {
		if (photoUrl) {
			var photoWindow = $('<div/>').window({
				title: 'Foto Item',
				width: 500,
				height: 400,
				modal: true,
				closed: false,
				content: '<img src="' + photoUrl + '" style="width:100%; height:auto;">',
				onClose: function() {
					$(this).window('destroy');
				}
			});
		} else {
			alert('Gambar tidak tersedia.');
		}
	}
</script>