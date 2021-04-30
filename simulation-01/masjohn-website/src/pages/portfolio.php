<?php

$loggedIn = $_SESSION['logged_in'] ?? false;
$originIp = $_SESSION['origin_ip'] ?? '0.0.0.0';
$currentIp = $_SERVER['REMOTE_ADDR'];

if ($loggedIn !== true || $originIp !== $currentIp) {
    header('HTTP/1.1 403 Access Forbidden');
    echo <<<EOF
<!DOCTYPE html>
<html>
<body>
<h1>403 Access Forbidden</h1>
</body>
</html>
EOF;
    exit(1);
}

$id = $_GET['id'] ?? '';
$isPost = ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';

$statement = $pdo->prepare('SELECT * FROM portfolio WHERE id=:id');
$statement->execute(['id' => $id]);
$portfolio = $statement->fetch(PDO::FETCH_ASSOC);

if ($isPost) {
    $data = [
        'id' => $id,
        'title' => $_POST['title'] ?? $portfolio['title'],
        'content' => $_POST['content'] ?? $portfolio['content']
    ];

    $statement = $pdo->prepare('UPDATE portfolio SET title=:title, content=:content WHERE id=:id');
    $statement->execute($data);

    $portfolio['title'] = $data['title'];
    $portfolio['content'] = $data['content'];
}

if ($portfolio === false) {
    $portfolio = [
        'id' => '',
        'title' => '',
        'content' => ''
    ];
}

require BASEPATH . '/src/views/portfolio.php';