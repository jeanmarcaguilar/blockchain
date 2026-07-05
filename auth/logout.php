<?php
require_once __DIR__ . '/../includes/config.php';
session_start();
session_destroy();
header('Location: ' . bc_url('index.php'));
exit;
