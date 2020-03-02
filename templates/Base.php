<?php
    $assets = getenv('ASSETS');
    if (!$assets) {
        $assets = 'assets/';
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= $assets ?>css/style.css">
  <link rel="stylesheet" href="<?= $assets ?>css/sanatize.css">
  <link rel="stylesheet" href="<?= $assets ?>css/forms.css">
  <link rel="stylesheet" href="<?= $assets ?>css/typography.css">
<?php foreach ($stylesheets as $stylesheet): ?>
  <link rel="stylesheet" href="<?= $assets . $stylesheet ?>">
<?php endforeach ?>
  <title><?= $this->e($title) ?></title>
</head>
<?= $this->section('content') ?>

</html>
