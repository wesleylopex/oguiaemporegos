<div id="description-form-modal" class="slickModal">
  <div class="window rounded-sm p-8">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-dark font-medium text-lg">Descrição</h2>
      <button class="closeModal outline-none focus:outline-none">
        <i class="text-gray-500" data-feather="x-circle"></i>
      </button>
    </div>
    <form id="description-form" action="<?= base_url('companies/profile/description/save') ?>" method="post" class="grid grid-cols-1 gap-4">
      <div>
        <div data-input="textarea[name=description]" data-label=".input-length-counter__label" class="input-length-counter flex items-center justify-between">
          <label class="input-label">Breve descrição sobre a empresa *</label>
          <span class="input-label text-xs">
            <span class="input-length-counter__label">0/200</span>
          </span>
        </div>
        <textarea required maxlength="200" name="description" rows="4" class="input"><?= $company->description ?></textarea>
        <label class="input-label--error"></label>
      </div>
      <div class="col-span-full">
        <button class="btn btn--primary w-full">
          Salvar descrição
        </button>
      </div>
    </form>
  </div>
</div>