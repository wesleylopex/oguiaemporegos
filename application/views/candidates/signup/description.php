<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include_once 'application/views/imports/head.php' ?>
</head>
<body>
  <?php include_once 'application/views/imports/header.php' ?>

  <section class="min-h-screen bg-white grid place-items-center">
    <div class="h-full grid grid-cols-1 md:grid-cols-3">
      <div class="md:col-span-1 bg-primary p-12">
        <h1 class="md:mb-14 font-medium text-xl md:text-2xl leading-relaxed md:leading-relaxed text-white">
          Finalize seu cadastro e encontre as oportunidades que <span class="text-secondary">vão mudar a sua vida</span>.
        </h1>
        <a href="https://storyset.com" target="_blank">
          <figure class="hidden md:block">
            <img class="w-4/5" src="<?= base_url('assets/site/images/illustrations/welcome-cuate.svg') ?>" loading="lazy" alt="Illustration welcome png">
          </figure>
        </a>
      </div>
      <div class="md:col-span-2 p-10 md:p-0 flex items-center justify-center">
        <div class="sm:w-2/3 mx-auto">
          <div class="progress-bar w-full h-1 bg-gray-300 rounded-full">
            <div data-percentage="66" class="w-0 transition-all duration-500 progress-bar__percentage h-1 bg-primary rounded-full"></div>
          </div>
          <div class="flex justify-end my-10">
            <a href="<?= base_url('candidates/signup/professionalGoals') ?>">
              <button class="flex items-center hover:underline text-blue-600">
                <span>Pular</span>
                <i class="feather-lg ml-2" data-feather="chevron-right"></i>
              </button>
            </a>
          </div>
          <form action="<?= base_url('candidates/signup/description/save') ?>" method="post" class="mt-10 grid grid-cols-1 gap-4">
            <div>
              <div data-input="textarea[name=description]" data-label=".input-length-counter__label" class="input-length-counter flex items-center justify-between">
                <label class="input-label">Breve descrição sobre você *</label>
                <span class="input-label text-xs">
                  <span class="input-length-counter__label">0</span>
                </span>
              </div>
              <textarea required maxlength="200" name="description" rows="4" class="input"></textarea>
              <label class="input-label--error"></label>
            </div>
            <div class="col-span-full">
              <button class="w-full btn btn--primary">Avançar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php include_once 'application/views/imports/footer.php' ?>
  <?php include_once 'application/views/imports/scripts.php' ?>

  <script type="module">
    import { Alert } from '<?= base_url('assets/site/scripts/Alert/Alert.js') ?>'
    import { InputLengthCounter } from '<?= base_url('assets/site/scripts/InputLengthCounter/InputLengthCounter.js') ?>'

    window.addEventListener('load', function () {
      onSubmit()
      initInputLengthCounter()
    })

    function onSubmit () {
      const form = document.querySelector('form')
      
      form.addEventListener('submit', function (event) {
        event.preventDefault()
        
        save(form)
      })
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
          window.location.href = '<?= base_url('candidates/signup/professionalGoals') ?>'
        }
      } catch (error) {
        showAlert('error', 'Erro ao salvar, tente novamente')
      }
    }

    function initInputLengthCounter () {
      const inputLengthCounter = InputLengthCounter('.input-length-counter')
      inputLengthCounter.init()
    }
  </script>
</body>
</html>