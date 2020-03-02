<?php $this->layout('Base', [
    'title' => 'Erro | Minhas Horas',
    'stylesheets' => [
      'css/error.css'
    ]
]); ?>
<body>
  <h1>ERRO <?= $this->e($code) ?></h1>
  <h2><?= $this->e($message) ?></h2>
  <script>
    console.error(`Status Code: <?= $this->e($code) . ". Message: " . $this->e($message) ?>`);
<?php if (getenv('DEVELOPMENT')): ?>
    console.error(`<?= $this->e($text) ?>`);
<?php endif; ?>
  </script>
</body>
