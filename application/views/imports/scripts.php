<!-- Alerts -->
<div class="alert alert--success cursor-pointer fixed left-1/2 z-40 text-gray-100 w-4/5 md:w-full max-w-sm bg-green-600 p-8 rounded-sm flex items-center">
  <i class="mr-6" data-feather="check-circle"></i>
  <p class="alert__message"></p>
</div>

<div class="alert alert--error cursor-pointer fixed left-1/2 z-40 text-gray-100 w-4/5 md:w-full max-w-sm bg-red-600 p-8 rounded-sm flex items-center">
  <i class="mr-6" data-feather="x-circle"></i>
  <p class="alert__message"></p>
</div>

<div class="alert alert--warning cursor-pointer fixed left-1/2 z-40 text-gray-100 w-4/5 md:w-full max-w-sm bg-yellow-600 p-8 rounded-sm flex items-center">
  <i class="mr-6" data-feather="alert-circle"></i>
  <p class="alert__message"></p>
</div>

<div id="loader" class="w-screen h-screen fixed top-0 left-0 bg-white z-40 flex justify-center items-center">
  <img src="<?= base_url('assets/site/images/company/loader.gif') ?>" loading="lazy" alt="Loader gif">
</div>

<script src="<?= base_url('assets/site/scripts/plugins/feather-icons/feather.min.js') ?>"></script>
<script src="<?= base_url('assets/site/scripts/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/site/scripts/plugins/jquery-mask/jquery.mask.min.js') ?>"></script>
<script src="<?= base_url('assets/site/scripts/plugins/slick-modal/jquery.slick-modals.min.js') ?>"></script>
<script src="<?= base_url('assets/site/scripts/plugins/select2/select2.min.js') ?>"></script>

<script type="module">
  import { Utils } from '<?= base_url('assets/site/scripts/Utils/Utils.js?version=1') ?>'
  import { Alert } from '<?= base_url('assets/site/scripts/Alert/Alert.js?version=1') ?>'

  window.addEventListener('load', function () {
    initUtils()
    initSelect2()
    showServerSessionMessages()

    window.showAlert = showAlert
    window.slugify = slugify
  })

  function initUtils () {
    const utils = Utils()
    utils.start()
  }

  function initSelect2 () {
    $('.select2').select2({
      placeholder: $(this).attr('placeholder')
    })
  }

  function showServerSessionMessages () {
    const error = '<?= $this->session->flashdata('error') ?>'
    const success = '<?= $this->session->flashdata('success') ?>'

    if (error) {
      showAlert('error', error)
    } else if (success) {
      showAlert('success', success)
    } 
  }

  function showAlert (type, message, hideAfter = 4000) {
    const alert = Alert()
    alert.show(`.alert.alert--${type}`, message, hideAfter)
  }

  function slugify (text) {
    return text.toString().toLowerCase().normalize('NFD')
      .replace(/[\u0300-\u036f]/g, '')
      .replace(/\s+/g, '-')
      .replace(/[^\w\-]+/g, '')
      .replace(/\-\-+/g, '-')
      .replace(/^-+/, '')
      .replace(/-+$/, '')
  }
</script>