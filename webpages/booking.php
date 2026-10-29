<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("../php/db.php");

// Get movieId from URL (support both ?movieId= and ?id=)
$movieId = filter_input(INPUT_GET, 'movieId', FILTER_VALIDATE_INT) ?: filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$movieId) {
    header("Location: movies.php");
    exit;
}

// Get movie info
$sql = "SELECT movieId, title, genre, posterPath
        FROM movies
        WHERE movieId = ?";

$result = $db->prepare($sql);
$result->bind_param("i", $movieId);
$result->execute();
$movie = $result->get_result()->fetch_assoc();
$result->close();

if (!$movie) {
    header("Location: movies.php");
    exit;
}

// Get screenings for this movie
$sql = "SELECT screeningId, startDate, startTime
        FROM screenings
        WHERE movieId = ?
        ORDER BY startDate ASC, startTime ASC";

$result = $db->prepare($sql);
$result->bind_param("i", $movieId);
$result->execute();
$result = $result->get_result();

$screenings = [];
$dates = [];

while ($row = $result->fetch_assoc()) {
    $screenings[] = $row;

    if (!in_array($row["startDate"], $dates)) {
        $dates[] = $row["startDate"];
    }
}

$result->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - <?php echo htmlspecialchars($movie['title']); ?> - Screendinavia</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../javascript/booking.js" defer></script>
</head>

<body>

    <?php include 'header.php'; ?>

    <main>
        <section class="booking-container">

            <!-- Poster -->
            <div class="booking-poster">
                <img src="<?php echo htmlspecialchars($movie['posterPath']); ?>"
                    alt="Poster for <?php echo htmlspecialchars($movie['title']); ?>">
            </div>

            <!-- Content -->
            <div class="booking-content">
                <h1><?php echo htmlspecialchars($movie['title']); ?></h1>
                <p class="booking-genre"><?php echo htmlspecialchars($movie['genre']); ?></p>

                <?php if (empty($screenings)): ?>
                    <p style="color: #b4b8c3; font-size: 1.1rem; margin-top: 10px;">
                        No screenings are currently scheduled for this movie. Please check back later!
                    </p>
                    <div style="margin-top: 20px;">
                        <a href="movies.php" class="ticket-button"
                            style="display: inline-block; width: auto; padding: 12px 24px; text-decoration: none; text-align: center;">Back
                            to Movies</a>
                    </div>
                <?php else: ?>
                    <form id="booking-form" action="../php/add_to_cart.php" method="POST">

                        <!-- hidden fields -->
                        <input type="hidden" name="movieId" value="<?php echo (int) $movie['movieId']; ?>">
                        <input type="hidden" name="screeningId" id="screeningId">

                        <!-- DATE -->
                        <label for="booking-date">Select Date</label>
                        <select id="booking-date" name="selectedDate" required>
                            <option value="">Choose date</option>
                            <?php foreach ($dates as $date): ?>
                                <option value="<?php echo htmlspecialchars($date); ?>">
                                    <?php echo htmlspecialchars(date("M j, Y", strtotime($date))); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <!-- TIME -->
                        <label>Select Showtime</label>
                        <p id="select-date-prompt" style="color: #b4b8c3; font-size: 0.95rem; margin: 4px 0 10px 0;">Please
                            select a date above to view showtimes.</p>
                        <div class="showtime-buttons">
                            <?php foreach ($screenings as $screening): ?>
                                <div class="time-option" data-date="<?php echo htmlspecialchars($screening['startDate']); ?>">
                                    <input type="radio" id="time-<?php echo (int) $screening['screeningId']; ?>"
                                        name="selectedTime" value="<?php echo (int) $screening['screeningId']; ?>">
                                    <label for="time-<?php echo (int) $screening['screeningId']; ?>" class="time-button">
                                        <?php echo htmlspecialchars(date("H:i", strtotime($screening['startTime']))); ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- TICKETS -->
                        <label for="tickets">Number of Tickets</label>
                        <input type="number" id="tickets" name="noOfTickets" min="1" max="10" value="2" required>

                        <button type="submit" class="red-button">Add to Cart</button>
                    </form>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <p>&copy; 2026 Screendinavia Cinema</p>
    </footer>

</body>

</html>