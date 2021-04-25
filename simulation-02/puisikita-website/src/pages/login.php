<?php

$isPost = ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
$isLogout = $_GET['logout'] ?? 'false';

if ($isLogout === 'true') {
    unset($_SESSION['logged_in'], $_SESSION['current_user']);
    header('Location: /');
    exit(0);
}

if ($isPost === false) {
    require BASEPATH . '/src/views/login.php';
    exit(0);
}

$username = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$statement = $pdo->prepare('SELECT * FROM authors WHERE email=:email LIMIT 1');
$statement->execute([':email' => $username]);
$row = $statement->fetch(PDO::FETCH_ASSOC);

if (is_array($row)) {
    if ($username === $row['email'] && password_verify($password, $row['password']) === true) {
        $_SESSION['logged_in'] = true;
        // On this demo we do not care about forwarded IP from HTTP PROXY
        $_SESSION['current_user'] = $row + ['ip' => $_SERVER['REMOTE_ADDR']];

        header('Location: /');
        echo 'Redirecting...';
        exit(0);
    }
}

$success = false;
$errors[] = 'Password salah.';
require BASEPATH . '/src/views/login.php';