
<?php
session_start();
require_once '../php/db.php';

// Check login
$isLoggedIn = isset($_SESSION["userId"]);

// Remember cart as login destination only when logged out
$_SESSION["page"] = "../webpages/cart.php";

// Only read cart for logged-in users
$cart = $isLoggedIn ? ($_SESSION["cart"] ?? []) : [];
$cartItems = [];

// Load movie information if logged in
if ($isLoggedIn) {

    $sql = "SELECT m.title, m.posterPath,
                   s.startDate, s.startTime
            FROM screenings s
            JOIN movies m ON s.movieId = m.movieId
            WHERE s.screeningId = ?";

    $stmt = $db->prepare($sql);

    foreach ($cart as $index => $booking) {

        $screeningId = (int)$booking["screeningId"];

        $stmt->bind_param("i", $screeningId);
        $stmt->execute();

        $movie = $stmt->get_result()->fetch_assoc();

        if ($movie) {
            $cartItems[] = [
                "title" => $movie["title"],
                "posterPath" => $movie["posterPath"],
                "startDate" => $movie["startDate"],
                "startTime" => $movie["startTime"],
                "noOfTickets" => $booking["noOfTickets"],
                "priority" => $index + 1
            ];
        }
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Shopping Cart - Screendinavia</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <main>
        <section class="cart-container">

            <h1>Your Cart</h1>

            <!-- User is NOT logged in -->
            <?php if (!$isLoggedIn): ?>

                <div class="cart-login-message">

                    <i class="fa fa-lock"></i>

                    <h2>You need to be logged in</h2>

                    <p>
                        Please log in to view your shopping cart.
                    </p>

                    <a href="loginPage.php" class="cart-login-button">
                        Login
                    </a>

                </div>

            <!-- User IS logged in -->
            <?php else: ?>

                <?php if (empty($cartItems)): ?>

                    <p>Your shopping cart is empty.</p>

                <?php else: ?>

                    <!-- Shopping Cart Table -->
                    <table class="cart-table">

                        <thead>
                            <tr>
                                <th colspan="2">Movie</th>
                                <th>Tickets</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($cartItems as $item): ?>

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

                                    </td>

                                    <!-- Number of Tickets -->
                                    <td class="tickets-cell">
                                        <?php echo (int)$item["noOfTickets"]; ?>
                                        tickets
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>

                <?php endif; ?>

                <!-- Cart Buttons -->
                <div class="cart-actions">

                    <a href="movies.php" class="more-tickets-button">
                        Purchase More Tickets
                    </a>

                    <?php if (!empty($cartItems)): ?>

                        <a href="payment.php" class="cart-payment-button">
                            Proceed to Payment
                        </a>

                    <?php endif; ?>

                </div>

            <?php endif; ?>

        </section>
    </main>

    <footer class="site-footer">
        <p>&copy; 2026 Screendinavia Cinema</p>
    </footer>

</body>
</html>

