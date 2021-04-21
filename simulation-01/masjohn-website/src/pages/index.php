<?php

$isPost = ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';

$portfolios = $pdo->query('SELECT * FROM portfolio', PDO::FETCH_ASSOC);

if ($isPost === false) {
    require BASEPATH . '/src/views/homepage.php';
    exit(0);
}

// Contact Us process
$validation = [
    'name' => [
        'label' => 'Name',
        'callbacks' => 'not_empty'
    ],
    'email' => [
        'label' => 'Email',
        'callbacks' => 'not_empty|valid_email',
    ],
    'message' => [
        'label' => 'Pesan',
        'callbacks' => 'not_empty'
    ]
];
$errors = [];

foreach ($validation as $field => $options) {
    $callbacks = explode('|', $options['callbacks']);
    $_POST[$field] = trim($_POST[$field] ?? '');

    foreach ($callbacks as $callback) {
        if ($callback === 'not_empty') {
            if (strlen($_POST[$field]) === 0) {
                $errors[] = sprintf('Field %s harus diisi.', $options['label']);
            }
        }

        if ($callback === 'valid_email' && !empty($_POST[$field])) {
            if (filter_var($_POST[$field], FILTER_VALIDATE_EMAIL) === false) {
                $errors[] = sprintf('Email tidak valid untuk field %s.', $options['label']);
            }
        }
    }
}

if (empty($errors)) {
    $statement = $pdo->prepare('INSERT INTO messages (id, name, email, url, message, created_at)
        VALUES (:id, :name, :email, :url, :message, :created_at)');
    $values = [
        'id' => md5($_POST['email'] . microtime(TRUE)),
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'url' => $_POST['url'],
        'message' => $_POST['message'],
        'created_at' => (new DateTime('now', new DateTimeZone('Asia/Jakarta')))->format('c')
    ];

    $statement->execute($values);
    $success = true;
    require BASEPATH . '/src/views/homepage.php';

    exit(0);
}

$success = false;
require BASEPATH . '/src/views/homepage.php';