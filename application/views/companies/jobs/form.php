<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include_once 'application/views/imports/head.php' ?>
</head>
<body>
  <?php include_once 'application/views/imports/header.php' ?>

  <section class="min-h-screen bg-white grid place-items-center">
    <div class="h-full w-full max-w-screen-2xl mx-auto">
      <div class="p-10 flex items-center justify-center">
        <div class="sm:w-1/2 xl:w-2/5 mx-auto">
          <button onclick="history.back()" class="mb-10 flex items-start hover:underline text-blue-600">
            <div class="flex items-center">
              <i class="feather-lg mr-2" data-feather="chevron-left"></i>
              <span>Voltar</span>
            </div>
          </button>
          <h1 class="text-dark font-medium text-xl leading-relaxed md:leading-relaxed"><?= isset($job) ? 'Editar' : 'Cadastrar' ?> vaga de emprego</h1>
          <form data-submit=".job-form__submit" data-loader=".job-form__loader" action="<?= base_url('companies/jobs/jobs/save') ?>" method="post" class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="hidden" name="id" value="<?= isset($job, $job->id) ? $job->id : '' ?>">
            <div>
              <label class="input-label">Título da vaga *</label>
              <input type="text" required name="title" class="input" value="<?= isset($job) ? $job->title : '' ?>">
              <label class="input-label--error"></label>
            </div>
            <div>
              <label class="input-label">Situação *</label>
              <select required name="situation_id" class="input" <?= isset($job) ? 'disabled' : '' ?>>
                <?php foreach ($situations as $situation) : ?>
                  <option <?= isset($job) && $situation->id == $job->situation_id ? 'selected' : '' ?> value="<?= $situation->id ?>"><?= $situation->title ?></option>
                <?php endforeach ?>
              </select>
              <label class="input-label--error"></label>
            </div>
            <div>
              <label class="input-label">Área *</label>
              <select required name="area_id" class="input">
                <?php foreach ($areas as $area) : ?>
                  <option <?= isset($job) && $area->id == $job->area_id ? 'selected' : '' ?> value="<?= $area->id ?>"><?= $area->title ?></option>
                <?php endforeach ?>
              </select>
              <label class="input-label--error"></label>
            </div>
            <div>
              <label class="input-label">Tipo de vaga *</label>
              <select required name="type_id" class="input">
                <?php foreach ($types as $type) : ?>
                  <option <?= isset($job) && $type->id == $job->type_id ? 'selected' : '' ?> value="<?= $type->id ?>"><?= $type->title ?></option>
                <?php endforeach ?>
              </select>
              <label class="input-label--error"></label>
            </div>
            <div class="col-span-full grid grid-cols-2 gap-4">
              <div>
                <label class="input-label">Salário (R$) *</label>
                <input type="text" <?= isset($job) && !$job->salary ? 'disabled' : '' ?> required name="salary" class="money input" value="<?= isset($job) && $job->salary ? $job->salary : '' ?>">
                <label class="input-label--error"></label>
              </div>
              <div>
                <label class="input-label opacity-0">Salário a combinar</label>
                <div class="flex items-center mt-2">
                  <input type="checkbox" <?= isset($job) && !$job->salary ? 'checked' : '' ?> id="salary-negotiable" name="salary_negotiable" class="form-checkbox h-5 w-5 text-gray-600">
                  <label for="salary-negotiable" class="ml-2 text-gray-700 leading-none">Salário a combinar</label>
                </div>                
              </div>
            </div>
            <div>
              <label class="input-label">Horário de trabalho *</label>
              <input type="text" required name="work_time" class="input" value="<?= isset($job) ? $job->work_time : '' ?>">
              <label class="input-label--error"></label>
            </div>
            <div>
              <label class="input-label">Cidade</label>
              <select required name="city_id" class="input">
                <?php foreach ($cities as $city) : ?>
                  <option <?= isset($job) && $city->id == $job->city_id ? 'selected' : '' ?> value="<?= $city->id ?>"><?= $city->name ?></option>
                <?php endforeach ?>
              </select>
              <label class="input-label--error"></label>
            </div>
            <div>
              <div data-input="[name=activities_description]" data-label=".input-length-counter__label" class="input-length-counter flex items-center justify-between">
                <label class="input-label">Descrição das atividades *</label>
                <span class="input-label text-xs">
                  <span class="input-length-counter__label">0</span>
                </span>
              </div>
              <textarea required maxlength="200" name="activities_description" rows="4" class="input"><?= isset($job) ? $job->activities_description : '' ?></textarea>
              <label class="input-label--error"></label>
            </div>
            <div>
              <div data-input="[name=requirements]" data-label=".input-length-counter__label" class="input-length-counter flex items-center justify-between">
                <label class="input-label">Requisitos</label>
                <span class="input-label text-xs">
                  <span class="input-length-counter__label">0</span>
                </span>
              </div>
              <textarea maxlength="200" name="requirements" rows="4" class="input"><?= isset($job) ? $job->requirements : '' ?></textarea>
              <label class="input-label--error"></label>
            </div>
            <div>
              <div data-input="[name=benefits]" data-label=".input-length-counter__label" class="input-length-counter flex items-center justify-between">
                <label class="input-label">Benefícios</label>
                <span class="input-label text-xs">
                  <span class="input-length-counter__label">0</span>
                </span>
              </div>
              <textarea maxlength="200" name="benefits" rows="4" class="input"><?= isset($job) ? $job->benefits : '' ?></textarea>
              <label class="input-label--error"></label>
            </div>
            <div>
              <div data-input="[name=additional_information]" data-label=".input-length-counter__label" class="input-length-counter flex items-center justify-between">
                <label class="input-label">Informações adicionais</label>
                <span class="input-label text-xs">
                  <span class="input-length-counter__label">0</span>
                </span>
              </div>
              <textarea maxlength="200" name="additional_information" rows="4" class="input"><?= isset($job) ? $job->additional_information : '' ?></textarea>
              <label class="input-label--error"></label>
            </div>
            <div class="col-span-full">
              <button class="job-form__submit w-full btn btn--primary flex items-center justify-center">
                Salvar
                <i class="job-form__loader rotating hidden ml-1" data-feather="loader"></i>
              </button>
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
      onSalaryNegotiableChange()
      onSubmit()
      initInputLengthCounter()
    })

    function onSalaryNegotiableChange () {
      const checkbox = document.querySelector('#salary-negotiable')
      const salary = document.querySelector('[name=salary]')
      const errorLabel = salary.parentNode.querySelector('label.input-label--error')

      checkbox.addEventListener('change', (event) => {
        const { checked } = event.target

        salary.disabled = !!checked
        salary.required = !checked

        salary.value = ''

        salary.classList.remove('border-yellow-600')
        salary.classList.remove('placeholder-yellow-600')

        if (errorLabel) {
          errorLabel.innerHTML = ''
        }
      })
    }

    function onSubmit () {
      const form = document.querySelector('form')
      
      form.addEventListener('submit', function (event) {
        event.preventDefault()
        saveForm(form)
      })
    }

    async function saveForm (form) {
      function handleLoader (isLoading = true) {
        const loader = document.querySelector(form.dataset.loader)
        loader.style.display = isLoading ? 'block' : 'none'
        
        const submit = document.querySelector(form.dataset.submit)
        submit.disabled = isLoading
      }

      handleLoader()

      try {
        const body = new FormData(form)
        const url = form.getAttribute('action')

        const moneyInputs = form.querySelectorAll('.money')
        
        moneyInputs.forEach(input => {
          body.set(input.name, $(`[name=${input.name}]`).cleanVal())
        })

        const response = await fetch(url, {
          method: 'POST',
          body
        }).then(response => response.json())

        
        const { success, error } = response
        
        if (!success) {
          handleLoader(false)
          showAlert('error', error)
        } else {
          window.location.href = '<?= base_url($this->session->userdata('company')['username']) ?>'
        }
      } catch (error) {
        console.log(error)
        handleLoader(false)
        showAlert('error', 'Erro ao salvar, se continuar entre em contato')
      }
    }

    function initInputLengthCounter () {
      const inputLengthCounter = InputLengthCounter('.input-length-counter')
      inputLengthCounter.init()
    }
  </script>
</body>
</html>