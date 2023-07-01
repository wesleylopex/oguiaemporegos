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
          <h1 class="md:mb-14 font-medium text-xl md:text-2xl leading-relaxed md:leading-relaxed text-white">
            Encontre os candidatos certo para <span class="text-secondary">a sua empresa</span>.
          </h1>
          <a href="https://storyset.com" target="_blank">
            <figure class="hidden md:block">
              <img class="w-4/5" src="<?= base_url('assets/site/images/illustrations/welcome-cuate.svg') ?>" loading="lazy" alt="Illustration welcome png">
            </figure>
          </a>
        </div>
        <div class="md:col-span-2 p-10 flex items-center justify-center">
          <div class="sm:w-2/3 mx-auto">
            <div class="flex justify-between items-center my-10">
              <h1 class="text-gray-900 font-medium text-xl leading-relaxed md:leading-relaxed">Informações</h1>
              <a href="<?= base_url($this->session->userdata('company')['username']) ?>">
                <button class="open-language-form-modal flex items-center hover:underline text-blue-600">
                  <span>Pular</span>
                  <i class="feather-lg ml-2" data-feather="chevron-right"></i>
                </button>
              </a>
            </div>
            <form action="<?= base_url('companies/signup/info/save') ?>" method="post" class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="input-label">Latitude</label>
                <input type="text" name="latitude" class="input">
                <label class="input-label--error"></label>
              </div>
              <div>
                <label class="input-label">Longitude</label>
                <input type="text" name="longitude" class="input">
                <label class="input-label--error"></label>
              </div>
              <div class="col-span-full">
                <div class="flex items-center justify-between">
                  <label class="input-label">Breve descrição sobre a empresa *</label>
                  <span class="input-label text-xs">
                    <span id="description-counter">0</span> / 200
                  </span>
                </div>
                <textarea maxlength="200" name="description" rows="4" class="input"></textarea>
                <label class="input-label--error"></label>
              </div>
              <div class="col-span-full">
                <button class="w-full btn btn--primary">Avançar</button>
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
          window.location.href = '<?= base_url($this->session->userdata('company')['username']) ?>'
        }
      } catch (error) {
        showAlert('error', 'Erro ao salvar, tente novamente')
      }
    }

    function initInputLengthCounter () {
      const input = document.querySelector('[name=description]')
      const counter = document.querySelector('#description-counter')
      
      counter.innerText = input.value.length

      input.addEventListener('keydown', () => {
        counter.innerText = input.value.length   
      })
    }
  </script>
</body>
</html>