<div id="confirm-delete-interest-modal" class="slickModal">
  <div class="window rounded-sm p-8">
    <h2 class="text-dark font-medium text-lg">Tem certeza que deseja remover este interesse?</h2>
    <p class="paragraph my-4 text-sm">Se a vaga já estiver encerrada ou cancelada, não será possível se candidatar novamente.</p>
    <form action="<?= base_url('candidates/profile/interests/delete') ?>" method="post" class="grid grid-cols-2 gap-4">
      <input type="hidden" name="job-id">
      <button type="button" class="closeModal btn btn--primary btn--outline w-full">
        Voltar
      </button>
      <button class="btn btn--primary w-full">
        Sim, remover interesse
      </button>
    </form>
  </div>
</div>