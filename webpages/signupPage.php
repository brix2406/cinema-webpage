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
  <!-- Navigation bar -->
  <?php include 'header.php'; ?>

  <div class="login-container">

    <!-- SIGN UP -->
    <div id="sign-up">
      <h1>Create Account</h1>

      <form action="register.php" method="POST" id="signup-form">

        <label for="signup-email">Email</label>
        <input type="email" id="signup-email" name="email" required>

        <label for="signup-password">Password</label>
        <input type="password" id="signup-password" name="password" minlength="8" required>

        <label for="confirm-password">
          Confirm Password
        </label>
        <input type="password" id="confirm-password" name="confirm_password" minlength="8" required>

        <button type="submit">Sign Up</button>
      </form>

      <p>Already have an account?
        <a href="loginPage.php">Login</a>
      </p>
    </div>

  </div>

  <footer class="site-footer">
    <p>&copy; 2026 Screendinavia Cinema</p>
  </footer>

    <script>
      const params = new URLSearchParams(window.location.search);

      if (params.get("error") === "email_exists") {
        alert("This email is already registered. Please try to login instead.");
      }
    </script>
</body>

</html>