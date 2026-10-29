<?php
session_start();
require_once 'db.php';

// Create empty cart if needed
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// Handle submitted booking
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $screeningId = filter_input(
        INPUT_POST, "screeningId", FILTER_VALIDATE_INT
    );

    $noOfTickets = filter_input(
        INPUT_POST, "noOfTickets", FILTER_VALIDATE_INT
    );

    if (!$screeningId || !$noOfTickets ||
        $noOfTickets < 1 || $noOfTickets > 10) {
        die("Invalid booking information.");
    }

    // Remember booking before login
    $_SESSION["pendingBooking"] = [
        "screeningId" => $screeningId,
        "noOfTickets" => $noOfTickets
    ];

    // Check if user is logged in
    if (!isset($_SESSION["userId"])) {
        header("Location: ../webpages/loginPage.php");
        exit;
    }

    header("Location: add_to_cart.php?resume=1");
    exit;
}

// Require login to view cart
if (!isset($_SESSION["userId"])) {
    header("Location: ../webpages/loginPage.php");
    exit;
}

// Add pending booking after login or POST
if (isset($_SESSION["pendingBooking"]) &&
    isset($_GET["resume"])) {

    $booking = $_SESSION["pendingBooking"];

    // Verify screening exists and is upcoming
    $sql = "SELECT screeningId
            FROM screenings
            WHERE screeningId = ?
            AND TIMESTAMP(startDate, startTime) >= NOW()";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $booking["screeningId"]);
    $stmt->execute();

    $screening = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$screening) {
        unset($_SESSION["pendingBooking"]);
        die("This screening is no longer available.");
    }

    // Add booking to cart
    $_SESSION["cart"][] = $booking;

    unset($_SESSION["pendingBooking"]);

    // Redirect to prevent duplicate additions on refresh
    header("Location: ../webpages/cart.php");
    exit;
}

// Remove booking from cart
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handled below in a later step
}

// Get cart details from database
$cartItems = [];

$sql = "SELECT
            m.title,
            m.posterPath,
            s.startDate,
            s.startTime
        FROM screenings s
        JOIN movies m ON s.movieId = m.movieId
        WHERE s.screeningId = ?";

$stmt = $db->prepare($sql);

foreach ($_SESSION["cart"] as $index => $booking) {
    $stmt->bind_param("i", $booking["screeningId"]);
    $stmt->execute();

    $movie = $stmt->get_result()->fetch_assoc();

    if ($movie) {
        $cartItems[] = [
            "index" => $index,
            "title" => $movie["title"],
            "posterPath" => $movie["posterPath"],
            "startDate" => $movie["startDate"],
            "startTime" => $movie["startTime"],
            "noOfTickets" => $booking["noOfTickets"]
        ];
    }
}

$stmt->close();
?>