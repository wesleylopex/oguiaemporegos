<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php include_once("application/views/admin/utils/start.php") ?>
</head>

<body class="login">
  <div class="wrapper wrapper-login">
    <div class="container container-login animated fadeIn">
      <div class="login-logo-container">
        <img class="login-logo-image" src="<?= base_url('assets/site/images/airgo-logo-black.png') ?>" loading="lazy" alt="">
      </div>
      <form action="<?= base_url('admin/login/signin') ?>" method="post" class="login-form">
      <div class="form-group form-floating-label">
        <input name="username" type="text" class="form-control input-border-bottom" autocomplete="off" placeholder="Usuário">
      </div>
      <div class="mt-20px form-group form-floating-label">
        <input name="password" type="password" class="form-control input-border-bottom" autocomplete="off" placeholder="Senha">
        <div class="show-password">
          <i class="flaticon-interface"></i>
        </div>
      </div>
      <div class="form-action">
        <button type="submit" class="btn btn-black btn-rounded btn-login">Entrar</button>
      </div>
      </form>
    </div>
  </div>
  <?php include_once("application/views/admin/utils/end.php") ?>
</body>

</html>