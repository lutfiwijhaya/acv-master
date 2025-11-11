<!-- HTML View -->
<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $title; ?></h3>
        </div>
        <div class="easyui-panel" style="position:relative;overflow:auto;">
            <div class="card-body">
                <div class="easyui-layout">
                    <table id="dgJournal" 
                        toolbar="#toolbar"
                        class="easyui-treegrid"
                        rowNumbers="false"
                        pagination="true"
                        pageSize="50"
                        pageList="[10,20,50,75,100,125,150,200]"
                        nowrap="true"
                        singleSelect="true"
                        idField="id"
                        treeField="description"
                        showFooter="true">
                        <thead>
                            <tr>
                                <th field="nomor" width="6%">No</th>
                                <th field="journal_date" width="12%">Date</th>
                                <th field="reference" width="12%">Reference</th>
                                <th field="description" width="25%">Description</th>
                                <th field="code" width="12%">COA Code</th>
                                <th field="name" width="15%">COA Name</th>
                                <th field="debit" width="12%" align="right" formatter="formatCurrency">Debit</th>
                                <th field="credit" width="12%" align="right" formatter="formatCurrency">Credit</th>
                            </tr>
                        </thead>
                    </table>


                    <!-- Toolbar -->
                    <div id="toolbar" style="padding: 10px">
                        <div class="row ml-1 d-flex justify-content-between align-items-center">
                            <!-- Left menu -->
                           
                            <div class="col-sm-6 text-menu">
                                <nav class="toolbar-menu">
                                    <a href="javascript:void(0);" onclick="newForm()">Add</a>
                                    <a href="javascript:void(0);" onclick="editForm()">Edit</a>
                                    <a href="javascript:void(0);" onclick="destroy()">Delete</a>
                                    <a href="javascript:void(0);" onclick="expandAll()">Expand All</a>
                                    <a href="javascript:void(0);" onclick="collapseAll()">Collapse All</a>
                                </nav>
                            </div>

                            <!-- Right search -->
                            <div class="col-sm-6 text-right">
                                <input id="search" placeholder="Search Journal..." style="width:60%;" />
                                <a href="javascript:void(0);" id="btn_serach" onclick="doSearch()">Search</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dialog - Keep existing structure -->
    <div id="dialog-form" class="easyui-window" title="Add / Edit Journal"
        data-options="modal:true,closed:true,iconCls:'icon-save',inline:true,onResize:function(){$(this).window('hcenter');}" 
        style="width:100%;max-width:500px;padding:30px 60px;margin-top:20px;">
        <form id="ff" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
            <input type="hidden" name="id">
            <div style="margin-bottom:20px">
                <input class="easyui-datebox" name="journal_date" style="width:100%" data-options="label:'Date:',required:true">
            </div>
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="reference" style="width:100%" data-options="label:'Reference:',required:true">
            </div>
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="description" style="width:100%" data-options="label:'Description:',required:true">
            </div>
            
            <!-- Journal Details Section -->
            <div style="margin-bottom:20px">
                <label>Journal Details:</label>
                <table id="detailsGrid" class="easyui-datagrid" 
                    style="width:100%;height:200px"
                    toolbar="#detail-toolbar"
                    singleSelect="true"
                    rownumbers="true">
                    <thead>
                        <tr>
                            <th field="coa_id" width="30%">COA</th>
                            <th field="debit" width="35%" align="right" editor="{type:'numberbox',options:{precision:2}}">Debit</th>
                            <th field="credit" width="35%" align="right" editor="{type:'numberbox',options:{precision:2}}">Credit</th>
                        </tr>
                    </thead>
                </table>
                <div id="detail-toolbar">
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="addDetailRow()">Add</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeDetailRow()">Remove</a>
                </div>
            </div>
        </form>
        <div id="dialog-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitForm()">Simpan</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#dialog-form').dialog('close')">Batal</a>
        </div>
    </div>
</div>

<style>

    /* Text menu style */
    .text-menu a,
    #btn_serach {
        margin-right: 15px;
        font-weight: 600;
        color: #333;
        text-decoration: none;
    } 

    .text-menu a:hover,
    #btn_serach:hover {
        color: #007bff;       /* biru saat hover */
        text-decoration: underline;
    }
</style>

<script type="text/javascript">
    var url;
    var editIndex = undefined;

    $('#dgJournal').treegrid({
        minHeight: 410,
        maxHeight: 520,
        method: 'get',
        loader: function(param, success, error) {
            $.ajax({
                url: "<?= base_url('journal/getDataJournal') ?>",
                type: "GET",
                data: {
                    page: param.page,
                    rows: param.rows,
                    search_data: $('#search').val()
                },
                dataType: "json",
                success: function(data) {
                    var transformedData = [];

                    // rekursif untuk generate nomor
                    function processChildren(children, parentId, prefix) {
                        var counter = 1;
                        children.forEach(function(child) {
                            var childId = 'child_' + child.id;
                            var nomor = prefix + '.' + counter;

                            var childRow = {
                                id: childId,
                                nomor: nomor,
                                journal_date: '',
                                reference: '',
                                description: child.description,
                                code: child.code,
                                name: child.name,
                                debit: child.debit || 0,
                                credit: child.credit || 0,
                                _parentId: parentId,
                                journal_detail_id: child.id,
                                journal_id: child.journal_id || null
                            };
                            transformedData.push(childRow);

                            // kalau ada sub-child
                            if(child.children && child.children.length > 0) {
                                processChildren(child.children, childId, nomor);
                            }
                            counter++;
                        });
                    }

                    if(data.rows) {
                        var parentCounter = 1;
                        data.rows.forEach(function(parent) {
                            var parentId = 'parent_' + parent.id;

                            var parentRow = {
                                id: parentId,
                                nomor: parentCounter.toString(),
                                journal_date: parent.journal_date,
                                reference: parent.reference,
                                description: parent.description + ' (' + parent.detail_count + ' entries)',
                                code: '',
                                name: 'Total:',
                                debit: parent.total_debit || 0,
                                credit: parent.total_credit || 0,
                                state: parent.state || 'closed',
                                _parentId: null,
                                journal_id: parent.id
                            };
                            transformedData.push(parentRow);

                            // proses children rekursif
                            if(parent.children && parent.children.length > 0) {
                                processChildren(parent.children, parentId, parentCounter.toString());
                            }
                            parentCounter++;
                        });
                    }

                    success({
                        total: data.total,
                        rows: transformedData
                    });
                },
                error: function() {
                    error.apply(this, arguments);
                }
            });
        }
    });


    function doSearch() {
        $('#dgJournal').treegrid('load', {
            page: 1,
            rows: $('#dgJournal').treegrid('options').pageSize
        });
    }

    function expandAll() {
        $('#dgJournal').treegrid('expandAll');
    }

    function collapseAll() {
        $('#dgJournal').treegrid('collapseAll');
    }

    function formatCurrency(value) {
        if (value == null || value == '') return '';
        return 'Rp ' + parseFloat(value).toLocaleString('id-ID', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function submitForm() {
        // Validate details
        var details = $('#detailsGrid').datagrid('getRows');
        if(details.length === 0) {
            $.messager.alert('Warning', 'Please add at least one journal detail');
            return;
        }

        // Check if debit equals credit
        var totalDebit = 0, totalCredit = 0;
        details.forEach(function(detail) {
            totalDebit += parseFloat(detail.debit || 0);
            totalCredit += parseFloat(detail.credit || 0);
        });

        if(totalDebit !== totalCredit) {
            $.messager.alert('Warning', 'Total debit must equal total credit');
            return;
        }

        $('#ff').form('submit', {
            url: url,
            onSubmit: function(param) {
                // Add details to form data
                param.journal_details = JSON.stringify(details);
                return $(this).form('validate');
            },
            success: function(result) {
                var result = JSON.parse(result);
                if (result.errorMsg) {
                    Toast.fire({ icon: 'error', title: result.errorMsg });
                } else {
                    Toast.fire({ icon: 'success', title: result.message });
                    $('#dialog-form').dialog('close'); 
                    $('#dgJournal').treegrid('reload'); 
                }
            }
        });
    }

    function newForm() {
        url = "<?= base_url('journal/create') ?>";
        window.location.href = url;
        
    }

    function editForm() {
        var row = $('#dgJournal').treegrid('getSelected');
        if (row && row.journal_id) {
            $('#dialog-form').dialog('open').dialog('setTitle', 'Edit Journal');
            
            // Load parent data
            $('#ff').form('load', {
                id: row.journal_id,
                journal_date: row.journal_date,
                reference: row.reference,
                description: row.description.split(' (')[0] // Remove count text
            });
            
            // Load details
            $.get("<?= base_url('journal/getJournalDetails') ?>", {
                journal_id: row.journal_id
            }, function(data) {
                $('#detailsGrid').datagrid('loadData', data);
            }, 'json');
            
            url = "<?= base_url('journal/updateJournal') ?>?id=" + row.journal_id;
        } else {
            Toast.fire({ icon: 'warning', title: 'Pilih data dulu' });
        }
    }

    function destroy() {
        var row = $('#dgJournal').treegrid('getSelected');
        if (row && row.journal_id) {
            $.messager.confirm('Confirm', 'Yakin ingin hapus Journal: ' + row.journal_id + '?', function(r) {
                if (r) {
                    $.post("<?= base_url('journal/destroyJournal') ?>", { 
                        id: row.journal_id 
                    }, function(result) {
                        if (result.errorMsg) {
                            Toast.fire({ icon: 'error', title: result.errorMsg });
                        } else {
                            Toast.fire({ icon: 'success', title: result.message });
                            $('#dgJournal').treegrid('reload');
                        }
                    }, 'json');
                }
            });
        } else {
            Toast.fire({ icon: 'warning', title: 'Pilih data dulu' });
        }
    }

    function addDetailRow() {
        $('#detailsGrid').datagrid('appendRow', {
            coa_id: '',
            debit: 0,
            credit: 0
        });
    }

    function removeDetailRow() {
        var row = $('#detailsGrid').datagrid('getSelected');
        if (row) {
            var index = $('#detailsGrid').datagrid('getRowIndex', row);
            $('#detailsGrid').datagrid('deleteRow', index);
        }
    }
</script>