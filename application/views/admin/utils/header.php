<div class="main-header">
  <div class="logo-header" data-background-color="black">
    <!--
					Tip 1: You can change the background color of the logo header using: data-background-color="black | dark | blue | purple | light-blue | green | orange | red"
				-->
    <a href="https://pontoagencia.com.br" target="_blank" class="logo">
      <img src="<?= base_url('assets/admin/img/ponto/logo-ponto-white-small.png') ?>" loading="lazy" alt="Logo da Agência Ponto"
        class="navbar-brand">
    </a>
    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">
        <i class="la la-bars"></i>
      </span>
    </button>
    <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
  </div>

  <nav class="navbar navbar-header navbar-expand-lg" data-background-color="black">
    <!-- Tip 1: You can change the background color of the navbar header using: data-background-color="black | dark | blue | purple | light-blue | green | orange | red" -->
    <div class="container-fluid">
      <!-- <div class="navbar-minimize">
        <button class="btn btn-minimize btn-rounded">
          <i class="la la-navicon"></i>
        </button>
      </div> -->
      <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
        <li class="nav-item mr-20px">
          <a class="nav-link" href="<?= base_url() ?>" target="_blank">
            <div class="d-flex align-items-center">
              Visitar site
              <i class="ml-2" data-feather="globe"></i>
            </div>
          </a>
        </li>
        <li class="nav-item dropdown hidden-caret">
          <span class="d-flex dropdown-toggle color-white cursor-pointer" data-toggle="dropdown" href="" aria-expanded="false">
            <i data-feather="settings"></i>
          </span>
          <ul class="dropdown-menu dropdown-user animated fadeIn">
            <li>
              <div class="user-box">
                <div class="u-text">
                  <h4><?= $this->session->userdata('admin')['name'] ?></h4>
                </div>
              </div>
            </li>
            <li>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?= site_url('admin/login/logout') ?>">Sair</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</div>

<div class="sidebar">
  <div class="sidebar-wrapper scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav">
        <li class="nav-section"><h4 class="text-section">Geral</h4></li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'administrators' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/administrators') ?>">
            <i data-feather="users"></i>
            <p>Administradores</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'messages' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/messages') ?>">
            <i data-feather="message-circle"></i>
            <p>Mensagens</p>
            <?php if (isset($unreadMessagesLength) && $unreadMessagesLength) : ?>
              <span class="badge badge-count badge-primary"><?= $unreadMessagesLength ?></span>
            <?php endif ?>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'emails' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/emails') ?>">
            <i data-feather="mail"></i>
            <p>E-mails</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'metatags' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/metatags') ?>">
            <i data-feather="activity"></i>
            <p>Metatags</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'formations' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/formations') ?>">
            <i data-feather="book"></i>
            <p>Formações</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'quizQuestions' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/quizQuestions') ?>">
            <i data-feather="help-circle"></i>
            <p>Perguntas do Quest.</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'candidatesQuizQuestions' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/candidatesQuizQuestions') ?>">
            <i data-feather="align-justify"></i>
            <p>Respostas do Quest.</p>
          </a>
        </li>

        <li class="nav-section">
          <h4 class="text-section">Empresa</h4>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'companyAbout' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/companyAbout') ?>">
            <i data-feather="file-text"></i>
            <p>Sobre nós</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'companyInformations' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/companyInformations') ?>">
            <i data-feather="info"></i>
            <p>Informações</p>
          </a>
        </li>

        <li class="nav-section"><h4 class="text-section">Vagas de emprego</h4></li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'jobs' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/jobs') ?>">
            <i data-feather="file-text"></i>
            <p>Vagas de emprego</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'invalidJobs' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/invalidJobs') ?>">
            <i data-feather="file-text"></i>
            <p>Vagas inválidas</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'jobsAreas' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/jobsAreas') ?>">
            <i data-feather="activity"></i>
            <p>Áreas</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'jobsTypes' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/jobsTypes') ?>">
            <i data-feather="list"></i>
            <p>Tipos</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'jobsSituations' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/jobsSituations') ?>">
            <i data-feather="align-center"></i>
            <p>Situações</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'jobsCities' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/jobsCities') ?>">
            <i data-feather="map-pin"></i>
            <p>Cidades</p>
          </a>
        </li>

        <li class="nav-section">
          <h4 class="text-section">Candidatos</h4>
        </li>
        <li class="nav-item <?= isset($names) && $names["link"] == "candidates" ? "active" : "" ?>">
          <a href="<?= site_url("admin/candidates") ?>">
            <i data-feather="users"></i>
            <p>Todos os candidatos</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names["link"] == "candidatesPayments" ? "active" : "" ?>">
          <a href="<?= site_url("admin/candidatesPayments") ?>">
            <i data-feather="dollar-sign"></i>
            <p>Pagamentos</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names["link"] == "candidatesJobs" ? "active" : "" ?>">
          <a href="<?= site_url("admin/candidatesJobs") ?>">
            <i data-feather="thumbs-up"></i>
            <p>
              Interesses
              <?php if (isset($todayInterestsLength) && $todayInterestsLength > 0) : ?>
                <span class="ml-2 badge badge-pill badge-primary">
                  <?= $todayInterestsLength ?>
                </span>
              <?php endif ?>
            </p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'candidatesJobsSituations' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/candidatesJobsSituations') ?>">
            <i data-feather="align-center" data-></i>
            <p>Situações interesses</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names["link"] == "candidatesLanguages" ? "active" : "" ?>">
          <a href="<?= site_url("admin/candidatesLanguages") ?>">
            <i data-feather="message-square"></i>
            <p>Idiomas</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'candidatesDesiredResponsabilities' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/candidatesDesiredResponsabilities') ?>">
            <i data-feather="bookmark"></i>
            <p>Cargos desejados</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'candidatesCourses' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/candidatesCourses') ?>">
            <i data-feather="book-open"></i>
            <p>Cursos</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'candidatesFormations' ? 'active' : '' ?>">
          <a href="<?= site_url("admin/candidatesFormations") ?>">
            <i data-feather="book"></i>
            <p>Formações</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'candidatesProfessionalExperiences' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/candidatesProfessionalExperiences') ?>">
            <i data-feather="briefcase"></i>
            <p>Exp. profissionais</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>