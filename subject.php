<?php
include "include/db.php";

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Retrieve subjects for the current user
$stmt = $db->prepare("SELECT * FROM subjects WHERE user_id = :user_id");
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();
$subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects</title>
</head>
<body>
    <h2>Subjects</h2>
    <?php if (count($subjects) > 0): ?>
        <ul>
            <?php foreach ($subjects as $subject): ?>
                <li><?php echo $subject['subject_id'] . ': ' . $subject['subject_name']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No subjects available to show.</p>
    <?php endif; ?>

    <h2>Add New Subject</h2>
    <form action="include/subjects_process.php" method="POST">
        <label for="subject_name">Subject Name:</label>
        <input type="text" name="subject_name" required>
        <input type="submit" value="Add Subject">
    </form>
</body>
</html>
