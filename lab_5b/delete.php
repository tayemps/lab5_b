<?php
include 'Database.php';
include 'User.php';

if (isset($_GET['matric'])) {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    if ($user->deleteUser($_GET['matric'])) {
        header('Location: read.php');
    } else {
        echo 'Failed to delete user.';
    }
}
?>
