<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

include 'Database.php';
include 'User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$userDetails = null;

if (isset($_GET['matric'])) {
    $userDetails = $user->getUser($_GET['matric']);
}

if (!$userDetails) {
    echo 'User not found.';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            font-size: 22px;
            margin-bottom: 20px;
        }
        form {
            max-width: 400px;
        
        }
        label {
            display: inline-block;
            width: 100px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        input[type="text"], select {
            width: calc(100% - 120px);
            padding: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 7px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        a {
            margin-left: 10px;
            color: #0066cc;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Update User</h1>
    <form action="update.php" method="post">
        <label for="matric">Matric</label>
        <input type="text" id="matric" name="matric" value="<?= htmlspecialchars($userDetails['matric']) ?>" readonly><br>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($userDetails['name']) ?>" required><br>

        <label for="role">Access Level</label>
        <select id="role" name="role" required>
            <option value="lecturer" <?= $userDetails['role'] == 'lecturer' ? 'selected' : '' ?>>Lecturer</option>
            <option value="student" <?= $userDetails['role'] == 'student' ? 'selected' : '' ?>>Student</option>
        </select><br>

        <input type="submit" value="Update">
        <a href="read.php">Cancel</a>
    </form>
</body>
</html>
