<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include_once 'application/views/imports/head.php' ?>
</head>
<body>
  <?php include_once 'application/views/imports/header.php' ?>

  <section class="min-h-screen bg-white grid place-items-center">
    <div class="h-full max-w-screen-2xl mx-auto">
      <div class="h-full grid grid-cols-1 md:grid-cols-3">
        <div class="md:col-span-1 bg-primary p-12">
          <figure>
            <img class="w-20" src="<?= base_url('assets/site/images/company/logo-amarelo-branco.png') ?>" loading="lazy" alt="O Guia Empregos">
          </figure>
          <h1 class="mt-14 md:mb-14 font-medium text-xl md:text-2xl leading-relaxed md:leading-relaxed text-white">
            Cadastre a sua empresa. <span class="text-secondary">É rápido e fácil</span>.
          </h1>
          <a href="https://storyset.com" target="_blank">
            <figure class="hidden md:block">
              <img class="w-4/5" src="<?= base_url('assets/site/images/illustrations/career-progress-cuate.svg') ?>" loading="lazy" alt="Illustration welcome png">
            </figure>
          </a>
        </div>
        <div class="md:col-span-2 p-10 md:p-0 flex items-center justify-center">
          <div class="sm:w-1/2 xl:w-2/5 mx-auto">
            <h1 class="text-gray-900 font-medium text-xl leading-relaxed md:leading-relaxed">Cadastro de empresas</h1>
            <p class="paragraph">Já possui cadastro? <a href="<?= base_url('empresas/entrar') ?>" class="text-blue-600 underline font-medium"> Faça login</a></p>
            <form action="<?= base_url('companies/signup/signup/save') ?>" method="post" class="mt-10 grid grid-cols-1 gap-4">
              <div>
                <label class="input-label">Nome da empresa</label>
                <input type="text" required name="name" class="input">
                <label class="input-label--error"></label>
              </div>
              <div>
                <label class="input-label">Nome de usuário</label>
                <span class="text-gray-400 text-xs">(letras, números, traço (-) e underline (_))</span>
                <input type="text" required name="username" class="input">
                <label class="input-label--error"></label>
              </div>
              <div>
                <label class="input-label">E-mail</label>
                <input type="email" required name="email" class="input">
                <label class="input-label--error"></label>
              </div>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="input-label">Senha</label>
                  <input type="password" required name="password" class="input">
                  <label class="input-label--error"></label>
                </div>
                <div>
                  <label class="input-label">Confirmar senha</label>
                  <input type="password" required name="password_confirmation" class="input">
                  <label class="input-label--error"></label>
                </div>
              </div>
              <div>
                <button class="w-full btn btn--primary">Avançar</button>
              </div>
              <div class="px-1">
                <p class="text-sm paragraph text-center text-gray-500">
                  Ao clicar em Avançar, você declara que leu e concorda com os <a href="<?= base_url('termos-de-uso') ?>" class="text-blue-600 underline">Termos de Uso</a>.
                </p>
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
      generateAutoUsername()
    })

    function onSubmit () {
      const form = document.querySelector('form')
      
      form.addEventListener('submit', function (event) {
        event.preventDefault()
        
        const passwordMatch = checkPasswordMatch()
        const isUsernameValid = checkUsernameValidity()

        if (passwordMatch && isUsernameValid) {
          save(form)
        }
      })
    }

    function checkPasswordMatch () {
      const password = document.querySelector('[name=password]').value
      const passwordConfirmation = document.querySelector('[name=password_confirmation]').value

      if (password !== passwordConfirmation) {
        showAlert('warning', 'As senhas não conferem')
        return false
      }

      return true
    }

    function checkUsernameValidity () {
      const username = document.querySelector('[name=username]').value
      const regex = /^(\w|\.|-)+$/gi

      const isValid = regex.test(username)

      if (!isValid) {
        showAlert('warning', 'Nome de usuário inválido')
        return false
      }
      
      return true
    }

    async function save (form) {
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
          window.location.href = '<?= base_url('companies/signup/info') ?>'
        }
      } catch (error) {
        showAlert('error', 'Erro ao se cadastrar, tente novamente')
      }
    }

    function generateAutoUsername () {
      const name = document.querySelector('[name=name]')
      const username = document.querySelector('[name=username]')

      name.addEventListener('blur', () => {
        if (name.value) {
          username.value = slugify(name.value)
        }
      })
    }
  </script>
</body>
</html>