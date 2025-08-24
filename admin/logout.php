<?php
require_once __DIR__ . '/../config.php';
$_SESSION['admin_logged_in'] = false;
header('Location: index.php');
exit;
?>
