<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include_once 'application/views/imports/head.php' ?>
</head>
<body class="bg-gray-50">
  <?php include_once 'application/views/imports/header.php' ?>

  <section class="min-h-screen grid place-items-center">
    <div class="h-full max-w-screen-2xl mx-auto">
      <div class="h-full grid grid-cols-1 lg:grid-cols-3">
        <div class="lg:col-span-1 bg-primary p-12">
          <figure>
            <img class="w-20" src="<?= base_url('assets/site/images/company/logo-amarelo-branco.png') ?>" loading="lazy" alt="O Guia Empregos" title="O Guia Empregos">
          </figure>
          <h1 class="mt-14 lg:mb-14 font-medium text-xl md:text-2xl leading-relaxed md:leading-relaxed text-white">
            <span class="text-secondary">E-mail enviado com sucesso</span>. Verifique a sua caixa de entrada, lixeira eletrônica e a caixa de spam.
          </h1>
          <a href="https://storyset.com" target="_blank" rel="noopener noreferrer">
            <figure class="hidden lg:block">
              <img class="w-4/5" src="<?= base_url('assets/site/images/illustrations/forgot-password-cuate.svg') ?>" loading="lazy" alt="Illustration forgot password svg" title="Illustration forgot password svg">
            </figure>
          </a>
        </div>
        <div class="lg:col-span-2 p-10 lg:p-0 flex items-center justify-center">
          <div class="xl:w-2/5 bg-white shadow-md rounded-sm p-6">
            <h1 class="text-gray-800 font-medium text-xl">E-mail enviado</h1>
            <p class="text-gray-600 paragraph text-sm mt-4">
              Enviamos um e-mail com <span class="font-medium">instruções para recuperação de senha.</span>
            </p>
            <p class="text-gray-600 paragraph text-sm my-4">Se não encontrou, verifique na lixeira eletrônica e na caixa de spam.</p>
            <a href="<?= base_url(($this->input->get('type') == 'companies' ? 'empresas/' : '') . 'entrar') ?>">
              <button class="btn btn--primary w-full">Voltar ao Login</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include_once 'application/views/imports/footer.php' ?>
  <?php include_once 'application/views/imports/scripts.php' ?>
</body>
</html>