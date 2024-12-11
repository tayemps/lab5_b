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
$result = $user->getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            font-size: 22px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f9f9f9;
        }
        a {
            color: #0066cc;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .logout-btn {
            background-color: #ff4d4d;
            color: white;
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #cc0000;
        }
        .note {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
    <script>
        function confirmDelete(matric) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = `delete.php?matric=${matric}`;
            }
        }
    </script>
</head>
<body>
    <h1>User List</h1>
    <table>
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Access Level</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($row['matric']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['role']) ?></td>
                <td><a href="update_form.php?matric=<?= htmlspecialchars($row['matric']) ?>">Update</a></td>
                <td><a href="javascript:void(0);" onclick="confirmDelete('<?= htmlspecialchars($row['matric']) ?>')">Delete</a></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <a href="logout.php" class="logout-btn">Logout</a>
    
    <div class="note">
        <p><strong>Note:</strong> Please ensure that you press the logout button when you are done, so the pages cannot be accessed without logging in again.</p>
    </div>
</body>
</html>
