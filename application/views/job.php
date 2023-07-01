<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include_once 'application/views/imports/head.php' ?>
</head>
<body class="overflow-x-hidden">
  <?php include_once 'application/views/imports/header.php' ?>

  <section class="py-12 md:py-20 bg-gray-100">
    <div class="wrapper">
      <button onclick="history.back()" class="mb-6 flex items-start hover:underline text-blue-600">
        <div class="flex items-center">
          <i class="feather-lg mr-2" data-feather="chevron-left"></i>
          <span>Voltar</span>
        </div>
      </button>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-1">
          <div class="grid grid-cols-1 gap-6">
            <div>
              <div class="grid grid-cols-1 gap-6 p-6 bg-white rounded-sm shadow-md">
                <div>
                  <p class="text-dark font-medium">Título da vaga</p>
                  <h1 class="paragraph text-gray-600 text-sm mt-1">
                    <?= $job->title ?>
                  </h1>
                </div>
                <?php if (isset($job->company)) : ?>
                  <div>
                    <p class="text-dark font-medium">Empresa</p>
                    <h2 class="paragraph text-gray-600 text-sm mt-1">
                      <?= $job->company->name ?>
                    </h2>
                  </div>
                <?php endif ?>
                <?php if (isset($job->city)) : ?>
                  <div>
                    <p class="text-dark font-medium">Localização</p>
                    <h2 class="paragraph text-gray-600 text-sm mt-1">
                      <?= $job->city->name ?>
                    </h2>
                  </div>
                <?php endif ?>
                <div>
                  <p class="text-dark font-medium">Horário</p>
                  <h2 class="paragraph text-gray-600 text-sm mt-1">
                    <?= $job->work_time ?>
                  </h2>
                </div>
                <?php if (isset($job->area)) : ?>
                  <div>
                    <p class="text-dark font-medium">Área</p>
                    <h2 class="paragraph text-gray-600 text-sm mt-1">
                      <?= $job->area->title ?>
                    </h2>
                  </div>
                <?php endif ?>
                <div>
                  <h2 class="text-dark font-medium">Salário</h2>
                  <p class="mt-1 paragraph text-sm text-gray-600">
                    <?php if ($job->salary > 0) : ?>
                      R$ <span class="money"><?= $job->salary ?></span>
                    <?php else : ?>
                      A combinar
                    <?php endif ?>
                  </p>
                </div>
                <div class="grid grid-cols-1 gap-2">
                  <?php if (isset($job->interest)) : ?>
                    <div>
                      <?php if (isset($job->situation) && $job->situation->is_finished) : ?>
                        <button class="w-full btn btn--primary" disabled><?= $job->situation->title ?></button>
                      <?php else : ?>
                        <button class="w-full btn btn--primary" disabled>Você já está concorrendo</button>
                      <?php endif ?>
                    </div>
                  <?php elseif ((isset($job->situation) && !$job->situation->is_finished) && $this->session->userdata('candidate')) : ?>
                    <div>
                      <button class="w-full btn btn--primary interest-button">Quero me candidatar</button>
                    </div>
                  <?php elseif ((isset($job->situation) && !$job->situation->is_finished) && !$this->session->userdata('company')) : ?>
                    <div>
                      <a href="<?= base_url('entrar') ?>">
                        <button class="w-full btn btn--primary">Faça login para se candidatar</button>
                      </a>
                    </div>
                  <?php endif ?>
                </div>
              </div>
            </div>
            <?php if (isset($job->company) && ($job->company->facebook || $job->company->instagram || $job->company->whatsapp)) : ?>
              <div>
                <div class="p-6 bg-white rounded-sm shadow-md">
                  <h2 class="text-lg text-dark text-center">Acompanhe a <?= $job->company->name ?></h2>
                  <div class="mt-6 flex flex-wrap items-center justify-center">
                    <?php if ($job->company->facebook) : ?>
                      <a href="https://facebook.com/<?= $job->company->facebook ?>" target="_blank" rel="noopener noreferrer">
                        <div class="m-4 flex flex-col items-center">
                          <img class="h-8 " src="<?= base_url('assets/site/images/social-media-logos/facebook-logo.png') ?>" loading="lazy" alt="Facebook Logo png">
                          <h3 class="paragraph text-gray-600 text-sm mt-2">Facebook</h3>
                        </div>
                      </a>
                    <?php endif ?>
                    <?php if ($job->company->instagram) : ?>
                      <a href="https://instagram.com/<?= $job->company->instagram ?>" target="_blank" rel="noopener noreferrer">
                        <div class="m-4 flex flex-col items-center">
                          <img class="h-8 " src="<?= base_url('assets/site/images/social-media-logos/instagram-logo.png') ?>" loading="lazy" alt="Instagram Logo png">
                          <h3 class="paragraph text-gray-600 text-sm mt-2">Instagram</h3>
                        </div>
                      </a>
                    <?php endif ?>
                  </div>
                </div>
              </div>
            <?php endif ?>
          </div>
        </div>
        <div class="md:col-span-2">
          <div class="p-6 grid grid-cols-1 gap-6 bg-white rounded-sm shadow-md">
            <?php if (isset($job->company)) : ?>
              <div class="flex items-center">
                <a href="<?= base_url($job->company->username) ?>">
                  <div class="flex items-center">
                    <figure class="rounded-full border border-gray-300 overflow-hidden w-14 h-14">
                      <img class="image-preview__img flex-shrink-0 w-full h-full object-cover" src="<?= $job->company->image ? base_url('assets/uploads/images/companies/' . $job->company->image) : base_url('assets/site/images/icons/user.png') ?>" loading="lazy" alt="<?= $job->company->name ?>" title="<?= $job->company->name ?>">
                    </figure>
                    <div class="ml-4 flex flex-col">
                      <h2 class="hover:underline font-medium text-dark"><?= $job->company->name ?></h2>
                      <span class="hover:underline text-sm text-gray-600">@<?= $job->company->username ?></span>
                    </div>
                  </div>
                </a>
              </div>
            <?php endif ?>
            <div class="flex flex-wrap items-center">
              <?php if (isset($job->city)) : ?>
                <div class="mt-4 mr-4 flex items-center" title="Localização">
                  <i class="text-dark feather-lg mr-2" data-feather="map-pin"></i>
                  <p class="paragraph text-sm text-gray-600"><?= $job->city->name ?></p>
                </div>
              <?php endif ?>
              <?php if (isset($job->situation)) : ?>
                <div class="mt-4 mr-4 badge badge--<?= $job->situation->type ?> flex items-center" title="Situação">
                  <i class="feather-lg mr-2" data-feather="info"></i>
                  <p class="font-medium text-sm"><?= $job->situation->title ?></p>
                </div>
              <?php endif ?>
              <div class="mt-4 flex items-center" title="Salário">
                <i class="text-dark mr-2 far fa-money-bill-alt"></i>
                <?php if ($job->salary > 0) : ?>
                  <p class="paragraph text-sm text-gray-600">R$ <span class="money"><?= $job->salary ?></span></p>
                <?php else : ?>
                  <p class="paragraph text-sm text-gray-600">A combinar</span></p>
                <?php endif ?>
              </div>
            </div>
            
            <div>
              <h2 class="font-medium text-dark">Título da vaga</h2>
              <p class="paragraph text-gray-600 mt-2 text-sm leading-relaxed">
                <?= $job->title ?>
              </p>
            </div>
            <div>
              <h2 class="font-medium text-dark">Descrição da vaga</h2>
              <p class="paragraph text-gray-600 mt-2 text-sm leading-relaxed">
                <?= nl2br($job->activities_description) ?>
              </p>
            </div>
            <?php if ($job->requirements) : ?>
              <div>
                <h2 class="font-medium text-dark">Requisitos</h2>
                <p class="paragraph text-gray-600 mt-2 text-sm leading-relaxed">
                  <?= nl2br($job->requirements) ?>
                </p>
              </div>
            <?php endif ?>
            <?php if ($job->benefits) : ?>
              <div>
                <h2 class="font-medium text-dark">Benefícios</h2>
                <p class="paragraph text-gray-600 mt-2 text-sm leading-relaxed">
                  <?= nl2br($job->benefits) ?>
                </p>
              </div>
            <?php endif ?>
            <?php if (isset($job->interest)) : ?>
              <div class="flex items-center">
                <?php if (isset($job->situation) && $job->situation->is_finished) : ?>
                  <button class="btn btn--primary" disabled><?= $job->situation->title ?></button>
                <?php else : ?>
                  <button class="btn btn--primary" disabled>Você já está concorrendo</button>
                <?php endif ?>
                <?php if (isset($job->interest->situation)) : ?>
                  <div class="ml-2 badge badge--<?= $job->interest->situation->type ?>"><?= $job->interest->situation->title ?></div>
                <?php endif ?>
              </div>
            <?php elseif ((isset($job->situation) && !$job->situation->is_finished) && $this->session->userdata('candidate')) : ?>
              <div>
                <button class="btn btn--primary interest-button">Quero me candidatar</button>
              </div>
            <?php elseif ((isset($job->situation) && !$job->situation->is_finished) && !$this->session->userdata('company')) : ?>
              <div>
                <a href="<?= base_url('entrar') ?>">
                  <button class="btn btn--primary">Faça login para se candidatar</button>
                </a>
              </div>
            <?php endif ?>
          </div>
          <?php if (isset($relatedJobs) && is_array($relatedJobs) && count($relatedJobs) > 0) : ?>
            <div class="mt-6">
              <h2 class="font-medium text-dark">Outras vagas desta empresa</h2>
            </div>
            <div class="mt-4 grid grid-cols-1 xl:grid-cols-2 gap-6">
              <?php foreach ($relatedJobs as $related) : ?>
                <div class="bg-white p-6 rounded-sm shadow-md">
                  <div class="flex justify-between">
                    <a href="<?= base_url($related->company->username) ?>">
                      <div class="flex items-center">
                        <figure class="rounded-full border border-gray-300 overflow-hidden w-14 h-14">
                          <img class="image-preview__img flex-shrink-0 w-full h-full object-cover" src="<?= $related->company->image ? base_url('assets/uploads/images/companies/' . $related->company->image) : base_url('assets/site/images/icons/user.png') ?>" loading="lazy" alt="<?= $related->company->name ?>" title="<?= $related->company->name ?>">
                        </figure>
                        <div class="ml-4 flex flex-col">
                          <h3 class="hover:underline font-medium text-dark"><?= $related->company->name ?></h3>
                          <span class="hover:underline text-sm text-gray-500">@<?= $related->company->username ?></span>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="mt-4">
                    <a href="<?= base_url('vaga-de-emprego/' . $related->slug) ?>">
                      <h4 class="hover:underline font-medium text-dark"><?= $related->title ?></h4>
                    </a>
                    <div class="flex flex-wrap items-center">
                      <?php if (isset($related->city)) : ?>
                        <div class="mr-4 mt-4 flex items-center" title="Localização">
                          <i class="text-dark feather-lg mr-2" data-feather="map-pin"></i>
                          <p class="paragraph text-sm"><?= $related->city->name ?></p>
                        </div>
                      <?php endif ?>
                      <?php if (isset($related->situation)) : ?>
                        <div class="mr-4 mt-4 flex items-center" title="Situação">
                          <i class="text-dark feather-lg mr-2" data-feather="info"></i>
                          <p class="paragraph text-sm"><?= $related->situation->title ?></p>
                        </div>
                      <?php endif ?>
                      <div class="mt-4 flex items-center" title="Salário">
                        <i class="text-dark mr-2 far fa-money-bill-alt"></i>
                        <?php if ($related->salary > 0) : ?>
                          <p class="paragraph text-sm">R$ <span class="money"><?= $related->salary ?></span></p>
                        <?php else : ?>
                          <p class="paragraph text-sm">A combinar</span></p>
                        <?php endif ?>
                      </div>
                    </div>
                    <p class="mt-4 paragraph text-sm"><?= word_limiter($related->activities_description, 16) ?></p>
                    <?php if (isset($related->interest->situation)) : ?>
                      <div class="flex">
                        <div class="mt-4 sm:mb-0 badge badge--<?= $related->interest->situation->type ?>"><?= $related->interest->situation->title ?></div>
                      </div>
                    <?php endif ?>
                    <a href="<?= base_url('vaga-de-emprego/' . $related->slug) ?>">
                      <button class="mt-4 flex items-start hover:underline text-blue-600">
                        <div class="flex items-center">
                          <span>Ver mais</span>
                          <i class="feather-lg ml-2" data-feather="chevron-right"></i>
                        </div>
                      </button>
                    </a>
                  </div>
                </div>
              <?php endforeach ?>
            </div>
          <?php endif ?>
        </div>
      </div>
    </div>
  </section>

  <?php include_once 'application/views/imports/footer.php' ?>
  <?php include_once 'application/views/imports/scripts.php' ?>

  <script type="module">
    import { Alert } from '<?= base_url('assets/site/scripts/Alert/Alert.js') ?>'

    window.addEventListener('load', () => {
      initInterest()
    })

    function initInterest () {
      const buttons = document.querySelectorAll('button.interest-button')

      buttons.forEach(button => {
        button.addEventListener('click', async () => {
          const created = await createInterest()

          if (created === true) {
            onSuccess()
          }
        })
      })

      function onSuccess () {
        buttons.forEach(button => {
          button.innerText = 'Você já está concorrendo'
          button.disabled = true
        })
      }
    }

    async function createInterest () {
      try {
        const url = '<?= base_url('candidates/jobs/createInterest/save') ?>'

        const body = new FormData()
        body.append('job_id', '<?= $job->id ?>')

        const response = await fetch(url, {
          method: 'POST',
          body
        }).then(response => response.json())

        const { success, error } = response

        if (!success) {
          showAlert('error', error)
          return false
        }

        showAlert('success', 'Candidatura realizada')
        return true
      } catch (error) {
        showAlert('error', 'Erro ao se candidatar, se continuar entre em contato')
        return false
      }
    }
  </script>
</body>
</html>