<div id="confirm-logout-modal" class="slickModal">
  <div class="window rounded-sm p-8">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-dark font-medium text-lg">Tem certeza que deseja sair?</h2>
    </div>
    <div class="grid grid-cols-2 gap-4">
      <button class="closeModal btn btn--primary btn--outline w-full">
        Voltar
      </button>
      <a href="<?= base_url('companies/login/logout') ?>">
        <button class="btn btn--primary w-full">
          Sim, sair
        </button>
      </a>
    </div>
  </div>
</div>