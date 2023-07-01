<div id="settings-form-modal" class="slickModal">
  <div class="window rounded-sm p-8">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-dark font-medium text-lg">Configurações</h2>
      <button class="closeModal outline-none focus:outline-none">
        <i class="text-gray-500" data-feather="x-circle"></i>
      </button>
    </div>
    <form id="settings-form" action="<?= base_url('companies/profile/settings/save') ?>" method="post" class="grid grid-cols-1 gap-4">
      <div>
        <label class="input-label">Nome da empresa</label>
        <input type="text" required name="name" class="input" value="<?= $company->name ?>">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Nome de usuário</label>
        <span class="text-gray-400 text-xs">(letras, números, traço (-) e underline (_))</span>
        <input type="text" required name="username" value="<?= $company->username ?>" class="input">
        <label class="input-label--error"></label>
      </div>
      <div class="col-span-full">
        <button class="btn btn--primary w-full">
          Salvar configurações
        </button>
      </div>
    </form>
  </div>
</div>