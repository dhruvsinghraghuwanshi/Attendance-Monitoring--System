<?php
include "include/db.php";

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Fetch subjects for the dropdown menu
$stmt = $db->prepare("SELECT * FROM subjects WHERE user_id = :user_id");
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();
$subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject_id = $_POST["subject"];
    $classes_took_place = $_POST["classes_took_place"];
    $classes_attended = $_POST["classes_attended"];

    if (isset($_POST["present"])) {
        // Increment both classes took place and attended
        $classes_took_place++;
        $classes_attended++;
    } elseif (isset($_POST["absent"])) {
        // Only increment classes took place
        $classes_took_place++;
    }

    // Update attendance data in the database
    $stmt = $db->prepare("UPDATE subjects SET classes_took_place = classes_took_place + 1, classes_attended = classes_attended + 1 WHERE subject_id = :subject_id");
    $stmt->bindParam(":subject_id", $subject_id);
    $stmt->execute();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
</head>
<body>
    <h2>Mark Attendance</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="subject">Subject:</label>
        <select name="subject" required>
            <option value="">Select Subject</option>
            <?php foreach ($subjects as $subject): ?>
                <option value="<?php echo $subject['subject_id']; ?>"><?php echo $subject['subject_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <label for="classes_took_place">Classes Took Place:</label>
        <input type="number" name="classes_took_place" value="0" required>
        <br><br>
        <label for="classes_attended">Classes Attended:</label>
        <input type="number" name="classes_attended" value="0" required>
        <br><br>
        <button type="submit" name="submit_attendance">Submit Attendance</button>
        <button type="submit" name="present">Present</button>
        <button type="submit" name="absent">Absent</button>
    </form>
</body>
</html>
