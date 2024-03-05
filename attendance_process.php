<?php
include "include/db.php";

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject_id = $_POST["subject_id"];

    // Check which button was clicked
    if (isset($_POST["present"])) {
        // If present button clicked, update classes attended and took place
        $stmt = $db->prepare("UPDATE subjects SET classes_attended = classes_attended + 1, classes_took_place = classes_took_place + 1 WHERE subject_id = :subject_id AND user_id = :user_id");
        $stmt->bindParam(":subject_id", $subject_id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
    } elseif (isset($_POST["absent"])) {
        // If absent button clicked, update classes took place only
        $stmt = $db->prepare("UPDATE subjects SET classes_took_place = classes_took_place + 1 WHERE subject_id = :subject_id AND user_id = :user_id");
        $stmt->bindParam(":subject_id", $subject_id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
    }

    // Redirect back to the index page after processing
    header("Location: index.php");
    exit();
}
?>
