<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php include_once 'application/views/admin/utils/start.php' ?>
</head>

<body data-background-color="bg3">
	<div class="wrapper">
		<?php include_once 'application/views/admin/utils/header.php' ?>
		<div class="main-panel">
			<div class="content">
				<div class="container-fluid">
					<div class="page-header god-header">
						<h4 class="page-title">E-mails</h4>
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
								E-mails
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
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
                    <btn class="mr-auto btn-excluir d-flex align-items-center justify-content-center" data-toggle="modal" data-target="#confirm-deletion-modal" data-toggles="tooltip" data-placement="bottom" title="Excluir">
                      <i data-feather="trash"></i>
                    </btn>
                    <a href="<?= base_url('admin/emails/create'); ?>">
                      <button class="btn btn-black">
                        <i class="la la-plus"></i>
                      </button>
                    </a>
                  </div>
                </div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="display table table-striped table-hover datatable">
											<thead>
												<tr>
                          <th>Assunto</th>
                          <th>Mensagem</th>
                          <th>Link</th>
                          <th>Enviado em</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($emails as $email) : ?>
													<tr>
														<td><?= $email->subject ?></td>
														<td><?= word_limiter(nl2br($email->message), 14) ?></td>
														<td><?= $email->link ?></td>
														<td><?= date('d/m/Y H:i:s', strtotime($email->created_at)) ?></td>
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
</body>

</html>