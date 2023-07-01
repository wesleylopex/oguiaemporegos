<div id="formations-form-modal" class="slickModal">
  <div class="window rounded-sm p-8">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-dark font-medium text-lg">Escolaridade</h2>
      <button class="closeModal outline-none focus:outline-none">
        <i class="text-gray-500" data-feather="x-circle"></i>
      </button>
    </div>
    <form id="formations-form" action="<?= base_url('candidates/profile/formations/save') ?>" method="post" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <input type="text" class="hidden" name="id">
      <div class="col-span-full">
        <label class="input-label">Grau de formação *</label>
        <select required name="formation_degree" class="input">
          <option value="" class="hidden"></option>
          <optgroup label="Ensino fundamental">
            <option value="Ensino fundamental incompleto">Ensino fundamental incompleto</option>
            <option value="Ensino fundamental cursando">Ensino fundamental cursando</option>
            <option value="Ensino fundamental completo">Ensino fundamental completo</option>
          </optgroup>
          <optgroup label="Ensino médio">
            <option value="Ensino médio incompleto">Ensino médio incompleto</option>
            <option value="Ensino médio cursando">Ensino médio cursando</option>
            <option value="Ensino médio completo">Ensino médio completo</option>
          </optgroup>
          <optgroup label="Ensino superior">
            <option value="Ensino superior incompleto">Ensino superior incompleto</option>
            <option value="Ensino superior cursando">Ensino superior cursando</option>
            <option value="Ensino superior completo">Ensino superior completo</option>
          </optgroup>
        </select>
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Nome da instituição *</label>
        <input type="text" required name="institution_name" class="input">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Nome do curso</label>
        <input type="text" name="course_name" class="input">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Data de início *</label>
        <input type="text" required name="started_at" class="date input">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Data de conclusão</label>
        <input type="text" name="ended_at" class="date input">
      </div>
      <div class="col-span-full">
        <button class="btn btn--primary w-full">
          Salvar formação
        </button>
      </div>
    </form>
  </div>
</div>
