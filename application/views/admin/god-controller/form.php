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
            <h4 class="page-title"><?= $names['singular'] ?></h4>
            <ul class="breadcrumbs">
              <li class="nav-home">
                <a href="<?= base_url("admin") ?>"> home </a>
              </li>
              <li class="separator">
                <i class="flaticon-right-arrow"></i>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("admin/" . $names['link']) ?>"><?= $names['plural'] ?></a>
              </li>
              <li class="separator">
                <i class="flaticon-right-arrow"></i>
              </li>
              <li class="nav-item">
                <?= $names['singular'] ?>
              </li>
            </ul>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <form id="form" action="<?= base_url('admin/' . $names['link'] . '/save') ?>" method="post">
                  <div id="card-body" class="card-body p-30px">
                    <div class="form-row">
                      <?php foreach ($fields as $key => $field) : ?>
                        <?php if (!array_key_exists('showOnForm', $field) || $field['showOnForm']) : ?>
                          <?php if ($field['type'] == 'separator') : ?>
                            <div class="form-group col-md-12 no-pb">
                              <div class="row">
                                <div class="col-auto">
                                  <div class="title-section">
                                    <h6><?= $field['title'] ?></h6>
                                  </div>
                                </div>
                                <div class="col">
                                  <hr class="title-separator mt-10px">
                                </div>
                              </div>
                            </div>
                          <?php endif ?>
                          
                          <?php $disabled = array_key_exists('disabled', $field) ? $field['disabled'] : false ?>
                          <?php $required = array_key_exists('required', $field) ? $field['required'] : false ?>
                          <?php $class = array_key_exists('class', $field) ? $field['class'] : '' ?>
                          <?php $col = array_key_exists('col', $field) ? $field['col'] : 'col-md-12' ?>

                          <?php if ($field['type'] == 'hidden') : ?>
                            <input type="hidden" class="form-control <?= $class ?>" <?= $disabled ? 'disabled' : '' ?> name="<?= $field['name'] ?>" value="<?= isset($record) ? $record->{$field['name']} : '' ?>">
                          <?php endif ?>

                          <?php if ($field['type'] != 'hidden' && $field['type'] != 'separator') : ?>
                            <div class="form-group <?= $col ?> form-show-validation <?= $field['type'] == 'image' ? 'pb-20px' : '' ?>">
                              <label style="white-space: initial" class="d-flex align-items-center">
                                <?php if (isset($record) && isset($field['baseForeignLinkOnLabel']) && isset($field['disabled']) && $field['disabled']) : ?>
                                  <span>
                                    <?= $field['label'] ?>
                                    (<a href="<?= base_url($field['baseForeignLinkOnLabel'].'/'.$record->{$field['name']}) ?>">
                                      Visualizar <?= $field['label'] ?>
                                    </a>)
                                  </span>
                                <?php else : ?>
                                  <?= $field['label'] ?>
                                <?php endif ?>
                              </label>

                              <?php if ($field['type'] == 'text' || $field['type'] == 'number' || $field['type'] == 'email') : ?>
                                <div>
                                  <input type="<?= $field['type'] ?>" class="form-control <?= $class ?>" <?= $disabled ? 'disabled' : '' ?> name="<?= $field['name'] ?>" value="<?= isset($record) ? $record->{$field['name']} : "" ?>" <?php if ($required) : ?> required <?php endif ?>>
                                  <label class="error-label"></label>
                                </div>
                              <?php endif ?>

                              <?php if ($field['type'] == 'password') : ?>
                                <input type="password" class="form-control <?= $class ?>" <?= $disabled ? 'disabled' : '' ?> name="<?= $field['name'] ?>" <?php if ($required) : ?> required <?php endif ?> autocomplete="off">
                              <?php endif ?>

                              <?php if ($field['type'] == 'textarea') : ?>
                                <div>
                                  <textarea name="<?= $field['name'] ?>" maxlength="<?= array_key_exists('maxlength', $field) ? $field['maxlength'] : '' ?>" rows="<?= isset($field['rows']) ? $field['rows'] : "5" ?>" <?= $disabled ? 'disabled' : '' ?> class="form-control <?= $class ?>" <?php if ($required) : ?> required <?php endif ?>><?= isset($record) ? $record->{$field['name']} : "" ?></textarea>
                                  <label class="error-label"></label>
                                </div>
                              <?php endif ?>

                              <?php if ($field['type'] == 'image') : ?>
                                <div class="input-file input-file-image">
                                  <img class="img-upload-preview" width="150" src="<?= isset($record) ? base_url('assets/uploads/images/' . $uploadFolder . ($uploadFolder ? '/' : '') . $record->{$field['name']}) : "" ?>" loading="lazy" alt="">
                                  <input type="file" class="form-control form-control-file" id="<?= $field['name'] ?>" name="<?= $field['name'] ?>" accept="image/*">
                                  <label for="<?= $field['name'] ?>" class="label-input-file btn btn-icon btn-black btn-lg"><i class="la la-file-image-o"></i> Escolher imagem</label>
                                </div>
                              <?php endif ?>

                              <?php if ($field['type'] == 'file' || $field['type'] == 'video') : ?>
                                <div class="mb-3">
                                  <div class="custom-file">
                                    <input type="file" <?= $disabled ? 'disabled' : '' ?> name="<?= $field['name'] ?>" class="custom-file-input" id="<?= $field['name'] ?>" accept="<?= $field['type'] == 'video' ? 'video/mp4,video/x-m4v,video' : 'application/pdf' ?>">
                                    <label style="white-space: initial" class="custom-file-label" for="<?= $field['name'] ?>" data-browse="Procurar">
                                      <?= isset($record) && $record->{$field['name']} ? $record->{$field['name']} : 'Escolher um arquivo'?>
                                    </label>
                                  </div>
                                  <?php if (isset($record) && $record->{$field['name']}) : ?>
                                    <a href="<?= base_url('assets/uploads/'. ($field['type'] . 's/') . ($uploadFolder ? $uploadFolder . '/' : '') . $record->{$field['name']}) ?>" download>
                                    <?= $record->{$field['name']} ?>
                                  </a>
                                  <?php endif ?>
                                </div>
                              <?php endif ?>

                              <?php if ($field['type'] == 'select') : ?>
                                <div>
                                  <?= form_dropdown($field['name'], $field['options'], isset($record) ? $record->{$field['name']} : '', ['class' => "form-control $class select2", $disabled ? 'disabled' : '' => 'disabled', $required ? 'required' : '' => 'required']) ?>
                                  <label class="error-label"></label>
                                </div>
                              <?php endif ?>

                              <?php if ($field['type'] == 'date') : ?>
                                <div class="input-group">
                                  <input
                                    type="text"
                                    class="form-control date"
                                    <?= $disabled ? 'disabled' : '' ?>
                                    name="<?= $field['name'] ?>"
                                    value="<?= isset($record) && $record->{$field['name']} ? date('d/m/Y', strtotime($record->{$field['name']})) : '' ?>">
                                  <div class="input-group-append">
                                    <span class="input-group-text">
                                      <i class="la la-calendar-check-o"></i>
                                    </span>
                                  </div>
                                </div>
                              <?php endif ?>

                              <?php if ($field['type'] == 'month') : ?>
                                <div>
                                  <input
                                    type="month"
                                    class="form-control"
                                    <?= $disabled ? 'disabled' : '' ?>
                                    name="<?= $field['name'] ?>"
                                    value="<?= isset($record) ? $record->{$field['name']} : null ?>"
                                  >
                                  <label for="" class="error-label"></label>
                                </div>
                              <?php endif ?>
                              
                              <?php if ($field['type'] == 'color') : ?>
                                <div>
                                  <input
                                    type="color"
                                    <?= $disabled ? 'disabled' : '' ?>
                                    name="<?= $field['name'] ?>"
                                    value="<?= isset($record) ? $record->{$field['name']} : null ?>"
                                  >
                                  <label for="" class="error-label"></label>
                                </div>
                              <?php endif ?>
                            </div>
                          <?php endif ?>
                        <?php endif ?>
                      <?php endforeach ?>
                    </div>
                  </div>
                  <div class="card-action">
                    <?php if (!array_key_exists('isUnique', $permissions) || !$permissions['isUnique']) : ?>
                      <a href="<?= site_url('admin/' . $names['link']) ?>">
                        <button type="button" class="btn btn-black btn-border">
                          Voltar
                        </button>
                      </a>
                    <?php endif ?>
                    <button type="submit" class="submit-button d-flex align-items-center btn btn-black btn-save">
                      Salvar
                      <i class="submit-button__loader ml-2 rotating hidden" data-feather="loader"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Custom template -->
  </div>
  
  <?php include_once 'application/views/admin/utils/end.php' ?>
  <script>
    $(document).ready(onDocumentReady)

    function onDocumentReady () {
      onFormSubmit()
      onSituationChange()
      onShowInfoChange()
    }

    function onShowInfoChange () {
      const showInfoCheckbox = $('#show-info')

      if (!showInfoCheckbox) {
        return
      }

      showInfoCheckbox.change(function () {
        const self = $(this)
        updatePrintLink(self)
      })
    }

    function updatePrintLink (checkbox) {
      const shouldShowInfo = checkbox.prop('checked')
      const printButtonLink = $('#print-button-link')

      if (!printButtonLink) {
        return
      }
      
      const baseUrl = '<?= base_url() ?>'
      const { id } = <?= isset($record) ? json_encode($record) : json_encode([]) ?>;
      const baseLink = `${baseUrl}admin/printCandidate/index/${id}`
      printButtonLink.attr('href', `${baseLink}/${shouldShowInfo}`)
    }

    function onSituationChange () { 
      const situationSelect = $('.candidate-job-situation-select')
      if (situationSelect) {
        situationSelect.change(function () {
          const self = $(this)
          updateSituationOnChange(self)
        })
      }
    }

    function updateSituationOnChange (situationSelect) {
      const situationId = situationSelect.val()
      const candidateId = situationSelect.attr('candidate-id')
      const jobId = situationSelect.attr('job-id');
      const data = {
        candidateId,
        jobId,
        situationId
      }
      updateInterestSituation(data)
    }

    function updateInterestSituation (data) {
      if (!data) return

      const url = `${base_url}admin/candidatesJobs/updateSituation`
      const shouldRedirect = false
      const isJson = true
      ajaxSubmit(url, data, isJson, shouldRedirect)
    }

    function onFormSubmit () {
      $('#form').submit(event => {
        event.preventDefault()
        saveRegister()
      })
    }

    async function saveRegister () {
      const vanillaForm = document.querySelector('#form')
      const data = new FormData(vanillaForm)
      const url = '<?= base_url('admin/' . $names['link'] . '/save') ?>'
      
      try {
        showButtonLoader()
        disableSubmitButton()
        await ajaxSubmit(url, data)
      } catch (error) {
        hideButtonLoader()
        enableSubmitButton()
        showError('danger')
      }
    }

    function disableSubmitButton () {
      const buttonLoader = document.querySelector('.submit-button')
      buttonLoader.disabled = true
    }
    
    function enableSubmitButton () {
      const buttonLoader = document.querySelector('.submit-button')
      buttonLoader.disabled = false
    }

    function showButtonLoader () {
      const buttonLoader = document.querySelector('.submit-button .submit-button__loader')
      buttonLoader.classList.remove('hidden')
    }
    
    function hideButtonLoader () {
      const buttonLoader = document.querySelector('.submit-button .submit-button__loader')
      buttonLoader.classList.add('hidden')
    }

    function isResponseAMessage (response) {
      try {
        if (response.errors) return response.errors

        if (response.includes('<p>')) {
          response = response.replace('<p>', '')
          response = response.replace('</p>', '')
          return response
        }

        return false
      } catch (error) {
        return false
      }
    }

    async function ajaxSubmit (url, data, isJson, shouldRedirect = true) {
      await $.ajax({
        url,
        type: 'post',
        dataType: isJson ? 'json' : false,
        cache: false,
        async: true,
        processData: isJson ? undefined : false,
        contentType: isJson ? undefined : false,
        data: data,
        success (result) {
          console.log(result)
          const isMessage = isResponseAMessage(result)
          if (isMessage) {
            showError('danger', isMessage)
          } else {
            const response = isJson ? result : JSON.parse(result)
            onResponse(response, shouldRedirect)
          }
        },
        error (error) {
          console.log(error)
        }
      })
    }

    function showError (type, message = null) {
      const messageText = message || 'Erro ao salvar, tente novamente'
      const icon = 'la la-close'
      showAlert(type, messageText, icon)
    }

    function showSuccess () {
      const type = 'primary'
      const messageText = 'Salvo com sucesso'
      const icon = 'la la-check'
      showAlert(type, messageText, icon)
    }

    function onResponse (response, shouldRedirect = true) {
      const names = { link: '<?= $names['link'] ?>' }
      const responses = {
        true () {
          if (shouldRedirect) {
            window.location.href = `${base_url}admin/${names.link}`
          } else {
            showSuccess()
          }
        },
        false () {
          showError('warning', response.errors || null)
        }
      }
      const showResponse = responses[response.success]
      showResponse()
    }
  </script>
</body>

</html>