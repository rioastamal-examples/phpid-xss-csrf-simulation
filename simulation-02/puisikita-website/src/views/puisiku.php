<?php require __DIR__ . '/header.php'

?><main>
    <div class="row">
      <h2>Puisiku</h2>
    </div>

    <?php foreach ($poetry as $_poetry) : ?>
    <div class="row">
      <div class="column column-30">
        <article>
          <div>
            <h3><a href="#"><?= $_poetry['title'] ?></a></h3>
            <blockquote style="font-style: italic;">
                <?= nl2br(htmlentities($_poetry['content'], ENT_QUOTES)); ?>
            </blockquote>
          </div>
        </article>
      </div>

      <div class="column column-70">
        <p>
            <button class="button button-outline"><?= (int)$_poetry['likes'] ?> Likes</button>
            <a href="/puisiku/?id=<?= htmlentities($_poetry['id'], ENT_QUOTES) ?>&delete" class="button delete-poetry">Hapus</a>
        </p>
      </div>
    </div>
    <!-- ./row -->
    <?php endforeach; ?>

  </main>
<script>
var deleteBtn = document.querySelectorAll('a.delete-poetry');
for (var i=0; i<deleteBtn.length; i++) {
    deleteBtn[i].addEventListener('click', function(e) {
        if (confirm('Anda yakin ingin menghapus puisi ini?') === false) {
            e.preventDefault();
            return false;
        }

        return true;
    });
}
</script><?php

  require __DIR__ . '/footer.php';