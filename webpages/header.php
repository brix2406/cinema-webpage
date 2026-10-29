<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="site-header">
    <nav class="navbar">
        <a href="../webpages/index.php">
            <img src="../media/logo.png" id="logo" alt="Screendinavia" width="auto" height="55px">
        </a>
        <div class="nav-links">
            <a href="../webpages/index.php">Home</a>
            <a href="../webpages/movies.php">Movies</a>
            <?php if (isset($_SESSION["userId"])): ?>
                <a href="../webpages/myBookings.php">My Bookings</a>
                <a href="../php/logout.php">Logout</a>
            <?php else: ?>
                <a href="../php/login.php">Login</a>
            <?php endif; ?>
            <a href="../webpages/cart.php" class="cart-link" aria-label="Shopping Cart">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </a>
        </div>
    </nav>
</header>