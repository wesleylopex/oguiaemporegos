<title><?= 'O Guia Empregos' . (isset($metatags) ? " - $metatags->title" : '') ?></title>

<link rel="shortcut icon" href="<?= base_url('assets/site/images/favicons/favicon.ico') ?>" type="image/x-icon">
<link rel="icon" href="<?= base_url('assets/site/images/favicons/favicon-32.png') ?>" sizes="32x32">
<link rel="icon" href="<?= base_url('assets/site/images/favicons/favicon-48.png') ?>" sizes="48x48">
<link rel="icon" href="<?= base_url('assets/site/images/favicons/favicon-96.png') ?>" sizes="96x96">
<link rel="icon" href="<?= base_url('assets/site/images/favicons/favicon-144.png') ?>" sizes="144x144">

<meta http-equiv="content-language" content="pt-br">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="<?= isset($metatags, $metatags->keywords) ? $metatags->keywords : 'empregos, O Guia Empregos, Rio Grande do Sul, Serra Gaúcha' ?>">
<meta name="author" content="Agência Ponto">
<meta name="publisher" content="O Guia Empregos">
<meta name="copyright" content="O Guia Empregos">
<meta name="description" content="<?= isset($metatags, $metatags->description) ? $metatags->description : '' ?>">
<meta name="page-topic" content="Media">
<meta name="page-type" content="article">
<meta name="audience" content="Everyone">
<meta name="robots" content="index, follow">

<!-- Open Graph -->
<meta property="og:type" content="article" />
<meta property="og:title" content="<?= 'O Guia Empregos' . (isset($metatags, $metatags->title) ? " - $metatags->title" : '') ?>" />
<meta property="og:description" content="<?= isset($metatags, $metatags->description) ? $metatags->description : '' ?>" />
<meta property="og:image" content="<?= isset($metatags, $metatags->image) ? $metatags->image : base_url('assets/site/images/company/o-guia-empregos-card.jpg') ?>" />
<meta property="og:url" content="<?= base_url() ?>" />
<meta property="og:site_name" content="O Guia Empregos" />

<!-- Twitter -->
<meta name="twitter:title" content="<?= 'O Guia Empregos' . (isset($metatags, $metatags->title) ? " - $metatags->title" : '') ?>">
<meta name="twitter:description" content="<?= isset($metatags, $metatags->description) ? $metatags->description : '' ?>">
<meta name="twitter:image" content="<?= isset($metatags, $metatags->image) ? $metatags->image : base_url('assets/site/images/company/o-guia-empregos-card.jpg') ?>">
<meta name="twitter:site" content="<?= base_url() ?>">
<meta name="twitter:creator" content="O Guia Empregos">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- CSS Files -->
<link rel="stylesheet" href="<?= base_url('assets/site/styles/tailwindcss/tailwind.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/site/styles/index.css?version=1.1') ?>">
<link rel="stylesheet" href="<?= base_url('assets/site/styles/font-awesome/styles/all.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/site/styles/slick-modal/styles.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/site/styles/select2/select2.min.css') ?>">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-2TPWYK505N"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-2TPWYK505N');
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-165290656-2">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-165290656-2');
</script>
