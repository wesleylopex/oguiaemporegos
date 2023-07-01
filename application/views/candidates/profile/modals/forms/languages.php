<div id="languages-form-modal" class="slickModal">
  <div class="window rounded-sm p-8">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-dark font-medium text-lg">Idiomas</h2>
      <button class="closeModal outline-none focus:outline-none">
        <i class="text-gray-500" data-feather="x-circle"></i>
      </button>
    </div>
    <form id="languages-form" action="<?= base_url('candidates/profile/languages/save') ?>" method="post" class="grid grid-cols-1 gap-4">
      <input type="text" class="hidden" name="id">
      <div>
        <label class="input-label">Idioma *</label>
        <input type="text" required name="language" class="input">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Nível *</label>
        <select required name="level" class="input">
          <option value="" class="hidden"></option>
          <option value="Básico">Básico</option>
          <option value="Intermediário">Intermediário</option>
          <option value="Técnico">Técnico</option>
          <option value="Avançado">Avançado</option>
          <option value="Fluente">Fluente</option>
        </select>
        <label class="input-label--error"></label>
      </div>
      <div class="col-span-full">
        <button class="btn btn--primary w-full">
          Salvar idioma
        </button>
      </div>
    </form>
  </div>
</div>
