<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../php/db.php';

// User must be logged in
if (!isset($_SESSION["userId"])) {
    $_SESSION['page'] = 'myBookings.php';
    header("Location: loginPage.php");
    exit;
}

$_SESSION['page'] = 'myBookings.php';

$userId = (int)$_SESSION["userId"];

// Fetch user's bookings from database
$sql = "SELECT
            b.bookingId,
            b.noOfTickets,
            m.title,
            m.posterPath,
            s.startDate,
            s.startTime
        FROM bookings b
        JOIN screenings s ON b.screeningId = s.screeningId
        JOIN movies m ON s.movieId = m.movieId
        WHERE b.userId = ?
        ORDER BY s.startDate ASC, s.startTime ASC, b.bookingId ASC";

$stmt = $db->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>My Bookings - Screendinavia</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <main>
        <section class="cart-container">

            <h1>My Bookings</h1>

            <?php if (empty($bookings)): ?>

                <p>You have no bookings yet.</p>

            <?php else: ?>

                <table class="cart-table">
                    <thead>
                        <tr>
                            <th colspan="2">Movie</th>
                            <th>Tickets</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($bookings as $item): ?>

                        <tr>
                            <!-- Movie Poster -->
                            <td class="poster-cell">
                                <img
                                    src="<?php echo htmlspecialchars($item['posterPath']); ?>"
                                    alt="Movie Poster">
                            </td>

                            <!-- Movie Information -->
                            <td class="movie-cell">
                                <h3>
                                    <?php echo htmlspecialchars($item['title']); ?>
                                </h3>

                                <p>
                                    <?php
                                    echo date(
                                        "M j, Y",
                                        strtotime($item["startDate"])
                                    );
                                    ?>
                                    -
                                    <?php
                                    echo date(
                                        "H:i",
                                        strtotime($item["startTime"])
                                    );
                                    ?>
                                </p>

                                <p class="booking-ref">
                                    Booking #<?php echo htmlspecialchars($item['bookingId']); ?>
                                </p>
                            </td>

                            <!-- Number of Tickets -->
                            <td class="tickets-cell">
                                <?php echo (int)$item["noOfTickets"]; ?>
                                <?php echo ((int)$item["noOfTickets"] === 1) ? 'ticket' : 'tickets'; ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                    </tbody>
                </table>

            <?php endif; ?>

            <!-- Action Buttons -->
            <div class="cart-actions">
                <a href="movies.php"
                   class="more-tickets-button">
                    Book More Tickets
                </a>
            </div>

        </section>
    </main>

    <footer class="site-footer">
        <p>&copy; 2026 Screendinavia Cinema</p>
    </footer>

</body>
</html>
