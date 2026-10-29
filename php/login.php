<?php
session_start();

require_once 'db.php';

// Only accept POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../webpages/loginPage.php");
    exit;
}

// Get values from form
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

// Validate input
if (
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    $password === ""
) {

    header("Location: ../webpages/loginPage.php?error=invalid");
    exit;
}

try {
    // Find user by email
    $sql = "SELECT userId, email, password
            FROM users
            WHERE email = ?";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();

    // Check whether email exists
    if (!$user) {
        header("Location: ../webpages/loginPage.php?error=not_found");
        exit;
    }

    // Verify password against stored hash
    if (!password_verify($password, $user["password"])) {
        header("Location: ../webpages/loginPage.php?error=incorrect_password");
        exit;
    }

    // Regenerate session ID after successful login
    session_regenerate_id(true);

    // Store logged-in user information
    $_SESSION["userId"] = $user["userId"];
    $_SESSION["email"] = $user["email"];

    // Redirect after successful login
    header("Location: ../webpages/index.php?login=success");
    exit;

} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

    header("Location: ../webpages/loginPage.php?error=server");
    exit;
}
?>