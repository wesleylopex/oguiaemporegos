<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include_once 'application/views/imports/head.php' ?>
</head>
<body class="bg-gray-100 overflow-x-hidden">
  <?php include_once 'application/views/imports/header.php' ?>

  <section class="bg-white shadow-sm py-12 md:py-20 ">
    <div class="wrapper md:w-4/5 md:mx-auto flex flex-col md:flex-row items-center justify-between">
      <div class="flex flex-col md:flex-row items-center justify-center">
        <div id="profile-image__preview-container" class="relative rounded-full p-1 border-2 border-primary">
          <figure class="rounded-full relative overflow-hidden w-32 h-32">
            <img class="w-full h-full object-cover" src="../../assets/site/images/profile/profile.jpg" loading="lazy" alt="Profile" title="Profile">
          </figure>
        </div>
        <div class="mt-6 md:mt-0 md:ml-6 flex flex-col items-center md:items-start">
          <h1 class="font-medium text-2xl text-dark">Selecionar RH</h1>
          <span class="text-gray-500">@selecionarrh</span>
        </div>
      </div>
      <button class="mt-6 md:mt-0 btn btn--primary flex justify-center items-center">
        <i class="text-xl mr-4 fab fa-whatsapp"></i>
        WhatsApp
      </button>
    </div>
  </section>

  <section class="py-12">
    <div class="wrapper md:w-4/5 md:mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
        <div class="md:col-span-2 grid grid-cols-1 gap-6">
          <div class="bg-white p-6 rounded-sm shadow-md">
            <h2 class="text-dark font-medium text-lg">Sobre</h2>
            <p class="mt-6 paragraph text-gray-600">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam 
            </p>
          </div>
          <div class="bg-white p-6 rounded-sm shadow-md">
            <h2 class="text-dark font-medium text-lg">Informações de contato</h2>
            <div class="mt-6 grid grid-cols-1 gap-4">
              <div class="flex items-center">
                <i class="text-dark mr-4" data-feather="globe"></i>
                <a href="https://pontoagencia.com.br" target="_blank">
                  <p class="text-blue-600 hover:underline">https://pontoagencia.com.br</p>
                </a>
              </div>
              <div class="flex items-center">
                <i class="text-dark mr-4" data-feather="instagram"></i>
                <a href="https://pontoagencia.com.br" target="_blank">
                  <p class="text-blue-600 hover:underline">@ponto_agencia</p>
                </a>
              </div>
              <div class="flex items-center">
                <i class="text-dark mr-4" data-feather="facebook"></i>
                <a href="https://pontoagencia.com.br" target="_blank">
                  <p class="text-blue-600 hover:underline">@ponto_agencia</p>
                </a>
              </div>
              <div class="flex items-center">
                <i class="text-dark mr-4 text-2xl fab fa-whatsapp"></i>
                <a href="https://pontoagencia.com.br" target="_blank">
                  <p class="text-blue-600 hover:underline">(54) 99672 7875</p>
                </a>
              </div>
              <div class="flex items-center">
                <i class="text-dark mr-4 text-2xl" data-feather="mail"></i>
                <a href="https://pontoagencia.com.br" target="_blank">
                  <p class="text-blue-600 hover:underline">contato@pontoagencia.com.br</p>
                </a>
              </div>
              <div class="flex items-center">
                <i class="text-dark mr-4 text-2xl" data-feather="phone"></i>
                <a href="https://pontoagencia.com.br" target="_blank">
                  <p class="text-blue-600 hover:underline">(54) 99672 7875</p>
                </a>
              </div>
            </div>
          </div>
          <div class="bg-white p-6 rounded-sm shadow-md">
            <h2 class="text-dark font-medium text-lg">Localização</h2>
            <iframe class="rounded-sm mt-6" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55712.082286371544!2d-51.37505443182108!3d-29.223403240061092!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x951ea084f6c184db%3A0xeba370db94d5e1b!2sFarroupilha%2C%20RS%2C%2095180-000!5e0!3m2!1spt-BR!2sbr!4v1617235758277!5m2!1spt-BR!2sbr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
        <div class="md:col-span-3">
          <div class="flex items-center justify-between">
            <h2 class="font-medium uppercase text-dark">Vagas de emprego</h2>
            <button class="open-language-form-modal btn bg-transparent border-none bg-gray-200 flex items-center">
              <i class="text-dark" data-feather="sliders"></i>
              <p class="text-dark font-medium ml-2">Filtrar</p>
            </button>
          </div>
          <div class="mt-6 grid grid-cols-1 gap-6">
            <div class="bg-white p-6 rounded-sm shadow-md">
              <div class="flex items-center">
                <figure id="profile-image__preview-container" class="rounded-full relative overflow-hidden w-14 h-14">
                  <img class="w-full h-full object-cover" src="../../assets/site/images/profile/profile.jpg" loading="lazy" alt="Profile" title="Profile">
                </figure>
                <div class="ml-4 flex flex-col">
                  <h1 class="font-medium text-dark">Selecionar RH</h1>
                  <span class="text-sm text-gray-500">@selecionarrh</span>
                </div>
              </div>
              <div class="mt-4">
                <h2 class="font-medium text-dark">Assistente de Desenvolvimento</h2>
                <div class="mt-4 flex items-center" title="Localização">
                  <i class="text-dark feather-lg mr-2" data-feather="map-pin"></i>
                  <p class="paragraph text-sm">Farroupilha - RS</p>
                </div>
                <div class="mt-4 flex items-center" title="Salário">
                  <i class="text-dark mr-2 far fa-money-bill-alt"></i>
                  <p class="paragraph text-sm">R$ 10.000,00</p>
                </div>
                <p class="mt-4 paragraph text-sm">Auxiliar na organização e acompanhamento de atividades. Contribuir para a execução do plano de formação anual do departamento.</p>
                <button class="mt-4 flex items-center hover:underline text-blue-600">
                  <span>Ver mais</span>
                  <i class="feather-lg ml-2" data-feather="chevron-right"></i>
                </button>
              </div>
            </div>
            <div class="bg-white p-6 rounded-sm shadow-md">
              <div class="flex items-center">
                <figure id="profile-image__preview-container" class="rounded-full relative overflow-hidden w-14 h-14">
                  <img class="w-full h-full object-cover" src="../../assets/site/images/profile/profile.jpg" loading="lazy" alt="Profile" title="Profile">
                </figure>
                <div class="ml-4 flex flex-col">
                  <h1 class="font-medium text-dark">Selecionar RH</h1>
                  <span class="text-sm text-gray-500">@selecionarrh</span>
                </div>
              </div>
              <div class="mt-4">
                <h2 class="font-medium text-dark">Assistente de Desenvolvimento</h2>
                <div class="mt-4 flex items-center">
                  <i class="text-dark feather-lg mr-2" data-feather="map-pin"></i>
                  <p class="paragraph text-sm">Farroupilha - RS</p>
                </div>
                <div class="mt-4 flex items-center" title="Salário">
                  <i class="text-dark mr-2 far fa-money-bill-alt"></i>
                  <p class="paragraph text-sm">a combinar</p>
                </div>
                <p class="mt-4 paragraph text-sm">Auxiliar na organização e acompanhamento de atividades. Contribuir para a execução do plano de formação anual do departamento.</p>
                <button class="mt-4 flex items-center hover:underline text-blue-600">
                  <span>Ver mais</span>
                  <i class="feather-lg ml-2" data-feather="chevron-right"></i>
                </button>
              </div>
            </div>
            <div class="bg-white p-6 rounded-sm shadow-md">
              <div class="flex items-center">
                <figure id="profile-image__preview-container" class="rounded-full relative overflow-hidden w-14 h-14">
                  <img class="w-full h-full object-cover" src="../../assets/site/images/profile/profile.jpg" loading="lazy" alt="Profile" title="Profile">
                </figure>
                <div class="ml-4 flex flex-col">
                  <h1 class="font-medium text-dark">Selecionar RH</h1>
                  <span class="text-sm text-gray-500">@selecionarrh</span>
                </div>
              </div>
              <div class="mt-4">
                <h2 class="font-medium text-dark">Assistente de Desenvolvimento</h2>
                <div class="mt-4 flex items-center">
                  <i class="text-dark feather-lg mr-2" data-feather="map-pin"></i>
                  <p class="paragraph text-sm">Farroupilha - RS</p>
                </div>
                <p class="mt-4 paragraph text-sm">Auxiliar na organização e acompanhamento de atividades. Contribuir para a execução do plano de formação anual do departamento.</p>
                <button class="mt-4 flex items-center hover:underline text-blue-600">
                  <span>Ver mais</span>
                  <i class="feather-lg ml-2" data-feather="chevron-right"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="bg-gray-100 py-6">
    <div class="wrapper">
      <div class="flex flex-col items-center md:flex-row md:justify-between">
        <div class="flex flex-col md:flex-row items-center">
          <figure>
            <img class="w-20" src="../../assets/site/images/company/logo-amarelo-azul.png" loading="lazy" alt="Logo png">
          </figure>
          <p class="paragraph text-sm text-center md:text-left mt-8 md:mt-0 md:ml-8">2021 - O Guia Empregos. Todos os direitos reservados.</p>
        </div>
        <a href="https://pontoagencia.com.br" target="_blank">
          <div class="flex items-center mt-8 md:mt-0">
            <p class="paragraph text-sm">
              Desenvolvido por
            </p>
            <figure>
              <img class="w-4 ml-2" src="../../assets/site/images/company/logo-agencia-ponto-no-bg.png" loading="lazy" alt="Logo Agência Ponto">
            </figure>
          </div>
        </a>
      </div>
    </div>
  </footer>

  <div id="language-form-modal" class="slickModal">
    <div class="window rounded-sm flex flex-col justify-between items-center p-8">
      <form action="" method="" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="hidden flex col-span-full justify-end">
          <button class="open-language-form-modal flex items-center hover:underline text-blue-600">
            Remover
          </button>
        </div>
        <div>
          <label class="text-sm text-gray-600 block">Idioma</label>
          <input type="text" name="language" required class="mt-2 w-full outline-none p-2 border border-gray-400 rounded-sm bg-transparent">
            <label class="error text-sm text-red-600 block"></label>
        </div>
        <div>
          <label class="text-sm text-gray-600 block">Nível</label>
          <select name="level" required class="mt-2 w-full outline-none p-2 border border-gray-400 rounded-sm bg-transparent">
            <option value="" class="hidden"></option>
            <option value="Básico">Básico</option>
            <option value="Intermediário">Intermediário</option>
            <option value="Técnico">Técnico</option>
            <option value="Avançado">Avançado</option>
            <option value="Fluente">Fluente</option>
          </select>
          <label class="error text-sm text-red-600 block"></label>
        </div>
        <div class="col-span-full">
          <button class="closeModal btn btn--primary w-full">
            Salvar idioma
          </button>
        </div>
      </form>
    </div>
  </div>

  <div class="alert alert--success cursor-pointer fixed right-6 z-40 text-gray-100 w-full max-w-sm bg-green-600 p-8 rounded-sm flex items-center">
    <i class="mr-6" data-feather="check-circle"></i>
    <p>Sua senha foi atualizada com sucesso.</p>
  </div>
  <div class="alert alert--error cursor-pointer fixed right-6 z-40 text-gray-100 w-full max-w-sm bg-red-600 p-8 rounded-sm flex items-center">
    <i class="mr-6" data-feather="x-circle"></i>
    <p>Não foi possível atualizar sua senha.</p>
  </div>
  <div class="alert alert--warning cursor-pointer fixed right-6 z-40 text-gray-100 w-full max-w-sm bg-yellow-600 p-8 rounded-sm flex items-center">
    <i class="mr-6" data-feather="alert-circle"></i>
    <p>Seu perfil está desatualizado.</p>
  </div>

  <?php include_once 'application/views/imports/footer.php' ?>

  <script type="module">
    import { Filters } from '../../assets/site/scripts/Filters/Filters.js'
    import { Modal } from '../../assets/site/scripts/Modal/Modal.js'

    window.addEventListener('load', function () {
      initModals()
    })

    function initModals () {
      const modal = Modal()
      modal.add('#language-form-modal', { reopenClass: 'open-language-form-modal' })
    }
  </script>
</body>
</html>