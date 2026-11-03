<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (isset($_SESSION['userId'])) {
  if (isset($_SESSION['page'])) {
    $page = $_SESSION['page'];
  } else {
    $page = 'index.php';
  }
  header('Location: ../webPages/' . $page);
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Screendenavia Cinema</title>
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <?php include 'header.php'; ?>
  <div class="login-container">

    <div id="sign-in">
      <h1>Login</h1>

      <!-- F3: Login form sends credentials to the PHP authentication handler. -->
      <form action="../php/login.php" method="POST">
        <label for="login-email">E-mail</label>
        <input type="email" id="login-email" name="email" required>

        <label for="login-password">Password</label>
        <input type="password" id="login-password" name="password" required>

        <button type="submit">Login</button>
      </form>

      <p>Don't have an account?
        <a href="signupPage.php">Sign Up</a>
      </p>
    </div>

  </div>

  <footer class="site-footer">
    <p>&copy; 2026 Screendinavia Cinema</p>
  </footer>

  <!-- F6: Show client-side feedback for validation/authentication results returned in the URL. -->
  <script>
    const params = new URLSearchParams(window.location.search);

    if (params.get("error") === "not_found") {
      alert("Email does not exist. Please create an account.");
    }

    if (params.get("error") === "incorrect_password") {
      alert("Incorrect password. Please try again.");
    }

    if (params.get("error") === "invalid") {
      alert("Please enter a valid email and password.");
    }

    if (params.get("registered") === "success") {
      alert("Registration successful! You can now log in.");
    }
  </script>
</body>

</html>