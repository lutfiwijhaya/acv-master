<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/icon/Logo2.png" />
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-12/css/all.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/sweetalert2/sweetalert2.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/chat.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/easyui/themes/material/easyui.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<!-- jQuery (WAJIB terlebih dahulu) -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- jQuery UI (baru setelah jQuery) -->
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
	<!--  -->

	<!-- <?php
	foreach ($css_files as $file) { ?> -->
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<!-- <?php } ?> -->

	<!-- <?php foreach ($js_files as $file) { ?> -->
		<script src="<?php echo $file; ?>"></script>
	<!-- <?php } ?> -->
	<style type="text/css">
		.textbox-label {
			width: 120px;
		}

		.datagrid-cell {
			font-size: 12x;
		}

		

		#resizable-sidebar {
			resize: horizontal;
			overflow: auto;
			min-width: 200px;
			max-width: 500px;
			position: fixed;
			top: 0;
			left: 0;
			height: 100vh;
			z-index: 1030;
			overflow: auto;
			/* tetap di atas konten */
		}

		.content-wrapper {
			margin-left: 250px;
			/* default sesuai sidebar awal */
			transition: margin-left 0.2s ease;
		}


		#tree-explorer {
			font-size: 14px;
			/* ukuran teks folder */
		}

		#tree-explorer .jstree-icon {
			width: 17px;
			height: 17px;
		}

		#tree-explorer .jstree-anchor {
			padding: 50px 50px;
		}

		#tree-explorer .jstree-node {
			margin-left: 10px;
			/* jarak indentasi */
		}

		#tree-explorer .jstree-anchor {
			line-height: 16px;
			padding: 1px 2px;
		}

		#tree-explorer {
			padding-left: 0 !important;
			margin-left: 0 !important;
		}

		#tree-explorer .jstree-container-ul {
			margin-left: 0px;
			/* bisa diubah jadi 0 jika ingin sangat rapat */
			padding-left: 0;
		}

		#tree-explorer .jstree-node {
			margin-left: 5 !important;
		}
	</style>


	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
			</ul>

			<!-- SEARCH FORM -->

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<!-- Messages Dropdown Menu -->

				<!-- Notifications Dropdown Menu -->
				<li class="nav-item">
					<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
						<i class="fas fa-th-large"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<?php $this->load->view(isset($sidebar) ? $sidebar : 'sidebar'); ?>
		<!-- Content Wrapper. Contains page content -->
		<div id="main-content" class="content-wrapper">
			<?php echo $contents ?>
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<strong>Copyright &copy; 2025 <a href="#">PT. Achivon Prestasi Abadi</a>.</strong>
			All rights reserved.
			<div class="float-right d-none d-sm-inline-block">
				<b>Version</b> 1.0.0
			</div>
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->


	<!-- Bootstrap -->
	<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="<?php echo base_url(); ?>assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- SweetAlert2 -->
	<script src="<?php echo base_url(); ?>assets/admin/plugins/sweetalert2/sweetalert2.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url(); ?>assets/admin/dist/js/adminlte.js"></script>


	<script type="text/javascript">
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			let lastSelectedId = localStorage.getItem("last_selected_node");

			$('#tree-explorer').jstree({
				'core': {
					'data': {
						"url": "<?= site_url('explorer/get_tree') ?>",
						"dataType": "json"
					}
				},
				"plugins": ["state", "wholerow"], // tambahkan wholerow agar highlight full baris
				"state": {
					"key": "tree_state_<?= $this->session->userdata('user_id') ?>"
				}
			});

			// Aktifkan kembali node terakhir setelah jsTree selesai load
			$('#tree-explorer').on('loaded.jstree', function(e, data) {
				if (lastSelectedId) {
					const tree = $('#tree-explorer').jstree(true);
					tree.deselect_all();
					tree.select_node(lastSelectedId);
					tree.open_node(lastSelectedId); // buka node
				}
			});

			// Simpan node terakhir yang diklik
			$('#tree-explorer').on('activate_node.jstree', function(e, data) {
				var node_id = data.node.id;
				var href = data.node.a_attr.href;

				// Simpan ke localStorage
				localStorage.setItem("last_selected_node", node_id);

				// Redirect
				if (href && href !== '#') {
					window.location.href = href;
				}
			});
		});
	</script>

</body>

</html>