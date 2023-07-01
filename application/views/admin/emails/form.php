<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php include_once 'application/views/admin/utils/start.php' ?>
</head>

<body data-background-color="bg3">
  <div class="wrapper">
    <?php include_once 'application/views/admin/utils/header.php' ?>
    <div class="main-panel">
      <div class="content">
        <div class="container-fluid">
          <div class="page-header god-header">
            <h4 class="page-title">E-mail</h4>
            <ul class="breadcrumbs">
              <li class="nav-home">
                <a href="<?= base_url("admin") ?>"> home </a>
              </li>
              <li class="separator">
                <i class="flaticon-right-arrow"></i>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/emails') ?>">E-mails</a>
              </li>
              <li class="separator">
                <i class="flaticon-right-arrow"></i>
              </li>
              <li class="nav-item">
                E-mail
              </li>
            </ul>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <form data-submit=".send-email-form__submit" data-loader=".send-email-form__loader" class="send-email-form" action="<?= base_url('admin/emails/sendEmail') ?>" method="post">
                  <div class="card-body">
                    <div class="form-row">
                      <div class="form-group col-md-12 form-show-validation">
                        <label>Assunto</label>
                        <input type="text" maxlength="255" required name="subject" class="form-control">
                        <label class="error-label"></label>
                      </div>
                      <div class="form-group col-md-12 form-show-validation">
                        <label>Mensagem</label>
                        <textarea name="message" required rows="5" class="form-control"></textarea>
                        <label class="error-label"></label>
                      </div>
                      <div class="form-group col-md-12 form-show-validation">
                        <label>Link</label>
                        <input type="url" maxlength="255" name="link" class="form-control">
                        <label class="error-label"></label>
                      </div>
                    </div>
                  </div>
                  <div class="card-action">
                    <a href="<?= site_url('admin/emails') ?>">
                      <button type="button" class="btn btn-black btn-border">
                        Voltar
                      </button>
                    </a>
                    <button type="submit" class="send-email-form__submit d-flex align-items-center btn btn-black btn-save">
                      Salvar
                      <i class="send-email-form__loader ml-2 rotating hidden" data-feather="loader"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <?php include_once 'application/views/admin/utils/end.php' ?>

  <script>
    window.addEventListener('load', function () {
      onFormSubmit()
    })

    function onFormSubmit () {
      const form = document.querySelector('.send-email-form')
      
      form.addEventListener('submit', function (event) {
        event.preventDefault()
        saveForm(form)
      })
    }

    async function saveForm (form) {
      handleLoader()

      try {
        const body = new FormData(form)
        const url = form.getAttribute('action')

        const response = await fetch(url, {
          method: 'POST',
          body
        }).then(response => response.json())
        
        const { success, error } = response

        if (!success) {
          handleLoader(false)
          showAlert('danger', error, 'la la-close')
        } else {
          window.location.href = '<?= base_url('admin/emails') ?>'
        }
      } catch (error) {
        console.log(error)
        handleLoader(false)
        showAlert('danger', 'Erro ao salvar, se continuar entre em contato', 'la la-close')
      }
    }

    function handleLoader (isLoading = true) {
      const form = document.querySelector('.send-email-form')

      const loader = document.querySelector(form.dataset.loader)
      loader.style.display = isLoading ? 'block' : 'none'
      
      const submit = document.querySelector(form.dataset.submit)
      submit.disabled = isLoading
    }
  </script>
</body>
</html>