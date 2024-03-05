<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO students (name, email, password) VALUES (:name, :email, :password)");
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    
    if ($stmt->execute()) {
        echo "Sign up successful! You can now <a href='login.php'>login</a>.";
    } else {
        echo "Sign up failed. Please try again later.";
    }
}
?>
