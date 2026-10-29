<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Screendenavia Cinema</title>
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <!-- Navigation bar -->
  <header class="site-header">
    <nav class="navbar">
      <img src="../media/logo.png" id="logo" alt="Screendinavia" width="auto" height="60px">
      <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="../html/movies.html">Movies</a>
        <?php if (isset($_SESSION["userId"])): ?>
            <a href="../php/logout.php">Logout</a>
        <?php else: ?>
            <a href="../html/login.html">Login</a>
        <?php endif; ?>
        <a href="cart.php" class="cart-link" aria-label="Shopping Cart">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        </a>
      </div>
    </nav>
  </header>

  <main>
    <!-- Featured movies: replace the image with your own cinema banner -->
    <section class="hero" aria-label="Featured movies">
      <img id="hero-image" src="images/banner1.jpg" alt="Featured movie banner">
      <div class="hero-overlay">
        <p>WELCOME TO SCREENDINAVIA</p>
        <h1 id="hero-title">Experience movies on the big screen</h1>
        <a href="movies.html" class="hero-button">Explore Movies</a>
      </div>
      <button class="hero-arrow previous" id="prev-slide" type="button"
        aria-label="Previous featured movie">&#10094;</button>
      <button class="hero-arrow next" id="next-slide" type="button" aria-label="Next featured movie">&#10095;</button>
    </section>

    <!-- Movie cards -->
    <section class="now-showing" aria-labelledby="now-showing-title">
      <div class="section-heading">
        <h2 id="now-showing-title">Now Showing</h2>
        <a href="movies.html">View All Movies →</a>
      </div>
      <div class="movie-grid">
        <article class="movie-card">
          <img src="images/movie1.jpg" alt="Poster for Movie One">
          <div class="movie-info">
            <h3>Movie One</h3>
            <p>Action / Adventure</p>
            <a href="movie-details.php?id=1" class="ticket-button">Buy Tickets</a>
          </div>
        </article>
        <article class="movie-card">
          <img src="images/movie2.jpg" alt="Poster for Movie Two">
          <div class="movie-info">
            <h3>Movie Two</h3>
            <p>Comedy / Romance</p>
            <a href="movie-details.php?id=2" class="ticket-button">Buy Tickets</a>
          </div>
        </article>
        <article class="movie-card">
          <img src="images/movie3.jpg" alt="Poster for Movie Three">
          <div class="movie-info">
            <h3>Movie Three</h3>
            <p>Drama / Thriller</p>
            <a href="movie-details.php?id=3" class="ticket-button">Buy Tickets</a>
          </div>
        </article>
        <article class="movie-card">
          <img src="images/movie4.jpg" alt="Poster for Movie Four">
          <div class="movie-info">
            <h3>Movie Four</h3>
            <p>Animation / Family</p>
            <a href="movie-details.php?id=4" class="ticket-button">Buy Tickets</a>
          </div>
        </article>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <p>&copy; 2026 Screendinavia Cinema</p>
  </footer>
  <script src="carrousel.js"></script>
</body>

</html>