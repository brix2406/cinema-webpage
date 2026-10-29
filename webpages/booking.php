<?php
session_start();
require_once("../php/db.php");
include 'header.php';

// Get movieId from URL
$movieId = filter_input(INPUT_GET, 'movieId', FILTER_VALIDATE_INT);

if (!$movieId) {
    header("Location: movies.php");
    exit;
}

// Get movie info
$sql = "SELECT movieId, title, genre, posterPath
        FROM movies
        WHERE movieId = ?";

$stmt = $db->prepare($sql);
$stmt->bind_param("i", $movieId);
$stmt->execute();
$movie = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$movie) {
    header("Location: movies.php");
    exit;
}

// Get screenings for this movie
$sql = "SELECT screeningId, startDate, startTime
        FROM screenings
        WHERE movieId = ?
        AND TIMESTAMP(startDate, startTime) >= NOW()
        ORDER BY startDate, startTime";

$stmt = $db->prepare($sql);
$stmt->bind_param("i", $movieId);
$stmt->execute();
$result = $stmt->get_result();

$screenings = [];
$dates = [];

while ($row = $result->fetch_assoc()) {
    $screenings[] = $row;

    if (!in_array($row["startDate"], $dates)) {
        $dates[] = $row["startDate"];
    }
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - Screendinavia</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer>
        document.addEventListener("DOMContentLoaded", function () {
            const dateSelect = document.getElementById("booking-date");
            const timeOptions = document.querySelectorAll(".time-option");
            const screeningIdInput = document.getElementById("screeningId");

            function updateTimeOptions() {
                const selectedDate = dateSelect.value;

                // reset hidden field + uncheck old radio
                screeningIdInput.value = "";
                document.querySelectorAll('input[name="selectedTime"]').forEach(radio => {
                    radio.checked = false;
                });

                timeOptions.forEach(option => {
                    if (option.dataset.date === selectedDate) {
                        option.style.display = "inline-block";
                    } else {
                        option.style.display = "none";
                    }
                });
            }

            dateSelect.addEventListener("change", updateTimeOptions);

            document.querySelectorAll('input[name="selectedTime"]').forEach(radio => {
                radio.addEventListener("change", function () {
                    screeningIdInput.value = this.value;
                });
            });

            const bookingForm = document.getElementById("booking-form");
            bookingForm.addEventListener("submit", function (event) {
                if (!screeningIdInput.value) {
                    alert("Please select a date and showtime.");
                    event.preventDefault();
                }
            });

            updateTimeOptions();
        });
    </script>
</head>
<body>

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

            <form id="booking-form" action="../php/add_to_cart.php" method="POST">
                
                <!-- hidden fields -->
                <input type="hidden" name="movieId" value="<?php echo (int)$movie['movieId']; ?>">
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
                <div class="showtime-buttons">
                    <?php foreach ($screenings as $screening): ?>
                        <div class="time-option"
                             data-date="<?php echo htmlspecialchars($screening['startDate']); ?>">
                            <input
                                type="radio"
                                id="time-<?php echo (int)$screening['screeningId']; ?>"
                                name="selectedTime"
                                value="<?php echo (int)$screening['screeningId']; ?>"
                            >
                            <label for="time-<?php echo (int)$screening['screeningId']; ?>" class="time-button">
                                <?php echo htmlspecialchars(date("H:i", strtotime($screening['startTime']))); ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- TICKETS -->
                <label for="tickets">Number of Tickets</label>
                <input type="number"
                       id="tickets"
                       name="noOfTickets"
                       min="1"
                       max="10"
                       value="2"
                       required>

                <button type="submit" class="red-button">Add to Cart</button>
            </form>
        </div>
    </section>
</main>

<footer class="site-footer">
    <p>&copy; 2026 Screendinavia Cinema</p>
</footer>

</body>
</html>