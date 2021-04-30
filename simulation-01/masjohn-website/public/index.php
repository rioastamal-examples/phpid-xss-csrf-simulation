<?php
session_start();

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

// This code also having vulnerability :)
$filename = BASEPATH . sprintf('/src/pages/%s.php', $path);

if (file_exists($filename) === false) {
  header('HTTP/1.1 404 Not Found');
  echo <<<EOF
<!DOCTYPE html>
<html>
<body>
<h1>404 Not Found</h1>
</body>
</html>
EOF;

  exit(1);
}

$sqliteFile = BASEPATH . '/data/app.sqlite';
if (file_exists($sqliteFile) === false) {
  $pdo = new PDO('sqlite:' . $sqliteFile);
  $pdo->exec(<<<EOF
CREATE TABLE IF NOT EXISTS messages(
  id TEXT,
  name TEXT,
  email TEXT,
  url TEXT,
  message TEXT,
  created_at
);
EOF);

  $pdo->exec(<<<EOF
CREATE TABLE IF NOT EXISTS portfolio(
  id TEXT,
  title TEXT,
  content TEXT,
  url TEXT,
  image TEXT,
  created_at
);
EOF);

  $date = (new DateTime('now', new DateTimeZone('Asia/Jakarta')));
  $rows = [
    [
      'id' => md5(microtime(true) . uniqid()),
      'title' => 'Puisi Kita',
      'content' => 'Puisi kita adalah sebuah website kolaborasi tulisan antar seniman puisi. Pengguna dapat mengirimkan puisi dan memberikan tanggapan pada setiap puisi yang ada.',
      'url' => '#',
      'image' => '',
      'created_at' => $date->format('c')
    ],
    [
      'id' => md5(microtime(true) . uniqid()),
      'title' => 'Website PT Maju Mundur',
      'content' => 'PT Maju Mundur adalah perusahaan yang bergerak dibidang olahraga, khususnya atletik. Dimana mereka menyediakan sepatu olahraga khusus untuk maju dan lari mundur. Keren bukan?',
      'url' => '#',
      'image' => '',
      'created_at' => $date->format('c')
    ],
    [
      'id' => md5(microtime(true) . uniqid()),
      'title' => 'SKD - Sistem Kas Desa',
      'content' => 'Sistem Kas Desa adalah aplikasi web sederhana untuk mencatat pengeluaran sebuah desa. Aplikasi ini diimplementasikan di desan Mas John yaitu Desa Smith Kidul.',
      'url' => '#',
      'image' => '',
      'created_at' => $date->format('c')
    ],
    [
      'id' => md5(microtime(true) . uniqid()),
      'title' => 'Lapor Pak Kades',
      'content' => 'Sistem informasi pelaporan di Desa Smith Kidul. Warga yang ingin mengajukan laporan dapat melakukannya online dan statusnya bisa dimonitor setiap saat.',
      'url' => '#',
      'image' => '',
      'created_at' => $date->format('c')
    ]
  ];

  $statement = $pdo->prepare('INSERT INTO portfolio (id, title, content, url, image, created_at) VALUES
    (:id, :title, :content, :url, :image, :created_at)');

  foreach ($rows as $row) {
    $statement->execute([
      ':id' => $row['id'],
      ':title' => $row['title'],
      ':content' => $row['content'],
      ':url' => $row['url'],
      ':image' => $row['image'],
      ':created_at' => $row['created_at']
    ]);
  }

  // Messages table
  $rows = [
    [
      'id' => md5(microtime(true) . uniqid()),
      'name' => 'Mas Joko',
      'email' => 'joko@example.com',
      'url' => 'http://example.com/',
      'message' => "Halo Mas John,\n\nSaya ingin membuat website usaha dagang saya? berapa ya harganya.",
      'created_at' => '2021-04-19T03:52:08+07:00'
    ],
    [
      'id' => md5(microtime(true) . uniqid()),
      'name' => 'Mas Parto',
      'email' => 'parto@example.com',
      'url' => '',
      'message' => "Mas John,\n\nbisa minta nomor HP nya saya ingin membuat website untuk desa saya.",
      'created_at' => '2021-04-19T03:52:09+07:00'
    ],
  ];

  $statement = $pdo->prepare('INSERT INTO messages (id, name, email, url, message, created_at) VALUES
    (:id, :name, :email, :url, :message, :created_at)');

  foreach ($rows as $row) {
    $statement->execute([
      ':id' => $row['id'],
      ':name' => $row['name'],
      ':email' => $row['email'],
      ':url' => $row['url'],
      ':message' => $row['message'],
      ':created_at' => $row['created_at']
    ]);
  }
}
// file_exists($filename) === false) -> DB Seed

// We dont like to use 'else' :)
if (file_exists($sqliteFile) === true) {
  $pdo = new PDO('sqlite:' . $sqliteFile);
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$loggedIn = $_SESSION['logged_in'] ?? false;
require $filename;