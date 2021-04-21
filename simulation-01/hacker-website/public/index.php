<?php

// PHP Built-in web server router
if (php_sapi_name() === 'cli-server') {
    if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|xml|txt)$/', $_SERVER['SCRIPT_FILENAME'])) {
        if (file_exists($_SERVER['SCRIPT_FILENAME'])) {
            return false;
        }
    }
}

define('BASEPATH', __DIR__ . '/..');

$path = explode('/', $_SERVER['PATH_INFO'] ?? '/')[1];

if ($path === '') { $path = 'index'; }

if ($path === 'index') {
    echo <<<EOF
<!DOCTYPE html>
<html>
<head>
<body>
<h2>This is my fake website</h2>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
</body>
</html>
EOF;
}

if ($path === 'collect') {
    header('Access-Control-Allow-Origin: *');
    $json = $_GET['data'] ?? false;
    if ($json === false) {
        exit(1);
    }

    $json = json_decode($json, $_toArray = true);
    $json['date'] = (new DateTime('now', new DateTimeZone('Asia/Jakarta')))->format('c');
    $json = json_encode($json, JSON_UNESCAPED_SLASHES);

    file_put_contents('php://stderr', $json);
    file_put_contents(BASEPATH . '/data.txt', $json . "\n", FILE_APPEND);
}

if ($path === 'view') {
    header('Content-Type: text/plain');
    $lines = explode("\n", trim(@file_get_contents(BASEPATH . '/data.txt')));
    rsort($lines);
    print_r($lines);
}