<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Get bookings from session
$cart = $_SESSION["cart"] ?? [];
$cartItems = [];
$userId = $_SESSION[''];
$query = "INSERT INTO bookings (userId, screeningId, noOfTickets)
        VALUES (?,?,?)";
$stmt = $db->prepare($sql);

foreach ($cart as $index => $booking) {

    $screeningId = (int) $booking["screeningId"];
    $noOfTickets = (int) $booking["noOfTickets"];

}
?>