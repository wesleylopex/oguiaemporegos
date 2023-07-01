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
            Estamos muito felizes que você está aqui. <span class="text-secondary">Faça seu login</span>.
          </h1>
          <a href="https://storyset.com" target="_blank" rel="noopener noreferrer">
            <figure class="hidden lg:block">
              <img class="w-4/5" src="<?= base_url('assets/site/images/illustrations/welcome-cuate.svg') ?>" loading="lazy" alt="Illustration welcome png" title="Illustration welcome png">
            </figure>
          </a>
        </div>
        <div class="lg:col-span-2 p-10 lg:p-0 flex items-center justify-center">
          <div class="xl:w-2/5 bg-white shadow-md rounded-sm p-6">
            <h1 class="text-gray-900 font-medium text-xl md:text-2xl leading-relaxed md:leading-relaxed">Login</h1>
            <p class="paragraph text-sm mt-1">Ainda não possui cadastro? <a href="<?= base_url('cadastro') ?>" class="text-blue-600 hover:underline">Crie sua conta</a></p>
            <form action="<?= base_url('candidates/login/login') ?>" method="post" class="mt-10 grid grid-cols-1 gap-6">
              <div>
                <label class="input-label">E-mail</label>
                <input type="email" required name="email" class="input">
                <label class="input-label--error"></label>
              </div>
              <div>
                <div class="flex items-center justify-between">
                  <label class="input-label">Senha</label>
                  <a href="<?= base_url('esqueceu-senha?type=candidates') ?>" class="hover:underline text-sm block text-blue-600">Esqueceu a senha?</a>
                </div>
                <input type="password" required name="password" class="input">
                <label class="input-label--error"></label>
              </div>
              <div>
                <button class="w-full btn btn--primary">Entrar</button>
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
        
        login(form)
      })
    }

    async function login (form) {
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
          window.location.href = '<?= base_url('candidates/profile') ?>'
        }
      } catch (error) {
        showAlert('error', 'Erro ao logar, se continuar entre em contato')
      }
    }
  </script>
</body>
</html>