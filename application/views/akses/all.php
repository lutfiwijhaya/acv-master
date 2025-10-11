<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4>User Access Management</h4>

            <!-- === TOOLBAR === -->
            <div style="padding: 10px; margin-bottom: 10px; margin-left: 15px; background: #f5f5f5; border-radius: 4px;">
                <a href="javascript:void(0);" onclick="selectAllRead()" class="btn-action">Select All Read</a>
                <a href="javascript:void(0);" onclick="selectAllWrite()" class="btn-action">Select All Write</a>
                <a href="javascript:void(0);" onclick="deselectAll()" class="btn-action">Deselect All</a>
                <a href="javascript:void(0);" onclick="saveAccess()" class="btn-action" style="color:#28a745; font-weight:bold;">Save Access</a>

                <!-- Dropdown kategori menu -->
                <select id="menuCategory" onchange="changeCategory()" style="margin-left:20px; padding:5px;">
                    <option value="">-- Select Category --</option>
                </select>
            </div>

            <!-- === TABLE === -->
            <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped" style="min-width:1000px;">
                    <thead>
                        <tr id="categoryHeader">
                            <th rowspan="2" style="min-width:200px;">User</th>
                        </tr>
                        <tr id="menuHeader"></tr>
                    </thead>
                    <tbody id="userRows"></tbody>
                </table>
            </div>

            <!-- === PAGINATION === -->
            <div id="pagination" style="margin-top: 15px; text-align: center;"></div>
        </div>
    </div>
</div>

<style>
/* Wrapper agar tabel bisa discroll ke samping */
.table-wrapper {
    width: 100%;
    overflow-x: auto;
    overflow-y: auto;
    max-height: 70vh; /* biar tabel panjang tidak makan layar */
    position: relative;
}

/* Table dasar */
.table {
    border-collapse: collapse;
    min-width: 1000px;
    width: max-content; /* biar kolom tidak dipaksa ngepas */
}

/* Freeze kolom "User" (kiri) */
.table td.user-cell,
.table th:first-child {
    position: sticky;
    left: 0;
    background: #fff;
    z-index: 5;
    min-width: 200px;
    border-right: 1px solid #dee2e6;
}

/* Freeze header (atas) */
.table thead th {
    position: sticky;
    top: 0;
    background: #f8f9fa;
    z-index: 8;
    border: 1px solid #dee2e6;
}

/* Style untuk parent category */
.table thead th.category-col {
    background: #e9ecef;
    font-weight: bold;
    text-align: center;
    border: 1px solid #dee2e6;
}

/* Style untuk menu column */
.table thead th.menu-col {
    background: #f8f9fa;
    text-align: center;
    vertical-align: middle;
    border: 1px solid #dee2e6;
}

/* Style untuk access cell */
.table td.access-cell {
    text-align: center;
    vertical-align: middle;
    padding: 8px;
    min-width: 120px;
}

.table td.access-cell label {
    display: block;
    margin: 2px 0;
    font-size: 13px;
}

/* Supaya header User (pojok kiri atas) tetap paling depan */
.table thead th:first-child {
    z-index: 10;
}

/* Responsive adjustment */
@media (max-width: 768px) {
    .table {
        font-size: 12px;
        min-width: 600px;
    }
    th, td {
        padding: 5px;
    }
}

</style>

<script>
var usersData = [];
var menusData = [];
var currentPage = 1;
var pageSize = 10;
var currentCategoryId = "";

// === Load Dropdown Menu Category ===
function loadMenus() {
    $.ajax({
        url: "<?= base_url('user/getMenus') ?>",
        type: "POST",
        data: { segment: 'root' },
        dataType: "json",
        success: function(response) {
            var options = '<option value="">-- Select Category --</option>';
            response.forEach(function(parent) {
                options += '<option value="' + parent.id + '">' + parent.text + '</option>';
            });
            $('#menuCategory').html(options);
        },
        error: function() {
            alert('Gagal memuat kategori menu');
        }
    });
}

// === Change Category (ambil menu + users) ===
function changeCategory() {
    var categoryId = $('#menuCategory').val();
    currentCategoryId = categoryId;

    if (categoryId === "") {
        $('#categoryHeader').find("th:not(:first)").remove();
        $('#menuHeader').empty();
        // tetap tampilkan user walau kategori kosong
        loadUsers();
        return;
    }

    // Ambil menu sesuai kategori
    $.ajax({
        url: "<?= base_url('user/getMenus') ?>",
        type: "POST",
        data: { segment: categoryId },
        dataType: "json",
        success: function(response) {
            menusData = response;

            if (!menusData || menusData.length === 0) {
                $('#categoryHeader').find("th:not(:first)").remove();
                $('#menuHeader').empty();
                $('#userRows').html('<tr><td colspan="100" style="text-align:center; padding:20px;">No menu found for this category</td></tr>');
                return;
            }

            // Build header recursive (FIXED)
            var res = buildHeaderRecursive(menusData);

            // Reset header
            $('#categoryHeader').find("th:not(:first)").remove();
            $('#categoryHeader').append(res.categoryRow);
            $('#menuHeader').html(res.menuRow);

            // Load users (page 1)
            currentPage = 1;
            loadUsers();
        },

        error: function() {
            alert('Gagal memuat menu');
        }
    });
}

// === Load Users (paginated) ===
function loadUsers() {
    $.ajax({
        url: "<?= base_url('user/getUsers') ?>",
        type: "POST",
        data: { 
            page: currentPage, 
            rows: pageSize, 
            sort: "tbl_user._id", 
            order: "ASC",
            category_id: currentCategoryId
        },
        dataType: "json",
        success: function(response) {
            usersData = response.rows || [];
            renderUserRows();
            updatePagination(response.total);
        },
        error: function() {
            alert('Gagal memuat user');
        }
    });
}

// === Header Recursive Builder (FIXED) ===
function buildHeaderRecursive(children) {
    var categoryRow = '';
    var menuRow = '';

    children.forEach(function(child) {
        if (child.children && child.children.length > 0) {
            // Parent node dengan children → tampil di baris kategori dengan colspan
            var totalLeaf = countLeafNodes(child);
            categoryRow += '<th colspan="' + totalLeaf + '" class="category-col" style="text-align:center; background:#e9ecef; font-weight:bold; border:1px solid #dee2e6;">' + child.text + '</th>';

            // Children-nya tampil di baris menu (baris kedua)
            child.children.forEach(function(subChild) {
                menuRow += '<th class="menu-col" style="text-align:center; vertical-align:middle; background:#f8f9fa; border:1px solid #dee2e6;">' + subChild.text + '</th>';
            });
        } else {
            // Leaf node tanpa children → merge 2 baris (rowspan 2)
            categoryRow += '<th rowspan="2" class="menu-col" style="text-align:center; vertical-align:middle; background:#f8f9fa; font-weight:bold; border:1px solid #dee2e6;">' + child.text + '</th>';
        }
    });

    return { categoryRow, menuRow };
}

function countLeafNodes(menu) {
    if (!menu.children || menu.children.length === 0) {
        return 1;
    }
    var count = 0;
    menu.children.forEach(function(child) {
        count += countLeafNodes(child);
    });
    return count;
}

// === Render Rows User + Access ===
function renderUserRows() {
    var html = '';

    if (usersData.length === 0) {
        $('#userRows').html('<tr><td colspan="100" style="text-align:center; padding:20px;">No users found</td></tr>');
        return;
    }

    usersData.forEach(function(user) {
        html += '<tr>';
        html += '<td class="user-cell">';
        html += '<span class="name">' + user.nama + '</span>';
        html += '</td>';

        if (menusData && menusData.length > 0) {
            html += renderAccessCellsRecursive(menusData, user);
        }

        html += '</tr>';
    });

    $('#userRows').html(html);
}

// === Render Access Recursive ===
function renderAccessCellsRecursive(children, user) {
    var html = '';
    children.forEach(function(child) {
        if (child.children && child.children.length > 0) {
            // Jika ada children, render access untuk setiap child
            child.children.forEach(function(subChild) {
                var menuId = subChild.id;
                var userId = user._id;
                var currentAccess = "";

                if (user.access && user.access[menuId]) {
                    currentAccess = user.access[menuId];
                }

                html += '<td class="access-cell" style="text-align:center; vertical-align:middle; border:1px solid #dee2e6;">';
                html += '<label style="display:block; margin:2px 0;"><input type="radio" name="access_' + userId + '_' + menuId + '" value="none" ' + (currentAccess === "" ? 'checked' : '') + '> None</label>';
                html += '<label style="display:block; margin:2px 0;"><input type="radio" name="access_' + userId + '_' + menuId + '" value="read" ' + (currentAccess === "read" ? 'checked' : '') + '> Read</label>';
                html += '<label style="display:block; margin:2px 0;"><input type="radio" name="access_' + userId + '_' + menuId + '" value="write" ' + (currentAccess === "write" ? 'checked' : '') + '> Write</label>';
                html += '</td>';
            });
        } else {
            // Jika tidak ada children, render access untuk menu ini
            var menuId = child.id;
            var userId = user._id;
            var currentAccess = "";

            if (user.access && user.access[menuId]) {
                currentAccess = user.access[menuId];
            }

            html += '<td class="access-cell" style="text-align:center; vertical-align:middle; border:1px solid #dee2e6;">';
            html += '<label style="display:block; margin:2px 0;"><input type="radio" name="access_' + userId + '_' + menuId + '" value="none" ' + (currentAccess === "" ? 'checked' : '') + '> None</label>';
            html += '<label style="display:block; margin:2px 0;"><input type="radio" name="access_' + userId + '_' + menuId + '" value="read" ' + (currentAccess === "read" ? 'checked' : '') + '> Read</label>';
            html += '<label style="display:block; margin:2px 0;"><input type="radio" name="access_' + userId + '_' + menuId + '" value="write" ' + (currentAccess === "write" ? 'checked' : '') + '> Write</label>';
            html += '</td>';
        }
    });
    return html;
}

// === Save Access ===
function saveAccess() {
    var accessData = [];
    if (currentCategoryId === "") {
        alert("Pilih kategori menu terlebih dahulu!");
        return;
    }

    usersData.forEach(function(user) {
        var userId = user._id;
        collectAccessRecursive(menusData, userId, accessData);
    });

    if (accessData.length === 0) {
        alert('Tidak ada akses yang dipilih');
        return;
    }

    $.ajax({
        url: "<?= base_url('user/saveAkses') ?>",
        type: "POST",
        data: { access_data: accessData },
        dataType: "json",
        success: function(result) {
            if (result.success) {
                alert('Access saved successfully!');
                loadUsers();
            } else {
                alert('Failed: ' + result.message);
            }
        },
        error: function() {
            alert('Gagal menyimpan akses');
        }
    });
}

function collectAccessRecursive(children, userId, accessData) {
    children.forEach(function(child) {
        if (child.children && child.children.length > 0) {
            // Jika parent punya children, collect access dari children-nya
            child.children.forEach(function(subChild) {
                var menuId = subChild.id;
                var radioName = 'access_' + userId + '_' + menuId;
                var checkedRadio = $('input[name="' + radioName + '"]:checked');

                if (checkedRadio.length > 0) {
                    var val = checkedRadio.val();
                    accessData.push({
                        menu_id: menuId,
                        user_id: userId,
                        access: (val === "none" ? "" : val)
                    });
                }
            });
        } else {
            // Jika tidak ada children, collect access dari menu ini
            var menuId = child.id;
            var radioName = 'access_' + userId + '_' + menuId;
            var checkedRadio = $('input[name="' + radioName + '"]:checked');

            if (checkedRadio.length > 0) {
                var val = checkedRadio.val();
                accessData.push({
                    menu_id: menuId,
                    user_id: userId,
                    access: (val === "none" ? "" : val)
                });
            }
        }
    });
}

// === Select All / Deselect ===
function selectAllRead() { $('input[value="read"]').prop('checked', true); }
function selectAllWrite() { $('input[value="write"]').prop('checked', true); }
function deselectAll() { $('input[value="none"]').prop('checked', true); }

// === Pagination ===
function updatePagination(total) {
    var totalPages = Math.ceil(total / pageSize);
    var html = '';

    if (totalPages > 1) {
        for (var i = 1; i <= totalPages; i++) {
            html += '<a href="javascript:void(0);" onclick="gotoPage(' + i + ')" style="margin:0 5px;' + (i === currentPage ? 'font-weight:bold;' : '') + '">' + i + '</a>';
        }
    }

    $('#pagination').html(html);
}

function gotoPage(page) {
    currentPage = page;
    loadUsers();
}

// === Init ===
$(document).ready(function() {
    loadUsers();   // default langsung tampilkan user list
    loadMenus();   // isi dropdown kategori
});
</script>