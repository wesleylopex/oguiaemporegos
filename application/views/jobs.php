<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include_once 'application/views/imports/head.php' ?>
</head>
<body>
  <?php include_once 'application/views/imports/header.php' ?>

  <section class="py-12 md:py-20 bg-gray-100">
    <div class="wrapper">
      <div class="md:w-1/3 md:mx-auto">
        <h1 class="text-dark font-medium mx-auto text-center text-xl md:text-2xl leading-relaxed md:leading-relaxed">
          Encontre as melhores vagas de emprego da região
        </h1>
        <?php if ($jobsLength > 100) : ?>
          <p class="text-center paragraph mt-6">Mais de <span class="font-medium"><?= number_format($jobsLength, 0, ',', '.') ?> oportunidades</span> esperando por você</p>
        <?php endif ?>
      </div>
      <div class="mt-10 md:mt-20 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:cols-span-1">
          <div class="p-6 bg-white rounded-sm shadow-md">
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <i class="text-dark" data-feather="sliders"></i>
                <p class="text-dark ml-2 font-medium">Filtros</p>
              </div>
              <button type="button" id="clear-filters" class="text-sm hover:underline text-blue-600">
                Limpar todos
              </button>
            </div>
            <form id="filters-form" action="<?= base_url('vagas-de-emprego') ?>" method="get" class="mt-6 grid grid-cols-1 gap-4">
              <div>
                <label class="input-label">Título ou palavras chaves</label>
                <input value="<?= $this->input->get('query') ?>" type="text" name="query" class="input">
              </div>
              <div>
                <label class="input-label mb-2">Cidade</label>
                <select name="cities[]" multiple class="select2 input">
                  <?php foreach ($cities as $city) : ?>
                    <option
                      <?= $this->input->get('cities') && in_array($city->id, $this->input->get('cities')) ? 'selected' : '' ?>
                      value="<?= $city->id ?>"
                    ><?= $city->name ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div>
                <label class="input-label mb-2">Área</label>
                <select name="areas[]" multiple class="select2 input">
                  <?php foreach ($areas as $area) : ?>
                    <option
                      <?= $this->input->get('areas') && in_array($area->id, $this->input->get('areas')) ? 'selected' : '' ?>
                      value="<?= $area->id ?>"
                    ><?= $area->title ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div>
                <label class="input-label mb-2">Tipo de vaga</label>
                <select name="types[]" multiple class="select2 input">
                  <?php foreach ($types as $type) : ?>
                    <option
                      <?= $this->input->get('types') && in_array($type->id, $this->input->get('types')) ? 'selected' : '' ?>
                      value="<?= $type->id ?>"
                    ><?= $type->title ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div>
                <label class="input-label mb-2">Empresa</label>
                <select name="companies[]" multiple class="select2 input">
                  <?php foreach ($companies as $company) : ?>
                    <option
                      <?= $this->input->get('companies') && in_array($company->id, $this->input->get('companies')) ? 'selected' : '' ?>
                      value="<?= $company->id ?>"
                      ><?= $company->name ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div>
                <button class="w-full btn btn--primary">Filtrar</button>
              </div>
            </form>
          </div>
        </div>
        <div class="md:col-span-2">
          <?php if (isset($jobs) && is_array($jobs) && count($jobs) > 0) : ?>
            <div class="flex flex-wrap items-center justify-between">
              <h2 class="font-medium uppercase text-dark">Vagas de emprego</h2>
              <p class="text-dark text-sm">
                <?= isset($resultsMessage) ? $resultsMessage : '' ?>
              </p>
            </div>
            <div class="mt-6 grid grid-cols-1 xl:grid-cols-2 gap-6">
              <?php foreach ($jobs as $job) : ?>
                <div class="bg-white p-6 rounded-sm shadow-md">
                  <div class="flex justify-between">
                    <a href="<?= base_url($job->company->username) ?>">
                      <div class="flex items-center">
                        <figure class="rounded-full border border-gray-300 overflow-hidden w-14 h-14">
                          <img class="image-preview__img flex-shrink-0 w-full h-full object-cover" src="<?= $job->company->image ? base_url('assets/uploads/images/companies/' . $job->company->image) : base_url('assets/site/images/icons/user.png') ?>" loading="lazy" alt="<?= $job->company->name ?>" title="<?= $job->company->name ?>">
                        </figure>
                        <div class="ml-4 flex flex-col">
                          <h3 class="hover:underline font-medium text-dark"><?= $job->company->name ?></h3>
                          <span class="hover:underline text-sm text-gray-500">@<?= $job->company->username ?></span>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="mt-4">
                    <a href="<?= base_url('vaga-de-emprego/' . $job->slug) ?>">
                      <h4 class="hover:underline font-medium text-dark"><?= $job->title ?></h4>
                    </a>
                    <div class="flex flex-wrap items-center">
                      <?php if (isset($job->city)) : ?>
                        <div class="mr-4 mt-4 flex items-center" title="Localização">
                          <i class="text-dark feather-lg mr-2" data-feather="map-pin"></i>
                          <p class="paragraph text-sm"><?= $job->city->name ?></p>
                        </div>
                      <?php endif ?>
                      <?php if (isset($job->situation)) : ?>
                        <div class="mr-4 mt-4 flex items-center" title="Situação">
                          <i class="text-dark feather-lg mr-2" data-feather="info"></i>
                          <p class="paragraph text-sm"><?= $job->situation->title ?></p>
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
                    <?php if (isset($job->interest->situation)) : ?>
                      <div class="flex">
                        <div class="mt-4 sm:mb-0 badge badge--<?= $job->interest->situation->type ?>"><?= $job->interest->situation->title ?></div>
                      </div>
                    <?php endif ?>
                    <a href="<?= base_url('vaga-de-emprego/' . $job->slug) ?>">
                      <button class="mt-4 flex items-start hover:underline text-blue-600">
                        <div class="flex items-center">
                          <span>Registrar interesse</span>
                          <i class="feather-lg ml-2" data-feather="chevron-right"></i>
                        </div>
                      </button>
                    </a>
                  </div>
                </div>
              <?php endforeach ?>
            </div>
            <?php if (isset($pagination) && $pagination) : ?>
              <div class="mt-6 pagination">
                <?= $pagination ?>
              </div>
            <?php endif ?>
          <?php else: ?>
            <div class="bg-white p-6 rounded-sm shadow-md">
              <a class="w-full" href="https://storyset.com" target="_blank" rel="noopener noreferrer">
                <img class="md:w-2/5" src="<?= base_url('assets/site/images/illustrations/rising-cuate.svg') ?>" loading="lazy" alt="Progresso SVG">
              </a>
              <h1 class="text-gray-700 mt-4 text-xl font-semibold">Nenhuma vaga de emprego foi encontrada</h1>
              <ul class="mt-4 grid grid-cols-1 gap-3">
                <li class="flex items-center">
                  <i class="text-green-600 mr-2" data-feather="check-circle"></i>
                  <p class="paragraph">Tente realizar uma <span class="font-medium">pesquisa</span> mais ampla</p>
                </li>
                <li class="flex items-center">
                  <i class="text-green-600 mr-2" data-feather="check-circle"></i>
                  <p class="paragraph">Se você tem alguma sugestão, <span class="font-medium">entre em contato com a gente</span></p>
                </li>
                <li class="flex items-center">
                  <i class="text-green-600 mr-2" data-feather="check-circle"></i>
                  <a href="mailto:contato@pontoagencia.com.br">
                    <p class="paragraph text-blue-600 hover:underline">contato@pontoagencia.com.br</p>
                  </a>
                </li>
              </ul>
            </div>
          <?php endif ?>
        </div>
      </div>
    </div>
  </section>

  <?php include_once 'application/views/imports/footer.php' ?>
  <?php include_once 'application/views/imports/scripts.php' ?>

  <script>
    window.addEventListener('load', function () {
      onFiltersFormSubmit()
      clearFilters()
    })

    function onFiltersFormSubmit () {
      const form = document.querySelector('form#filters-form')
      
      form.addEventListener('submit', (event) => {
        const fields = event.target.querySelectorAll('[name]')
        
        fields.forEach(field => {
          if (!field.value) field.disabled = true
        })
      })
    }

    function clearFilters () {
      const form = document.querySelector('form#filters-form')
      const inputs = form.querySelectorAll('[name]')
      const clearButton = document.querySelector('button#clear-filters')
      const select2 = $('form#filters-form .select2')

      clearButton.addEventListener('click', () => {
        form.reset()

        inputs.forEach(input => {
          input.value = ''
        })

        select2.select2().val('')
      })
    }
  </script>
</body>
</html>