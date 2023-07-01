<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title><?= slugify('O Guia Empregos - Currículo ' . $candidate->name) ?></title>
  <?php include_once 'application/views/imports/head.php' ?>
</head>
<body class="overflow-x-hidden">
  <section class="py-6">
    <div class="wrapper md:w-4/5 md:mx-auto grid grid-cols-3">
      <figure>
        <img class="w-12" src="<?= base_url('assets/site/images/company/logo-amarelo-azul.png') ?>" loading="lazy" alt="O Guia Empregos" title="O Guia Empregos">
      </figure>
      <div class="flex flex-col items-center justify-center">
        <?php if ($candidate->image) : ?>
          <div class="overflow-hidden rounded-full p-1 border-2 border-primary">
            <figure class="rounded-full overflow-hidden w-32 h-32">
              <img class="w-full h-full object-cover" src="<?= base_url('assets/uploads/images/candidates/' . $candidate->image) ?>" loading="lazy" alt="<?= $candidate->name ?>" title="<?= $candidate->name ?>">
            </figure>
          </div>
        <?php endif ?>
        <h1 class="text-center mt-6 font-medium text-xl text-dark"><?= $candidate->name ?></h1>
        <span class="text-center mt-1 text-gray-500"><?= $candidate->email ?></span>
      </div>
    </div>
  </section>

  <section class="py-6">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <div class="grid grid-cols-2 gap-6">
        <div class="border border-gray-200 rounded-md p-4">
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <i class="text-primary mr-3" data-feather="user"></i>
              <h2 class="text-dark font-medium">Informações pessoais</h2>
            </div>
          </div>
          <div class="mt-4 flex items-center">
            <i class="text-gray-500 feather-lg mr-3" data-feather="info"></i>
            <p class="paragraph text-gray-500"><?= $candidate->age ?> anos, <?= $candidate->genre ?>, <?= $candidate->marital_status ?></p>
          </div>
          <div class="mt-2 flex items-center">
            <i class="text-gray-500 feather-lg mr-3" data-feather="phone"></i>
            <p class="paragraph text-gray-500 phone"><?= $candidate->phone ?></p>
          </div>
          <div class="mt-2 flex items-center">
            <i class="text-gray-500 feather-lg mr-3" data-feather="credit-card"></i>
            <p class="paragraph text-gray-500"><?= $candidate->cpf ?> (CPF), <?= $candidate->rg ?> (RG)</p>
          </div>
        </div>
        <div class="border border-gray-200 rounded-md p-4">
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <i class="text-primary mr-3" data-feather="target"></i>
              <h2 class="text-dark font-medium">Objetivos profissionais</h2>
            </div>
          </div>
          <?php if ($candidate->function_1 || $candidate->function_2 || $candidate->function_3) : ?>
            <div class="mt-4">
              <h3 class="mb-1 font-medium text-dark">Cargos</h3>
              <?php if ($candidate->function_1) : ?>
                <p class="paragraph text-gray-500"><?= $candidate->function_1 ?></p>
              <?php endif ?>
              <?php if ($candidate->function_2) : ?>
                <p class="paragraph text-gray-500"><?= $candidate->function_2 ?></p>
              <?php endif ?>
              <?php if ($candidate->function_3) : ?>
                <p class="paragraph text-gray-500"><?= $candidate->function_3 ?></p>
              <?php endif ?>
            </div>
          <?php endif ?>
          <?php if ($candidate->desired_salary) : ?>
            <div class="mt-4">
              <h3 class="mb-1 font-medium text-dark">Salário pretendido</h3>
              <div class="flex items-center">
                <p class="paragraph text-gray-500 mr-2">R$</p>
                <p class="paragraph text-gray-500 money"><?= $candidate->desired_salary ?></p>
              </div>
            </div>
          <?php endif ?>
        </div>
        <div class="border border-gray-200 rounded-md p-4">
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <i class="text-primary mr-3" data-feather="map-pin"></i>
              <h2 class="text-dark font-medium">Endereço</h2>
            </div>
          </div>
          <?php if ($candidate->address_zip_code) : ?>
            <div class="mt-4">
              <p class="paragraph text-gray-500">
                <?= "$candidate->address_zip_code - $candidate->address_street, $candidate->address_number - Bairro $candidate->address_neighborhood" . ($candidate->address_complement ? ", $candidate->address_complement" : '') . ", $candidate->address_city - $candidate->address_uf" ?>
              </p>
            </div>
          <?php endif ?>
        </div>
        <?php if ($candidate->description) : ?>
          <div class="border border-gray-200 rounded-md p-4">
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <i class="text-primary mr-3" data-feather="file-text"></i>
                <h2 class="text-dark font-medium">Descrição</h2>
              </div>
            </div>
            <?php if ($candidate->description) : ?>
              <p class="mt-4 paragraph text-gray-500"><?= $candidate->description ?></p>
            <?php endif ?>
          </div>
        <?php endif ?>
      </div>
    </div>
  </section>

  <?php if (isset($candidate->formations) && is_array($candidate->formations) && count($candidate->formations) > 0) : ?>
    <section class="py-6">
      <div class="wrapper md:w-4/5 md:mx-auto">
        <div>
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <i class="text-primary mr-3" data-feather="book"></i>
              <h2 class="text-dark font-medium">Escolaridade</h2>
            </div>
          </div>
          <div class="mt-4 grid grid-cols-2 gap-6">
            <?php foreach ($candidate->formations as $formation) : ?>
              <div class="border border-gray-200 rounded-md p-4">
                <div class="mb-1 flex items-center justify-between">
                  <div class="flex items-center">
                    <h3 class="font-medium text-dark"><?= $formation->institution_name ?></h3>
                  </div>
                </div>
                <p class="paragraph text-gray-500"><?= $formation->formation_degree ?><?= $formation->course_name ? (' - ' . $formation->course_name) : '' ?></p>
                <p class="paragraph text-gray-500">
                  <?= date('d/m/Y', strtotime($formation->started_at)) ?>
                  -
                  <?= $formation->ended_at ? date('d/m/Y', strtotime($formation->ended_at)) : 'Não concluído' ?>
                </p>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif ?>

  <?php if (isset($candidate->courses) && is_array($candidate->courses) && count($candidate->courses) > 0) : ?>
    <section class="py-6">
      <div class="wrapper md:w-4/5 md:mx-auto">
        <div>
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <i class="text-primary mr-3" data-feather="edit"></i>
              <h2 class="text-dark font-medium">Cursos e certificações</h2>
            </div>
          </div>
          <div class="mt-4 grid grid-cols-2 gap-6">
            <?php foreach ($candidate->courses as $course) : ?>
              <div class="border border-gray-200 rounded-md p-4">
                <div class="mb-1 flex items-center justify-between">
                  <h3 class="font-medium text-dark"><?= $course->course_name ?></h3>
                </div>
                <p class="paragraph text-gray-500"><?= $course->institution_name ?> - <?= $course->hours ?> horas</p>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif ?>

  <?php if (isset($candidate->experiences) && is_array($candidate->experiences) && count($candidate->experiences) > 0) : ?>
    <section class="py-6">
      <div class="wrapper md:w-4/5 md:mx-auto">
        <div>
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <i class="text-primary mr-3" data-feather="briefcase"></i>
              <h2 class="text-dark font-medium">Experiências profissionais</h2>
            </div>
          </div>
          <div class="mt-4 grid grid-cols-2 gap-6">
            <?php foreach ($candidate->experiences as $experience) : ?>
              <div class="border border-gray-200 rounded-md p-4">
                <div class="mb-1 flex items-center justify-between">
                  <h3 class="font-medium text-dark"><?= $experience->function ?></h3>
                </div>
                <p class="paragraph text-gray-500"><?= $experience->company_name ?><?= isset($experience->area) ? (' - ' . $experience->area->title) : '' ?></p>
                <p class="paragraph text-gray-500">R$ <span class="money"><?= $experience->salary ?></span></p>
                <p class="paragraph text-gray-500"><?= date('d/m/Y', strtotime($experience->entry_date)) ?> - <?= $experience->exit_date ? date('d/m/Y', strtotime($experience->exit_date)) : 'Atualmente' ?></p>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif ?>

  <?php if (isset($candidate->languages) && is_array($candidate->languages) && count($candidate->languages) > 0) : ?>          
    <section class="py-6">
      <div class="wrapper md:w-4/5 md:mx-auto">
        <div>
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <i class="text-primary mr-3" data-feather="globe"></i>
              <h2 class="text-dark font-medium">Idiomas</h2>
            </div>
          </div>
          <div class="mt-4 flex flex-wrap items-center">
            <?php foreach ($candidate->languages as $language) : ?>
              <div class="flex items-center border border-gray-200 rounded-md p-4 py-2 px-3 mr-4 mb-4">
                <p class="text-sm text-gray-700"><span class="font-medium"><?= $language->language ?></span> - <?= $language->level ?></p>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif ?>

  <?php include_once 'application/views/imports/scripts.php' ?>

  <script>
    window.addEventListener('load', () => {
      window.print()
    })

    window.addEventListener('afterprint', () => {
      window.history.back()
    })
  </script>
</body>
</html>