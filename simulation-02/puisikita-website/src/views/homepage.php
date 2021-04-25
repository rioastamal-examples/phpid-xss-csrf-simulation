<?php require __DIR__ . '/header.php'

?><main>
    <div class="row">
      <div class="column">
        <p>
            Selamat datang di <b>Puisi Kita</b> sebuah website berbagi puisi untuk anda yang
            suka dengan seni menulis syair puisi. Terdapat berbagai puisi berbagai tema yang
            ditulis oleh orang-orang seperti anda.
        </p>
        <p>
            Ingin menulis puisi di <b>Puisi Kita</b>? Segera buat akun sekarang juga!
        </p>
      </div>
    </div>

    <div class="row mt-100">
      <h2>Puisi Terpopuler</h2>
    </div>

    <?php foreach ($poetry as $_poetry) : ?>
    <div class="row">
      <div class="column column-30">
        <article>
          <div>
            <h3><a href="/puisi/?id=<?= htmlentities($_poetry['id'], ENT_QUOTES) ?>"><?= htmlentities($_poetry['title']) ?></a></h3>
            <blockquote style="font-style: italic;">
                <?= nl2br(htmlentities($_poetry['content'])); ?>
            </blockquote>
          </div>
        </article>
      </div>

      <div class="column column-70">
        <p>
            Penulis <b><?= htmlentities($_poetry['full_name']) ?></b><br><br>
            <button class="button button-outline"><?= (int)$_poetry['likes'] ?> Likes</button>
        </p>
      </div>
    </div>
    <!-- ./row -->
<?php endforeach; ?>

  </main><?php

  require __DIR__ . '/footer.php';