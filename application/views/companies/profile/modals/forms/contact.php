<div id="contact-form-modal" class="slickModal">
  <div class="window rounded-sm p-8">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-dark font-medium text-lg">Informações de contato</h2>
      <button class="closeModal outline-none focus:outline-none">
        <i class="text-gray-500" data-feather="x-circle"></i>
      </button>
    </div>
    <form id="contact-form" action="<?= base_url('companies/profile/contact/save') ?>" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="col-span-full">
        <label class="input-label">Instagram</label>
        <div class="input py-0 flex items-center">
          <label class="input-label">https://instagram.com/</label>
          <input type="text" name="instagram" class="w-full input-label text-dark bg-transparent py-2" value="<?= $company->instagram ?>">
        </div>
      </div>
      <div class="col-span-full">
        <label class="input-label">Facebook</label>
        <div class="input py-0 flex items-center">
          <label class="input-label">https://facebook.com/</label>
          <input type="text" name="facebook" class="w-full input-label text-dark bg-transparent py-2" value="<?= $company->facebook ?>">
        </div>
      </div>
      <div>
        <label class="input-label">Website</label>
        <input type="text" name="website" class="input" value="<?= $company->website ?>">
      </div>
      <div>
        <label class="input-label">WhatsApp</label>
        <div class="input py-0 flex items-center">
          <label class="input-label mr-2">+55</label>
          <input type="text" name="whatsapp" class="phone w-full input-label text-dark bg-transparent py-2" value="<?= $company->whatsapp ?>">
        </div>
      </div>
      <div>
        <label class="input-label">E-mail</label>
        <input type="email" name="email" class="input" value="<?= $company->email ?>">
      </div>
      <div>
        <label class="input-label">Telefone</label>
        <div class="input py-0 flex items-center">
          <label class="input-label mr-2">+55</label>
          <input type="text" name="phone" class="phone w-full input-label text-dark bg-transparent py-2" value="<?= $company->phone ?>">
        </div>
      </div>
      <div class="col-span-full">
        <button class="btn btn--primary w-full">
          Salvar informações
        </button>
      </div>
    </form>
  </div>
</div>