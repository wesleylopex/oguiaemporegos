<div id="interest-modal" class="slickModal">
  <div class="window rounded-sm p-8">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-dark font-medium text-lg">Interesse</h2>
      <button class="closeModal outline-none focus:outline-none">
        <i class="text-gray-500" data-feather="x-circle"></i>
      </button>
    </div>
    <div class="flex items-center mb-6">
      <a href="">
        <figure class="rounded-full relative overflow-hidden w-14 h-14">
          <img class="candidate_image w-full h-full object-cover" src="<?= base_url('assets/site/images/icons/user.png') ?>" loading="lazy" alt="Imagem de perfil do candidato" title="Imagem de perfil do candidato">
        </figure>
      </a>
      <div class="ml-4 flex flex-col">
        <h2 class="text-dark">
          <a href="">
            <span class="hover:underline font-medium candidate_name"></span>,
          </a>
          <span class="candidate_age"></span>
          anos
        </h2>
        <p class="paragraph text-sm candidate_function_1"><?= $interest->candidate_function_1 ?></p>
      </div>
    </div>
    <h2 class="text-dark text-sm">
      Se interessou na vaga
      <span class="job_title text-base font-medium hover:underline cursor-pointer"></span>
    </h2>
    <div class="mb-6 flex flex-wrap items-center">
      <div class="mr-6 mt-6 flex items-center" title="Localização">
        <i class="text-dark feather-lg mr-2" data-feather="map-pin"></i>
        <p class="paragraph text-sm">
          <span class="candidate_address_city"></span>
          -
          <span class="candidate_address_uf"></span>
        </p>
      </div>
      <div class="mr-6 mt-6 flex items-center" title="Localização">
        <i class="text-dark feather-lg mr-2" data-feather="info"></i>
        <p class="candidate_genre paragraph text-sm"></p>
      </div>
    </div>
    <form id="interest" action="<?= base_url('companies/profile/interests/save') ?>" method="post" class="grid grid-cols-1 gap-4">
      <input type="hidden" name="id" class="id">
      <div>
        <label class="input-label">Status *</label>
        <select required name="situation_id" class="situation_id input">
          <option value="" class="hidden"></option>
          <?php foreach ($situations as $situation) : ?>
            <option value="<?= $situation->id ?>"><?= $situation->title ?></option>
          <?php endforeach ?>
        </select>
        <label class="input-label--error"></label>
      </div>
      <div class="col-span-full">
        <button class="btn btn--primary w-full">
          Salvar interesse
        </button>
      </div>
    </form>
  </div>
</div>