<?php
require_once 'db.php';

// Only accept POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../webpages/signupPage.php");
    exit;
}

// Get values from form
$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";
$confirmPassword = $_POST["confirm_password"] ?? "";

try {
    // Check if email already exists
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

    // Insert new user into database
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

    // Redirect after successful registration
    header("Location: ../webpages/loginPage.php?registered=success");
    exit;

} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());
    die("Registration failed. Please try again.");
}
?>