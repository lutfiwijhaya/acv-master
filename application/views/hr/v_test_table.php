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
	            url="<?= base_url('admin/getsupplier') ?>" 
	            pageSize="20" 
	            pageList="[10,20,50,75,100,125,150,200]" 
	            nowrap="true" 
	            singleSelect="true">
	              <thead>
	                  <tr>
	                      <!-- <th field="id" width="5%">ID</th> -->
	                      <th field="nama" width="15%">Nama Supplier</th>
	                      <th field="PIC_name" width="15%">PIC Name</th>
	                      <th field="email" width="15%">Email</th>
	                      <th field="phone" width="10%">Phone</th>
	                      <th field="address" width="20%">Address</th>
	                      <th field="bank_account" width="10%">Bank Account</th>
	                      <th field="rek_bank" width="10%">Rekening Bank</th>
	                      <th field="tax" width="10%">Tax</th>
	                      <th field="status" width="10%">Status</th>
	                      <th field="created_at" width="10%">Created At</th>
	                      <th field="updated_at" width="10%">Updated At</th>
	                  </tr>
	              </thead>
	          </table>

	          <div id="toolbar" style="padding: 10px">
	              <div class="row ml-1">
	                  <div class="col-sm-6">
	                      <a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="newForm()">Add</a>
	                      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editForm()">Edit</a>
	                      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="delete_item()">Delete</a>
	                  </div>
	                  <div class="col-sm-6 pull-right">
	                      <input id="search" placeholder="Please Enter Search Term" style="width:60%;" align="right">
	                      <a href="javascript:void(0);" id="btn_serach" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
	                  </div>
	              </div>
	          </div>
	        </div>
	    </div>
	  </div>

	  <!-- Dialog untuk menambah dan mengedit supplier -->
	 <div id="dialog-form" class="easyui-window" title="Add/Edit Supplier" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){
    						$(this).window('hcenter');}" style="width:100%;max-width:500px;padding:30px 60px;max-height:500px;overflow-y:auto;">
	      	<form id="ff" class="easyui-form" method="post" data-options="novalidate:false">
	      		<div style="margin-bottom:20px">
	      			<input class="easyui-textbox" id="nama" name="nama" style="width:100%" data-options="label:'Nama Supplier:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="PIC_name" name="PIC_name" style="width:100%" data-options="label:'PIC Name:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="email" name="email" style="width:100%" data-options="label:'Email:',required:true,validType:'email'">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="phone" name="phone" style="width:100%" data-options="label:'Phone:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="address" name="address" style="width:100%" data-options="label:'Address:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="bank_account" name="bank_account" style="width:100%" data-options="label:'Bank Account:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="rek_bank" name="rek_bank" style="width:100%" data-options="label:'Rekening Bank:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="tax" name="tax" style="width:100%" data-options="label:'Tax:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" id="status" name="status" style="width:100%" data-options="label:'Status:',required:true,valueField:'value',textField:'label',data:[{label:'Active',value:'1'},{label:'Inactive',value:'0'}]">
				</div>
				<div id="dialog-buttons">
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitForm()">Simpan</a>
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Batal</a>
				</div>
			</form>
	   </div>
	</div>
</div>