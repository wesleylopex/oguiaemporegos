<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include_once 'application/views/imports/head.php' ?>
</head>
<body class="bg-gray-100 overflow-x-hidden">
  <?php include_once 'application/views/imports/header.php' ?>

  <section class="bg-white shadow-sm py-12 xl:py-0">
    <div class="wrapper md:mx-auto">
      <div class="xl:py-20 flex flex-col items-center justify-center">
        <form data-loader=".image-preview__loader" id="profile-image-form" class="hidden" action="<?= base_url('companies/profile/profileImage/save') ?>" method="post" enctype="multipart/form-data">
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" class="hidden">
        </form>
        <div class="image-preview cursor-pointer relative rounded-full p-1 border-2 border-primary">
          <figure class="rounded-full relative overflow-hidden w-32 h-32">
            <img class="image-preview__img w-full h-full object-cover" src="<?= ($this->session->userdata('company')['image'] ? base_url('assets/uploads/images/companies/' . $this->session->userdata('company')['image']) : base_url('assets/site/images/icons/user.png')) ?>" loading="lazy" alt="Profile" title="Profile">
            <div class="image-preview__overlay transition-all duration-700 opacity-0 flex bg-black bg-opacity-60 absolute top-0 w-full h-full left-0 items-center justify-center">
              <span class="text-sm text-gray-100 font-medium">Alterar imagem</span>
            </div>
            <div class="image-preview__loader transition-all hidden duration-700 bg-black bg-opacity-60 absolute top-0 w-full h-full left-0">
              <div class="w-full h-full flex items-center justify-center">
                <i class="text-white rotating" data-feather="loader"></i>
              </div>
            </div>
          </figure>
          <div class="border-4 border-white p-2 rounded-full bg-gray-300 absolute right-0 bottom-0">
            <i class="feather-lg" data-feather="camera"></i>
          </div>
        </div>
        <h1 class="mt-6 font-medium text-2xl text-dark"><?= $company->name ?></h1>
        <span class="mt-1 text-gray-500">@<?= $company->username ?></span>
      </div>
      <div class="mt-6 xl:mt-0 flex flex-col xl:flex-row flex-wrap items-center justify-center xl:justify-between">
        <ul class="flex flex-wrap items-center justify-center xl:justify-start">
          <a href="<?= base_url($this->session->userdata('company')['username']) ?>">
            <li class="font-medium text-dark text-center px-6 py-4 mr-1 hover:bg-gray-300 rounded-sm cursor-pointer">
              Página inicial
            </li>
          </a>
          <li class="relative font-medium text-primary text-center px-6 py-4 mr-1">
            Interesses
            <div style="height: 2px" class="rounded-t-sm bottom-0 left-0 absolute w-full bg-primary"></div>
            <?php if (isset($todayInterestsLength) && $todayInterestsLength > 0) : ?>
              <div class="rounded-full top-0 right-0 absolute w-6 h-6 grid place-items-center text-white font-semibold text-xs bg-red-600">
                <?= $todayInterestsLength ?>
              </div>
            <?php endif ?>
          </li>
          <a href="<?= base_url('companies/candidates/search') ?>">
              <li class="font-medium text-dark text-center px-6 py-4 mr-1 hover:bg-gray-300 rounded-sm cursor-pointer">
                Pesquisar candidatos
              </li>
            </a>
          <li class="open-settings-form-modal font-medium text-dark text-center px-6 py-4 mr-1 hover:bg-gray-300 rounded-sm cursor-pointer">
            Configurações
          </li>
          <li class="open-new-password-form-modal font-medium text-dark text-center px-6 py-4 hover:bg-gray-300 rounded-sm cursor-pointer">
            Alterar senha
          </li>
        </ul>
        <button class="open-confirm-logout-modal ml-4 btn btn--primary btn--outline text-sm font-medium flex items-center">
          <i class="feather-lg mr-2" data-feather="log-out"></i>
          Sair
        </button>
      </div>
    </div>
  </section>

  <?php if (isset($todayInterestsLength) && $todayInterestsLength > 0) : ?>
    <section class="pt-12">
      <div class="wrapper md:mx-auto">
        <div class="p-6 bg-green-600 rounded-sm shadow-md flex items-center">
          <i class="text-white mr-4" data-feather="bell"></i>
          <h2 class="text-white">+<?= $todayInterestsLength ?> interesse(s) registrado(s) nas suas vagas de emprego hoje</h2>
        </div>
      </div>
    </section>
  <?php endif ?>

  <section class="py-12">
    <div class="wrapper md:mx-auto">
      <div class="grid grid-cols-1 xl:grid-cols-5 gap-6">
        <div class="xl:col-span-2">
          <form id="filters-form" method="get" action="<?= base_url('companies/profile/interests') ?>">
            <div class="bg-white p-6 rounded-sm shadow-md">
              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <i class="text-dark" data-feather="sliders"></i>
                  <p class="text-dark ml-2 font-medium">Filtros</p>
                </div>
                <button type="button" id="clear-filters" class="text-sm hover:underline text-blue-600">
                  Limpar todos
                </button>
              </div>
              <div class="mt-6 grid grid-cols-1 gap-6">
                <div>
                  <label class="inline-flex items-center mt-3">
                    <input type="checkbox" name="only-attached" class="h-5 w-5 text-gray-600" <?= $this->input->get('only-attached') ? 'checked' : '' ?>>
                    <span class="ml-2 text-gray-700">Apenas quem anexou currículo</span>
                  </label>
                </div>
                <div class="grid grid-cols-2 gap-6">
                  <div>
                    <label class="input-label">Idade mínima</label>
                    <input type="number" name="min-age" value="<?= $this->input->get('min-age') ?>" class="mt-2 input">
                  </div>
                  <div>
                    <label class="input-label">Idade máxima</label>
                    <input type="number" name="max-age" value="<?= $this->input->get('max-age') ?>" class="mt-2 input">
                  </div>
                </div>
                <div>
                  <label class="input-label">Palavras chaves</label>
                  <input type="text" name="query" value="<?= $this->input->get('query') ?>" class="mt-2 input">
                </div>
                <div>
                  <label class="input-label mb-2">Gênero</label>
                  <select type="text" name="genres[]" multiple class="select2 mt-2 input">
                    <option
                      <?= $this->input->get('genres') && in_array('Masculino', $this->input->get('genres')) ? 'selected' : '' ?>
                      value="Masculino"
                    >Masculino</option>
                    <option
                      <?= $this->input->get('genres') && in_array('Feminino', $this->input->get('genres')) ? 'selected' : '' ?>
                      value="Feminino"
                    >Feminino</option>
                    <option
                      <?= $this->input->get('genres') && in_array('Outro', $this->input->get('genres')) ? 'selected' : '' ?>
                      value="Outro"
                    >Outro</option>
                  </select>
                </div>
                <div>
                  <label class="input-label mb-2">Vagas</label>
                  <select type="text" multiple name="jobs[]" class="select2 mt-2 input">
                    <?php foreach ($jobs as $job) : ?>
                      <option
                        <?= $this->input->get('jobs') && in_array($job->id, $this->input->get('jobs')) ? 'selected' : '' ?>
                        value="<?= $job->id ?>"
                      ><?= $job->title ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <?php if (isset($jobsSituations) && is_array($jobsSituations) && count($jobsSituations) > 0) : ?>
                  <div>
                    <label class="input-label mb-2">Situações das vagas</label>
                    <select type="text" multiple name="jobs-situations[]" class="select2 mt-2 input">
                      <?php foreach ($jobsSituations as $situation) : ?>
                        <option
                          <?= $this->input->get('jobs-situations') && in_array($situation->id, $this->input->get('jobs-situations')) ? 'selected' : '' ?>
                          value="<?= $situation->id ?>"
                        ><?= $situation->title ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                <?php endif ?>
                <div>
                  <label class="input-label mb-2">Situações dos interesses</label>
                  <select type="text" multiple name="situations[]" class="select2 mt-2 input">
                    <?php foreach ($situations as $situation) : ?>
                      <option
                        <?= $this->input->get('situations') && in_array($situation->id, $this->input->get('situations')) ? 'selected' : '' ?>
                        value="<?= $situation->id ?>"
                      ><?= $situation->title ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div>
                  <label class="input-label">Cidade</label>
                  <input type="text" name="city" value="<?= $this->input->get('city') ?>" class="mt-2 input">
                </div>
                <div>
                  <label class="input-label mb-2">Idioma</label>
                  <select type="text" multiple name="languages[]" class="select2 mt-2 input">
                    <option
                      <?= $this->input->get('languages') && in_array('Inglês', $this->input->get('languages')) ? 'selected' : '' ?>
                      value="Inglês"
                    >Inglês</option>
                    <option
                      <?= $this->input->get('languages') && in_array('Espanhol', $this->input->get('languages')) ? 'selected' : '' ?>
                      value="Espanhol"
                    >Espanhol</option>
                    <option
                      <?= $this->input->get('languages') && in_array('Alemão', $this->input->get('languages')) ? 'selected' : '' ?>
                      value="Alemão"
                    >Alemão</option>
                    <option
                      <?= $this->input->get('languages') && in_array('Francês', $this->input->get('languages')) ? 'selected' : '' ?>
                      value="Francês"
                    >Francês</option>
                    <option
                      <?= $this->input->get('languages') && in_array('Italiano', $this->input->get('languages')) ? 'selected' : '' ?>
                      value="Italiano"
                    >Italiano</option>
                    <option
                      <?= $this->input->get('languages') && in_array('Japonês', $this->input->get('languages')) ? 'selected' : '' ?>
                      value="Japonês"
                    >Japonês</option>
                    <option
                      <?= $this->input->get('languages') && in_array('Mandarim', $this->input->get('languages')) ? 'selected' : '' ?>
                      value="Mandarim"
                    >Mandarim</option>
                    <option
                      <?= $this->input->get('languages') && in_array('Árabe', $this->input->get('languages')) ? 'selected' : '' ?>
                      value="Árabe"
                    >Árabe</option>
                  </select>
                </div>
                <div>
                  <button class="btn btn--primary w-full">Filtrar</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="xl:col-span-3">
          <div class="flex flex-wrap items-center justify-between">
            <h2 class="font-medium uppercase text-dark">Interesses</h2>
            <p class="text-dark text-sm">
              <?= $resultsMessage ?>
            </p>
          </div>
          <?php if (count($interests) > 0) : ?>
            <div class="mt-6 grid grid-cols-1 gap-6">
              <?php foreach ($interests as $interest) : ?>
                <div class="bg-white p-6 rounded-sm shadow-md">
                  <div class="flex justify-between">
                    <div class="flex items-center">
                        <a href="<?= base_url('companies/candidates/candidate/index/' . $interest->candidate_id) ?>">
                          <figure class="rounded-full relative overflow-hidden w-14 h-14">
                            <img class="w-full h-full object-cover" src="<?= base_url($interest->candidate_image ? ('assets/uploads/images/candidates/' . $interest->candidate_image) : ('assets/site/images/icons/user.png')) ?>" loading="lazy" alt="<?= $interest->candidate_name ?>" title="<?= $interest->candidate_name ?>">
                          </figure>
                        </a>
                      <div class="ml-4 flex flex-col">
                        <h2 class="font-medium text-dark">
                          <a href="<?= base_url('companies/candidates/candidate/index/' . $interest->candidate_id) ?>">
                            <span class="hover:underline"><?= $interest->candidate_name ?></span>,
                          </a>
                          <span class="font-normal"><?= $interest->candidate_age ?> anos</span>
                        </h2>
                        <?php if (isset($interest->candidate_function_1)) : ?>
                          <p class="paragraph text-sm"><?= $interest->candidate_function_1 ?></p>
                        <?php endif ?>
                      </div>
                    </div>
                    <div>
                      <div class="dropdown relative inline-block text-left">
                        <div>
                          <button type="button" class="dropdown__toggle hover:bg-gray-200 p-1 rounded-full" aria-expanded="true" aria-haspopup="true">
                            <i data-feather="more-horizontal"></i>
                          </button>
                        </div>
                        <div class="dropdown__content hidden z-50 origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                          <div class="py-1" role="none">
                            <a href="<?= base_url('companies/candidates/candidate/index/' . $interest->candidate_id) ?>">
                              <button class="dropdown__item w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                <i class="feather-lg mr-2" data-feather="info"></i>
                                <span>Ver candidato</span>
                              </button>
                            </a>
                            <button
                              onclick="setInterestModalData('<?= base_url('companies/profile/interests/get/' . $interest->id) ?>')"
                              class="open-interest-modal dropdown__item w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                              role="menuitem"
                            >
                              <i class="feather-lg mr-2" data-feather="edit"></i>
                              <span>Editar status</span>
                            </button>
                            <button 
                              onclick="setConfirmDeleteModalLink('<?= base_url('companies/profile/interests/delete/' . $interest->id) ?>')"
                              class="open-confirm-delete-modal dropdown__item w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                              role="menuitem"
                            >
                              <i class="feather-lg mr-2" data-feather="trash"></i>
                              <span>Remover</span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mt-4">
                    <h2 class="text-dark text-sm">
                      Se interessou na vaga
                      <a href="<?= base_url('companies/jobs/jobs/update/' . $interest->job_id) ?>">
                        <span class="hover:underline text-base font-medium"><?= $interest->job_title ?></span>
                      </a>
                    </h2>
                    <div class="flex flex-wrap items-center">
                      <div class="mr-4 mt-4 flex items-center" title="Data de criação">
                        <i class="text-dark feather-lg mr-2" data-feather="calendar"></i>
                        <p class="paragraph text-sm"><?= date('d/m/Y, H:i', strtotime($interest->created_at)) ?></p>
                      </div>
                      <div class="mr-4 mt-4 flex items-center" title="Localização">
                        <i class="text-dark feather-lg mr-2" data-feather="map-pin"></i>
                        <p class="paragraph text-sm"><?= $interest->candidate_address_city ?> - <?= $interest->candidate_address_uf ?></p>
                      </div>
                      <div class="mr-4 mt-4 flex items-center" title="Localização">
                        <i class="text-dark feather-lg mr-2" data-feather="info"></i>
                        <p class="paragraph text-sm"><?= $interest->candidate_genre ?></p>
                      </div>
                      <?php if (isset($interest->job_situation_title, $interest->job_situation_type)) : ?>
                        <button class="mr-4 mt-4 open-interest-modal badge">
                          <p class="text-sm font-medium text-<?= $interest->job_situation_type ?>">
                            <?= $interest->job_situation_title ?>
                          </p>
                        </button>
                      <?php endif ?>
                      <?php if (isset($interest->situation_id) && $interest->situation_id) : ?>
                        <button onclick="setInterestModalData('<?= base_url('companies/profile/interests/get/' . $interest->id) ?>')" class="open-interest-modal mr-4 mt-4 badge badge--<?= $interest->situation_type ?> flex items-center" title="Status do interesse">
                          <i class="feather-lg mr-2" data-feather="info"></i>
                          <p class="font-medium text-sm"><?= $interest->situation_title ?></p>
                        </button>
                      <?php endif ?>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
            </div>
            <?php if (isset($pagination) && $pagination) : ?>
              <div class="mt-6 pagination">
                <?= $pagination ?>
              </div>
            <?php endif ?>
          <?php else : ?>
            <div class="mt-6 bg-white p-6 rounded-sm shadow-md">
              <a class="w-full" href="https://storyset.com" target="_blank" rel="noopener noreferrer">
                <img class="md:w-3/5" src="<?= base_url('assets/site/images/illustrations/rising-cuate.svg') ?>" loading="lazy" alt="Progresso SVG">
              </a>
              <h1 class="text-gray-700 mt-4 text-xl font-semibold">Nenhum interesse encontrado no momento</h1>
              <ul class="mt-4 grid grid-cols-1 gap-3">
                <li class="flex items-center">
                  <i class="text-green-600 mr-2" data-feather="check-circle"></i>
                  <p class="paragraph">Clique no <span class="font-medium">link abaixo</span> para copiá-lo</p>
                </li>
                <li class="flex items-center">
                  <i class="text-green-600 mr-2" data-feather="check-circle"></i>
                  <p class="paragraph">Divulgue <span class="font-medium">seu perfil</span></p>
                </li>
                <li class="flex items-center">
                  <i class="text-green-600 mr-2" data-feather="check-circle"></i>
                  <p class="paragraph">Divulgue <span class="font-medium">suas vagas</span></p>
                </li>
              </ul>
              <p onclick="copyToClipboard(event)" class="cursor-pointer mt-4 paragraph text-blue-600 underline"><?= base_url($company->username) ?></p>
            </div>
          <?php endif ?>
        </div>
      </div>
    </div>
  </section>

  <?php include_once 'application/views/companies/profile/modals/forms/new-password.php' ?>
  <?php include_once 'application/views/companies/profile/modals/forms/settings.php' ?>
  <?php include_once 'application/views/companies/profile/modals/forms/interest.php' ?>
  <?php include_once 'application/views/companies/profile/modals/confirm-logout.php' ?>
  <?php include_once 'application/views/companies/profile/modals/confirm-delete.php' ?>

  <?php include_once 'application/views/imports/footer.php' ?>
  <?php include_once 'application/views/imports/scripts.php' ?>

  <script type="module">
    import { ImagePreview } from '<?= base_url('assets/site/scripts/ImagePreview/ImagePreview.js') ?>'
    import { Filters } from '<?= base_url('assets/site/scripts/Filters/Filters.js') ?>'
    import { Modal } from '<?= base_url('assets/site/scripts/Modal/Modal.js') ?>'

    window.addEventListener('load', function () {
      window.setConfirmDeleteModalLink = setConfirmDeleteModalLink
      window.setInterestModalData = setInterestModalData
      window.copyToClipboard = copyToClipboard
      
      onFiltersFormSubmit()
      initImagePreview()
      initFilters()
      initModals()
      onModalsFormsSubmit()
    })

    function setConfirmDeleteModalLink (url) {
      const modal = document.querySelector('#confirm-delete-modal')
      if (!modal) return false
      
      const form = modal.querySelector('form')
      if (!form) return false

      form.action = url
    }

    function copyToClipboard (event) {
      const element = event.target
      const toCopy = document.createElement('input')

      document.body.appendChild(toCopy);

      toCopy.value = element.innerText
      toCopy.select()
      
      document.execCommand('copy')

      showAlert('success', 'Link de perfil copiado')
      
      toCopy.remove()
    }

    function onFiltersFormSubmit () {
      const form = document.querySelector('#filters-form')
      
      form.addEventListener('submit', (event) => {
        const fields = event.target.querySelectorAll('[name]')
        
        fields.forEach(field => {
          if (!field.value) field.disabled = true
        })
      })
    }

    async function setInterestModalData (url) {
      const modal = document.querySelector('#interest-modal')

      const response = await fetch(url, {
        method: 'GET', 
      }).then(response => response.json())

      const { success, error, data } = response
      
      if (!success) {
        showAlert('error', error)
      }

      const linksElements = modal.querySelectorAll('a')
      linksElements.forEach(element => {
        const base = '<?= base_url('companies/candidates/candidate/index') ?>'
        element.href = `${base}/${data.candidate_id}`
      })

      for (const key in data) {
        const element = modal.querySelector(`.${key}`)

        if (element) {
          const tagName = element.tagName.toLowerCase()
          const value = data[key] || ''

          if (tagName === 'img') {
            if (value) {
              const base = '<?= base_url('assets/uploads/images/candidates') ?>'
              element.src = `${base}/${value}`
            } else {
              const src = '<?= base_url('assets/site/images/icons/user.png') ?>'
              element.src = src
            }
          } else if (tagName === 'input' || tagName === 'select') {
            element.value = value
          } else {
            element.innerHTML = value
          }
        }
      }
    }

    function initImagePreview () {
      const imagePreview = ImagePreview({
        input: document.querySelector('form#profile-image-form [name=image]'),
        preview: 'img.image-preview__img',
        toggle: document.querySelector('.image-preview')
      })
      imagePreview.start()

      onProfileImageChange()
    }

    function onProfileImageChange () {
      const form = document.querySelector('form#profile-image-form')
      const input = form.querySelector('[name=image]')

      input.addEventListener('change', function () {
        form.submit()

        const loader = document.querySelector(form.dataset.loader)
        loader.style.display = 'block'
      })
    }

    function initFilters () {
      const filters = Filters()
      filters.start()
    }

    function initModals () {
      const modal = Modal()
      modal.add('#new-password-form-modal', { reopenClass: 'open-new-password-form-modal' })
      modal.add('#settings-form-modal', { reopenClass: 'open-settings-form-modal' })
      modal.add('#confirm-logout-modal', { reopenClass: 'open-confirm-logout-modal' })
      modal.add('#confirm-delete-modal', { reopenClass: 'open-confirm-delete-modal' })
      modal.add('#interest-modal', { reopenClass: 'open-interest-modal' })
    }

    function onModalsFormsSubmit () {
      const forms = document.querySelectorAll('.slickModal form')
      
      forms.forEach(form => {
        const reloadInfo = form.dataset.reload
        const reload = reloadInfo && reloadInfo.toLowerCase().trim() === 'false' ? false : true

        form.addEventListener('submit', function (event) {
          event.preventDefault()
          saveFormData(form, reload)
        })
      })
    }

    async function saveFormData (form, reload = true) {
      try {
        const url = form.getAttribute('action')
        const body = new FormData(form)

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
          showAlert('error', error)
          return false
        }
        
        if (reload) {
          window.location.reload()
        } else { 
          showAlert('success', 'Alteração salva')
          form.reset()
          
          const closeButton = form.querySelector('.closeModal')
          closeButton && closeButton.click()
        }
      } catch (error) {
        showAlert('error', 'Erro ao salvar, se continuar entre em contato')
      }
    }
  </script>
</body>
</html>