<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post">
        <label>Matric:</label>
        <input type="text" name="matric" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <p><a href="register_form.html">Register here if you have not register yet.</a></p>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include 'Database.php';
        include 'User.php';

        $database = new Database();
        $db = $database->getConnection();
        $user = new User($db);

        $userDetails = $user->getUser($_POST['matric']);
        if ($userDetails && password_verify($_POST['password'], $userDetails['password'])) {
            session_start();
            $_SESSION['user'] = $userDetails;
            header('Location: read.php');
        } else {
            echo '<p style="color:red;">Invalid username or password, try <a href="login.php">login</a> again.</p>';
        }
    }
    ?>
</body>
</html>
