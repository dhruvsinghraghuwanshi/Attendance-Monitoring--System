<?php
include "include/db.php";

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Fetch subjects with attendance details
$stmt = $db->prepare("SELECT s.subject_id, s.subject_name, s.classes_took_place, s.classes_attended FROM subjects s WHERE s.user_id = :user_id");
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();
$subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Index</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Attendance Index</h2>
    <table>
        <thead>
            <tr>
                <th>Subject Name</th>
                <th>Classes Attended</th>
                <th>Classes Took Place</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Attendance Percentage</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subjects as $subject): ?>
                <tr>
                    <td><?php echo $subject['subject_name']; ?></td>
                    <td><?php echo $subject['classes_attended']; ?></td>
                    <td><?php echo $subject['classes_took_place']; ?></td>
                    <td>
                        <form action="attendance_process.php" method="POST">
                            <input type="hidden" name="subject_id" value="<?php echo $subject['subject_id']; ?>">
                            <button type="submit" name="present">Present</button>
                        </form>
                    </td>
                    <td>
                        <form action="attendance_process.php" method="POST">
                            <input type="hidden" name="subject_id" value="<?php echo $subject['subject_id']; ?>">
                            <button type="submit" name="absent">Absent</button>
                        </form>
                    </td>
                    <td>
                        <?php
                        if ($subject['classes_took_place'] > 0) {
                            $attendance_percentage = ($subject['classes_attended'] / $subject['classes_took_place']) * 100;
                            echo round($attendance_percentage, 2) . '%';
                        } else {
                            echo 'N/A';
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
