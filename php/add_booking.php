<?php
require_once '../php/db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Get bookings from session
$cart = $_SESSION["cart"] ?? [];
$cartItems = [];
$userId = $_SESSION["userId"];
if (!$userId) {
    $page = $_SESSION['page'];
    if (!$page) {
        header("Location: ../webpages/index.php");
    } else {
        header("Location: ../webpages/$page");
    }
    exit;
}
$query = "INSERT INTO bookings (userId, screeningId, noOfTickets)
        VALUES (?,?,?)";
$stmt = $db->prepare($query);

$stmt->bind_param("iii", $userId, $screeningId, $noOfTickets);
$i = 0;
foreach ($cart as $index => $booking) {
    $screeningId = (int) $booking["screeningId"];
    $noOfTickets = (int) $booking["noOfTickets"];
    $stmt->execute();
    $i++;
}
$stmt->close();
unset($_SESSION['cart']);
header("location: ../webpages/myBookings.php");
exit;
?>