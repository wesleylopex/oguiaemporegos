<div id="job-filters-modal" class="slickModal">
  <div class="window rounded-sm p-8">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-dark font-medium text-lg">Filtrar vagas</h2>
      <button class="closeModal outline-none focus:outline-none">
        <i class="text-gray-500" data-feather="x-circle"></i>
      </button>
    </div>
    <form id="job-filters" action="<?= base_url($this->session->userdata('company')['username']) ?>" method="get" class="mt-6 grid grid-cols-1 gap-4">
      <div>
        <label class="input-label">Título ou palavras chaves</label>
        <input value="<?= $this->input->get('query') ?>" type="text" name="query" class="input">
      </div>
      <div>
        <label class="input-label">Cidade</label>
        <select name="cities[]" class="input">
          <option value=""></option>
          <?php foreach ($cities as $city) : ?>
            <option
              <?= $this->input->get('cities') && in_array($city->id, $this->input->get('cities')) ? 'selected' : '' ?>
              value="<?= $city->id ?>"
            ><?= $city->name ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div>
        <label class="input-label">Área</label>
        <select name="areas[]" class="input">
          <option value=""></option>
          <?php foreach ($areas as $area) : ?>
            <option
              <?= $this->input->get('areas') && in_array($area->id, $this->input->get('areas')) ? 'selected' : '' ?>
              value="<?= $area->id ?>"
            ><?= $area->title ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div>
        <label class="input-label">Tipo de vaga</label>
        <select name="types[]" class="input">
          <option value=""></option>
          <?php foreach ($types as $type) : ?>
            <option
              <?= $this->input->get('types') && in_array($type->id, $this->input->get('types')) ? 'selected' : '' ?>
              value="<?= $type->id ?>"
            ><?= $type->title ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div>
        <button class="w-full btn btn--primary">Filtrar</button>
      </div>
    </form>
  </div>
</div>