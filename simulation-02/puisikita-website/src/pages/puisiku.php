<?php

$loggedIn = $_SESSION['logged_in'] ?? false;
if ($loggedIn !== true) {
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

$currentUser = $_SESSION['current_user'];
$currentIp = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$storedIp = $currentUser['ip'] ?? '_';

if ($currentIp !== $storedIp) {
    header('HTTP/1.1 403 Access Forbidden');
    echo <<<EOF
<!DOCTYPE html>
<html>
<body>
<h1>Your IP has changed.</h1>
<p><a href="/login/?logout=true">Klik disini untuk login kembali</a></p>
</body>
</html>
EOF;
    exit(1);
}

$isDelete = isset($_GET['delete']);
$clientCsrfToken = $_GET['token'] ?? '';
$serverCsrfToken = $_SESSION['csrf_token'] ?? false;

if ($isDelete && $clientCsrfToken === $serverCsrfToken) {
    $poetryId = $_GET['id'] ?? '_';
    $statement = $pdo->prepare('DELETE FROM poetry WHERE author=:author AND id=:id');
    $success = $statement->execute([
        'author' => $currentUser['id'], 'id' => $poetryId
    ]);

    $successMessage = 'Puisi berhasil dihapus';

    if ($success === false) {
        $successMessage = 'Puisi gagal dihapus';
    }
}

$statement = $pdo->prepare('SELECT * FROM poetry WHERE author=:id');
$statement->execute(['id' => $currentUser['id']]);
$poetry = $statement->fetchAll(PDO::FETCH_ASSOC);

$currentCsrfToken = bin2hex(openssl_random_pseudo_bytes($_length = 16));
$_SESSION['csrf_token'] = $currentCsrfToken;

require BASEPATH . '/src/views/puisiku.php';