<aside class="main-sidebar sidebar-light-primary elevation-4">
	<a href="#" class="brand-link">
		<img src="<?= base_url() ?>assets/admin/dist/img/Logo4.png" alt="AdminLTE Logo" class="brand-image" style="opacity: 1;">
		<span>&nbsp;</span>
	</a>

	<div class="sidebar">
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= $this->session->userdata('path_foto'); ?>" class="img-square elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block"><?= $this->session->userdata('nama'); ?></a>
			</div>
		</div>

		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-header">Directory</li>
				<li class="nav-item">
					<div id="tree-explorer" class="pl-3 pr-3"></div>
				</li>

				<li class="nav-header">USER</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>admin" class="nav-link">
						<i class="nav-icon fa fa-arrow-left"></i>
						<p>Back</p>
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
	</div>
</aside>

<!-- jsTree CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jstree@3.3.12/dist/themes/default/style.min.css" />
<script src="https://cdn.jsdelivr.net/npm/jstree@3.3.12/dist/jstree.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		$('#tree-explorer').jstree({
			'core': {
				'data': {
					"url": "<?= site_url('explorer/get_tree') ?>",
					"dataType": "json"
				}
			},
			"plugins": ["state"],
			"state": {
				"key": "tree_state_<?= $this->session->userdata('user_id') ?>"
			}
		});

		$('#tree-explorer').on('activate_node.jstree', function (e, data) {
			var href = data.node.a_attr.href;
			if (href && href !== '#') {
				window.location.href = href;
			}
		});
	});
</script>
