<!DOCTYPE html>
<html lang="ru" itemscope itemtype="http://schema.org/WebPage">
<head>
  <title><?= $this->meta_title; ?></title>
  <?php if ($this->paginPage) { ?>
    <link rel="canonical" href="<?= $this->canonical; ?>">
    <?php if ($this->next) { ?>
      <link rel="next" href="<?= $this->next; ?>">
    <?php } if ($this->prev) { ?>
      <link rel="prev" href="<?= $this->prev; ?>">
    <?php }
  }else{ ?>
    <link rel="canonical" href="http://<?= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>">
  <?php } ?>
  <meta charset="utf-8">
  <meta name="keywords" content="<?= $this->meta_keywords; ?>">
  <meta name="description" content="<?= $this->meta_description; ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=6">
  <meta property="og:image" content="/assets/img/logo.png">
  <meta property="og:url" content="<?= absoluteLink(); ?>">
  <meta property="og:type" content="<?= $_SERVER['SERVER_NAME'] ?>">
  <meta property="og:title" content="<?= $this->meta_keywords; ?>">
  <meta property="og:description" content="<?= $this->meta_description; ?>">

  <!-- Windows Phone -->
  <meta name="msapplication-navbutton-color" content="#ffffff">
  <!-- iOS Safari -->
  <meta name="apple-mobile-web-app-status-bar-style" content="#ffffff">

  <!-- Generator set favicon pack -->
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
  <!-- <link rel="manifest" href="/assets/favicon/site.webmanifest"> -->
  <link rel="mask-icon" href="/assets/favicon/safari-pinned-tab.svg" color="#41b26e">
  <link rel="shortcut icon" href="/assets/favicon/favicon.ico">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-config" content="/assets/favicon/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">

  <link rel="shortcut icon" href="/assets/img/favicon/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900&display=swap&subset=cyrillic" rel="stylesheet">
  <link onload="if(media!='all') media='all'" rel="stylesheet" type="text/css" href="/assets/css/style.min.css">
  <script src="/assets/js/main.min.js"></script>
</head>
<body>
  <?php include dirname(__FILE__) . '/layouts/' . $this->layout . '.php'; ?>
  <!-- <script async src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script> -->
  <!-- <script src="/assets/js/main.min.js"></script> -->
  <?php if ($this->message != '') { ?>
    <script>
      $('#feedback').modal('show');
    </script>
  <?php } ?>
</body>
</html>