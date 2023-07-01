<div id="new-password-form-modal" class="slickModal">
  <div class="window rounded-sm p-8">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-dark font-medium text-lg">Alterar senha</h2>
      <button class="closeModal outline-none focus:outline-none">
        <i class="text-gray-500" data-feather="x-circle"></i>
      </button>
    </div>
    <form data-reload="false" id="new-password-form" action="<?= base_url('companies/profile/newPassword/save') ?>" method="post" class="grid grid-cols-1 gap-4">
      <div class="hidden">
        <input type="email" name="email" class="hidden" autocomplete="username">
      </div>
      <div>
        <label class="input-label">Senha atual *</label>
        <input type="password" required autocomplete="current-password" name="password" class="input">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Nova senha *</label>
        <input type="password" required autocomplete="new-password" name="new_password" class="input">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Confirmar nova senha *</label>
        <input type="password" required autocomplete="new-password" name="new_password_confirmation" class="input">
        <label class="input-label--error"></label>
      </div>
      <div>
        <button class="btn btn--primary w-full">
          Salvar nova senha
        </button>
      </div>
      <div class="hidden">
        <button type="button" class="closeModal"></button>
      </div>
    </form>
  </div>
</div>