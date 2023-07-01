<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php include_once("application/views/admin/utils/start.php") ?>
</head>

<body data-background-color="bg3">
	<div class="wrapper">
		<?php include_once("application/views/admin/utils/header.php") ?>
		<div class="main-panel">
			<div class="content">
				<div class="container-fluid">
					<div class="page-header god-header">
						<h4 class="page-title"><?= $names['plural'] ?></h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="<?= site_url("admin") ?>">
									home
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<?= $names['plural'] ?>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<?php if ($names['link'] == 'candidates') : ?>
									<div class="card-header">
										<div class="row">
											<div class="col-md-12">
												<h6 class="page-title">Filtros</h6>
											</div>
											<div class="col-md-2">
												<label class="d-flex align-items-center">
													Idade mínima
												</label>
												<input id="min-age-field" type="text" class="form-control" placeholder="Idade mínima">
											</div>
											<div class="col-md-2">
												<label class="d-flex align-items-center">
													Idade máxima
												</label>
												<input id="max-age-field" type="text" class="form-control" placeholder="Idade máxima">
											</div>
											<div class="col-md-2">
												<label class="d-flex align-items-center">
													Por gênero
												</label>
												<div>
													<select class="form-control select2" id="genre-select">
														<option value="-1">Todos</option>
														<option value="Masculino">Masculino</option>
														<option value="Feminino">Feminino</option>
														<option value="Outro">Outro</option>
													</select>
												</div>
											</div>
											<div class="col-md-2">
												<label class="d-flex align-items-center">
													Por área
												</label>
												<div>
													<select class="form-control select2" id="desired-area-select">
														<option value="-1">Todas</option>
														<?php foreach ($jobsAreas as $area) : ?>
															<option value="<?= $area->title ?>"><?= $area->title ?></option>
														<?php endforeach ?>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<label class="d-flex align-items-center">
													Por cidade
												</label>
												<div>
													<input id="input-filter-city" placeholder="Digite uma cidade" type="text" class="form-control" id="desired-area-select" />
												</div>
											</div>
										</div>
									</div>
								<?php endif ?>

								<?php if ($permissions['create'] || $permissions['delete'] || $this->session->flashdata('errors') || $this->session->flashdata('success')) : ?>
									<div class="card-header">
										<?php if ($this->session->flashdata('errors')) : ?>
											<div class="mb-4 alert alert-danger d-flex align-items-center justify-content-between" role="alert">
												<?= $this->session->flashdata('errors') ?>
												<i class="close" data-feather="x"></i>
											</div>
										<?php endif ?>
										<?php if ($this->session->flashdata('success')) : ?>
											<div class="mb-4 alert alert-success d-flex align-items-center justify-content-between" role="alert">
												<?= $this->session->flashdata('success') ?>
												<i class="close" data-feather="x"></i>
											</div>
										<?php endif ?>
										<div class="d-flex align-items-center justify-content-end">
											<?php if ($permissions['delete']) : ?>
												<btn class="mr-auto btn-excluir d-flex align-items-center justify-content-center" data-toggle="modal" data-target="#confirm-deletion-modal" data-toggles="tooltip" data-placement="bottom" title="Excluir">
													<i data-feather="trash"></i>
												</btn>
											<?php endif ?>
											<?php if ($permissions['create']) : ?>
												<a href="<?= base_url('admin/' . $names['link'] . '/create'); ?>">
													<button class="btn btn-black">
														<i class="la la-plus"></i>
													</button>
												</a>
											<?php endif ?>
										</div>
									</div>
								<?php endif ?>
								<div class="card-body">
									<div class="table-responsive">
										<table class="display table table-striped table-hover datatable">
											<thead>
												<tr>
													<?php if ($permissions['delete']) : ?>
														<th>
															<div class="custom-control custom-checkbox">
																<input type="checkbox" class="custom-control-input" id="select-all">
																<label class="custom-control-label" for="select-all"></label>
															</div>
														</th>
													<?php endif; ?>
													<?php foreach ($fields as $field) : ?>
														<?php if (isset($field["showOnTable"]) && $field["showOnTable"]) : ?>
															<th><?= $field['label'] ?></th>
														<?php endif ?>
													<?php endforeach ?>
													<?php if ($names['link'] == 'candidates') : ?>
														<th>Idade</th>
													<?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($records as $record) : ?>
													<tr id="<?= $record->id ?>">
														<?php if ($permissions['delete']) : ?>
															<td width="48" class="not-clickable">
																<?php if ($permissions['delete']) : ?>
																	<div class="custom-control custom-checkbox">
																		<input type="checkbox" class="custom-control-input" id="check<?= $record->id ?>">
																		<label class="custom-control-label" for="check<?= $record->id ?>"></label>
																	</div>
																<?php endif ?>
															</td>
														<?php endif ?>
														<?php foreach ($fields as $key => $field) : ?>
															<?php if (isset($field["showOnTable"]) && $field["showOnTable"]) : ?>
																<td class="<?= array_key_exists('editableOnTable', $field) && $field['editableOnTable'] ? 'not-clickable' : '' ?>">
																	<?php if (array_key_exists('isFeatherIcons', $field) && $field['isFeatherIcons']) : ?>
																		<?php if ($record->{$field['name']}) : ?>
																			<i data-feather="<?= $record->{$field['name']} ?>"></i>
																		<?php endif ?>
																	<?php elseif (array_key_exists('fromDataBase', $field) && $field['fromDataBase']) : ?>
																		<?php if (array_key_exists('editableOnTable', $field) && $field['editableOnTable']) : ?>
																			<?= form_dropdown($field['name'], $field['options'], $record->{$field['name']}, ['style' => 'width: fit-content', 'class' => 'form-control select2 editable-on-table', 'record-id' => $record->id]) ?>
																		<?php else : ?>
																			<?= isset($record->{$field['name']}) ? $record->{$field['name']}['selectText'] : '' ?>
																		<?php endif ?>
																	<?php elseif ($field['type'] == 'select') : ?>
																		<?php if (array_key_exists('editableOnTable', $field) && $field['editableOnTable']) : ?>
																			<?= form_dropdown($field['name'], $field['options'], $record->{$field['name']}, ['style' => 'width: fit-content', 'class' => 'form-control select2 editable-on-table', 'record-id' => $record->id]) ?>
																		<?php else : ?>
																			<?= array_key_exists($record->{$field['name']}, $field['options']) ? $field['options'][$record->{$field['name']}] : '' ?>
																		<?php endif ?>
																	<?php elseif ($field['type'] == 'date') : ?>
																		<?= $record->{$field['name']} ? date('d/m/Y', strtotime($record->{$field['name']})) : null ?>
																	<?php elseif ($field['type'] == 'month') : ?>
																		<?= $record->{$field['name']} ? date('m/Y', strtotime($record->{$field['name']})) : null ?>
																	<?php elseif ($field['type'] == 'color') : ?>
																		<div class="small-rectangle" style="background-color: <?= $record->{$field['name']}; ?>"></div>
																	<?php elseif ($field['type'] == 'image') : ?>
																		<img class="img-upload-preview" width="150" src="<?= isset($record) ? base_url('assets/uploads/images/' . $uploadFolder . ($uploadFolder ? '/' : '') . $record->{$field['name']}) : '' ?>" loading="lazy" alt="">
																	<?php else : ?>
																		<?php if (array_key_exists('editableOnTable', $field) && $field['editableOnTable']) : ?>
																			<input type="<?= $field['type'] ?>" record-id="<?= $record->id ?>" class="form-control editable-on-table" name="<?= $field['name'] ?>" value="<?= $record->{$field['name']} ?>">
																		<?php else : ?>
																			<?= $record->{$field['name']} ?>
																		<?php endif ?>
																	<?php endif ?>
																</td>
															<?php endif ?>
														<?php endforeach ?>
														<?php if ($names['link'] == 'candidates') : ?>
															<td>
																<?= $record->age ?>
															</td>
														<?php endif ?>
													</tr>
												<?php endforeach ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
  <?php include_once 'application/views/admin/modals/confirm-deletion.php' ?>
	<?php include_once 'application/views/admin/utils/end.php' ?>
	
	<script>
		$(document).ready(function () {
			removeFirstArrowsFromThead()
			selectAll()

			editRegister()
			onConfirmDeletion()

			onEditableFieldsChange()

			filterByAge()
			filterBySelect('#genre-select')
			filterBySelect('#desired-area-select')
			filterBySelect('#input-filter-city', 'input')
			filterBySelect('#stars-select')
			closeAlert()
		});

		function closeAlert () {
			const alert = document.querySelector('.alert')
			if (!alert) return null
			const close = alert.querySelector('.close')
			close.addEventListener('click', () => {
				alert.remove()
			})
		}

		function onEditableFieldsChange () {
			$(document).on('change', '.editable-on-table', function () {
				const recordId = $(this).attr('record-id')
				const fieldName = $(this).attr('name')
				const fieldValue = $(this).val()

				const url = `${base_url}admin/<?= $names['link'] ?>/saveFromTable`
				const data = {
					recordId,
					fieldName,
					fieldValue 
				}
				ajaxSubmit(url, data)
			})
		}

		function ajaxSubmit (url, data) {
      $.ajax({
        url,
        type: 'post',
        dataType: 'json',
        cache: false,
        data,
        success (response) {
					const { success, errors } = response
					if (errors) {
						showAlert('danger', errors, 'la la-times')
					} else {
						showAlert('primary', 'Registro editado com sucesso.', 'la la-check')
					}
        },
        error (error) {
          console.log(error)
        }
      })
    }

		function filterBySelect (selector, type = 'select') {
			const link = '<?= $names['link']; ?>'

			if (link != 'candidates') return

			const table = $('.datatable').DataTable();
		 
			if(type === 'select') {
				$(selector).change(table.draw);
			} else {
				$(selector).keyup(table.draw);
			}
		}

		const citySearch = (settings, data, dataIndex) =>
			filterDatatableBySelect(settings, data, dataIndex, '#input-filter-city', 4, 'input')
		$.fn.dataTable.ext.search.push(citySearch);
		
		const desiredAreaSearch = (settings, data, dataIndex) =>
			filterDatatableBySelect(settings, data, dataIndex, '#desired-area-select', 5)
		$.fn.dataTable.ext.search.push(desiredAreaSearch);

		const genreSearch = (settings, data, dataIndex) =>
			filterDatatableBySelect(settings, data, dataIndex, '#genre-select', 3)
		$.fn.dataTable.ext.search.push(genreSearch);
		
		const starSearch = (settings, data, dataIndex) =>
			filterDatatableBySelect(settings, data, dataIndex, '#stars-select', 1)
		$.fn.dataTable.ext.search.push(starSearch);

		function filterDatatableBySelect (seetings, data, dataIndex, selector, dataPosition, type = 'select') {
			const select = $(selector)

			if (select.length <= 0) return true

			const selectedValue = select.val()
			const tableValue = data[dataPosition] || '';

			if (type === 'select') {
				if (tableValue == selectedValue || selectedValue == -1)
					return true;
			} else if (tableValue.toLowerCase().includes(selectedValue.toLowerCase()))
				return true
					
			return false;
		}

		function filterByAge () {
			const link = '<?= $names['link']; ?>'

			if (link != 'candidates') return

			const table = $('.datatable').DataTable();
     
			$('#min-age-field, #max-age-field').keyup(function () {
				table.draw();
			});
		}

		$.fn.dataTable.ext.search.push(
    	function (settings, data, dataIndex) {
				const minAgeField = $('#min-age-field')
				const maxAgeField = $('#max-age-field')

				if (minAgeField.length <= 0 || maxAgeField.length <= 0) return true

        const min = parseInt(minAgeField.val(), 10);
        const max = parseInt(maxAgeField.val(), 10);
        const age = parseFloat( data[6] ) || 0; // use data for the age column
 
        if ((isNaN(min) && isNaN(max)) ||
					(isNaN( min ) && age <= max) ||
					(min <= age && isNaN( max)) ||
					(min <= age && age <= max)) {
            return true;
        }
        return false;
    	}
		)

		function editRegister () {
			$('table').on('click', 'td:not(.not-clickable)', function() {
				const id = $(this).closest('tr').attr('id')
				const link = '<?= $names['link'] ?>'
				const canUpdate = '<?= $permissions['update'] ?>'

				if (canUpdate) window.location.href = `${base_url}admin/${link}/update/${id}`
			})
		}

		function onConfirmDeletion () {
			const buttonConfirmDeletion = document.querySelector('#btn-confirm-deletion')
			buttonConfirmDeletion.addEventListener('click', () => {
				closeConfirmDeletionModal()
				deleteRecords()
			})
		}

		function closeConfirmDeletionModal () {
			const modal = $('#confirm-deletion-modal')
			modal.modal('hide')
		}

		function deleteRecords () {
			const checkboxes = $('.datatable tbody input[type=checkbox]').toArray()
			const id = []
			const trs = []

			$(checkboxes).each(function () {
				if ($(this).prop('checked')) {
					id.push($(this).closest('tr').attr('id'))
					trs.push($(this).closest('tr'))
				}
			})

			if (id.length == 0)
				showAlert('default', 'Nenhum registro selecionado', 'la la-trash')
			else {
				$.ajax({
					method: 'POST',
					url: '<?= site_url('admin/' . $names['link'] . '/delete'); ?>',
					data: {
						id: id
					},
					success (result) {
						fadeOutRows(trs)
						$('#select-all').prop('checked', false)

						showAlert('default', `${id.length} registro(s) excluído(s).`, 'la la-trash')
					}
				})
			}
		}

		function fadeOutRows (trs) {
			const table = $('.datatable').DataTable()

			$(trs).each(function () {
				$(this).fadeOut('slow', function() {
					table.row($(this)).remove().draw();
				})
			})
		}

		function selectAll () {
			$('#select-all').click(function () {
				const checkboxes = $('.datatable tr td input[type=checkbox]')
				checkboxes.prop('checked', $(this).prop('checked'))
			})
			$('.datatable tr td input[type=checkbox]').click(function () {
				if ($(this).prop('checked') == false)
					$('#select-all').prop('checked', false)
			})
		}

		function removeFirstArrowsFromThead () {
			$('thead th').first().removeClass('sorting_desc')
		}
	</script>
</body>

</html>