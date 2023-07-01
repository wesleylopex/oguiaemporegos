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
              <div data-percentage="33" class="w-0 transition-all duration-500 progress-bar__percentage h-1 bg-primary rounded-full"></div>
            </div>
            <h1 class="mt-10 text-gray-900 font-medium text-xl md:text-2xl leading-relaxed md:leading-relaxed">Informações pessoais</h1>
            <form action="<?= base_url('candidates/signup/personalInfo/save') ?>" method="post" class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="input-label">Data de nascimento *</label>
                <input type="text" required name="birthdate" class="date input">
                <label class="input-label--error"></label>
              </div>
              <div>
                <label class="input-label">Celular / Telefone *</label>
                <input type="text" required name="phone" class="phone input">
                <label class="input-label--error"></label>
              </div>
              <div>
                <label class="input-label">WhatsApp</label>
                <div class="input py-0 flex items-center">
                  <label class="input-label mr-2">+55</label>
                  <input type="text" name="whatsapp" class="phone w-full input-label text-dark bg-transparent py-2">
                </div>
              </div>
              <div>
                <label class="input-label">CPF *</label>
                <input type="text" required name="cpf" class="cpf input">
                <label class="input-label--error"></label>
              </div>
              <div>
                <label class="input-label">RG *</label>
                <input type="text" required name="rg" class="rg input" minlength="10" maxlength="10">
                <label class="input-label--error"></label>
              </div>
              <div>
                <label class="input-label">Gênero *</label>
                <select required name="genre" class="input">
                  <option value="" class="hidden"></option>
                  <option value="Masculino">Masculino</option>
                  <option value="Feminino">Feminino</option>
                  <option value="Outro">Outro</option>
                </select>
                <label class="input-label--error"></label>
              </div>
              <div>
                <label class="input-label">Estado civil *</label>
                <select required name="marital_status" class="input">
                  <option value="" class="hidden"></option>
                  <option value="Solteiro">Solteiro</option>
                  <option value="Casado">Casado</option>
                  <option value="Viúvo">Viúvo</option>
                  <option value="Separado">Separado</option>
                  <option value="Divorciado">Divorciado</option>
                  <option value="União estável">União estável</option>
                </select>
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
        
        const toCleanInputs = form.querySelectorAll('.money, .phone')
        
        toCleanInputs.forEach(input => {
          body.set(input.name, $(`[name=${input.name}]`).cleanVal())
        })

        const response = await fetch(url, {
          method: 'POST',
          body
        }).then(response => response.json())

        const { success, error } = response

        if (!success) {
          showAlert('error', error)
        } else {
          window.location.href = '<?= base_url('candidates/signup/address') ?>'
        }
      } catch (error) {
        showAlert('error', 'Erro ao salvar, tente novamente')
      }
    }
  </script>
</body>
</html>