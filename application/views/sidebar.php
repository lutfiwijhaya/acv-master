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
				<!--<li class="nav-item">-->
				<!--	<a href="<?= base_url('admin'); ?>" class="nav-link <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == '') ? 'active' : '' ?>">-->
				<!--		<i class="nav-icon fas fa-tachometer-alt"></i>-->
				<!--		<p>Dashboard</p>-->
				<!--	</a>-->
				<!--</li>-->
				<?php
				$menu = $this->menu_model->getMenus($this->session->userdata('posisi'));
				foreach ($menu->result() as $row) :
					$submenu = $this->menu_model->getSubMenus($this->session->userdata('posisi'), $row->_id);
					if ($submenu->num_rows() > 0) { ?>
						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon <?= $row->icon; ?>"></i>
								<p>
									<?= $row->title; ?>
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<?php foreach ($submenu->result() as $sub) :
									$submenu2 = $this->menu_model->getSubMenus($this->session->userdata('posisi'), $sub->menu_id);
									if ($submenu2->num_rows() > 0) { ?>
										<li class="nav-item">
											<a href="#" class="nav-link">
												<i class="<?= $sub->icon; ?> nav-icon"></i>
												<p><?= $sub->title; ?></p>
												<i class="fas fa-angle-left right"></i>
											</a>
											<ul class="nav nav-treeview">
												<?php foreach ($submenu2->result() as $sub2) : ?>
													<li class="nav-item">
														<a href="<?= base_url($sub2->uri); ?>" class="nav-link">
															<i class="<?= $sub2->icon; ?> nav-icon"></i>
															<p><?= $sub2->title; ?></p>
														</a>
													</li>
												<?php endforeach; ?>
											</ul>
										</li>
									<?php } else { ?>
										<li class="nav-item">
											<a href="<?= base_url($sub->uri); ?>" class="nav-link">
												<i class="<?= $sub->icon; ?> nav-icon"></i>
												<p><?= $sub->title; ?></p>
											</a>
										</li>
								<?php }
								endforeach; ?>
							</ul>
						</li>
					<?php } else { ?>
						<li class="nav-item">
							<a href="<?= base_url($row->uri); ?>" class="nav-link">
							<!-- <a href="<?= base_url('admin/#'); ?>" class="nav-link"> -->
								<i class="nav-icon <?= $row->icon; ?>"></i>
								<p><?= $row->title; ?></p>
							</a>
						</li>
				<?php }
				endforeach; ?>
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


<div id="dlgChangePassword" class="easyui-dialog" title="Change Password" closed="true" modal="true" buttons="#dlg-buttons" style="width: 400px; padding: 15px;">
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
</div>

<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitChangePassword()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#dlgChangePassword').dialog('close')">Cancel</a>
</div>

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