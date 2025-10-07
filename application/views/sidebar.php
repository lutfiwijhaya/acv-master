<aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href=# class="brand-link">
        <img src="<?= base_url() ?>assets/admin/dist/img/Logo4.png" alt="AdminLTE Logo" class="brand-image" style="opacity: 1;">
        <span>&nbsp;</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src=<?= $this->session->userdata('path_foto'); ?> class="img-square elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $this->session->userdata('nama'); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu with jsTree -->
        <nav class="mt-2">
            <div id="sidebar-tree"></div>

            <!-- <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <a href="<?= base_url() ?>admin/logout" class="nav-link">
                        <i class="nav-icon fa fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul> -->
        </nav>
    </div>
</aside>

<!-- jsTree CSS dan JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js"></script>

<!-- Custom CSS untuk styling jsTree agar sesuai dengan AdminLTE -->
<style>
    #sidebar-tree {
        background: transparent;
        padding: 0;
    }

    #sidebar-tree .jstree-default .jstree-anchor {
        color: #c2c7d0;
        padding: 8px 16px;
        border-radius: 0.25rem;
        margin: 1px 8px;
        display: flex;
        align-items: center;
    }

    #sidebar-tree .jstree-default .jstree-anchor:hover,
    #sidebar-tree .jstree-default .jstree-anchor:focus {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        text-decoration: none;
    }

    #sidebar-tree .jstree-default .jstree-clicked {
        background: #007bff !important;
        color: #fff !important;
        box-shadow: none;
    }

    #sidebar-tree .jstree-default .jstree-node {
        margin: 0;
        padding: 0;
    }

    .jstree-default .jstree-node {
        min-height: 24px;
        line-height: 24px;
        margin-left: 5px !important;
        min-width: 24px
    }

    .os-content {
        padding: 0px 0px !important;
    }

    #sidebar-tree .jstree-default .jstree-children {
        padding-left: 0;
        background: rgba(255, 255, 255, 0.05);
    }

    #sidebar-tree .jstree-default .jstree-children .jstree-anchor {
        padding-left: 40px;
        font-size: 0.9em;
    }

    #sidebar-tree .jstree-default .jstree-children .jstree-children .jstree-anchor {
        padding-left: 60px;
    }

    #sidebar-tree .jstree-default .jstree-ocl {
        color: #c2c7d0;
        margin-right: 5px;
    }

    #sidebar-tree .jstree-default .jstree-icon {
        display: none !important;
    }

    /* Sembunyikan icon di dalam text */
    #sidebar-tree .nav-icon {
        display: none !important;
    }

    /* Loading spinner overlay */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        backdrop-filter: blur(2px);
    }

    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 5px solid #f3f3f3;
        border-top: 5px solid #007bff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .loading-text {
        margin-top: 15px;
        color: #007bff;
        font-weight: 500;
        text-align: center;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .loading-overlay.hidden {
        display: none;
    }
</style>

<!-- Loading Overlay HTML -->
<div id="loadingOverlay" class="loading-overlay hidden">
    <div>
        <div class="loading-spinner"></div>
        <div class="loading-text">Memuat halaman...</div>
    </div>
</div>

<script type="text/javascript">
    function showLoading() {
        $('#loadingOverlay').removeClass('hidden');
        console.log('Loading shown');
    }

    function hideLoading() {
        $('#loadingOverlay').addClass('hidden');
        console.log('Loading hidden');
    }

    function loadPage(url) {
        console.log('Loading page:', url);
        showLoading();

        if ($('#main-content-container').length === 0) {
            console.error('Container #main-content-container tidak ditemukan!');
            hideLoading();
            window.location.href = url;
            return;
        }

        $.ajax({
            url: url,
            type: 'GET',
            timeout: 30000,
            success: function(data, textStatus, xhr) {
                console.log('AJAX Success:', textStatus);
                $('#main-content-container').html(data);

                if (window.history && window.history.pushState) {
                    window.history.pushState({
                        path: url
                    }, '', url);
                }

                hideLoading();
                $(document).trigger('pageLoaded', [url]);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                hideLoading();

                if (status === 'timeout') {
                    alert('Halaman terlalu lama dimuat. Silakan coba lagi.');
                } else if (status !== 'abort') {
                    alert('Gagal memuat halaman: ' + error + '. Halaman akan dimuat ulang.');
                    window.location.href = url;
                }
            }
        });
    }

    $(document).ready(function() {
        console.log('Document ready, initializing sidebar...');

        var treeData = [];

        <?php
        $CI = &get_instance();
        function build_tree_data($user_position, $parent_id, $level = 0)
        {
            $CI = &get_instance();
            $items = [];
            if ($level == 0) {
                $menus = $CI->menu_model->getMainMenu($user_position);
            } else {
                $menus = $CI->menu_model->getSubMenus($user_position, $parent_id);
            }
            if ($menus->num_rows() > 0) {
                foreach ($menus->result() as $menu) {
                    $has_children = $CI->menu_model->getSubMenus($user_position, $menu->_id)->num_rows() > 0;
                    $item = [
                        'id' => 'menu_' . $menu->_id,
                        'text' => $menu->title, // Hanya text, tanpa icon
                    ];
                    if (!$has_children && !empty($menu->uri)) {
                        $item['a_attr'] = [
                            'href' => base_url($menu->uri),
                            'class' => 'menu-link ajax-link',
                            'data-url' => base_url($menu->uri)
                        ];
                    }
                    if ($has_children) {
                        $item['children'] = build_tree_data($user_position, $menu->_id, $level + 1);
                    }
                    $items[] = $item;
                }
            }
            return $items;
        }
        $tree_data = build_tree_data($this->session->userdata('_id'), null, 0);
        echo 'treeData = ' . json_encode($tree_data) . ';';
        ?>

        console.log('Tree data:', treeData);

        $('#sidebar-tree').jstree({
            'core': {
                'data': treeData,
                'themes': {
                    'name': false,
                    'dots': false,
                    'icons': false
                },
                'animation': 150
            },
            'plugins': ['wholerow', 'state'],
            'state': {
                'key': 'sidebar_tree_state'
            }
        });

        $('#sidebar-tree').on('click', '.jstree-anchor', function(e) {
            console.log('Menu clicked');

            var tree = $('#sidebar-tree').jstree(true);
            var node = tree.get_node(this);

            e.preventDefault();
            e.stopPropagation();

            var href = $(this).attr('href');
            var dataUrl = $(this).attr('data-url');
            var url = dataUrl || href;

            console.log('URL to load:', url);
            console.log('Has ajax-link class:', $(this).hasClass('ajax-link'));

            if (url && url !== '#' && url !== 'javascript:void(0);' && $(this).hasClass('ajax-link')) {
                tree.select_node(node);
                loadPage(url);
            } else {
                console.log('Toggling node');
                tree.toggle_node(node);
            }
        });

        $(window).on('popstate', function(e) {
            if (e.originalEvent.state && e.originalEvent.state.path) {
                loadPage(e.originalEvent.state.path);
            }
        });

        console.log('Sidebar initialization complete');
    });

    function setActiveMenuItem() {
        var currentUrl = window.location.href;
        var tree = $('#sidebar-tree').jstree(true);

        if (tree) {
            var allNodes = tree.get_json('#', {
                flat: true
            });
            $.each(allNodes, function(i, node) {
                var nodeUrl = node.a_attr && node.a_attr['data-url'];
                if (nodeUrl === currentUrl) {
                    tree.select_node(node.id);
                    var parents = tree.get_path(node, false, true);
                    if (parents) {
                        tree.open_node(parents);
                    }
                    return false;
                }
            });
        }
    }

    $('#sidebar-tree').on('ready.jstree', function() {
        console.log('Tree ready, setting active menu');
        setActiveMenuItem();
    });

    function openChangePasswordModal() {
        $('#dlgChangePassword').dialog('open');
    }

    function submitChangePassword() {
        var formData = $('#frmChangePassword').serialize();
        $.post("<?= base_url('admin/change_password') ?>", formData, function(response) {
            if (response.success) {
                alert('Password successfully changed!');
                $('#dlgChangePassword').dialog('close');
                $('#frmChangePassword')[0].reset();
            } else {
                alert('Error: ' + response.message);
            }
        }, 'json');
    }

    function testAjaxLoad() {
        console.log('Testing AJAX load...');
        if ($('#main-content-container').length > 0) {
            console.log('Container found!');
            loadPage('<?= base_url("admin/dashboard") ?>');
        } else {
            console.log('Container NOT found!');
        }
    }

    console.log('Script loaded successfully');
</script>