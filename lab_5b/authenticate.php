<?php
include 'Database.php';
include 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    $matric = $db->real_escape_string($_POST['matric']);
    $password = $db->real_escape_string($_POST['password']);

    $user = new User($db);
    $userDetails = $user->getUser($matric);

    if ($userDetails && password_verify($password, $userDetails['password'])) {
        session_start();
        $_SESSION['user'] = $userDetails;
        header('Location: read.php');
    } else {
        echo 'Login failed';
    }
}
?>
