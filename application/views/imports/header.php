<header>
  <div class="wrapper">
    <div id="logo-wrapper">
      <a href="<?= base_url() ?>">
        <img src="<?= base_url('assets/site/images/company/logo-amarelo-azul.png') ?>" loading="lazy" alt="O Guia Empregos" title="O Guia Empregos" />
      </a>
    </div>
    <div id="burger">
      <div></div>
      <div></div>
    </div>
    <nav id="nav">
      <ul>
        <li class="<?= isset($page) && $page === 'home' ? 'active' : '' ?>"><a href="<?= base_url() ?>">Início</a></li>
        <li class="<?= isset($page) && $page === 'jobs' ? 'active' : '' ?>"><a href="<?= base_url('vagas-de-emprego') ?>">Vagas de emprego</a></li>
        <?php if ($this->session->userdata('company')) : ?>
          <li class="button-item md:ml-6">
            <a href="<?= base_url($this->session->userdata('company')['username']) ?>">
              <div class="flex items-center p-1 pr-2 hover:bg-gray-300 <?= isset($page) && $page === 'profile' ? 'bg-gray-200' : '' ?> rounded-full transition-all duration-200">
                <figure class="mr-2 w-8 h-8 border border-gray-300 rounded-full">
                  <img
                    class="image-preview__img flex-shrink-0 rounded-full w-full h-full object-cover"
                    src="<?= ($this->session->userdata('company')['image'] ? base_url('assets/uploads/images/companies/' . $this->session->userdata('company')['image']) : base_url('assets/site/images/icons/user.png')) ?>"
                    loading="lazy" alt="<?= $this->session->userdata('company')['name'] ?>"
                    title="<?= $this->session->userdata('company')['name'] ?>">
                </figure>
                <span class="text-gray-800 text-sm font-semibold">
                  <?= $this->session->userdata('company')['name'] ?>
                </span>
              </div>
            </a>
          </li>
        <?php elseif (!$this->session->userdata('candidate')) : ?>
          <li class="<?= isset($page) && $page === 'companies' ? 'active' : '' ?>"><a href="<?= base_url('empresas/entrar') ?>">Empresas</a></li>
        <?php endif ?>
        <?php if ($this->session->userdata('candidate')) : ?>
          <li class="button-item md:ml-6">
            <a href="<?= base_url('candidates/profile') ?>">
              <div class="flex items-center p-1 pr-2 hover:bg-gray-300 <?= isset($page) && $page === 'profile' ? 'bg-gray-200' : '' ?> rounded-full transition-all duration-200">
                <figure class="mr-2 w-8 h-8 border border-gray-300 rounded-full">
                  <img
                    class="image-preview__img flex-shrink-0 rounded-full w-full h-full object-cover"
                    src="<?= ($this->session->userdata('candidate')['image'] ? base_url('assets/uploads/images/candidates/' . $this->session->userdata('candidate')['image']) : base_url('assets/site/images/icons/user.png')) ?>"
                    loading="lazy" alt="Profile"
                    title="Profile">
                </figure>
                <span class="text-gray-800 text-sm font-semibold">
                  <?= explode(' ', $this->session->userdata('candidate')['name'])[0] ?>
                </span>
              </div>
            </a>
          </li>
        <?php elseif (!$this->session->userdata('company')) : ?>
          <li class="button-item mx-2">
            <a href="<?= base_url('cadastro') ?>">
              <button class="btn btn--primary">Cadastre-se</button>
            </a>
          </li>
          <li class="button-item mx-2">
            <a href="<?= base_url('entrar') ?>">
              <button class="btn">Login</button>
            </a>
          </li>
        <?php endif ?>
      </ul>
    </nav>
  </div>
</header>