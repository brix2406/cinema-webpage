<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'db.php';

if (!isset($_SESSION["userId"])) {
    header("Location: ../webpages/loginPage.php");
    exit;
}

$userId = (int) $_SESSION["userId"];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["bookingId"])) {
    $bookingId = filter_input(INPUT_POST, "bookingId", FILTER_VALIDATE_INT);

    if ($bookingId) {
        $sql = "DELETE FROM bookings WHERE bookingId = ? AND userId = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ii", $bookingId, $userId);
        $stmt->execute();
        $stmt->close();
    }
}

header("Location: ../webpages/myBookings.php");
exit;
?>