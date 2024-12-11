<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

include 'Database.php';
include 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    if ($user->updateUser($_POST['matric'], $_POST['name'], $_POST['role'])) {
        header('Location: read.php');
    } else {
        echo 'Failed to update user.';
    }
}
?>
