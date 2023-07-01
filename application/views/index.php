<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include_once 'application/views/imports/head.php' ?>
</head>
<body>
  <?php include_once 'application/views/imports/header.php' ?>

  <section class="py-20 md:py-32 bg-white shadow-sm bg-cover bg-center bg-no-repeat">
    <div class="wrapper">
      <div class="max-w-screen-lg mx-auto px-4 md:px-0">
        <h1 class="text-dark font-medium text-center text-xl md:text-3xl leading-relaxed md:leading-relaxed">
          <?= $metatags->title ?>
        </h1>
        <?php if (isset($jobsLength) && $jobsLength > 100) : ?>
          <p class="text-center paragraph mt-2 max-w-xl mx-auto">Mais de <span class="font-medium"><?= number_format($jobsLength, 0, ',', '.') ?> oportunidades</span> esperando por você</p>
        <?php else : ?>
          <p class="text-center paragraph mt-2 max-w-xl mx-auto">
            As melhores oportunidades de emprego estão no O Guia Empregos.
            <a href="<?= base_url('cadastro') ?>" class="text-blue-600 underline">Cadastre-se</a>
            e concorra à quantas vagas quiser, <span class="font-medium">é grátis</span>.
          </p>
        <?php endif ?>
        <form action="<?= base_url('vagas-de-emprego') ?>" method="get" class="bg-gray-200 p-4 rounded-sm grid grid-cols-1 md:grid-cols-4 gap-4 mt-10">
          <div>
            <div class="flex items-center border border-gray-400 px-2 rounded-sm overflow-hidden bg-white">
              <i class="text-gray-400 mr-2 feather-lg flex-shrink-0" data-feather="search"></i>
              <input type="text" name="query" placeholder="Palavras-chave" class="w-full py-2 outline-none bg-transparent">
            </div>
          </div>
          <div>
            <select data-placeholder="Cidade" name="cities[]" multiple class="select2 input">
              <?php foreach ($cities as $city) : ?>
                <option
                  <?= $this->input->get('cities') && in_array($city->id, $this->input->get('cities')) ? 'selected' : '' ?>
                  value="<?= $city->id ?>"
                ><?= $city->name ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div>
            <select data-placeholder="Área" name="areas[]" multiple class="select2 input">
              <?php foreach ($areas as $area) : ?>
                <option
                  <?= $this->input->get('areas') && in_array($area->id, $this->input->get('areas')) ? 'selected' : '' ?>
                  value="<?= $area->id ?>"
                ><?= $area->title ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div>
            <button class="w-full btn btn--primary py-2 px-6">Pesquisar</button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <section class="py-12 md:py-20 bg-gray-100">
    <div class="wrapper">
      <h2 class="text-dark font-medium text-center text-xl leading-relaxed">
        Últimas vagas adicionadas
      </h2>
      <div class="mt-4 flex justify-center">
        <a href="<?= base_url('vagas-de-emprego') ?>">
          <button class="text-blue-600 flex items-center hover:underline cursor-pointer">
            Ver todas <i class="ml-1 feather-lg" data-feather="chevron-right"></i>
          </button>
        </a>
      </div>
      <div class="mt-10 md:mt-20 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
                  <div class="mr-4 mt-4 text-<?= $job->situation->type ?> flex items-center" title="Situação da vaga">
                    <i class="feather-lg mr-2" data-feather="info"></i>
                    <p class="text-sm"><?= $job->situation->title ?></p>
                  </div>
                <?php endif ?>
                <div class="mt-4 flex items-center" title="Salário">
                  <i class="text-dark mr-2 far fa-money-bill-alt"></i>
                  <p class="paragraph text-sm">
                    <?php if ($job->salary > 0) : ?>
                      R$ <span class="money"><?= $job->salary ?></span>
                    <?php else : ?>
                      A combinar
                    <?php endif ?>
                  </p>
                </div>
              </div>
              <p class="mt-4 paragraph text-sm"><?= word_limiter($job->activities_description, 16) ?></p>
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
    </div>
  </section>

  <section class="py-12 md:py-20">
    <div class="wrapper">
      <h2 class="text-dark font-medium text-center text-xl leading-relaxed">
        Como funciona
      </h2>
      <p class="paragraph mt-4 text-center md:w-1/2 md:mx-auto leading-relaxed">
        Um passo a passo para que você veja como é facil concorrer às vagas que podem mudar a sua vida
      </p>
      <div class="mt-20 relative">
        <div id="step-middle-line" class="hidden sm:block bg-gray-300 h-full absolute left-1/2 top-1/2"></div>
        <div class="flex flex-col sm:flex-row justify-center items-center">
          <figure>
            <img class="w-60 md:w-80" src="<?= base_url('assets/site/images/mockups/mockup-signup.jpg') ?>" loading="lazy" alt="O Guia Empregos mockup">
          </figure>
          <div class="my-10 sm:my-0 sm:mx-10 flex items-center justify-center w-14 h-14 bg-primary rounded-full">
            <span class="font-medium text-2xl text-gray-100">1</span>
          </div>
          <div>
            <p class="paragraph text-center sm:text-left md:w-80">Realize seu cadastro, é rápido e simples. Se você já fez o cadastro, faça o login</p>
          </div>
        </div>
        <div class="mt-20 sm:mt-10 flex flex-col-reverse sm:flex-row justify-center items-center">
          <div>
            <p class="paragraph text-center sm:text-left md:w-80">Cadastre todas as suas informações, assim será mais fácil paras as empresas encontrarem seu currículo</p>
          </div>
          <div class="my-10 sm:my-0 sm:mx-10 flex items-center justify-center w-14 h-14 bg-primary rounded-full">
            <span class="font-medium text-2xl text-gray-100">2</span>
          </div>
          <figure>
            <img class="w-60 md:w-80" src="<?= base_url('assets/site/images/mockups/mockup-profile.jpg') ?>" loading="lazy" alt="O Guia Empregos mockup">
          </figure>
        </div>
        <div class="mt-20 sm:mt-10 flex flex-col sm:flex-row justify-center items-center">
          <figure>
            <img class="w-60 md:w-80" src="<?= base_url('assets/site/images/mockups/mockup-jobs.jpg') ?>" loading="lazy" alt="O Guia Empregos mockup">
          </figure>
          <div class="my-10 sm:my-0 sm:mx-10 flex items-center justify-center w-14 h-14 bg-primary rounded-full">
            <span class="font-medium text-2xl text-gray-100">3</span>
          </div>
          <div>
            <p class="paragraph text-center sm:text-left md:w-80">Visite a <a href="<?= base_url('vagas-de-emprego') ?>" class="hover:underline text-blue-600">página vagas de emprego</a>, escolha as que mais se adequam ao se perfil e cadastre seu interesse</p>
          </div>
        </div>
        <div class="mt-20 sm:mt-10 flex flex-col-reverse sm:flex-row justify-center items-center">
          <div>
            <p class="paragraph text-center sm:text-left md:w-80">Você pode ver como está a situação do seus interesses em Perfil > Meus interesses. Se o seu currículo for selecionado, as empresas entrarão em contato</p>
          </div>
          <div class="my-10 sm:my-0 sm:mx-10 flex items-center justify-center w-14 h-14 bg-primary rounded-full">
            <span class="font-medium text-2xl text-gray-100">4</span>
          </div>
          <figure>
            <img class="w-60 md:w-80" src="<?= base_url('assets/site/images/mockups/mockup-interests.jpg') ?>" loading="lazy" alt="O Guia Empregos mockup">
          </figure>
        </div>
      </div>
    </div>
  </section>

  <?php include_once 'application/views/imports/call-to-action.php' ?>

  <section class="py-12 md:py-40">
    <div class="wrapper">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-0">
        <div>
          <h2 class="md:w-2/3 md:mx-auto text-gray-900 font-medium text-xl md:text-2xl leading-relaxed md:leading-relaxed">
            Anuncie suas vagas com a gente
          </h2>
        </div>
        <div>
          <form action="<?= base_url('home/saveContactMessage') ?>" method="post" class="contact-form md:w-2/3 p-8 bg-primary grid grid-cols-1 gap-10 rounded-sm">
            <div>
              <input type="text" required name="name" placeholder="Empresa / Nome" class="bg-transparent w-full text-gray-200 outline-none placeholder-gray-200 border-b border-gray-200 p-3 pl-0">
              <label class="input-label--error"></label>
            </div>
            <div>
              <input type="email" required name="email" placeholder="E-mail" class="bg-transparent w-full text-gray-200 outline-none placeholder-gray-200 border-b border-gray-200 p-3 pl-0">
              <label class="input-label--error"></label>
            </div>
            <div>
              <textarea required name="message" placeholder="Mensagem" class="bg-transparent w-full text-gray-200 outline-none placeholder-gray-200 border-b border-gray-200 p-3 pl-0"></textarea>
              <label class="input-label--error"></label>
            </div>
            <div>
              <button class="btn btn--white-opacity w-full">Enviar mensagem</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="py-12 md:py-20">
    <div class="wrapper">
      <h2 class="text-gray-900 font-medium text-center text-xl md:text-2xl leading-relaxed md:leading-relaxed">
        Siga nossas redes sociais
      </h2>
      <div class="mt-20 lg:w-2/3 mx-auto flex flex-wrap space-x-6 justify-center">
        <?php if (isset($companyInformations->twitter) && $companyInformations->twitter) : ?>
          <div>
            <a href="<?= $companyInformations->twitter ?>" target="_blank">
              <div class="rounded-sm bg-gray-200 w-40 h-40 m-auto flex flex-col items-center justify-center">
                <i data-feather="twitter"></i>
                <p class="mt-3 uppercase text-xs text-thin text-center">Twitter</p>
              </div>
            </a>
          </div>
        <?php endif ?>
        <?php if (isset($companyInformations->facebook) && $companyInformations->facebook) : ?>
          <div>
            <a href="<?= $companyInformations->facebook ?>" target="_blank">
              <div class="rounded-sm bg-gray-200 w-40 h-40 m-auto flex flex-col items-center justify-center">
                <i data-feather="facebook"></i>
                <p class="mt-3 uppercase text-xs text-thin text-center">Facebook</p>
              </div>
            </a>
          </div>
        <?php endif ?>
        <?php if (isset($companyInformations->instagram) && $companyInformations->instagram) : ?>
          <div>
            <a href="<?= $companyInformations->instagram ?>" target="_blank">
              <div class="rounded-sm bg-gray-200 w-40 h-40 m-auto flex flex-col items-center justify-center">
                <i data-feather="instagram"></i>
                <p class="mt-3 uppercase text-xs text-thin text-center">Instagram</p>
              </div>
            </a>
          </div>
        <?php endif ?>
        <?php if (isset($companyInformations->linkedin) && $companyInformations->linkedin) : ?>
          <div>
            <a href="<?= $companyInformations->linkedin ?>" target="_blank">
              <div class="rounded-sm bg-gray-200 w-40 h-40 m-auto flex flex-col items-center justify-center">
                <i data-feather="linkedin"></i>
                <p class="mt-3 uppercase text-xs text-thin text-center">Linkedin</p>
              </div>
            </a>
          </div>
        <?php endif ?>
      </div>
    </div>
  </section>
  
  <section class="py-12 md:py-40">
    <div class="wrapper">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-0">
        <div>
          <div class="md:w-2/3 md:mx-auto grid grid-cols-1 gap-6">
            <h2 class="text-gray-900 font-medium text-xl md:text-2xl leading-relaxed md:leading-relaxed">
              Precisa de ajuda?
            </h2>
            <?php if (isset($companyInformations->email) && $companyInformations->email) : ?>
              <div class="flex items-center">
                <i data-feather="mail"></i>
                <p class="ml-3 paragraph"><?= $companyInformations->email ?></p>
              </div>
            <?php endif ?>
            <?php if (isset($companyInformations->phone) && $companyInformations->phone) : ?>
              <div class="flex items-center">
                <i data-feather="phone"></i>
                <p class="ml-3 paragraph"><?= $companyInformations->phone ?></p>
              </div>
            <?php endif ?>
            <?php if (isset($companyInformations->address) && $companyInformations->address) : ?>
              <div class="flex items-center">
                <i data-feather="map-pin"></i>
                <p class="ml-3 paragraph"><?= $companyInformations->address ?></p>
              </div>
            <?php endif ?>
          </div>
        </div>
        <div>
          <form action="<?= base_url('home/saveContactMessage') ?>" method="post" class="contact-form md:w-2/3 p-8 bg-primary grid grid-cols-1 gap-10 rounded-sm">
            <div>
              <input type="text" required name="name" value="<?= $this->session->userdata('candidate') ? $this->session->userdata('candidate')['name'] : '' ?>" placeholder="Nome" class="bg-transparent w-full text-gray-200 outline-none placeholder-gray-200 border-b border-gray-200 p-3 pl-0">
              <label class="input-label--error"></label>
            </div>
            <div>
              <input type="email" required name="email" value="<?= $this->session->userdata('candidate') ? $this->session->userdata('candidate')['email'] : '' ?>" placeholder="E-mail" class="bg-transparent w-full text-gray-200 outline-none placeholder-gray-200 border-b border-gray-200 p-3 pl-0">
              <label class="input-label--error"></label>
            </div>
            <div>
              <textarea required name="message" placeholder="Mensagem" class="bg-transparent w-full text-gray-200 outline-none placeholder-gray-200 border-b border-gray-200 p-3 pl-0"></textarea>
              <label class="input-label--error"></label>
            </div>
            <div>
              <button class="btn btn--white-opacity w-full">Enviar mensagem</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php include_once 'application/views/imports/footer.php' ?>
  <?php include_once 'application/views/imports/scripts.php' ?>

  <script type="module">
    window.addEventListener('load', function () {
      onContactFormSubmit()
    })

    function onContactFormSubmit () {
      const forms = document.querySelectorAll('form.contact-form')

      forms.forEach(form => {
        form.addEventListener('submit', (event) => {
          event.preventDefault()
          saveForm(form)
        })
      })
    }

    async function saveForm (form) {
      try {
        const url = form.getAttribute('action')
        const body = new FormData(form)
        
        const response = await fetch(url, {
          method: 'POST',
          body
        }).then(response => response.json())

        const { success, error } = response

        if (!success) {
          showAlert('error', error)
          return false
        }

        showAlert('success', 'Mensagem enviada com sucesso')
        form.reset()
      } catch (error) {
        console.error(error)
        showAlert('error', 'Erro ao enviar mensagem, se continuar entre em contato')
      }
    }
  </script>
</body>
</html>