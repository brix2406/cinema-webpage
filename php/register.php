
<?php
require_once 'db.php';

// Only accept POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../html/signup.html");
    exit;
}

// Get values from form
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";
$confirmPassword = $_POST["confirm_password"] ?? "";

// Validate input
if (
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    strlen($password) < 8 ||
    $password !== $confirmPassword
) {
    die("Invalid registration information.");
}

try {
    // Check if email already exists
    $sql = "SELECT userId FROM users WHERE email = ?";
    $stmt = $db->prepare($sql);

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

if ($result->num_rows > 0) {
    header("Location: ../html/signup.html?error=email_exists");
    exit;
}

    $stmt->close();

    // Hash password before storing
    $hashedPassword = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    // Insert new user into database
    $sql = "INSERT INTO users (email, password)
            VALUES (?, ?)";

    $stmt = $db->prepare($sql);

    $stmt->bind_param(
        "ss",
        $email,
        $hashedPassword
    );

    $stmt->execute();
    $stmt->close();

    // Redirect after successful registration
    header("Location: ../html/login.html?registered=success");
    exit;

} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());
    die("Registration failed. Please try again.");
}
?>
