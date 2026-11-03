<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$_SESSION['page'] = 'movies.php';
require("../php/db.php");
// F4/F5: Retrieve movies with upcoming screenings and generate the catalogue dynamically.
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
  <?php include 'header.php'; ?>
  <main>

    <section class="now-showing" aria-labelledby="now-showing-title">
      <div class="section-heading">
        <h2 id="now-showing-title">All Movies</h2>
      </div>
      <!-- F5: PHP generates one movie card for each database record. -->
      <div class="movie-grid">
        <?php for ($i = 0; $i < count($movies); $i++) { ?>
          <article class="movie-card">
            <img src="<?php echo $movies[$i]['posterPath']; ?>" alt="Poster for <?php echo $movies[$i]['title']; ?>">
            <div class="movie-info">
              <h3>
                <?php echo $movies[$i]['title']; ?>
              </h3>
              <p><?php echo $movies[$i]['genre']; ?></p>
              <a href="booking.php?movieId=<?php echo (int) $movies[$i]['movieId']; ?>" class="ticket-button">
                Buy Tickets
              </a>
            </div>
          </article>
        <?php } ?>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <p>&copy; 2026 Screendinavia Cinema</p>
  </footer>
</body>

</html>