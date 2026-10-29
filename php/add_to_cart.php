<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_SESSION["userId"])) {
        header("Location: ../webpages/loginPage.php");
        exit;
    }

    $screeningId = filter_input(
        INPUT_POST,
        "screeningId",
        FILTER_VALIDATE_INT
    );

    $noOfTickets = filter_input(
        INPUT_POST,
        "noOfTickets",
        FILTER_VALIDATE_INT
    );

    if (
        !$screeningId || !$noOfTickets ||
        $noOfTickets < 1 || $noOfTickets > 10
    ) {
        die("Invalid booking information.");
    }

    $sql = "SELECT screeningId
            FROM screenings
            WHERE screeningId = ?
            AND TIMESTAMP(startDate, startTime) >= NOW()";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $booking["screeningId"]);
    $stmt->execute();

    $screening = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    $_SESSION["cart"][] = [
        "screeningId" => $screeningId,
        "noOfTickets" => $noOfTickets
    ];
}

header("Location: ../webpages/cart.php");
exit;
?>