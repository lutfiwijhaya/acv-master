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

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <?php
                // Ambil instance CodeIgniter untuk bisa memanggil model di dalam fungsi
                $CI = &get_instance();

                // INI ADALAH FUNGSI REKURSIF
                function build_menu($user_position, $parent_id)
                {
                    $CI = &get_instance(); // Panggil instance lagi di dalam fungsi

                    // Ambil semua menu anak dari parent_id ini
                    $submenus = $CI->menu_model->getSubMenus($user_position, $parent_id);

                    // Jika ada anak, looping
                    if ($submenus->num_rows() > 0) {
                        foreach ($submenus->result() as $menu) {
                            // Cek lagi, apakah menu ini punya anak?
                            $has_children = $CI->menu_model->getSubMenus($user_position, $menu->_id)->num_rows() > 0;

                            if ($has_children) {
                                // JIKA PUNYA ANAK, buat dropdown
                                echo '<li class="nav-item has-treeview">';
                                echo '<a href="#" class="nav-link">';
                                echo '<i class="nav-icon ' . $menu->icon . '"></i>';
                                echo '<p>' . $menu->title . '<i class="fas fa-angle-left right"></i></p>';
                                echo '</a>';
                                echo '<ul class="nav nav-treeview">';

                                // Panggil fungsi ini lagi untuk membangun cucu-cucunya
                                build_menu($user_position, $menu->_id);

                                echo '</ul>';
                                echo '</li>';
                            } else {
                                // JIKA TIDAK PUNYA ANAK, buat link biasa
                                echo '<li class="nav-item">';
                                echo '<a href="' . base_url($menu->uri) . '" class="nav-link">';
                                echo '<i class="nav-icon ' . $menu->icon . '"></i>';
                                echo '<p>' . $menu->title . '</p>';
                                echo '</a>';
                                echo '</li>';
                            }
                        }
                    }
                }

                // PANGGILAN AWAL: Ambil menu level 1
                $main_menus = $CI->menu_model->getMainMenu($this->session->userdata('_id'));
                foreach ($main_menus->result() as $main) {
                    // Cek apakah menu utama ini punya anak?
                    $has_children = $CI->menu_model->getSubMenus($this->session->userdata('_id'), $main->_id)->num_rows() > 0;

                    if ($has_children) {
                        // JIKA PUNYA ANAK, buat dropdown
                        echo '<li class="nav-item has-treeview">';
                        echo '<a href="#" class="nav-link">';
                        echo '<i class="nav-icon ' . $main->icon . '"></i>';
                        echo '<p>' . $main->title . '<i class="fas fa-angle-left right"></i></p>';
                        echo '</a>';
                        echo '<ul class="nav nav-treeview">';

                        // Panggil fungsi rekursif untuk membangun anak-anaknya
                        build_menu($this->session->userdata('_id'), $main->_id);

                        echo '</ul>';
                        echo '</li>';
                    } else {
                        // JIKA TIDAK PUNYA ANAK, buat link biasa
                        echo '<li class="nav-item">';
                        echo '<a href="' . base_url($main->uri) . '" class="nav-link">';
                        echo '<i class="nav-icon ' . $main->icon . '"></i>';
                        echo '<p>' . $main->title . '</p>';
                        echo '</a>';
                        echo '</li>';
                    }
                }

                ?>

                <li class="nav-header">USER</li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link" onclick="openChangePasswordModal()">
                        <i class="nav-icon fa fa-key"></i>
                        <p>Change Password</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>admin/logout" class="nav-link">
                        <i class="nav-icon fa fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


<!-- <div id="dlgChangePassword" class="easyui-dialog" title="Change Password" closed="true" modal="true" buttons="#dlg-buttons" style="width: 400px; padding: 15px;">
    <form id="frmChangePassword">
        <div class="input-group mb-3">
            <label style="width: 100%;">Old Password:</label>
            <input type="password" id="old_password" class="form-control" placeholder="Old Password" name="old_password" required>
            <div class="input-group-append">
                <div class="input-group-text toggle-password" data-target="old_password">
                    <i class="fas fa-eye"></i>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <label style="width: 100%;">New Password:</label>
            <input type="password" id="new_password" class="form-control" placeholder="New Password" name="new_password" required>
            <div class="input-group-append">
                <div class="input-group-text toggle-password" data-target="new_password">
                    <i class="fas fa-eye"></i>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <label style="width: 100%;">Confirm Password:</label>
            <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
            <div class="input-group-append">
                <div class="input-group-text toggle-password" data-target="confirm_password">
                    <i class="fas fa-eye"></i>
                </div>
            </div>
        </div>
    </form>
</div> -->

<!-- <div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitChangePassword()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#dlgChangePassword').dialog('close')">Cancel</a>
</div> -->

<script type="text/javascript">
    $(document).ready(function() {
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
</script>