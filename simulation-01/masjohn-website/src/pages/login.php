<?php

$isPost = ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
$isLogout = $_GET['logout'] ?? 'false';

if ($isLogout === 'true') {
    unset($_SESSION['logged_in']);
    header('Location: /');
    exit(0);
}

if ($isPost === false) {
    require BASEPATH . '/src/views/login.php';
    exit(0);
}

$credentials = [
    'username' => 'masjohn',
    // phpidonline
    'hash' => '$2y$10$108vGK2YhFnQQrkicyYJROvRRa3CsvNSPNDGJjvvvuojo8AgjaG/q'
];

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === $credentials['username'] && password_verify($password, $credentials['hash']) === true) {
    $_SESSION['logged_in'] = true;
    echo 'Redirecting...';
    header('Location: /');
    exit(0);
}

$success = false;
$errors[] = 'Password salah.';
require BASEPATH . '/src/views/login.php';