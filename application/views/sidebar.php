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

            <!-- Static User Menu -->
            <div class="nav-header mt-3" style="color: #6c757d; font-size: 11px; font-weight: 600; text-transform: uppercase; padding: 0.5rem 1rem;">USER</div>
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link" onclick="openChangePasswordModal()">
                        <i class="nav-icon fa fa-key"></i>
                        <p>Change Password</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>admin/logout" class="nav-link">
                        <i class="nav-icon fa fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
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
        margin-right: 8px;
        width: 16px;
        height: 16px;
        line-height: 16px;
        text-align: center;
    }

    #sidebar-tree .jstree-default .jstree-icon:empty {
        display: none;
    }

    /* Custom icon styling */
    .nav-icon {
        margin-right: 8px;
        width: 16px;
        text-align: center;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        // Build tree data
        var treeData = [];

        <?php
        // Ambil instance CodeIgniter
        $CI = &get_instance();

        // Fungsi rekursif untuk membangun data tree
        function build_tree_data($user_position, $parent_id, $level = 0)
        {
            $CI = &get_instance();
            $items = [];

            if ($level == 0) {
                // Level 0: Main menus
                $menus = $CI->menu_model->getMainMenu($user_position);
            } else {
                // Level > 0: Sub menus
                $menus = $CI->menu_model->getSubMenus($user_position, $parent_id);
            }

            if ($menus->num_rows() > 0) {
                foreach ($menus->result() as $menu) {
                    $has_children = $CI->menu_model->getSubMenus($user_position, $menu->_id)->num_rows() > 0;

                    $item = [
                        'id' => 'menu_' . $menu->_id,
                        'text' => '<i class="nav-icon ' . $menu->icon . '"></i> ' . $menu->title,
                        'state' => ['opened' => false]
                    ];

                    if (!$has_children && !empty($menu->uri)) {
                        $item['a_attr'] = [
                            'href' => base_url($menu->uri),
                            'class' => 'menu-link'
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

        // Generate tree data
        $tree_data = build_tree_data($this->session->userdata('_id'), null, 0);

        // Output as JavaScript
        echo 'treeData = ' . json_encode($tree_data) . ';';
        ?>

        // Initialize jsTree
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
            'plugins': ['wholerow']
        });

        // Handle node click
        $('#sidebar-tree').on('select_node.jstree', function(e, data) {
            var href = data.node.a_attr.href;
            if (href && href !== '#') {
                window.location.href = href;
            }
        });

        // Handle node open/close animation
        $('#sidebar-tree').on('open_node.jstree close_node.jstree', function(e, data) {
            // Optional: Add custom animation or behavior
        });

        // Password toggle functionality
        $('.toggle-password').click(function() {
            var fieldId = $(this).data('target');
            var input = $('#' + fieldId);
            var icon = $(this).find('i');

            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fas fa-eye').addClass('fas fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fas fa-eye-slash').addClass('fas fa-eye');
            }
        });
    });

    function openChangePasswordModal() {
        $('#dlgChangePassword').dialog('open');
    }

    function submitChangePassword() {
        var formData = $('#frmChangePassword').serialize();

        $.post("<?= base_url('admin/change_password') ?>", formData, function(response) {
            if (response.success) {
                $.messager.alert('Success', 'Password successfully changed!', 'info');
                $('#dlgChangePassword').dialog('close');
                $('#frmChangePassword')[0].reset();
            } else {
                $.messager.alert('Error', response.message, 'error');
            }
        }, 'json');
    }

    // Function to highlight current page in tree
    function setActiveMenuItem() {
        var currentUrl = window.location.href;
        $('#sidebar-tree a[href="' + currentUrl + '"]').closest('.jstree-node').addClass('jstree-clicked');
    }

    // Call after tree is loaded
    $('#sidebar-tree').on('ready.jstree', function() {
        setActiveMenuItem();
    });
</script>