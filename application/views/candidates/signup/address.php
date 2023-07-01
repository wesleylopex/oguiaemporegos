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
            Finalize seu cadastro e encontre as oportunidades que <span class="text-secondary">vão mudar a sua vida</span>.
          </h1>
          <a href="https://storyset.com" target="_blank">
            <figure class="hidden md:block">
              <img class="w-4/5" src="<?= base_url('assets/site/images/illustrations/welcome-cuate.svg') ?>" loading="lazy" alt="Illustration welcome png">
            </figure>
          </a>
        </div>
        <div class="md:col-span-2 p-10 flex items-center justify-center">
          <div class="sm:w-2/3 mx-auto">
            <div class="progress-bar w-full h-1 bg-gray-300 rounded-full">
              <div data-percentage="50" class="w-0 transition-all duration-500 progress-bar__percentage h-1 bg-primary rounded-full"></div>
            </div>
            <h1 class="mt-10 text-gray-900 font-medium text-xl md:text-2xl leading-relaxed md:leading-relaxed">Endereço</h1>
            <form action="<?= base_url('candidates/signup/address/save') ?>" method="post" class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="input-label">CEP *</label>
                <input type="text" required name="address_zip_code" class="zip-code input">
                <label class="input-label--error"></label>
              </div>
              <div>
                <label class="input-label">Rua *</label>
                <input type="text" required name="address_street" class="input">
                <label class="input-label--error"></label>
              </div>
              <div>
                <label class="input-label">Número *</label>
                <input type="text" required name="address_number" class="input">
                <label class="input-label--error"></label>
              </div>
              <div>
                <label class="input-label">Bairro *</label>
                <input type="text" required name="address_neighborhood" class="input">
                <label class="input-label--error"></label>
              </div>
              <div class="col-span-full">
                <label class="input-label">Complemento</label>
                <input type="text" name="address_complement" class="input">
              </div>
              <div>
                <label class="input-label">UF *</label>
                <input type="text" required name="address_uf" class="input">
                <label class="input-label--error"></label>
              </div>
              <div>
                <label class="input-label">Cidade *</label>
                <input type="text" required name="address_city" class="input">
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
  <script src="https://cdn.jsdelivr.net/npm/cep-promise/dist/cep-promise.min.js"></script>

  <script type="module">
    import { Alert } from '<?= base_url('assets/site/scripts/Alert/Alert.js') ?>'

    window.addEventListener('load', function () {
      onSubmit()
      onSetZipCode()
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
          window.location.href = '<?= base_url('candidates/signup/description') ?>'
        }
      } catch (error) {
        showAlert('error', 'Erro ao salvar, tente novamente')
      }
    }

    function validZipCode (zipCode) {
      const cleanZipCode = zipCode.replace(/[^0-9]/g, '')
      return (/^[0-9]{8}$/).test(cleanZipCode)
    }

    function onSetZipCode () {
      const zipCodeField = document.querySelector('[name=address_zip_code]')
      
      if (!zipCodeField) return

      zipCodeField.addEventListener('keyup', function (event) {
        const zipCode = event.target.value
        if (validZipCode(zipCode)) {
          setAddressByZipCode(zipCode)
        }
      })
    }

    function setAddressByZipCode (zipCode) {
      if (!cep || typeof cep !== 'function') {
        return
      }

      try {
        const address = cep(zipCode).then(setAddressOnFields)
      } catch (error) {
        console.log(error)
      }
    }

    function setAddressOnFields (address) {
      if (!address) return
      
      const streetField = document.querySelector('[name=address_street]')
      streetField.value = address.street
      
      const neighborhoodField = document.querySelector('[name=address_neighborhood]')
      neighborhoodField.value = address.neighborhood
      
      const cityField = document.querySelector('[name=address_city]')
      cityField.value = address.city

      const stateField = document.querySelector('[name=address_uf]')
      stateField.value = address.state
    }
  </script>
</body>
</html>