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
            Ops, parece que você esqueceu sua senha. <span class="text-secondary">Estamos aqui para te ajudar</span>.
          </h1>
          <a href="https://storyset.com" target="_blank" rel="noopener noreferrer">
            <figure class="hidden lg:block">
              <img class="w-4/5" src="<?= base_url('assets/site/images/illustrations/forgot-password-cuate.svg') ?>" loading="lazy" alt="Illustration forgot password svg" title="Illustration forgot password svg">
            </figure>
          </a>
        </div>
        <div class="lg:col-span-2 p-10 lg:p-0 flex items-center justify-center">
          <div class="xl:w-2/5 bg-white shadow-md rounded-sm p-6">
            <h1 class="text-gray-800 font-medium text-xl">Nova senha</h1>
            <p class="text-gray-600 paragraph text-sm mt-1">Escolha uma senha forte, com números, símbolos, letras maiúsculas e minúsculas.</p>
            <form action="<?= base_url('forgotPassword/newPassword/save') ?>" method="post" class="mt-6 grid grid-cols-1 gap-4">
              <input type="hidden" required name="type" value="<?= $this->input->get('type') ?>">
              <input type="hidden" required name="code" value="<?= isset($code) ? $code : '' ?>">
              <div>
                <label class="input-label">Nova senha</label>
                <input type="password" required name="password" class="input">
                <label class="input-label--error"></label>
              </div>
              <div>
                <label class="input-label">Confirmar nova senha</label>
                <input type="password" required name="password-confirmation" class="input">
                <label class="input-label--error"></label>
              </div>
              <div>
                <button class="w-full btn btn--primary">Salvar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include_once 'application/views/imports/footer.php' ?>
  <?php include_once 'application/views/imports/scripts.php' ?>

  <script type="module">
    import { Alert } from '<?= base_url('assets/site/scripts/Alert/Alert.js') ?>'

    window.addEventListener('load', function () {
      onSubmit()
    })

    function onSubmit () {
      const form = document.querySelector('form')
      
      form.addEventListener('submit', function (event) {
        event.preventDefault()
        
        sendForm(form)
      })
    }

    async function sendForm (form) {
      try {
        const body = new FormData(form)
        const url = form.getAttribute('action')
        
        const response = await fetch(url, {
          method: 'POST',
          body
        }).then(response => response.json())

        const { success, error } = response

        if (!success) {
          showAlert('error', error)
        } else {
          window.location.href = '<?= base_url('entrar') ?>'
        }
      } catch (error) {
        showAlert('error', 'Erro ao enviar e-mail, se continuar entre em contato')
      }
    }
  </script>
</body>
</html>