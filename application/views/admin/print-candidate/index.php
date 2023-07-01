<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Imprimir</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?= base_url('assets/admin/img/ponto/favicon-agencia-ponto-transparent.png') ?>" type="image/x-icon" />
  <link rel="stylesheet" href="<?= base_url('assets/admin/css/print-candidate.css') ?>">
</head>
<body>
  <table>
    <thead>
      <tr>
        <td>
          <div class="header-space"></div>
        </td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <div class="content">
            <div>
              <h3 class="candidate-name"><?= $candidate->name ?></h3>
              <?php if ($candidate->image) : ?>
                <div class="candidate-profile">
                  <img class="candidate-profile__image" src="<?= base_url('assets/uploads/images/candidates/'.$candidate->image) ?>" loading="lazy" alt="">
                </div>
              <?php endif ?>
              <p class="item">
                <strong>Endereço:</strong> <?= "$candidate->address_street, $candidate->address_number - $candidate->address_neighborhood - " . ($candidate->address_complement ? "$candidate->address_complement - " : "") . "$candidate->address_city - $candidate->address_uf" ?>
              </p>
              <p class="item">
                <strong>Número de filhos:</strong> <?= $candidate->number_of_children ?>
              </p>
              <?php if ($candidate->childrens_age) : ?>
                <p class="item">
                  <strong>Idade do(s) filho(s):</strong> <?= $candidate->childrens_age ?>
                </p>
              <?php endif ?>
              <p class="item">
                <strong>Possui veículo para trabalho:</strong> <?= $candidate->own_work_vehicle ?>
              </p>
              <p class="item">
                <strong>Possui CNH:</strong> <?= $candidate->has_drivers_license ?>
              </p>
              <?php if ($showContactInfo) : ?>
                <div>
                  <p class="item"><strong>E-mail:</strong> <?= $candidate->email ?> </p>
                  <p class="item"><strong>Telefone:</strong> <?= $candidate->phone ?></p>
                </div>
              <?php endif ?>
              <p class="item"><strong>Data de Nascimento:</strong> <?= date("d/m/Y", strtotime($candidate->birthdate)) ?> </p>
            </div>
            <?php if (sizeof($candidate->formations) > 0) : ?>
              <div class="information-container">
                <div class="information-title-container">
                  <h4 class="information-title">Formação acadêmica</h4>
                </div>
                <ul class="information-list">
                  <?php foreach ($candidate->formations as $formation) : ?>
                    <li class="information-list-item"><?= "$formation->training_degree - $formation->institution_name - $formation->course_name" ?> </li>
                  <?php endforeach ?>
                </ul>
              </div>
            <?php endif ?>
            <?php if (sizeof($candidate->professionalExperiences) > 0) : ?>
              <div class="information-container">
                <div class="information-title-container">
                  <h4 class="information-title">Experiência profissional</h4>
                </div>
                <div class="information-item-container">
                  <?php foreach ($candidate->professionalExperiences as $experience) : ?>
                    <div class="information-item">
                      <p><strong>Empresa:</strong> <?= $experience->company_name ?></p>
                      <p class="my-1"><strong>Período:</strong> <?= date('m/Y', strtotime($experience->entry_date)) ?> - <?= $experience->exit_date ?></p>
                      <p class="my-1"><strong>Cargo:</strong> <?= $experience->responsability ?></p>
                      <?php if ($experience->activities_description) : ?>
                        <p><strong>Principais Funções:</strong> <?= $experience->activities_description ?></p>
                      <?php endif ?>
                    </div>
                  <?php endforeach ?>
                </div>
              </div>
            <?php endif ?>
            <?php if (sizeof($candidate->languages) > 0) : ?>
              <div class="information-container">
                <div class="information-title-container">
                  <h4 class="information-title">Idiomas</h4>
                </div>
                <ul class="information-list">
                  <?php foreach ($candidate->languages as $language) : ?>
                    <li class="information-list-item">
                      <?= "$language->language - $language->level" ?>
                    </li>
                  <?php endforeach ?>
                </ul>
              </div>
            <?php endif ?>
            <?php if (sizeof($candidate->courses) > 0) : ?>
              <div class="information-container">
                <div class="information-title-container">
                  <h4 class="information-title">Cursos e qualificações</h4>
                </div>
                <ul class="information-list">
                  <?php foreach ($candidate->courses as $course) : ?>
                    <li class="information-list-item">
                      <?= "$course->course_name - $course->institution_name - $course->conclusion_year" ?>
                    </li>
                  <?php endforeach ?>
                </ul>
              </div>
            <?php endif ?>
          </div>
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td>
          <div class="footer-space">&nbsp;</div>
        </td>
      </tr>
    </tfoot>
  </table>
  <div class="header"></div>
  <div class="footer">
    <div class="company-logo-container">
      <img class="company-logo" src="<?= base_url('assets/uploads/images/company/' . $companyInformations->logo) ?>" loading="lazy" alt="">
      <div>
        <h1 class="company-title"><?= $companyInformations->name ?></h1>
        <p class="company-address"><?= nl2br($companyInformations->address) ?></p>
        <p class="company-address"><?= $companyInformations->phone ?></p>
      </div>
    </div>
  </div>
  <script>
    function onClickPrintButton () {
      printContent(".container")
    }

    document.onLoad = onClickPrintButton()

    function printContent (selector) {
      window.print();
    }
  </script>
</body>
</html>