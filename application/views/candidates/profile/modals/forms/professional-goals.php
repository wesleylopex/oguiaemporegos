<div id="professional-goals-form-modal" class="slickModal">
  <div class="window rounded-sm p-8">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-dark font-medium text-lg">Objetivos profissonais</h2>
      <button class="closeModal outline-none focus:outline-none">
        <i class="text-gray-500" data-feather="x-circle"></i>
      </button>
    </div>
    <form id="professional-goals-form" action="<?= base_url('candidates/profile/professionalGoals/save') ?>" method="post" class="grid grid-cols-1 gap-4">
      <div>
        <label class="input-label">Cargo desejado 1 *</label>
        <input type="text" required name="function_1" class="input" value="<?= $candidate->function_1 ?>">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Cargo desejado 2</label>
        <input type="text" name="function_2" class="input" value="<?= $candidate->function_2 ?>">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Cargo desejado 3</label>
        <input type="text" name="function_3" class="input" value="<?= $candidate->function_3 ?>">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Salário pretendido (R$) *</label>
        <input type="text" required name="desired_salary" class="money input" value="<?= $candidate->desired_salary ?>">
        <label class="input-label--error"></label>
      </div>
      <div class="col-span-full">
        <button class="btn btn--primary w-full">
          Salvar objetivos
        </button>
      </div>
    </form>
  </div>
</div>