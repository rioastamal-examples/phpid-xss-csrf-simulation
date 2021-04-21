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

$statement = $pdo->query('SELECT * FROM messages ORDER BY created_at DESC', PDO::FETCH_ASSOC);
$messages = $statement->fetchAll();

require BASEPATH . '/src/views/messages.php';