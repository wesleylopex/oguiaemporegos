<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include_once 'application/views/imports/head.php' ?>
</head>
<body>
  <?php include_once 'application/views/imports/header.php' ?>

  <section class="min-h-screen bg-white grid place-items-center">
    <div class="h-full max-w-screen-2xl mx-auto">
      <div class="h-full grid grid-cols-1 md:grid-cols-3">
        <div class="md:col-span-1 bg-primary p-12">
          <h1 class="md:mb-14 font-medium text-xl md:text-2xl leading-relaxed md:leading-relaxed text-white">
            Finalize seu cadastro e encontre as oportunidades que <span class="text-secondary">vão mudar a sua vida</span>.
          </h1>
          <a href="https://storyset.com" target="_blank">
            <figure class="hidden md:block">
              <img class="w-4/5" src="<?= base_url('assets/site/images/illustrations/welcome-cuate.svg') ?>" loading="lazy" alt="Illustration welcome png">
            </figure>
          </a>
        </div>
        <div class="md:col-span-2 p-10 flex items-center justify-center">
          <div class="sm:w-2/3 mx-auto">
            <div class="progress-bar w-full h-1 bg-gray-300 rounded-full">
              <div data-percentage="100" class="w-0 transition-all duration-500 progress-bar__percentage h-1 bg-primary rounded-full"></div>
            </div>
            <div class="flex justify-between my-10">
              <h1 class="text-gray-900 font-medium text-xl leading-relaxed md:leading-relaxed">Anexar currículo</h1>
              <a href="<?= base_url('candidates/profile') ?>">
                <button class="flex items-center hover:underline text-blue-600">
                  <span>Pular</span>
                  <i class="feather-lg ml-2" data-feather="chevron-right"></i>
                </button>
              </a>
            </div>
            <form data-submit=".resume-file-form__submit" data-loader=".resume-file-form__loader" id="resume-file-form" action="<?= base_url('candidates/profile/attach/save') ?>" method="post" class="mt-10 grid grid-cols-1 gap-4" enctype="multipart/form-data">
              <div>
                <label class="input-label">Arquivo (.pdf)</label>
                <input type="file" required accept="application/pdf" name="resume_file" class="mt-2">
                <label class="input-label--error"></label>
              </div>
              <div class="col-span-full">
                <button class="resume-file-form__submit w-full btn btn--primary flex items-center justify-center">
                  Avançar
                  <i class="resume-file-form__loader ml-3 hidden rotating" data-feather="loader"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include_once 'application/views/imports/footer.php' ?>
  <?php include_once 'application/views/imports/scripts.php' ?>

  <script type="module">
    window.addEventListener('load', function () {
      onSubmitResumeFileForm()
    })

    function onSubmitResumeFileForm () {
      const form = document.querySelector('#resume-file-form')

      form.addEventListener('submit', function (event) {
        const loader = document.querySelector(form.dataset.loader)
        loader.style.display = 'block'
        
        const submit = document.querySelector(form.dataset.submit)
        submit.disabled = true
      })
    }
  </script>
</body>
</html>