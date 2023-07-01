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
        <?php if ($canUpdate === true) : ?>
          <form data-loader=".image-preview__loader" id="profile-image-form" class="hidden" action="<?= base_url('companies/profile/profileImage/save') ?>" method="post" enctype="multipart/form-data">
            <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" class="hidden">
          </form>
        <?php endif ?>
        <div class="image-preview <?= $canUpdate === true ? 'cursor-pointer' : '' ?> relative rounded-full p-1 border-2 border-primary">
          <figure class="rounded-full relative overflow-hidden w-32 h-32">
            <img class="image-preview__img w-full h-full object-cover" src="<?= $company->image ? base_url('assets/uploads/images/companies/' . $company->image) : base_url('assets/site/images/icons/user.png') ?>" loading="lazy" alt="<?= $company->name ?>" title="<?= $company->name ?>">
            <?php if ($canUpdate === true) : ?>
              <div class="image-preview__overlay transition-all duration-700 opacity-0 flex bg-black bg-opacity-60 absolute top-0 w-full h-full left-0 items-center justify-center">
                <span class="text-sm text-gray-100 font-medium">Alterar imagem</span>
              </div>
              <div class="image-preview__loader transition-all hidden duration-700 bg-black bg-opacity-60 absolute top-0 w-full h-full left-0">
                <div class="w-full h-full flex items-center justify-center">
                  <i class="text-white rotating" data-feather="loader"></i>
                </div>
              </div>
            <?php endif ?>
          </figure>
          <?php if ($canUpdate === true) : ?>
            <div class="border-4 border-white p-2 rounded-full bg-gray-300 absolute right-0 bottom-0">
              <i class="feather-lg" data-feather="camera"></i>
            </div>
          <?php endif ?>
        </div>
        <h1 class="mt-6 font-medium text-2xl text-dark"><?= $company->name ?></h1>
        <span class="mt-1 text-gray-500">@<?= $company->username ?></span>
      </div>
      <?php if ($canUpdate === true) : ?>
        <div class="mt-6 xl:mt-0 flex flex-col xl:flex-row flex-wrap items-center justify-center xl:justify-between">
          <ul class="flex flex-wrap items-center justify-center xl:justify-start">
            <li class="relative font-medium text-primary text-center px-6 py-4 mr-1">
              Página inicial
              <div style="height: 2px" class="rounded-t-sm bottom-0 left-0 absolute w-full bg-primary"></div>
            </li>
            <a href="<?= base_url('companies/profile/interests') ?>">
              <li class="relative font-medium text-dark text-center px-6 py-4 mr-1 hover:bg-gray-300 rounded-sm cursor-pointer">
                Interesses
                <?php if (isset($todayInterestsLength) && $todayInterestsLength > 0) : ?>
                  <div class="rounded-full top-0 right-0 absolute w-6 h-6 grid place-items-center text-white font-semibold text-xs bg-red-600">
                    <?= $todayInterestsLength ?>
                  </div>
                <?php endif ?>
              </li>
            </a>
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
      <?php endif ?>
    </div>
  </section>

  <section class="py-12">
    <div class="wrapper md:mx-auto">
      <div class="grid grid-cols-1 xl:grid-cols-5 gap-6">
        <div class="xl:col-span-2">
          <div class="grid grid-cols-1 gap-6">
            <?php if ($canUpdate || (trim($company->description))) : ?>
              <div>
                <div class="bg-white p-6 rounded-sm shadow-md">
                  <div class="flex items-center justify-between">
                    <h2 class="text-dark font-medium text-lg">Sobre</h2>
                    <?php if ($canUpdate === true) : ?>
                      <button class="open-description-form-modal flex items-center hover:underline text-blue-600">
                        <span>Editar</span>
                        <i class="feather-lg ml-2" data-feather="chevron-right"></i>
                      </button>
                    <?php endif ?>
                  </div>
                  <p class="mt-6 paragraph text-gray-600">
                    <?= $company->description ?>
                  </p>
                </div>
              </div>
            <?php endif ?>
            <div>
              <div class="bg-white p-6 rounded-sm shadow-md">
                <div class="flex items-center justify-between">
                  <h2 class="text-dark font-medium text-lg">Informações de contato</h2>
                  <?php if ($canUpdate === true) : ?>
                    <button class="open-contact-form-modal flex items-center hover:underline text-blue-600">
                      <span>Editar</span>
                      <i class="feather-lg ml-2" data-feather="chevron-right"></i>
                    </button>
                  <?php endif ?>
                </div>
                <div class="mt-6 grid grid-cols-1 gap-4">
                  <?php if (trim($company->instagram)) : ?>
                    <div class="flex items-center">
                      <i class="text-dark mr-4" data-feather="instagram"></i>
                      <a href="https://instagram.com/<?= $company->instagram ?>" target="_blank">
                        <p class="text-blue-600 hover:underline">@<?= $company->instagram ?></p>
                      </a>
                    </div>
                  <?php endif ?>
                  <?php if (trim($company->facebook)) : ?>
                    <div class="flex items-center">
                      <i class="text-dark mr-4" data-feather="facebook"></i>
                      <a href="https://facebook.com/<?= $company->facebook ?>" target="_blank">
                        <p class="text-blue-600 hover:underline">@<?= $company->facebook ?></p>
                      </a>
                    </div>
                  <?php endif ?>
                  <?php if (trim($company->website)) : ?>
                    <div class="flex items-center">
                      <i class="text-dark mr-4" data-feather="globe"></i>
                      <a href="<?= $company->website ?>" target="_blank">
                        <p class="text-blue-600 hover:underline"><?= $company->website ?></p>
                      </a>
                    </div>
                  <?php endif ?>
                  <?php if (trim($company->whatsapp)) : ?>
                    <div class="flex items-center">
                      <i class="text-dark mr-4 text-2xl fab fa-whatsapp"></i>
                      <a href="https://api.whatsapp.com/send?phone=+55<?= $company->whatsapp ?>&text=Olá, encontrei seu contato no site O Guia Empregos" target="_blank">
                        <p class="text-blue-600 hover:underline phone"><?= $company->whatsapp ?></p>
                      </a>
                    </div>
                  <?php endif ?>
                  <?php if (trim($company->email)) : ?>
                    <div class="flex items-center">
                      <i class="text-dark mr-4 text-2xl" data-feather="mail"></i>
                      <a href="mailto:<?= $company->email ?>" target="_blank">
                        <p class="text-blue-600 hover:underline"><?= $company->email ?></p>
                      </a>
                    </div>
                  <?php endif ?>
                  <?php if (trim($company->phone)) : ?>
                    <div class="flex items-center">
                      <i class="text-dark mr-4 text-2xl" data-feather="phone"></i>
                      <a href="tel:+55<?= $company->phone ?>" target="_blank">
                        <p class="text-blue-600 hover:underline phone"><?= $company->phone ?></p>
                      </a>
                    </div>
                  <?php endif ?>
                </div>
              </div>
            </div>
            <?php if ($canUpdate || (trim($company->latitude) && trim($company->longitude))) : ?>
              <div>
                <div class="bg-white p-6 rounded-sm shadow-md">
                  <div class="flex items-center justify-between">
                    <h2 class="text-dark font-medium text-lg">Localização</h2>
                    <?php if ($canUpdate === true) : ?>
                      <button class="open-location-form-modal flex items-center hover:underline text-blue-600">
                        <span>Editar</span>
                        <i class="feather-lg ml-2" data-feather="chevron-right"></i>
                      </button>
                    <?php endif ?>
                  </div>
                  <div class="mt-6">
                    <div id="map" class="w-full rounded-sm" style="height: 30rem"></div>
                  </div>
                </div>
              </div>
            <?php endif ?>
          </div>
        </div>
        <div class="xl:col-span-3">
          <div class="flex flex-wrap items-center justify-between">
            <h2 class="font-medium uppercase text-dark">Vagas de emprego</h2>
            <?php if ($canUpdate === true) : ?>
              <div class="flex flex-wrap items-center">
                <button class="open-job-filters-modal btn btn--primary btn--text">
                  Filtrar
                </button>
                <a href="<?= base_url('companies/jobs/jobs/create') ?>">
                  <button class="btn btn--primary flex items-center ml-4">
                    <i class="feather-lg" data-feather="plus"></i>
                    <p class="ml-2 text-sm font-medium">Adicionar</p>
                  </button>
                </a>
              </div>
            <?php endif ?>
          </div>
          <?php if (isset($resultsMessage) && $canUpdate === true) : ?>
            <p class="mt-6 paragraph"><?= $resultsMessage ?></p>
          <?php endif ?>
          <?php if (count($jobs) > 0) : ?>
            <div class="mt-6 grid grid-cols-1 gap-6">
              <?php foreach ($jobs as $job) : ?>
                <div class="bg-white p-6 rounded-sm shadow-md">
                  <div class="flex justify-between">
                    <div class="flex items-center">
                      <figure class="rounded-full relative overflow-hidden w-14 h-14">
                      <img class="image-preview__img flex-shrink-0 w-full h-full object-cover" src="<?= $job->company->image ? base_url('assets/uploads/images/companies/' . $job->company->image) : base_url('assets/site/images/icons/user.png') ?>" loading="lazy" alt="<?= $job->company->name ?>" title="<?= $job->company->name ?>">
                      </figure>
                      <div class="ml-4 flex flex-col">
                        <h2 class="font-medium text-dark"><?= $company->name ?></h2>
                        <span class="text-sm text-gray-500">@<?= $company->username ?></span>
                      </div>
                    </div>
                    <?php if ($canUpdate === true) : ?>
                      <div>
                        <div class="dropdown relative inline-block text-left">
                          <div>
                            <button type="button" class="dropdown__toggle hover:bg-gray-200 p-1 rounded-full" aria-expanded="true" aria-haspopup="true">
                              <i data-feather="more-horizontal"></i>
                            </button>
                          </div>
                          <div class="dropdown__content hidden z-50 origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <div class="py-1" role="none">
                              <a href="<?= base_url('companies/jobs/jobs/update/' . $job->id) ?>">
                                <button class="dropdown__item w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                                  <i class="feather-lg mr-2" data-feather="edit"></i>
                                  <span>Editar</span>
                                </button>
                              </a>
                              <?php if ($job->situation->is_finished) : ?>
                                <button
                                  onclick="setConfirmResumeJobModalLink('<?= base_url('companies/jobs/jobs/updateSituation/' . $job->id . '/1') ?>')"
                                  class="open-confirm-resume-job-modal dropdown__item w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                  role="menuitem"
                                >
                                  <i class="feather-lg mr-2" data-feather="check-circle"></i>
                                  <span>Retomar vaga</span>
                                </button>
                              <?php else : ?>
                                <button
                                  onclick="setConfirmFinishJobModalLink('<?= base_url('companies/jobs/jobs/updateSituation/' . $job->id . '/2') ?>')"
                                  class="open-confirm-finish-job-modal dropdown__item w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                  role="menuitem"
                                >
                                  <i class="feather-lg mr-2" data-feather="power"></i>
                                  <span>Encerrar vaga</span>
                                </button>
                                <button
                                  onclick="setConfirmCancelJobModalLink('<?= base_url('companies/jobs/jobs/updateSituation/' . $job->id . '/3') ?>')"
                                  class="open-confirm-cancel-job-modal dropdown__item w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                  role="menuitem"
                                >
                                  <i class="feather-lg mr-2" data-feather="x"></i>
                                  <span>Cancelar vaga</span>
                                </button>
                              <?php endif ?>
                              <button 
                                onclick="setConfirmDeleteModalLink('<?= base_url('companies/jobs/jobs/delete/' . $job->id) ?>')"
                                class="open-confirm-delete-modal dropdown__item w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                role="menuitem"
                              >
                                <i class="feather-lg mr-2" data-feather="trash"></i>
                                <span>Excluir</span>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endif ?>
                  </div>
                  <div class="mt-4">
                    <a href="<?= base_url('vaga-de-emprego/' . $job->slug) ?>">
                      <h2 class="hover:underline font-medium text-dark"><?= $job->title ?></h2>
                    </a>
                    <div class="mt-4 flex flex-wrap items-center">
                      <?php if (isset($job->city)) : ?>
                        <div class="mr-6 my-1 flex items-center" title="Localização">
                          <i class="text-dark feather-lg mr-2" data-feather="map-pin"></i>
                          <p class="paragraph text-sm"><?= $job->city->name ?></p>
                        </div>
                      <?php endif ?>
                      <?php if (isset($job->area)) : ?>
                        <div class="mr-6 my-1 flex items-center" title="Área">
                          <i class="text-dark feather-lg mr-2" data-feather="info"></i>
                          <p class="paragraph text-sm"><?= $job->area->title ?></p>
                        </div>
                      <?php endif ?>
                      <?php if (isset($job->situation)) : ?>
                        <div class="mr-6 my-1 badge badge--<?= $job->situation->type ?> flex items-center" title="Situação">
                          <i class="feather-lg mr-2" data-feather="info"></i>
                          <p class="text-sm"><?= $job->situation->title ?></p>
                        </div>
                      <?php endif ?>
                      <div class="my-1 flex items-center" title="Salário">
                        <i class="text-dark mr-2 far fa-money-bill-alt"></i>
                        <?php if ($job->salary > 0) : ?>
                          <p class="paragraph text-sm">R$ <span class="money"><?= $job->salary ?></span></p>
                        <?php else : ?>
                          <p class="paragraph text-sm">A combinar</span></p>
                        <?php endif ?>
                      </div>
                    </div>
                    <p class="mt-4 paragraph text-sm"><?= $job->activities_description ?></p>
                    <?php if ($canUpdate === true) : ?>
                      <button class="outline-none focus:outline-none hover:underline mt-4 flex items-center">
                        <i class="text-dark feather-lg mr-2" data-feather="thumbs-up"></i>
                        <a href="<?= base_url('companies/profile/interests?jobs%5B%5D=' . $job->id) ?>">
                          <p class="paragraph text-sm font-medium"><?= count($job->candidates) ?> candidato(s) interessado(s)</p>
                        </a>
                      </button>
                    <?php else : ?>
                      <a href="<?= base_url('vaga-de-emprego/' . $job->slug) ?>">
                        <button class="mt-4 flex items-start hover:underline text-blue-600">
                          <div class="flex items-center">
                            <span>Registrar interesse</span>
                            <i class="feather-lg ml-2" data-feather="chevron-right"></i>
                          </div>
                        </button>
                      </a>
                    <?php endif ?>
                  </div>
                </div>
              <?php endforeach ?>
            </div>
            <?php if (isset($pagination) && $pagination) : ?>
              <div class="mt-6 pagination">
                <?= $pagination ?>
              </div>
            <?php endif ?>
          <?php elseif ($canUpdate === true) : ?>
            <div class="mt-6 bg-white p-10 rounded-sm shadow-md flex flex-col justify-center items-center">
              <a class="w-full" href="https://storyset.com" target="_blank" rel="noopener noreferrer">
                <img class="md:w-3/5 mx-auto" src="<?= base_url('assets/site/images/illustrations/rising-cuate.svg') ?>" loading="lazy" alt="Progresso SVG">
              </a>
              <h1 class="md:w-2/3 mx-auto text-gray-700 mt-6 text-2xl font-medium text-center">Você ainda não cadastrou vagas de emprego</h1>
              <h2 class="md:w-2/3 mx-auto text-center mt-4 paragraph text-gray-600">Cadastre suas vagas de emprego e encontre os melhores profissionais para a sua empresa.</h2>
              <a href="<?= base_url('companies/jobs/jobs/create') ?>">
                <button class="mt-6 btn btn--primary">Adicionar vaga de emprego</button>
              </a>
            </div>
          <?php else : ?>
            <div class="mt-6 bg-white p-10 rounded-sm shadow-md flex flex-col justify-center items-center">
              <a class="w-full" href="https://storyset.com" target="_blank" rel="noopener noreferrer">
                <img class="md:w-3/5 mx-auto" src="<?= base_url('assets/site/images/illustrations/rising-cuate.svg') ?>" loading="lazy" alt="Progresso SVG">
              </a>
              <h1 class="md:w-2/3 mx-auto text-gray-700 mt-6 text-2xl font-medium text-center">Esta empresa ainda não adicionou nenhuma vaga de emprego</h1>
            </div>
          <?php endif ?>
        </div>
      </div>
    </div>
  </section>

  <?php if ($canUpdate === true) include_once 'application/views/companies/profile/modals/forms/description.php' ?>
  <?php if ($canUpdate === true) include_once 'application/views/companies/profile/modals/forms/contact.php' ?>
  <?php if ($canUpdate === true) include_once 'application/views/companies/profile/modals/forms/location.php' ?>
  <?php if ($canUpdate === true) include_once 'application/views/companies/profile/modals/forms/new-password.php' ?>
  <?php if ($canUpdate === true) include_once 'application/views/companies/profile/modals/forms/settings.php' ?>
  <?php if ($canUpdate === true) include_once 'application/views/companies/profile/modals/forms/job-filters.php' ?>
  <?php if ($canUpdate === true) include_once 'application/views/companies/profile/modals/confirm-logout.php' ?>
  <?php if ($canUpdate === true) include_once 'application/views/companies/profile/modals/confirm-delete.php' ?>
  <?php if ($canUpdate === true) include_once 'application/views/companies/profile/modals/confirm-finish-job.php' ?>
  <?php if ($canUpdate === true) include_once 'application/views/companies/profile/modals/confirm-cancel-job.php' ?>
  <?php if ($canUpdate === true) include_once 'application/views/companies/profile/modals/confirm-resume-job.php' ?>

  <?php include_once 'application/views/imports/footer.php' ?>
  <?php include_once 'application/views/imports/scripts.php' ?>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArz1DGtacDxij2_ay1LPjr8y6ha0JTl90&callback=initMap&libraries=&v=weekly" defer></script>

  <script>
    function initMap () {
      const coordinates = {
        lat: Number(<?= $company->latitude ?>),
        lng: Number(<?= $company->longitude ?>)
      }

      const map = new google.maps.Map(document.querySelector('#map'), {
        zoom: 14,
        center: coordinates
      })

      const marker = new google.maps.Marker({
        position: coordinates,
        map
      })
    }
  </script>

  <?php if ($canUpdate === true) : ?>
    <script type="module">
      import { ImagePreview } from '<?= base_url('assets/site/scripts/ImagePreview/ImagePreview.js') ?>'
      import { Modal } from '<?= base_url('assets/site/scripts/Modal/Modal.js') ?>'
      import { InputLengthCounter } from '<?= base_url('assets/site/scripts/InputLengthCounter/InputLengthCounter.js') ?>'

      window.addEventListener('load', function () {
        window.setConfirmDeleteModalLink = setConfirmDeleteModalLink
        window.setConfirmFinishJobModalLink = setConfirmFinishJobModalLink
        window.setConfirmCancelJobModalLink = setConfirmCancelJobModalLink
        window.setConfirmResumeJobModalLink = setConfirmResumeJobModalLink

        onFiltersFormSubmit()
        initImagePreview()
        initModals()
        onModalsFormsSubmit()
        initInputLengthCounter()
        generateAutoUsername()
      })

      function onFiltersFormSubmit () {
        const form = document.querySelector('form#job-filters')
        
        form.addEventListener('submit', (event) => {
          const fields = event.target.querySelectorAll('[name]')
          
          fields.forEach(field => {
            if (!field.value) field.disabled = true
          })
        })
      }

      function setConfirmDeleteModalLink (url) {
        setModalFormLink('#confirm-delete-modal', url)
      }

      function setConfirmFinishJobModalLink (url) {
        setModalFormLink('#confirm-finish-job-modal', url)
      }

      function setConfirmCancelJobModalLink (url) {
        setModalFormLink('#confirm-cancel-job-modal', url)
      }

      function setConfirmResumeJobModalLink (url) {
        setModalFormLink('#confirm-resume-job-modal', url)
      }

      function setModalFormLink (modalSelector, url) {
        const modal = document.querySelector(modalSelector)
        if (!modal) return false
        
        const form = modal.querySelector('form')
        if (!form) return false

        form.action = url
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

      function initModals () {
        const modal = Modal()
        modal.add('#description-form-modal', { reopenClass: 'open-description-form-modal' })
        modal.add('#contact-form-modal', { reopenClass: 'open-contact-form-modal' })
        modal.add('#location-form-modal', { reopenClass: 'open-location-form-modal' })
        modal.add('#new-password-form-modal', { reopenClass: 'open-new-password-form-modal' })
        modal.add('#settings-form-modal', { reopenClass: 'open-settings-form-modal' })
        modal.add('#job-filters-modal', { reopenClass: 'open-job-filters-modal' })
        modal.add('#confirm-logout-modal', { reopenClass: 'open-confirm-logout-modal' })
        modal.add('#confirm-delete-modal', { reopenClass: 'open-confirm-delete-modal' })
        modal.add('#confirm-finish-job-modal', { reopenClass: 'open-confirm-finish-job-modal' })
        modal.add('#confirm-cancel-job-modal', { reopenClass: 'open-confirm-cancel-job-modal' })
        modal.add('#confirm-resume-job-modal', { reopenClass: 'open-confirm-resume-job-modal' })
      }

      function onModalsFormsSubmit () {
        const forms = document.querySelectorAll('.slickModal form:not(#job-filters)')
        
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

      function initInputLengthCounter () {
        const inputLengthCounter = InputLengthCounter('.input-length-counter')
        inputLengthCounter.init()
      }

      function generateAutoUsername () {
        const settingsForm = document.querySelector('#settings-form')
        const name = settingsForm.querySelector('[name=name]')
        const username = settingsForm.querySelector('[name=username]')

        name.addEventListener('blur', () => {
          if (name.value) {
            username.value = slugify(name.value)
          }
        })
      }
    </script>
  <?php endif ?>
</body>
</html>