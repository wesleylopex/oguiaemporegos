<div id="courses-form-modal" class="slickModal">
  <div class="window rounded-sm p-8">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-dark font-medium text-lg">Cursos e certificações</h2>
      <button class="closeModal outline-none focus:outline-none">
        <i class="text-gray-500" data-feather="x-circle"></i>
      </button>
    </div>
    <form id="courses-form" action="<?= base_url('candidates/profile/courses/save') ?>" method="post" class="grid grid-cols-1 gap-4">
      <input class="hidden" name="id">
      <div>
        <label class="input-label">Nome do curso *</label>
        <input type="text" required name="course_name" class="input">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Nome da instituição *</label>
        <input type="text" required name="institution_name" class="input">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Número de horas *</label>
        <input type="number" required name="hours" min="1" minlength="1" maxlength="4" class="input">
        <label class="input-label--error"></label>
      </div>
      <div class="col-span-full">
        <button class="btn btn--primary w-full">
          Salvar curso
        </button>
      </div>
    </form>
  </div>
</div>
