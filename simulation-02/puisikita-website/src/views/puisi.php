<?php require __DIR__ . '/header.php'

?><main>
    <div class="row">
      <h2><?= htmlentities($poetry['title']) ?></h2>
    </div>

    <div class="row">
      <div class="column column-30">
        <article>
          <div>
            <blockquote style="font-style: italic;">
                <?= nl2br(htmlentities($poetry['content'])); ?>
            </blockquote>
          </div>
        </article>
      </div>

      <div class="column column-70">
        <p>
            Penulis <b><?= htmlentities($poetry['full_name']) ?></b><br><br>
            <button class="button button-outline"><?= (int)$poetry['likes'] ?> Likes</button><br><br>
            Share ke <a href="#">Facebook</a> &bull; <a href="#">Twitter</a> &bull; <a href="#">WhatsApp</a>
        </p>
      </div>
    </div>

  </main><?php

  require __DIR__ . '/footer.php';