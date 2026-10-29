<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<header class="site-header">
    <nav class="navbar">
        <img src="../media/logo.png" id="logo" alt="Screendinavia" width="auto" height="60px">
        <div class="nav-links">
            <a href="../webpages/index.php">Home</a>
            <a href="../webpages/movies.php">Movies</a>
            <?php if (isset($_SESSION["userId"])): ?>
                <a href="../php/logout.php">Logout</a>
            <?php else: ?>
                <a href="../php/login.php">Login</a>
            <?php endif; ?>
            <a href="cart.php" class="cart-link" aria-label="Shopping Cart">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </a>
        </div>
    </nav>
</header>
</body>

</html>