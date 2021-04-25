<?php

$poetry = $pdo->query('SELECT
    p.id, p.title, p.content, p.likes, a.email, a.full_name
    FROM poetry AS p INNER JOIN authors a ON a.id=p.author
    ORDER BY p.likes DESC',
PDO::FETCH_ASSOC);

require BASEPATH . '/src/views/homepage.php';