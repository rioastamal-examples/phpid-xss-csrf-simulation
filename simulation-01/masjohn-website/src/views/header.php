<!DOCTYPE html>
<html lang="id">
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
<style>
.mr-8 { margin-right: 8px; }
.mb-8 { margin-bottom: 8px; }
.mt-100 { margin-top: 100px; }
header { margin-top: 70px; }
article {
  margin-bottom: 20px;
  display: block;
}
.portfolio img {
  width: 200px;
  height: 120px;
  background: #f1f1f1;
  border-radius: 8px;
  border: 1px solid #c1c1c1;
}
.red { color: #c60000; }
.profile-picture {
  border: 4px solid #ccc;
  border-radius: 50%;
  box-sizing: border-box;
  padding: 8px;
}
nav ul li {
  list-style-type: none;
  display: inline;
  margin-right: 10px;
}
</style>
</head>
<body>
<div class="container" id="app">
  <div class="row">
    <header>
      <h1>Mas John - Web Developer</h1>
      <?php if ($loggedIn) : ?>
      <nav>
        <ul>
          <li><a href="/">Home</a></li>
          <li><a href="/portfolio/">Portfolio</a></li>
          <li><a href="/messages/">Pesan</a></li>
          <li><a href="/login/?logout=true">Logout</a></li>
        </ul>
      </nav>
      <?php endif; ?>
    </header>
  </div>

  <?php if (isset($success) && $success === true) : ?>
    <div class="row">
      <blockquote>
        <p><?= $successMessage ?? 'Data berhasil disimpan' ?></p>
      </blockquote>
    </div>
  <?php endif; ?>

  <?php if (isset($success) && $success === false) : ?>
    <div class="row red">
      <blockquote>
        <p>Terdapat kesalahan mohon perbaiki.</p>
        <ul>
          <?php foreach ($errors as $error) : ?>
          <li><?= $error ; ?></li>
          <?php endforeach; ?>
        </ul>
      </blockquote>
    </div>
  <?php endif; ?>