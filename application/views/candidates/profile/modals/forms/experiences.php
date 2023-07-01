<div id="experiences-form-modal" class="slickModal">
  <div class="window rounded-sm p-8">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-dark font-medium text-lg">Experiências profissonais</h2>
      <button class="closeModal outline-none focus:outline-none">
        <i class="text-gray-500" data-feather="x-circle"></i>
      </button>
    </div>
    <form id="experiences-form" action="<?= base_url('candidates/profile/experiences/save') ?>" method="post" class="grid grid-cols md:grid-cols-2 gap-4">
      <input type="text" class="hidden" name="id">
      <div class="col-span-full">
        <label class="input-label">Nome de empresa *</label>
        <input type="text" required name="company_name" class="input">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Cargo *</label>
        <input type="text" required name="function" class="input">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Área *</label>
        <select name="area_id" required class="input">
          <option value="" class="hidden"></option>
          <?php foreach ($areas as $area) : ?>
            <option value="<?= $area->id ?>"><?= $area->title ?></option>
          <?php endforeach ?>
        </select>
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Salário final (R$) *</label>
        <input type="text" required name="salary" class="money input">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Data de entrada *</label>
        <input type="text" required name="entry_date" class="date input">
        <label class="input-label--error"></label>
      </div>
      <div class="col-span-full grid grid-cols-2 gap-4">
        <div>
          <label class="input-label">Data de saída *</label>
          <input type="text" required name="exit_date" class="date input">
          <label class="input-label--error"></label>
        </div>
        <div>
          <label class="input-label opacity-0">É o emprego atual</label>
          <div class="flex items-center mt-2">
            <input type="checkbox" id="actual-job" name="actual_job" class="form-checkbox h-5 w-5 text-gray-600">
            <label for="actual-job" class="ml-2 text-gray-700 leading-none">É o emprego atual</label>
          </div>                
        </div>
      </div>
      <div class="col-span-full">
        <button class="btn btn--primary w-full">
          Salvar experiência
        </button>
      </div>
    </form>
  </div>
</div>