<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h2>Sign Up</h2>
    <form action="include/signup_process.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br><br>
        <input type="submit" value="Sign Up">
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html>
