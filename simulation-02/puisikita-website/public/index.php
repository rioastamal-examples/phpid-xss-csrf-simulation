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
CREATE TABLE IF NOT EXISTS poetry(
  id TEXT,
  title TEXT,
  content TEXT,
  author TEXT,
  likes NUMBER,
  created_at TEXT
);
EOF);

  $pdo->exec(<<<EOF
CREATE TABLE IF NOT EXISTS authors(
  id TEXT,
  email TEST,
  password TEXT,
  full_name TEXT,
  created_at TEXT
);
EOF);

  $date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
  $rows = [
    [
        'id' => 'caklontong',
        'email' => 'cak@lontong.com',
        'password' => password_hash('akulontong', PASSWORD_DEFAULT),
        'full_name' => 'Cak Lontong',
        'created_at' => $date->format('c')
    ],
    [
        'id' => 'maskher',
        'email' => 'maskher@example.com',
        'password' => password_hash('akumaskher', PASSWORD_DEFAULT),
        'full_name' => 'Mas Kher',
        'created_at' => $date->format('c')
    ],
    [
        'id' => 'masboy',
        'email' => 'masboy@ganteng.xyz',
        'password' => password_hash('akuboyganteng', PASSWORD_DEFAULT),
        'full_name' => 'Mas Boy',
        'created_at' => $date->format('c')
    ],
  ];

  $statement = $pdo->prepare('INSERT INTO authors (id, email, password, full_name, created_at) VALUES
    (:id, :email, :password, :full_name, :created_at)');

  foreach ($rows as $row) {
    $statement->execute([
      ':id' => $row['id'],
      ':email' => $row['email'],
      ':password' => $row['password'],
      ':full_name' => $row['full_name'],
      ':created_at' => $row['created_at']
    ]);
  }

  $rows = [
    [
      'id' => md5(microtime(true) . uniqid()),
      'title' => 'Nusantara Tercinta',
      'content' => <<<PUISI
Kutulis dalam bait-bait indah
puisi tentang nusantara
Bentuk dari ungkapan cinta
Akan indahnya Indonesia

Alam yang luas terbentang
Dari sawah hingga lautan
Gunung-gunung berjajar
Hutan hijau luas terhampar.

Indonesia tanah kelahiran
Indahnya menjadi pujaan
Aku jaga sepanjang zaman
Agar lestari negeri idaman.
PUISI,
      'author' => 'masboy',
      'likes' => 1250,
      'created_at' => $date->format('c')
    ],
    [
      'id' => md5(microtime(true) . uniqid()),
      'title' => 'Keindahan Alam Ini',
      'content' => <<<PUISI
Betapa indahnya negeri ini
Laut yang berombak ombak
Lereng yang bertingkat-tingkat
angin berhembus sepoi-sepoi

Berdiri aku di tepi pantai
Di bawah langit yang membentang
Merasakan Negeri keindahan
Indonesia yang ku sayang

Indonesia negeri khatulistiwa
Beribu nikmat di dalamnya
Pemberian dari Tuhan Yang Esa
Agar bersyukur kita kepada-Nya.
PUISI,
      'author' => 'maskher',
      'likes' => 740,
      'created_at' => $date->format('c')
    ],
    [
      'id' => md5(microtime(true) . uniqid()),
      'title' => 'Keindahan Indonesia Lestari',
      'content' => <<<PUISI
Bertahun sudah Negeri Tercinta
Melewati hamparan masa
Beribu zaman telah berputar
Dari dahulu hingga masa depan

Indonesiaku tetap Lestari
Keindahan yang tak tertandingi
Taman taman lautan
Tempat berenang banyak ikan

Gunung-gunung penuh pepohonan
Rusa bermain sekawanan
Gunung yang tinggi sangat menjulang
Puncaknya menyentuh awan gemawan
PUISI,
      'author' => 'caklontong',
      'likes' => 310,
      'created_at' => $date->format('c')
    ]
  ];

  $statement = $pdo->prepare('INSERT INTO poetry (id, title, content, author, likes, created_at) VALUES
    (:id, :title, :content, :author, :likes, :created_at)');

  foreach ($rows as $row) {
    $statement->execute([
      ':id' => $row['id'],
      ':title' => $row['title'],
      ':content' => $row['content'],
      ':author' => $row['author'],
      ':likes' => $row['likes'],
      ':created_at' => $row['created_at']
    ]);
  }
}

// We dont like to use 'else' :)
if (file_exists($sqliteFile) === true) {
  $pdo = new PDO('sqlite:' . $sqliteFile);
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$loggedIn = $_SESSION['logged_in'] ?? false;
$currentUser = $_SESSION['current_user'] ?? false;

require $filename;