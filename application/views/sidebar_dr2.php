<style>
	/* Pastikan menu jsTree muncul di atas semua elemen lain */
	.vakata-context {
		z-index: 999999 !important;
	}

	/* Kalau terpotong karena sidebar, izinkan overflow
	.sidebar {
		overflow: visible !important;
	} */
</style>


<aside id="resizable-sidebar" class="main-sidebar sidebar-light-primary elevation-4">
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
					<a href="<?= base_url() ?>admin/logout" class="nav-link" id="logout-btn">
						<i class="nav-icon fa fa-sign-out-alt"></i>
						<p>Logout</p>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</aside>
<div id="sidebar-resizer"></div>

<!-- jsTree CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jstree@3.3.12/dist/themes/default/style.min.css" />
<script src="https://cdn.jsdelivr.net/npm/jstree@3.3.12/dist/jstree.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('a[data-widget="pushmenu"]').hide();
		let clipboardNode = null;
		let clipboardMode = null; // "copy" atau "cut"
		$('#tree-explorer').jstree({
			'core': {
				'check_callback': true,
				'multiple': false,
				'data': {
					"url": "<?= site_url('explorer/get_tree') ?>",
					"dataType": "json"
				}
			},
			"plugins": ["state", "contextmenu", "hotkeys", "dnd"],
			"contextmenu": {
				"items": function(node) {
					return {
						"create": {
							"label": "Create",
							"action": function() {
								const tree = $('#tree-explorer').jstree(true);
								const parent = node; // node yang di-klik kanan
								const parent_id = parent.id;
								// buat node sementara
								const newNode = tree.create_node(parent, {
									text: "Node Baru"
								}, "last");
								// langsung edit
								tree.edit(newNode, null, function(newNodeObj, status, cancelled) {
									if (!cancelled) {
										$.post("<?= base_url('admin/saveDirectory') ?>", {
											id_parent: parent_id,
											name: newNodeObj.text
										}, function(res) {
											let data = JSON.parse(res);
											if (data.id) {
												tree.set_id(newNodeObj, data.id);
												Toast.fire({
													icon: 'success', // Ubah 'type' menjadi 'icon'
													title: 'Succes Create Directory'
												});
											} else {
												Toast.fire({
													icon: 'error', // Ubah 'type' menjadi 'icon'
													title: 'Failed'
												});
												tree.delete_node(newNodeObj);
											}
										}).fail(function() {
											Toast.fire({
												icon: 'error', // Ubah 'type' menjadi 'icon'
												title: 'Server Error'
											});
											tree.delete_node(newNodeObj);
										});
									} else {
										tree.delete_node(newNode);
									}
								});
							}
						},
						"rename": {
							"label": "Rename",
							"action": function() {
								const tree = $('#tree-explorer').jstree(true);
								tree.edit(node, null, function(updatedNode, status, cancelled) {
									if (!cancelled) {
										$.ajax({
											url: "<?= base_url('admin/updatenamedirectory') ?>?id=" + updatedNode.id,
											method: "POST",
											data: {
												name: updatedNode.text
											},
											success: function(res) {
												let data = JSON.parse(res);
												if (data.message) {
													Toast.fire({
														icon: 'success',
														title: 'Rename Success'
													});
												} else {
													Toast.fire({
														icon: 'error',
														title: data.errorMsg || 'Rename Failed'
													});
													tree.refresh(); // rollback biar balik ke nama lama
												}
											},
											error: function() {
												Toast.fire({
													icon: 'error',
													title: 'Server Error'
												});
												tree.refresh();
											}
										});
									}
								});
							}
						},
						"delete": {
							"label": "Delete",
							"action": function(data) {
								const tree = $('#tree-explorer').jstree(true);
								const targetNode = node; // node yang diklik kanan

								if (targetNode) {
									$.messager.confirm('Confirm', 'Delete "' + targetNode.text + '"?', function(r) {
										if (r) {
											$.ajax({
												url: "<?= base_url('admin/destroydirectory') ?>",
												type: "POST",
												data: {
													ids: [targetNode.id]
												}, // ← kirim array, cocok dengan controllermu
												dataType: "json",
												success: function(response) {
													if (response.success) {
														tree.delete_node(targetNode); // hapus node dari UI
														$('#dgGrid').datagrid('reload');
														$('#dgGrid').datagrid('clearSelections');
														Toast.fire({
															icon: 'success',
															title: response.message
														});
													} else {
														Toast.fire({
															icon: 'error',
															title: response.message
														});
													}
												},
												error: function() {
													Toast.fire({
														icon: 'error',
														title: 'An error occurred while deleting data.'
													});
												}
											});
										}
									});
								}
							}
						},
						"cut": {
							"label": "Cut",
							"action": function() {
								clipboardNode = {
									text: node.text,
									id: node.id
								};
								clipboardMode = "cut";
								Toast.fire({
									icon: 'info',
									title: 'Selected: ' + clipboardNode.text
								});
							}
						},
						"paste": {
							"label": "Paste",
							"_disabled": (!clipboardNode),
							"action": function() {
								const tree = $('#tree-explorer').jstree(true);

								if (clipboardNode && clipboardMode === "cut") {
									$.ajax({
										url: "<?= base_url('admin/move_directory') ?>",
										type: "POST",
										data: {
											move_ids: [clipboardNode.id], // ← sesuai backend: array
											target_tree: node.id // node tujuan
										},
										dataType: "json",
										success: function(res) {
											if (res.success) {
												tree.move_node(clipboardNode.id, node, "last");
												Toast.fire({
													icon: 'success',
													title: res.message || 'Move Success'
												});
												$('#dgGrid').datagrid('reload');
												// reset clipboard
												clipboardNode = null;
												clipboardMode = null;
											} else {
												Toast.fire({
													icon: 'error',
													title: res.message || 'Move Failed'
												});
												clipboardNode = null;
												clipboardMode = null;
											}
										},
										error: function() {
											Toast.fire({
												icon: 'error',
												title: 'Server error while moving directory.'
											});
											clipboardNode = null;
											clipboardMode = null;
										}
									});
								}
							}
						}


					};
				}
			}

		});




		// Shortcut untuk Create
		$(document).on('keydown', function(e) {
			if (e.ctrlKey && e.shiftKey && e.key === 'C') { // Ctrl+Shift+C
				e.preventDefault();
				const tree = $('#tree-explorer').jstree(true);
				const selected = tree.get_selected(true)[0]; // ambil node yang dipilih
				if (selected) {
					const parent_id = selected.id;
					const newNode = tree.create_node(selected, {
						text: "Node Baru"
					}, "last");
					tree.edit(newNode, null, function(newNodeObj, status, cancelled) {
						if (!cancelled) {
							$.post("<?= base_url('admin/saveDirectory') ?>", {
								id_parent: parent_id,
								name: newNodeObj.text
							}, function(res) {
								let data = JSON.parse(res);
								if (data.id) {
									tree.set_id(newNodeObj, data.id);
									Toast.fire({
										icon: 'success',
										title: 'Succes Create Directory'
									});
								} else {
									Toast.fire({
										icon: 'error',
										title: 'Failed'
									});
									tree.delete_node(newNodeObj);
								}
							}).fail(function() {
								Toast.fire({
									icon: 'error',
									title: 'Server Error'
								});
								tree.delete_node(newNodeObj);
							});
						} else {
							tree.delete_node(newNode);
						}
					});
				} else {
					Toast.fire({
						icon: 'warning',
						title: 'Pilih parent node dulu!'
					});
				}
			}
		});

		// Shortcut Rename pakai F2
		$(document).on('keydown', function(e) {
			if (e.key === "F2") {
				e.preventDefault();
				const tree = $('#tree-explorer').jstree(true);
				const selected = tree.get_selected(true)[0]; // node terpilih
				if (selected) {
					tree.edit(selected, null, function(updatedNode, status, cancelled) {
						if (!cancelled) {
							$.ajax({
								url: "<?= base_url('admin/updatenamedirectory') ?>?id=" + updatedNode.id,
								method: "POST",
								data: {
									name: updatedNode.text
								},
								success: function(res) {
									let data = JSON.parse(res);
									if (data.message) {
										Toast.fire({
											icon: 'success',
											title: 'Rename Success'
										});
									} else {
										Toast.fire({
											icon: 'error',
											title: data.errorMsg || 'Rename Failed'
										});
										tree.refresh(); // rollback ke nama lama
									}
								},
								error: function() {
									Toast.fire({
										icon: 'error',
										title: 'Server Error'
									});
									tree.refresh();
								}
							});
						}
					});
				} else {
					Toast.fire({
						icon: 'warning',
						title: 'Pilih node dulu untuk rename'
					});
				}
			}
		});

		// Hotkey Delete untuk hapus node di jsTree
		$(document).on('keydown', function(e) {
			if (e.key === "Delete") {
				e.preventDefault();
				const tree = $('#tree-explorer').jstree(true);
				const selected = tree.get_selected(true)[0]; // ambil node terpilih

				if (selected) {
					$.messager.confirm('Confirm', 'Delete "' + selected.text + '"?', function(r) {
						if (r) {
							$.ajax({
								url: "<?= base_url('admin/destroydirectory') ?>",
								type: "POST",
								data: {
									ids: [selected.id] // ← sesuai controller
								},
								dataType: "json",
								success: function(response) {
									if (response.success) {
										tree.delete_node(selected); // hapus dari UI
										$('#dgGrid').datagrid('reload');
										$('#dgGrid').datagrid('clearSelections');
										Toast.fire({
											icon: 'success',
											title: response.message
										});
									} else {
										Toast.fire({
											icon: 'error',
											title: response.message
										});
									}
								},
								error: function() {
									Toast.fire({
										icon: 'error',
										title: 'An error occurred while deleting data.'
									});
								}
							});
						}
					});
				} else {
					Toast.fire({
						icon: 'error',
						title: 'Please select a node to delete.'
					});
				}
			}
		});



		// Hotkeys: Cut (Ctrl+X) & Paste (Ctrl+V)
		$(document).keydown(function(e) {
			const tree = $('#tree-explorer').jstree(true);
			const selected = tree.get_selected(true)[0]; // ambil node yang sedang dipilih

			// --- CUT (Ctrl+X) ---
			if (e.ctrlKey && e.key.toLowerCase() === 'x') {
				if (selected) {
					clipboardNode = {
						id: selected.id,
						text: selected.text
					};
					clipboardMode = "cut";
					Toast.fire({
						icon: 'info',
						title: "Cut: " + clipboardNode.text
					});
				} else {
					Toast.fire({
						icon: 'warning',
						title: 'No node selected to cut.'
					});
				}
				e.preventDefault();
			}

			// --- PASTE (Ctrl+V) ---
			if (e.ctrlKey && e.key.toLowerCase() === 'v') {
				if (clipboardNode && clipboardMode === "cut") {
					const target = selected; // paste ke node yang dipilih saat ini
					if (target) {
						$.ajax({
							url: "<?= base_url('admin/move_directory') ?>",
							type: "POST",
							data: {
								move_ids: [clipboardNode.id], // ← sesuaikan dengan backend: array
								target_tree: target.id
							},
							dataType: "json",
							success: function(res) {
								console.log("AJAX response:", res);

								if (res.success) {
									tree.move_node(clipboardNode.id, target, "last");
									Toast.fire({
										icon: 'success',
										title: res.message || 'Move Success'
									});
									$('#dgGrid').datagrid('reload');
								} else {
									Toast.fire({
										icon: 'error',
										title: res.message || 'Move Failed'
									});
								}

								// reset clipboard
								clipboardNode = null;
								clipboardMode = null;
							},
							error: function() {
								Toast.fire({
									icon: 'error',
									title: 'Server error while moving directory.'
								});
								clipboardNode = null;
								clipboardMode = null;
							}
						});
					} else {
						Toast.fire({
							icon: 'warning',
							title: 'Please select a target folder to paste.'
						});
					}
				} else {
					Toast.fire({
						icon: 'warning',
						title: 'Clipboard empty, nothing to paste.'
					});
				}
				e.preventDefault();
			}
		});



		// Hanya sekali klik langsung buka
		$('#tree-explorer').on('select_node.jstree', function(e, data) {
			var node_id = data.node.id;
			var node_text = data.node.text; // ini ambil nama node
			var dg = $('#dgGrid');
			var dg_file = $('#dgGrid_file');
			parent = node_id;

			// update H1 sesuai node yang dipilih
			$('#tree-title').text(node_text);

			// --- lanjutkan logika reload ---
			if (getWithExpiry("tree_expiry_<?= $this->session->userdata('user_id') ?>") === null) {
				const tree = $('#tree-explorer').jstree(true);
				localStorage.removeItem('tree_expiry_<?= $this->session->userdata('user_id') ?>');
				localStorage.removeItem('last_selected_node');
				tree.deselect_all();
			}

			setWithExpiry("last_selected_node", node_id, 30);
			setWithExpiry("tree_expiry_<?= $this->session->userdata('user_id') ?>", true, 30);

			dg.datagrid('options').url = "<?= base_url('admin/get_dr_tree/') ?>" + encodeURIComponent(node_id);
			dg_file.datagrid('options').url = "<?= base_url('admin/get_dr_file_tree/') ?>" + encodeURIComponent(node_id);

			dg.datagrid('reload');
			dg_file.datagrid('reload');
		});


		// Aktifkan kembali node terakhir setelah jsTree selesai load

		$('#tree-explorer').on('loaded.jstree', function(e, data) {
			let lastSelectedId = getWithExpiry("last_selected_node");
			if (lastSelectedId) {
				const tree = $('#tree-explorer').jstree(true);
				tree.deselect_all();
				tree.select_node(lastSelectedId);
				tree.open_node(lastSelectedId);

				// update judul H1
				let node = tree.get_node(lastSelectedId);
				if (node) {
					$('#tree-title').text(node.text);
				}
			}
		});



		// Logout clear state
		$('#logout-btn').on('click', function(e) {
			e.preventDefault();
			window.location.href = $(this).attr('href');
		});


	});
</script>


<script>
	$(function() {
		const sidebar = document.getElementById('resizable-sidebar');
		const resizer = document.getElementById('sidebar-resizer');
		const content = document.querySelector('.content-wrapper');
		const footer = document.querySelector('.main-footer');
		let isResizing = false;
		// Restore lebar dari localStorage saat load
		const savedWidth = localStorage.getItem('sidebar_width');
		if (savedWidth) {
			sidebar.style.width = savedWidth + 'px';
			resizer.style.left = savedWidth + 'px';
			content.style.marginLeft = savedWidth + 'px';
			footer.style.marginLeft = savedWidth + 'px'; // tambahkan ini
		}


		// Saat klik dan drag resizer
		resizer.addEventListener('mousedown', function(e) {
			isResizing = true;
			document.body.style.cursor = 'ew-resize';
		});

		document.addEventListener('mousemove', function(e) {
			if (!isResizing) return;
			let newWidth = e.clientX;
			if (newWidth < 200) newWidth = 200;
			if (newWidth > 500) newWidth = 500;
			sidebar.style.width = newWidth + 'px';
			resizer.style.left = newWidth + 'px';
			content.style.marginLeft = newWidth + 'px';
			footer.style.marginLeft = newWidth + 'px'; // tambahkan ini
			// Simpan ke localStorage
			localStorage.setItem('sidebar_width', newWidth);
		});

		document.addEventListener('mouseup', function() {
			isResizing = false;
			document.body.style.cursor = 'default';
		});

		// Fix ketika pushmenu collapse
		$(document).on('collapsed.lte.pushmenu', function() {
			content.style.marginLeft = '80px';
			resizer.style.left = '80px';
			footer.style.marginLeft = '80px'; // tambahkan ini

		});

		$(document).on('shown.lte.pushmenu', function() {
			const width = sidebar.offsetWidth;
			content.style.marginLeft = width + 'px';
			resizer.style.left = width + 'px';
			footer.style.marginLeft = width + 'px'; // tambahkan ini

		});
	});
</script>