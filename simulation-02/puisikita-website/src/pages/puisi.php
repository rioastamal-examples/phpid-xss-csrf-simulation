<?php

$id = $_GET['id'] ?? '_';
$statement = $pdo->prepare('SELECT
    p.id, p.title, p.content, p.likes, a.email, a.full_name
    FROM poetry AS p INNER JOIN authors a ON a.id=p.author
    WHERE p.id = :id
    ORDER BY p.likes DESC');
$statement->execute(['id' => $id]);
$poetry = $statement->fetch(PDO::FETCH_ASSOC);

require BASEPATH . '/src/views/puisi.php';