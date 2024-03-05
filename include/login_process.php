<?php
include "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $db->prepare("SELECT * FROM students WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        // Set session variables
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];

        // Redirect to dashboard or another page
        header("Location: ../subject.php");
        exit();
    } else {
        echo "Invalid email or password.";
    }
}
?>
