<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../webpages/signupPage.php");
    exit;
}


$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";
$confirmPassword = $_POST["confirm_password"] ?? "";

try {
    $sql = "SELECT userId FROM users WHERE email = ?";
    $stmt = $db->prepare($sql);

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: ../webpages/signupPage.php?error=email_exists");
        exit;
    }

    $stmt->close();

    // Hash password before storing
    $hashedPassword = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    $sql = "INSERT INTO users (name, email, password)
            VALUES (?, ?, ?)";

    $stmt = $db->prepare($sql);

    $stmt->bind_param(
        "sss",
        $name,
        $email,
        $hashedPassword
    );

    $stmt->execute();
    $stmt->close();

    header("Location: ../webpages/loginPage.php?registered=success");
    exit;

} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());
    die("Registration failed. Please try again.");
}
?>