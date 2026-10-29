<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// fetch previous page
$prevPage = $_SESSION['page'];

// Remove session variables
$_SESSION = [];

// Remove session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();

    setcookie(session_name(), "", [
        "expires" => time() - 42000,
        "path" => $params["path"],
        "domain" => $params["domain"],
        "secure" => $params["secure"],
        "httponly" => $params["httponly"],
        "samesite" => $params["samesite"] ?: "Lax"
    ]);
}

// Destroy session
session_destroy();

// Redirect to homepage
if (!$prevPage) {
    header("Location: ../webpages/index.php");
}
header("Location: ../webpages/$prevPage");
exit;
?>