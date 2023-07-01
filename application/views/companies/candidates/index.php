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
        <?php if ($candidate->image) : ?>
          <div class="overflow-hidden rounded-full p-1 border-2 border-primary">
            <figure class="rounded-full relative overflow-hidden w-32 h-32">
              <img class="w-full h-full object-cover" src="<?= base_url('assets/uploads/images/candidates/' . $candidate->image) ?>" loading="lazy" alt="<?= $candidate->name ?>" title="<?= $candidate->name ?>">
            </figure>
          </div>
        <?php endif ?>
        <h1 class="text-center mt-6 font-medium text-2xl text-dark"><?= $candidate->name ?></h1>
        <a href="mailto:<?= $candidate->email ?>">
          <span class="hover:underline text-center mt-2 text-gray-500"><?= $candidate->email ?></span>
        </a>
        <div class="mt-6 grid grid-cols-1 gap-4">
          <?php if ($candidate->resume_file) : ?>
            <a href="<?= base_url('assets/uploads/files/candidates/' . $candidate->resume_file) ?>" download>
              <button class="w-full btn btn--primary text-sm font-medium flex justify-center items-center">
                <i class="feather-lg mr-2" data-feather="download"></i>
                Baixar currículo
              </button>
            </a>
          <?php else : ?>
            <button disabled class="w-full btn btn--primary text-sm font-medium flex justify-center items-center">
              <i class="feather-lg mr-2" data-feather="download"></i>
              Nenhum arquivo anexado
            </button>
          <?php endif ?>
          <a href="<?= base_url('imprimir/' . $candidate->id) ?>">
            <button class="w-full btn btn--primary btn--outline text-sm font-medium flex justify-center items-center">
              <i class="feather-lg mr-2" data-feather="printer"></i>
              Imprimir perfil
            </button>
          </a>
          <?php if ($candidate->whatsapp) : ?>
            <a href="https://api.whatsapp.com/send?phone=+55<?= $candidate->whatsapp ?>&text=Olá <?= $candidate->name ?>, vimos seu currículo no site O Guia Empregos e achamos interessante" target="_blank" rel="noopener noreferrer">
              <button class="w-full btn btn--whatsapp text-sm font-medium">
                <img class="btn__image btn__image--white mr-2" src="<?= base_url('assets/site/images/icons/whatsapp.svg') ?>" loading="lazy" alt="WhatsApp logo svg">
                Enviar mensagem
              </button>
            </a>
          <?php endif ?>
        </div>
      </div>
    </div>
  </section>

  <section class="pb-3 pt-6">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <button onclick="history.back()" class="open-personal-info-form-modal flex items-center hover:underline text-blue-600">
        <i class="feather-lg mr-2" data-feather="chevron-left"></i>
        <span>Voltar</span>
      </button>
    </div>
  </section>

  <section class="py-3">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-sm shadow-md">
          <div class="flex items-center">
            <i class="text-primary mr-3" data-feather="user"></i>
            <h2 class="text-dark font-medium text-lg">Informações pessoais</h2>
          </div>
          <?php if ($candidate->age) : ?>
            <div class="mt-6 flex items-center">
              <i class="text-gray-500 feather-lg mr-3" data-feather="info"></i>
              <p class="paragraph text-gray-500"><?= $candidate->age ?> anos, <?= $candidate->genre ?>, <?= $candidate->marital_status ?></p>
            </div>
          <?php endif ?>
          <?php if ($candidate->phone) : ?>
            <div class="mt-2 flex items-center">
              <i class="text-gray-500 feather-lg mr-3" data-feather="phone"></i>
              <p class="phone paragraph text-gray-500"><?= $candidate->phone ?></p>
            </div>
          <?php endif ?>
          <?php if ($candidate->cpf && $candidate->rg) : ?>
            <div class="mt-2 flex items-center">
              <i class="text-gray-500 feather-lg mr-3" data-feather="credit-card"></i>
              <p class="paragraph text-gray-500"><?= $candidate->cpf ?> (CPF), <?= $candidate->rg ?> (RG)</p>
            </div>
          <?php endif ?>
        </div>
        <div class="bg-white p-6 rounded-sm shadow-md">
          <div class="flex items-center">
            <i class="text-primary mr-3" data-feather="target"></i>
            <h2 class="text-dark font-medium text-lg">Objetivos profissionais</h2>
          </div>
          <?php if ($candidate->function_1 || $candidate->function_2 || $candidate->function_3) : ?>
            <div class="mt-6">
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
            <div class="mt-6">
              <h3 class="mb-1 font-medium text-dark">Salário pretendido</h3>
              <div class="flex items-center">
                <p class="paragraph text-gray-500 mr-2">R$</p>
                <p class="paragraph text-gray-500 money"><?= $candidate->desired_salary ?></p>
              </div>
            </div>
          <?php endif ?>
        </div>
        <div class="bg-white p-6 rounded-sm shadow-md">
          <div class="flex items-center">
            <i class="text-primary mr-3" data-feather="map-pin"></i>
            <h2 class="text-dark font-medium text-lg">Endereço</h2>
          </div>
          <?php if ($candidate->address_zip_code) : ?>
            <div class="mt-6">
              <p class="paragraph text-gray-500">
                <?= "$candidate->address_zip_code - $candidate->address_street, $candidate->address_number - Bairro $candidate->address_neighborhood" . ($candidate->address_complement ? ", $candidate->address_complement" : '') . ", $candidate->address_city - $candidate->address_uf" ?>
              </p>
            </div>
          <?php endif ?>
        </div>
        <div class="bg-white p-6 rounded-sm shadow-md">
          <div class="flex items-center">
            <i class="text-primary mr-3" data-feather="file-text"></i>
            <h2 class="text-dark font-medium text-lg">Descrição</h2>
          </div>
          <?php if ($candidate->description) : ?>
            <p class="mt-6 paragraph text-gray-500"><?= $candidate->description ?></p>
          <?php endif ?>
        </div>
      </div>
    </div>
  </section>

  <section class="py-3">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <div class="bg-white p-6 rounded-sm shadow-md">
        <div class="flex items-center">
          <i class="text-primary mr-3" data-feather="book"></i>
          <h2 class="text-dark font-medium text-lg">Escolaridade</h2>
        </div>
        <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-6">
          <?php foreach ($candidate->formations as $formation) : ?>
            <div class="bg-gray-100 shadow-md p-4 rounded-sm">
              <div class="mb-1">
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

  <section class="py-3">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <div class="bg-white p-6 rounded-sm shadow-md">
        <div class="flex items-center">
          <i class="text-primary mr-3" data-feather="edit"></i>
          <h2 class="text-dark font-medium text-lg">Cursos e certificações</h2>
        </div>
        <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-6">
          <?php foreach ($candidate->courses as $course) : ?>
            <div class="bg-gray-100 shadow-md p-4 rounded-sm">
              <div class="mb-1">
                <h3 class="font-medium text-dark"><?= $course->course_name ?></h3>
              </div>
              <p class="paragraph text-gray-500"><?= $course->institution_name ?> - <?= $course->hours ?> horas</p>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </section>

  <section class="py-3">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <div class="bg-white p-6 rounded-sm shadow-md">
        <div class="flex items-center">
          <i class="text-primary mr-3" data-feather="briefcase"></i>
          <h2 class="text-dark font-medium text-lg">Experiências profissionais</h2>
        </div>
        <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-6">
          <?php foreach ($candidate->experiences as $experience) : ?>
            <div class="bg-gray-100 shadow-md p-4 rounded-sm">
              <div class="mb-1">
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

  <section class="py-3">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <div class="bg-white p-6 rounded-sm shadow-md">
        <div class="flex items-center">
          <i class="text-primary mr-3" data-feather="globe"></i>
          <h2 class="text-dark font-medium text-lg">Idiomas</h2>
        </div>
        <div class="mt-10 flex flex-wrap items-center">
          <?php foreach ($candidate->languages as $language) : ?>
            <div class="flex items-center cursor-pointer bg-gray-100 shadow-md p-4 rounded-sm py-1 px-1 mr-4 mb-4">
              <p class="text-sm text-gray-700"><span class="font-medium"><?= $language->language ?></span> - <?= $language->level ?></p>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </section>

  <?php include_once 'application/views/imports/footer.php' ?>
  <?php include_once 'application/views/imports/scripts.php' ?>
</body>
</html>