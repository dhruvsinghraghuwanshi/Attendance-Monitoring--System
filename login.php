<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="include/login_process.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br><br>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
</body>
</html>
