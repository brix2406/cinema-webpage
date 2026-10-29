<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cartIndex"])) {
    $cartIndex = filter_input(INPUT_POST, "cartIndex", FILTER_VALIDATE_INT);

    if ($cartIndex !== false && isset($_SESSION["cart"][$cartIndex])) {
        array_splice($_SESSION["cart"], $cartIndex, 1);
    }
}

header("Location: ../webpages/cart.php");
exit;
?>
