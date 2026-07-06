<?php require_once __DIR__ . '/config.php';
$bc_title = $bc_title ?? BC_SITE_NAME;
$bc_page = $bc_page ?? '';
$bc_extra_css = $bc_extra_css ?? '';
$bc_extra_js = $bc_extra_js ?? '';
$bc_dashboard = $bc_dashboard ?? false;
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($bc_title) ?> – <?= BC_SITE_NAME ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link href="<?= bc_asset('css/main.css') ?>?v=2.2" rel="stylesheet">
  <script>window.bcBase = '<?= BC_BASE ? BC_BASE : '' ?>';</script>
  <?= $bc_extra_css ?>
</head>

<body class="<?= $bc_dashboard ? 'dashboard-body' : '' ?>">