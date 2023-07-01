<div id="address-form-modal" class="slickModal">
  <div class="window rounded-sm p-8">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-dark font-medium text-lg">Endereço</h2>
      <button class="closeModal outline-none focus:outline-none">
        <i class="text-gray-500" data-feather="x-circle"></i>
      </button>
    </div>
    <form id="address-form" action="<?= base_url('candidates/profile/address/save') ?>" method="post" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label class="input-label">CEP *</label>
        <input type="text" required name="address_zip_code" class="zip-code input" value="<?= $candidate->address_zip_code ?>">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Rua *</label>
        <input type="text" required name="address_street" class="input" value="<?= $candidate->address_street ?>">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Número *</label>
        <input type="text" required name="address_number" class="input" value="<?= $candidate->address_number ?>">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Bairro *</label>
        <input type="text" required name="address_neighborhood" class="input" value="<?= $candidate->address_neighborhood ?>">
        <label class="input-label--error"></label>
      </div>
      <div class="col-span-full">
        <label class="input-label">Complemento</label>
        <input type="text" name="address_complement" class="input" value="<?= $candidate->address_complement ?>">
      </div>
      <div>
        <label class="input-label">UF *</label>
        <input type="text" required name="address_uf" class="input" value="<?= $candidate->address_uf ?>">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Cidade *</label>
        <input type="text" required name="address_city" class="input" value="<?= $candidate->address_city ?>">
        <label class="input-label--error"></label>
      </div>
      <div class="col-span-full">
        <button class="btn btn--primary w-full">
          Salvar endereço
        </button>
      </div>
    </form>
  </div>
</div>