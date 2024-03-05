<?php
include "db.php";

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject_name = $_POST["subject_name"];

    // Insert new subject for the current user
    $stmt = $db->prepare("INSERT INTO subjects (user_id, subject_name) VALUES (:user_id, :subject_name)");
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":subject_name", $subject_name);
    
    if ($stmt->execute()) {
        header("Location: ../subject.php");
        exit();
    } else {
        echo "Failed to add subject.";
    }
}
?>
