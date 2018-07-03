<?php

$host = 'localhost';
$dbname = 'netology';
$dbuser = 'basova';
$dbpassword = 'basova';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", "$dbuser", "$dbpassword", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die('Соединение с базой данных не установлено');
}

if (isset($_POST['save'])) {
    $query = "INSERT INTO `tasks` (description, date_added) VALUES (?, NOW())";
    $description = (string)($_POST['description']);
    $description = trim($description);

    if ($description !== '') {
        $statement = $pdo->prepare($query);
        $statement->execute([$description]);
    }
}

if (isset($_GET['done'])) {
    $query = "UPDATE tasks SET is_done = 1 WHERE id = ?";
    $id = (int)($_GET['done']);

    $statement = $pdo->prepare($query);
    $statement->execute([$id]);
    header("Location: index.php");
}

if (isset($_GET['delete'])) {
    $query = "DELETE FROM tasks WHERE id = ? LIMIT 1";
    $id = (int)($_GET['delete']);

    $statement = $pdo->prepare($query);
    $statement->execute([$id]);
    header("Location: index.php");
}

if (isset($_POST['save1'])) {
    $query = "UPDATE tasks SET description = ? WHERE id = ?";
    $description = (string)($_POST['description']);
    $description = trim($description);
    $id = (int)($_GET['edit']);

    if ($description !== '') {
        $statement = $pdo->prepare($query);
        $statement->execute([$description, $id]);
    }
    header("Location: index.php");
}

$sql = "SELECT * FROM tasks";
$statement = $pdo->prepare($sql);
$statement->execute();