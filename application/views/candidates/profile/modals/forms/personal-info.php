<div id="personal-info-form-modal" class="slickModal">
  <div class="window rounded-sm p-8">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-dark font-medium text-lg">Informações pessoais</h2>
      <button class="closeModal outline-none focus:outline-none">
        <i class="text-gray-500" data-feather="x-circle"></i>
      </button>
    </div>
    <form id="personal-info-form" action="<?= base_url('candidates/profile/personalInfo/save') ?>" method="post" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div class="col-span-full">
        <label class="input-label">Nome completo *</label>
        <input type="text" required name="name" class="input" value="<?= $candidate->name ?>">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">E-mail *</label>
        <input type="email" required name="email" class="input" value="<?= $candidate->email ?>">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Data de nascimento *</label>
        <input type="text" required name="birthdate" class="date input" value="<?= date('d/m/Y', strtotime($candidate->birthdate)) ?>">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Celular / Telefone *</label>
        <input type="text" required name="phone" class="phone input" value="<?= $candidate->phone ?>">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">WhatsApp</label>
        <div class="input py-0 flex items-center">
          <label class="input-label mr-2">+55</label>
          <input type="text" name="whatsapp" class="phone w-full input-label text-dark bg-transparent py-2" value="<?= $candidate->whatsapp ?>">
        </div>
      </div>
      <div>
        <label class="input-label">CPF *</label>
        <input type="text" required name="cpf" class="cpf input" value="<?= $candidate->cpf ?>">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">RG *</label>
        <input type="text" required name="rg" class="rg input" minlength="10" maxlength="10" value="<?= $candidate->rg ?>">
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Gênero *</label>
        <select required name="genre" class="input">
          <option value="" class="hidden"></option>
          <option <?= $candidate->genre === 'Masculino' ? 'selected' : '' ?> value="Masculino">Masculino</option>
          <option <?= $candidate->genre === 'Feminino' ? 'selected' : '' ?> value="Feminino">Feminino</option>
          <option <?= $candidate->genre === 'Outro' ? 'selected' : '' ?> value="Outro">Outro</option>
        </select>
        <label class="input-label--error"></label>
      </div>
      <div>
        <label class="input-label">Estado civil *</label>
        <select required name="marital_status" class="input">
          <option value="" class="hidden"></option>
          <option <?= $candidate->marital_status === 'Solteiro' ? 'selected' : '' ?> value="Solteiro">Solteiro</option>
          <option <?= $candidate->marital_status === 'Casado' ? 'selected' : '' ?> value="Casado">Casado</option>
          <option <?= $candidate->marital_status === 'Viúvo' ? 'selected' : '' ?> value="Viúvo">Viúvo</option>
          <option <?= $candidate->marital_status === 'Separado' ? 'selected' : '' ?> value="Separado">Separado</option>
          <option <?= $candidate->marital_status === 'Divorciado' ? 'selected' : '' ?> value="Divorciado">Divorciado</option>
          <option <?= $candidate->marital_status === 'União estável' ? 'selected' : '' ?> value="União estável">União estável</option>
        </select>
        <label class="input-label--error"></label>
      </div>
      <div class="col-span-full">
        <button class="btn btn--primary w-full">
          Salvar informações
        </button>
      </div>
    </form>
  </div>
</div>