<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../webpages/loginPage.php");
    exit;
}


$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";


if (
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    $password === ""
) {

    header("Location: ../webpages/loginPage.php?error=invalid");
    exit;
}

try {
    $sql = "SELECT userId, email, password
            FROM users
            WHERE email = ?";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();

    if (!$user) {
        header("Location: ../webpages/loginPage.php?error=not_found");
        exit;
    }

    // Verify password against stored hash
    if (!password_verify($password, $user["password"])) {
        header("Location: ../webpages/loginPage.php?error=incorrect_password");
        exit;
    }


    session_regenerate_id(true);
    $_SESSION["userId"] = $user["userId"];
    $_SESSION["email"] = $user["email"];


    $prevPage = $_SESSION['page'];
    if (!$prevPage) {
        header("Location: ../webpages/index.php");
    }
    header("Location: ../webpages/$prevPage");
    exit;

} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

    header("Location: ../webpages/loginPage.php?error=server");
    exit;
}
?>