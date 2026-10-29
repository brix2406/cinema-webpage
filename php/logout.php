<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$prevPage = $_SESSION['page'];

$_SESSION = [];


session_destroy();

if (!$prevPage) {
    header("Location: ../webpages/index.php");
}
header("Location: ../webpages/$prevPage");
exit;
?>