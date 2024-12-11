<?php
include 'Database.php';
include 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    if ($user->createUser($_POST['matric'], $_POST['name'], $_POST['password'], $_POST['role'])) {
        header('Location: read.php');
    } else {
        echo 'Failed to register user.';
    }
}
?>
