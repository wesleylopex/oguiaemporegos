<div id="location-form-modal" class="slickModal">
  <div class="window rounded-sm p-8">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-dark font-medium text-lg">Localização</h2>
      <button class="closeModal outline-none focus:outline-none">
        <i class="text-gray-500" data-feather="x-circle"></i>
      </button>
    </div>
    <form id="location-form" action="<?= base_url('companies/profile/location/save') ?>" method="post" class="grid grid-cols-1 gap-4">
      <div>
        <label class="input-label">Latitude</label>
        <input type="text" name="latitude" class="input" value="<?= $company->latitude ?>">
      </div>
      <div>
        <label class="input-label">Longitude</label>
        <input type="text" name="longitude" class="input" value="<?= $company->longitude ?>">
      </div>
      <div class="col-span-full">
        <button class="btn btn--primary w-full">
          Salvar localização
        </button>
      </div>
    </form>
  </div>
</div>