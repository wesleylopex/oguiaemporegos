<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include_once 'application/views/imports/head.php' ?>
</head>
<body class="bg-gray-100 overflow-x-hidden">
  <?php include_once 'application/views/imports/header.php' ?>

  <section class="bg-white shadow-sm py-12 lg:py-0">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <div class="lg:py-20 flex flex-col items-center justify-center">
        <form data-loader=".image-preview__loader" id="profile-image-form" class="hidden" action="<?= base_url('candidates/profile/profileImage/save') ?>" method="post" enctype="multipart/form-data">
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" class="hidden">
        </form>
        <div class="image-preview cursor-pointer relative rounded-full p-1 border-2 border-primary">
          <figure class="rounded-full relative overflow-hidden w-32 h-32">
            <img class="image-preview__img w-full h-full object-cover" src="<?= ($this->session->userdata('candidate')['image'] ? base_url('assets/uploads/images/candidates/' . $candidate->image) : base_url('assets/site/images/icons/user.png')) ?>" loading="lazy" alt="<?= $candidate->name ?>" title="<?= $candidate->name ?>">
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
        <h1 class="text-center mt-6 font-medium text-2xl text-dark"><?= $candidate->name ?></h1>
        <span class="text-center mt-1 text-gray-500"><?= $candidate->email ?></span>
      </div>
      <div class="mt-6 lg:mt-0 flex flex-col lg:flex-row flex-wrap items-center justify-center lg:justify-between">
        <ul class="flex flex-wrap items-center justify-center lg:justify-start">
          <li>
            <a href="<?= base_url('candidates/profile') ?>">
              <div class="font-medium text-dark text-center px-6 py-4 mr-1 hover:bg-gray-200 rounded-sm cursor-pointer">
                Meu currículo
              </div>
            </a>
          </li>
          <li class="relative font-medium text-primary text-center px-6 py-4 mr-1">
            Meus interesses
            <div style="height: 2px" class="rounded-t-sm bottom-0 left-0 absolute w-full bg-primary"></div>
            <?php if (isset($todayInterestsLength) && $todayInterestsLength > 0) : ?>
              <div class="rounded-full top-0 right-0 absolute w-6 h-6 grid place-items-center text-white font-semibold text-xs bg-red-600">
                <?= $todayInterestsLength ?>
              </div>
            <?php endif ?>
          </li>
          <li class="open-new-password-form-modal font-medium text-dark text-center px-6 py-4 mr-1 hover:bg-gray-200 rounded-sm cursor-pointer">
            Alterar senha
          </li>
        </ul>
        <div class="flex items-center mt-6 lg:mt-0 ">
          <a href="<?= base_url('imprimir') ?>" target="_blank">
            <button class="btn btn--primary text-sm font-medium flex items-center">
              <i class="feather-lg mr-2" data-feather="printer"></i>
              Imprimir
            </button>
          </a>
          <button class="open-confirm-logout-modal ml-4 btn btn--primary btn--outline text-sm font-medium flex items-center">
            <i class="feather-lg mr-2" data-feather="log-out"></i>
            Sair
          </button>
        </div>
      </div>
    </div>
  </section>

  <?php if (count($jobs) > 0 || (isset($todayInterestsLength) && $todayInterestsLength > 0)) : ?>
    <section class="pt-6">
      <div class="wrapper md:w-4/5 md:mx-auto">
        <div class="p-6 bg-blue-600 rounded-sm shadow-md flex items-center">
          <i class="text-white mr-4" data-feather="bell"></i>
          <h1 class="text-white">Fique atento ao seu <span class="font-medium">e-mail e telefone</span>, as empresas podem entrar em contato.</h1>
        </div>
      </div>
    </section>
  <?php endif ?>

  <section class="py-6">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <?php if (count($jobs) > 0) : ?>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <?php foreach ($jobs as $job) : ?>
            <div class="bg-white p-6 rounded-sm shadow-md">
              <div class="flex justify-between">
                <a href="<?= base_url($this->session->userdata('company')['username']) ?>">
                  <div class="flex items-center">
                    <figure class="rounded-full border border-gray-300 overflow-hidden w-14 h-14">
                      <img class="image-preview__img flex-shrink-0 w-full h-full object-cover" src="<?= $job->company->image ? base_url('assets/uploads/images/companies/' . $job->company->image) : base_url('assets/site/images/icons/user.png') ?>" loading="lazy" alt="<?= $job->company->name ?>" title="<?= $job->company->name ?>">
                    </figure>
                    <div class="ml-4 flex flex-col">
                      <h1 class="hover:underline font-medium text-dark"><?= $job->company->name ?></h1>
                      <span class="hover:underline text-sm text-gray-500">@<?= $job->company->username ?></span>
                    </div>
                  </div>
                </a>
                <div>
                  <button onclick="setModalJobId(<?= $job->id ?>)" title="Remover interesse" class="open-confirm-delete-interest-modal transition-colors duration-300 bg-gray-100 hover:bg-gray-200 p-2 rounded-full flex items-center justify-center">
                    <i class="feather-lg" data-feather="trash"></i>
                  </button>
                </div>
              </div>
              <div class="mt-4">
                <a href="<?= base_url('vaga-de-emprego/' . $job->slug) ?>">
                  <h2 class="hover:underline font-medium text-dark"><?= $job->title ?></h2>
                </a>
                <div class="flex flex-wrap items-center">
                  <div class="mr-4 mt-4 flex items-center" title="Data de criação">
                    <i class="text-dark feather-lg mr-2" data-feather="calendar"></i>
                    <p class="paragraph text-sm"><?= date('d/m/Y, H:i', strtotime($job->interest->created_at)) ?></p>
                  </div>
                  <?php if (isset($job->city)) : ?>
                    <div class="mr-4 mt-4 flex items-center" title="Localização">
                      <i class="text-dark feather-lg mr-2" data-feather="map-pin"></i>
                      <p class="paragraph text-sm"><?= $job->city->name ?></p>
                    </div>
                  <?php endif ?>
                  <?php if (isset($job->situation)) : ?>
                    <div class="mr-4 mt-4 badge text-<?= $job->situation->type ?> flex items-center" title="Situação">
                      <i class="feather-lg mr-2" data-feather="info"></i>
                      <p class="font-medium text-sm"><?= $job->situation->title ?></p>
                    </div>
                  <?php endif ?>
                  <div class="mt-4 flex items-center" title="Salário">
                    <i class="text-dark mr-2 far fa-money-bill-alt"></i>
                    <?php if ($job->salary > 0) : ?>
                      <p class="paragraph text-sm">R$ <span class="money"><?= $job->salary ?></span></p>
                    <?php else : ?>
                      <p class="paragraph text-sm">A combinar</span></p>
                    <?php endif ?>
                  </div>
                </div>
                <p class="mt-4 paragraph text-sm"><?= word_limiter($job->activities_description, 16) ?></p>
                <div class="mt-4 flex flex-col sm:flex-row items-start md:items-center justify-between">
                  <?php if (isset($job->interest->situation)) : ?>
                    <div class="mb-4 sm:mb-0 badge badge--<?= $job->interest->situation->type ?>"><?= $job->interest->situation->title ?></div>
                  <?php endif ?>
                  <?php if ($job->company->whatsapp) : ?>
                    <a href="https://api.whatsapp.com/send?phone=+55<?= $job->company->whatsapp ?>&text=Olá, meu nome é <?= $this->session->userdata('candidate')['name'] ?>, me interessei na vaga <?= $job->title ?>" target="_blank" rel="noopener noreferrer">
                      <button class="flex items-center text-green-600">
                        <span class="text-sm hover:underline font-medium">Enviar mensagem</span>
                        <i class="text-xl ml-2 fab fa-whatsapp"></i>
                      </button>
                    </a>
                  <?php endif ?>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      <?php else : ?>
        <div class="mt-6 bg-white p-6 rounded-sm shadow-md">
          <div class="md:w-2/5">
            <a href="https://storyset.com" target="_blank" rel="noopener noreferrer">
              <figure>
                <img src="<?= base_url('assets/site/images/illustrations/rising-cuate.svg') ?>" loading="lazy" alt="Progresso SVG">
              </figure>
            </a>
          </div>
          <h1 class="text-gray-700 mt-4 text-xl">
            Candidate-se em quantas vagas quiser, <span class="font-medium md:uppercase">é grátis</span>
          </h1>
          <ul class="mt-6 grid grid-cols-1 gap-4">
            <li class="flex items-center">
              <i class="text-green-600 mr-2" data-feather="check-circle"></i>
              <p class="paragraph">Visite a <a href="<?= base_url('vagas-de-emprego') ?>" class="hover:underline font-medium">página de empregos</a></p>
            </li>
            <li class="flex items-center">
              <i class="text-green-600 mr-2" data-feather="check-circle"></i>
              <p class="paragraph">Escolha as vagas que se <span class="font-medium">interessou</span></p>
            </li>
            <li class="flex items-center">
              <i class="text-green-600 mr-2" data-feather="check-circle"></i>
              <p class="paragraph">Se <span class="font-medium">candidate</span> nas vagas</p>
            </li>
            <li class="flex items-center">
              <i class="text-green-600 mr-2" data-feather="check-circle"></i>
              <p class="paragraph">Aguarde a <span class="font-medium">resposta da empresa</span></p>
            </li>
          </ul>
          <a href="<?= base_url('vagas-de-emprego') ?>">
            <button class="mt-6 flex items-center hover:underline text-blue-600">
              <span class="text-left">Ver todas as vagas de emprego</span>
              <i class="feather-lg ml-2" data-feather="chevron-right"></i>
            </button>
          </a>
        </div>
      <?php endif ?>
    </div>
  </section>

  <?php include_once 'application/views/imports/footer.php' ?>

  <!-- Modals -->
  <?php include_once 'application/views/candidates/profile/modals/forms/personal-info.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/forms/address.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/forms/description.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/forms/professional-goals.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/forms/formations.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/forms/new-password.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/confirm-logout.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/confirm-delete-interest.php' ?>
  
  <?php include_once 'application/views/imports/scripts.php' ?>
  <script src="https://cdn.jsdelivr.net/npm/cep-promise/dist/cep-promise.min.js"></script>

  <script>
    function setModalJobId (jobId) {
      const modal = document.querySelector('#confirm-delete-interest-modal')
      const field = modal.querySelector('[name=job-id]')
      
      field.value = jobId
    }
  </script>

  <script type="module">
    import { ImagePreview } from '<?= base_url('assets/site/scripts/ImagePreview/ImagePreview.js') ?>'
    import { Filters } from '<?= base_url('assets/site/scripts/Filters/Filters.js') ?>'
    import { Modal } from '<?= base_url('assets/site/scripts/Modal/Modal.js') ?>'
    import { Alert } from '<?= base_url('assets/site/scripts/Alert/Alert.js') ?>'
    import { InputLengthCounter } from '<?= base_url('assets/site/scripts/InputLengthCounter/InputLengthCounter.js') ?>'

    window.addEventListener('load', function () {
      initImagePreview()
      initModals()
      onModalsFormsSubmit()
    })

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
      modal.add('#new-password-form-modal', { reopenClass: 'open-new-password-form-modal' })
      modal.add('#confirm-logout-modal', { reopenClass: 'open-confirm-logout-modal' })
      modal.add('#confirm-delete-interest-modal', { reopenClass: 'open-confirm-delete-interest-modal' })
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