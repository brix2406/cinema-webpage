<?php
session_start();
define('gridSize', 4);
require("../php/db.php");
$query = "SELECT movieId, title, genre, posterPath FROM movies
          WHERE lastScreening >= CURDATE() ORDER BY lastScreening ASC";

$result = $db->query($query);
$movies = [];
if ($result) {
  $i = 0;
  while ($row = $result->fetch_assoc()) {
    $movies[$i] = [
      'movieId' => $row['movieId'],
      'title' => $row['title'],
      'genre' => $row['genre'],
      'posterPath' => $row['posterPath']
    ];
    $i++;
  }
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
  <!-- Navigation bar -->
  <div id="site-header"></div>
  <script>
    fetch('header.php')
      .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.text();
      })
      .then(data => {
        document.getElementById('site-header').innerHTML = data;
      })
      .catch(error => console.error('Error loading header:', error));
  </script>

  <main>
    <!-- Featured movies: replace the image with your own cinema banner -->
    <section class="hero" aria-label="Featured movies">
      <img id="hero-image" src="../media/moviePosters/by_any_means.jpeg" alt="Featured movie banner">
      <div class="hero-overlay">
        <p>WELCOME TO SCREENDINAVIA</p>
        <h1 id="hero-title">Experience movies on the big screen</h1>
        <a href="movies.php" class="hero-button">Explore Movies</a>
      </div>
      <button class="hero-arrow previous" id="prev-slide" type="button"
        aria-label="Previous featured movie">&#10094;</button>
      <button class="hero-arrow next" id="next-slide" type="button" aria-label="Next featured movie">&#10095;</button>
    </section>

    <!-- Movie cards -->
    <section class="now-showing" aria-labelledby="now-showing-title">
      <div class="section-heading">
        <h2 id="now-showing-title">Now Showing</h2>
        <a href="movies.php">View All Movies →</a>
      </div>
      <div class="movie-grid">
        <?php for ($i = 0; $i < min(gridSize, count($movies)); $i++) { ?>
          <article class="movie-card">
            <img src="<?php echo htmlspecialchars($movies[$i]['posterPath']); ?>"
              alt="Poster for <?php echo htmlspecialchars($movies[$i]['title']); ?>">
            <div class="movie-info">
              <h3>
                <?php echo htmlspecialchars($movies[$i]['title']); ?>
              </h3>
              <p><?php echo htmlspecialchars($movies[$i]['genre']); ?></p>
              <a href="movie-details.php?id=<?php echo htmlspecialchars($movies[$i]['movieId']); ?>"
                class="ticket-button">Buy Tickets</a>
            </div>
          </article>
        <?php } ?>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <p>&copy; 2026 Screendinavia Cinema</p>
  </footer>
  <script src="../javascript/carrousel.js"></script>
</body>

</html>