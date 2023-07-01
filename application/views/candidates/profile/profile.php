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
          <li class="relative font-medium text-primary text-center px-6 py-4 mr-1">
            Meu currículo
            <div style="height: 2px" class="rounded-t-sm bottom-0 left-0 absolute w-full bg-primary"></div>
          </li>
          <a href="<?= base_url('candidatos/interesses') ?>">
            <li class="relative font-medium text-dark text-center px-6 py-4 mr-1 hover:bg-gray-300 rounded-sm cursor-pointer">
              Meus interesses
              <?php if (isset($todayInterestsLength) && $todayInterestsLength > 0) : ?>
                <div class="rounded-full top-0 right-0 absolute w-6 h-6 grid place-items-center text-white font-semibold text-xs bg-red-600">
                  <?= $todayInterestsLength ?>
                </div>
              <?php endif ?>
            </li>
          </a>
          <li class="open-new-password-form-modal font-medium  text-dark text-center px-6 py-4 mr-1 hover:bg-gray-200 rounded-sm cursor-pointer">
            Alterar senha
          </li>
        </ul>
        <div class="flex items-center mt-6 lg:mt-0 ">
          <a href="<?= base_url('imprimir') ?>">
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

  <?php if (isset($candidate->interests_length) && $candidate->interests_length <= 0) : ?>
    <section class="pt-6">
      <div class="wrapper md:w-4/5 md:mx-auto">
        <div class="p-6 bg-blue-600 rounded-sm shadow-md flex items-center">
          <i class="text-white mr-4" data-feather="bell"></i>
          <h1 class="text-white">
            Para <span class="font-medium">concorrer</span>, escolha as vagas na <a class="text-blue-100 underline" href="<?= base_url('vagas-de-emprego') ?>">página de vagas de emprego</a>
          </h1>
        </div>
      </div>
    </section>
  <?php endif ?>

  <section class="pt-6">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <div class="bg-white p-6 rounded-sm shadow-md">
        <h1 class="text-gray-700 text-xl font-medium">Como ter mais chances de ser selecionado</h1>
        <ul class="mt-4 grid grid-cols-1 gap-4">
          <li class="flex items-center">
            <i class="text-green-600 mr-2" data-feather="check-circle"></i>
            <p class="paragraph"><span class="font-medium">Candidate-se</span> nas <a href="<?= base_url('vagas-de-emprego') ?>" class="text-blue-600 underline">vagas de emprego</a> do seu interesse</p>
          </li>
          <li class="flex items-center">
            <i class="text-green-600 mr-2" data-feather="info"></i>
            <p class="paragraph">Cadastre todas as suas informações</p>
          </li>
          <li class="flex items-center">
            <i class="text-green-600 mr-2" data-feather="paperclip"></i>
            <p class="paragraph">Anexe o <span class="font-medium">seu currículo</span></p>
          </li>
          <li class="flex items-center">
            <i class="text-green-600 mr-2" data-feather="image"></i>
            <p class="paragraph">Adicione uma <span class="font-medium">foto de perfil</span></p>
          </li>
          <li class="flex items-center">
            <i class="text-green-600 mr-2" data-feather="instagram"></i>
            <p class="paragraph">Siga <a href="https://www.instagram.com/oguiaempregos" target="_blank" rel="noopener noreferrer" class="text-blue-600 underline">O Guia Empregos no Instagram</a> para receber as novidades</p>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <section class="py-6">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-sm shadow-md">
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <i class="text-primary mr-3" data-feather="user"></i>
              <h2 class="text-dark font-medium text-lg">Informações pessoais</h2>
            </div>
            <button class="open-personal-info-form-modal flex items-center hover:underline text-blue-600">
              <span>Editar</span>
              <i class="feather-lg ml-2" data-feather="chevron-right"></i>
            </button>
          </div>
          <div class="mt-6 flex items-center">
            <i class="text-gray-500 feather-lg mr-3" data-feather="info"></i>
            <p class="paragraph text-gray-500"><?= $candidate->age ?> anos, <?= $candidate->genre ?>, <?= $candidate->marital_status ?></p>
          </div>
          <div class="mt-2 flex items-center">
            <i class="text-gray-500 feather-lg mr-3" data-feather="phone"></i>
            <p class="phone paragraph text-gray-500"><?= $candidate->phone ?></p>
          </div>
          <div class="mt-2 flex items-center">
            <i class="text-gray-500 text-xl mr-3 fab fa-whatsapp"></i>
            <p class="phone paragraph text-gray-500"><?= $candidate->whatsapp ?></p>
          </div>
          <div class="mt-2 flex items-center">
            <i class="text-gray-500 feather-lg mr-3" data-feather="credit-card"></i>
            <p class="paragraph text-gray-500"><?= $candidate->cpf ?> (CPF), <?= $candidate->rg ?> (RG)</p>
          </div>
        </div>
        <div class="bg-white p-6 rounded-sm shadow-md">
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <i class="text-primary mr-3" data-feather="target"></i>
              <h2 class="text-dark font-medium text-lg">Objetivos profissionais</h2>
            </div>
            <button class="open-professional-goals-form-modal flex items-center hover:underline text-blue-600">
              <span>Editar</span>
              <i class="feather-lg ml-2" data-feather="chevron-right"></i>
            </button>
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
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <i class="text-primary mr-3" data-feather="map-pin"></i>
              <h2 class="text-dark font-medium text-lg">Endereço</h2>
            </div>
            <button class="open-address-form-modal flex items-center hover:underline text-blue-600">
              <span>Editar</span>
              <i class="feather-lg ml-2" data-feather="chevron-right"></i>
            </button>
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
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <i class="text-primary mr-3" data-feather="file-text"></i>
              <h2 class="text-dark font-medium text-lg">Descrição</h2>
            </div>
            <button class="open-description-form-modal flex items-center hover:underline text-blue-600">
              <span>Editar</span>
              <i class="feather-lg ml-2" data-feather="chevron-right"></i>
            </button>
          </div>
          <?php if ($candidate->description) : ?>
            <p class="mt-6 paragraph text-gray-500"><?= $candidate->description ?></p>
          <?php endif ?>
        </div>
      </div>
    </div>
  </section>

  <section class="py-6">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <div class="bg-white p-6 rounded-sm shadow-md">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <i class="text-primary mr-3" data-feather="book"></i>
          <h2 class="text-dark font-medium text-lg">Anexar currículo</h2>
          </div>
          <?php if ($candidate->resume_file) : ?>
            <a href="<?= base_url('assets/uploads/files/candidates/' . $candidate->resume_file) ?>" download>
              <button class="flex items-center hover:underline text-blue-600">
                <span>Baixar arquivo</span>
                <i class="feather-lg ml-2" data-feather="download"></i>
              </button>
            </a>
          <?php endif ?>
        </div>
        <form data-submit=".resume-file-form__submit" data-loader=".resume-file-form__loader" id="resume-file-form" class="mt-6 grid grid-cols-1 gap-4" action="<?= base_url('candidates/profile/attach/save') ?>" method="post" enctype="multipart/form-data">
          <div>
            <label class="input-label">Arquivo (.pdf, .docx, .odt)</label>
            <input type="file" required accept=".pdf, .docx, .odt" name="resume_file" class="mt-2">
            <label class="input-label--error"></label>
          </div>
          <div>
            <button class="resume-file-form__submit btn btn--primary flex items-center">
              Salvar novo arquivo
              <i class="resume-file-form__loader ml-3 hidden rotating" data-feather="loader"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <section class="py-6">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <div class="bg-white p-6 rounded-sm shadow-md">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <i class="text-primary mr-3" data-feather="book"></i>
            <h2 class="text-dark font-medium text-lg">Escolaridade</h2>
          </div>
          <button onclick="resetModalForm('#formations-form-modal')" class="open-formations-form-modal flex items-center hover:underline text-blue-600">
            <span>Adicionar</span>
            <i class="feather-lg ml-2" data-feather="chevron-right"></i>
          </button>
        </div>
        <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-6">
          <?php foreach ($candidate->formations as $formation) : ?>
            <div class="bg-gray-100 shadow-md p-4 rounded-sm">
              <div class="mb-1 flex items-center justify-between">
                <div class="flex items-center">
                  <h3 class="font-medium text-dark"><?= $formation->institution_name ?></h3>
                </div>
                <div class="dropdown relative inline-block text-left">
                  <div>
                    <button type="button" class="dropdown__toggle hover:bg-gray-200 p-1 rounded-full" aria-expanded="true" aria-haspopup="true">
                      <i data-feather="more-horizontal"></i>
                    </button>
                  </div>
                  <div class="dropdown__content hidden z-50 origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="py-1" role="none">
                      <button
                        onclick="setModalValues('#formations-form-modal', '<?= base_url('candidates/profile/formations/get/' . $formation->id) ?>')"
                        class="open-formations-form-modal dropdown__item w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                        role="menuitem"
                      >
                        <i class="feather-lg mr-2" data-feather="edit"></i>
                        <span>Editar</span>
                      </button>
                      <button 
                        onclick="setConfirmDeleteModalLink('<?= base_url('candidates/profile/formations/delete/' . $formation->id) ?>')"
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


  <section class="py-6">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <div class="bg-white p-6 rounded-sm shadow-md">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <i class="text-primary mr-3" data-feather="edit"></i>
            <h2 class="text-dark font-medium text-lg">Cursos e certificações</h2>
          </div>
          <button onclick="resetModalForm('#courses-form-modal')" class="open-courses-form-modal flex items-center hover:underline text-blue-600">
            <span>Adicionar</span>
            <i class="feather-lg ml-2" data-feather="chevron-right"></i>
          </button>
        </div>
        <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-6">
          <?php foreach ($candidate->courses as $course) : ?>
            <div class="bg-gray-100 shadow-md p-4 rounded-sm">
              <div class="mb-1 flex items-center justify-between">
                <h3 class="font-medium text-dark"><?= $course->course_name ?></h3>
                <div class="dropdown relative inline-block text-left">
                  <div>
                    <button type="button" class="dropdown__toggle hover:bg-gray-200 p-1 rounded-full" aria-expanded="true" aria-haspopup="true">
                      <i data-feather="more-horizontal"></i>
                    </button>
                  </div>
                  <div class="dropdown__content hidden z-50 origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="py-1" role="none">
                      <button
                      onclick="setModalValues('#courses-form-modal', '<?= base_url('candidates/profile/courses/get/' . $course->id) ?>')" 
                        class="open-courses-form-modal dropdown__item w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                        role="menuitem"
                      >
                        <i class="feather-lg mr-2" data-feather="edit"></i>
                        <span>Editar</span>
                      </button>
                      <button 
                        onclick="setConfirmDeleteModalLink('<?= base_url('candidates/profile/courses/delete/' . $course->id) ?>')"
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
              <p class="paragraph text-gray-500"><?= $course->institution_name ?> - <?= $course->hours ?> horas</p>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </section>

  <section class="py-6">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <div class="bg-white p-6 rounded-sm shadow-md">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <i class="text-primary mr-3" data-feather="briefcase"></i>
            <h2 class="text-dark font-medium text-lg">Experiências profissionais</h2>
          </div>
          <button onclick="resetModalForm('#experiences-form-modal')" class="open-experiences-form-modal flex items-center hover:underline text-blue-600">
            <span>Adicionar</span>
            <i class="feather-lg ml-2" data-feather="chevron-right"></i>
          </button>
        </div>
        <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-6">
          <?php foreach ($candidate->experiences as $experience) : ?>
            <div class="bg-gray-100 shadow-md p-4 rounded-sm">
              <div class="mb-1 flex items-center justify-between">
                <h3 class="font-medium text-dark"><?= $experience->function ?></h3>
                <div class="dropdown relative inline-block text-left">
                  <div>
                    <button type="button" class="dropdown__toggle hover:bg-gray-200 p-1 rounded-full" aria-expanded="true" aria-haspopup="true">
                      <i data-feather="more-horizontal"></i>
                    </button>
                  </div>
                  <div class="dropdown__content hidden z-50 origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="py-1" role="none">
                      <button
                        onclick="setModalValues('#experiences-form-modal', '<?= base_url('candidates/profile/experiences/get/' . $experience->id) ?>')"
                        class="open-experiences-form-modal dropdown__item w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                        role="menuitem"
                      >
                        <i class="feather-lg mr-2" data-feather="edit"></i>
                        <span>Editar</span>
                      </button>
                      <button 
                        onclick="setConfirmDeleteModalLink('<?= base_url('candidates/profile/experiences/delete/' . $experience->id) ?>')"
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
              <p class="paragraph text-gray-500"><?= $experience->company_name ?><?= isset($experience->area) ? (' - ' . $experience->area->title) : '' ?></p>
              <p class="paragraph text-gray-500">R$ <span class="money"><?= $experience->salary ?></span></p>
              <p class="paragraph text-gray-500"><?= date('d/m/Y', strtotime($experience->entry_date)) ?> - <?= $experience->exit_date ? date('d/m/Y', strtotime($experience->exit_date)) : 'Atualmente' ?></p>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </section>

  <section class="py-6">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <div class="bg-white p-6 rounded-sm shadow-md">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <i class="text-primary mr-3" data-feather="globe"></i>
            <h2 class="text-dark font-medium text-lg">Idiomas</h2>
          </div>
          <button onclick="resetModalForm('#languages-form-modal')" class="open-languages-form-modal flex items-center hover:underline text-blue-600">
            <span>Adicionar</span>
            <i class="feather-lg ml-2" data-feather="chevron-right"></i>
          </button>
        </div>
        <div class="mt-10 flex flex-wrap items-center">
          <?php foreach ($candidate->languages as $language) : ?>
            <div
              onclick="setModalValues('#languages-form-modal', '<?= base_url('candidates/profile/languages/get/' . $language->id) ?>')"
              class="language-container transition-opacity duration-300 flex items-center cursor-pointer bg-gray-100 shadow-md p-4 rounded-sm py-1 px-1 pl-3 mr-4 mb-4">
              <p class="text-sm text-gray-700"><span class="font-medium"><?= $language->language ?></span> - <?= $language->level ?></p>             
              <div class="ml-4 dropdown relative inline-block text-left">
                <div class="flex items-center">
                  <button type="button" class="dropdown__toggle hover:bg-gray-200 p-1 rounded-full" aria-expanded="true" aria-haspopup="true">
                    <i data-feather="more-horizontal"></i>
                  </button>
                </div>
                <div class="dropdown__content hidden z-50 origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                  <div class="py-1" role="none">
                    <button
                      onclick="setModalValues('#languages-form-modal', '<?= base_url('candidates/profile/languages/get/' . $language->id) ?>')"
                      class="open-languages-form-modal dropdown__item w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                      role="menuitem"
                    >
                      <i class="feather-lg mr-2" data-feather="edit"></i>
                      <span>Editar</span>
                    </button>
                    <button 
                      onclick="setConfirmDeleteModalLink('<?= base_url('candidates/profile/languages/delete/' . $language->id) ?>')"
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
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </section>

  <?php include_once 'application/views/imports/footer.php' ?>

  <!-- Modals -->
  <?php include_once 'application/views/candidates/profile/modals/forms/personal-info.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/forms/address.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/forms/description.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/forms/professional-goals.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/forms/formations.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/forms/courses.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/forms/experiences.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/forms/languages.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/forms/new-password.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/confirm-logout.php' ?>
  <?php include_once 'application/views/candidates/profile/modals/confirm-delete.php' ?>
  
  <?php include_once 'application/views/imports/scripts.php' ?>
  <script src="https://cdn.jsdelivr.net/npm/cep-promise/dist/cep-promise.min.js"></script>

  <script type="module">
    import { ImagePreview } from '<?= base_url('assets/site/scripts/ImagePreview/ImagePreview.js') ?>'
    import { Filters } from '<?= base_url('assets/site/scripts/Filters/Filters.js') ?>'
    import { Modal } from '<?= base_url('assets/site/scripts/Modal/Modal.js') ?>'
    import { Alert } from '<?= base_url('assets/site/scripts/Alert/Alert.js') ?>'
    import { InputLengthCounter } from '<?= base_url('assets/site/scripts/InputLengthCounter/InputLengthCounter.js') ?>'

    window.addEventListener('load', function () {
      window.setModalValues = setModalValues
      window.resetModalForm = resetModalForm
      window.setConfirmDeleteModalLink = setConfirmDeleteModalLink

      onSubmitResumeFileForm()
      onActualJobChange()
      initImagePreview()
      initModals()
      onModalsFormsSubmit()
      onSetZipCode()
      initInputLengthCounter()
    })

    function onSubmitResumeFileForm () {
      const form = document.querySelector('#resume-file-form')

      form.addEventListener('submit', function () {
        const loader = document.querySelector(form.dataset.loader)
        loader.style.display = 'block'
        
        const submit = document.querySelector(form.dataset.submit)
        submit.disabled = true
      })
    }

    function setConfirmDeleteModalLink (url) {
      const modal = document.querySelector('#confirm-delete-modal')
      if (!modal) return false
      
      const form = modal.querySelector('form')
      if (!form) return false

      form.action = url
    }

    async function setModalValues (modalSelector, url) {
      resetModalForm(modalSelector)
      const modal = document.querySelector(modalSelector)
      const form = modal.querySelector('form')

      const response = await fetch(url, {
        method: 'GET', 
      }).then(response => response.json())

      const { success, error, data } = response
      
      if (!success) {
        showAlert('error', error)
      }

      for (const key in data) {
        const field = form.querySelector(`[name=${key}]`)

        if (field) {
          const isDate = field.classList.contains('date')
          const isMoney = field.classList.contains('money')

          if (isDate) {
            field.value = data[key] ? data[key].split('-').reverse().join('/') : ''
          } else if (isMoney) {
            field.value = data[key] ? $('.money').masked(data[key]) : ''
          } else {
            field.value = data[key] || ''
          }
        }
      }
    }

    function resetModalForm (modalSelector) {
      const modal = document.querySelector(modalSelector)
      if (!modal) return false
      
      const form = modal.querySelector('form')
      if (!form) return false
      
      form.reset()
    }

    function onActualJobChange () {
      const checkbox = document.querySelector('#actual-job')
      const exitDate = document.querySelector('[name=exit_date]')
      const errorLabel = exitDate.parentNode.querySelector('label.input-label--error')

      checkbox.addEventListener('change', (event) => {
        const { checked } = event.target

        exitDate.disabled = !!checked
        exitDate.required = !checked

        exitDate.value = ''

        exitDate.classList.remove('border-yellow-600')
        exitDate.classList.remove('placeholder-yellow-600')

        if (errorLabel) {
          errorLabel.innerHTML = ''
        }
      })
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
      modal.add('#personal-info-form-modal', { reopenClass: 'open-personal-info-form-modal' })
      modal.add('#address-form-modal', { reopenClass: 'open-address-form-modal' })
      modal.add('#description-form-modal', { reopenClass: 'open-description-form-modal' })
      modal.add('#professional-goals-form-modal', { reopenClass: 'open-professional-goals-form-modal' })
      modal.add('#formations-form-modal', { reopenClass: 'open-formations-form-modal' })
      modal.add('#courses-form-modal', { reopenClass: 'open-courses-form-modal' })
      modal.add('#experiences-form-modal', { reopenClass: 'open-experiences-form-modal' })
      modal.add('#languages-form-modal', { reopenClass: 'open-languages-form-modal' })
      modal.add('#new-password-form-modal', { reopenClass: 'open-new-password-form-modal' })
      modal.add('#confirm-logout-modal', { reopenClass: 'open-confirm-logout-modal' })
      modal.add('#confirm-delete-modal', { reopenClass: 'open-confirm-delete-modal' })
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
      const loaderSelector = form.dataset.loader
      const loader = document.querySelector(loaderSelector)

      if (loader) {
        loader.style.display = 'block'
      }

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

        if (loader) {
          loader.style.display = 'none'
        }

        const { success, error } = response

        if (!success) {
          showAlert('error', error)
          return false
        }
        
        if (reload) {
          return window.location.reload()
        }

        showAlert('success', 'Alteração salva')
        form.reset()
        
        const closeButton = form.querySelector('.closeModal')
        closeButton && closeButton.click()
      } catch (error) {
        if (loader) {
          loader.style.display = 'none'
        }

        showAlert('error', 'Não foi possível realizar esta ação, se continuar entre em contato')
      }
    }

    function validZipCode (zipCode) {
      const cleanZipCode = zipCode.replace(/[^0-9]/g, '')
      return (/^[0-9]{8}$/).test(cleanZipCode)
    }

    function onSetZipCode () {
      const zipCodeField = document.querySelector('[name=address_zip_code]')
      
      if (!zipCodeField) return false

      zipCodeField.addEventListener('keyup', function (event) {
        const zipCode = event.target.value
        if (validZipCode(zipCode)) {
          setAddressByZipCode(zipCode)
        }
      })
    }

    function setAddressByZipCode (zipCode) {
      if (!cep || typeof cep !== 'function') {
        return false
      }

      try {
        const address = cep(zipCode).then(setAddressOnFields)
      } catch (error) {
        console.log(error)
      }
    }

    function setAddressOnFields (address) {
      if (!address) return false
      
      const streetField = document.querySelector('[name=address_street]')
      streetField.value = address.street
      
      const neighborhoodField = document.querySelector('[name=address_neighborhood]')
      neighborhoodField.value = address.neighborhood
      
      const cityField = document.querySelector('[name=address_city]')
      cityField.value = address.city

      const stateField = document.querySelector('[name=address_uf]')
      stateField.value = address.state
    }

    function initInputLengthCounter () {
      const inputLengthCounter = InputLengthCounter('.input-length-counter')
      inputLengthCounter.init()
    }
  </script>
</body>
</html>