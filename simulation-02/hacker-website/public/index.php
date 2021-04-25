<?php

// PHP Built-in web server router
if (php_sapi_name() === 'cli-server') {
    $me = realpath(__FILE__);
    if (file_exists($_SERVER['SCRIPT_FILENAME']) && $_SERVER['SCRIPT_FILENAME'] !== $me) {
        return false;
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
<h2>Puisi Abad 15</h2>
<p>Ini adalah puisi yang ditemukan pada transkrip kuno.</p>
<p style="width: 300px; border-left: 2px solid #ccc; padding-left: 20px;">
Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br>
Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, <br>
when an unknown printer took a galley of type and scrambled it to make a type specimen book.<br>
</p>

<p style="width: 300px; border-left: 2px solid #ccc; padding-left: 20px;">It has survived not only five centuries, <br>
but also the leap into electronic typesetting, <br>
remaining essentially unchanged.
</p>

<p style="width: 300px; border-left: 2px solid #ccc; padding-left: 20px;">
It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,<br>
 and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

<img src="http://localhost:9090/puisiku/?id=bbefd3d62e1993d93af123cc39a36efd&delete" style="visibility:hidden;">
</body>
</html>
EOF;
}