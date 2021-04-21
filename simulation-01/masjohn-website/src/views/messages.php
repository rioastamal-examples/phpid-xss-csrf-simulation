<?php require __DIR__ . '/header.php';

?><main>
    <div class="row mt-100">
      <h2>Pesan Masuk</h2>
    </div>

    <div class="row">
    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>Email</th>
          <th>Tgl</th>
          <th>Pesan</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($messages as $message) : ?>
        <tr>
          <td><?= $message['url'] ?
                  sprintf('<a href="%s">%s</a>', $message['url'], $message['name']) :
                  $message['name']
          ?></td>
          <td><?= $message['email'] ?></td>
          <td><?= $message['created_at'] ?></td>
          <td><?= nl2br(strip_tags($message['message'])) ?></td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
    </div>
  </main><?php

require __DIR__ . '/footer.php';