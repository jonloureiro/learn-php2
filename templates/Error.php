<?php $this->layout('Base', [
    'title' => 'Erro | Minhas Horas',
    'stylesheets' => [
      'css/error.css'
    ]
]); ?>
<body>
  <div class="error-wrapper">
  <h1 class="error-wrapper__code"><?= $this->e($code) ?></h1>
  <h2 class="error-wrapper__message"><?= $this->e($message) ?></h2>
  </div>
  <script>
    console.error(`Status Code: <?= $this->e($code) . ". Message: " . $this->e($message) ?>`);
<?php if (getenv('DEVELOPMENT')): ?>
    console.error(`<?= $this->e($text) ?>`);
<?php endif; ?>
  </script>
</body>
