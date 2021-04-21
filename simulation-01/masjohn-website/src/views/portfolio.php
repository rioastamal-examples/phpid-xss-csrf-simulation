
<?php require __DIR__ . '/header.php'

?><main>
    <div class="row mt-100">
    <h2>Portfolio</h2>
    </div>

    <div class="row">
      <div class="column column">
      <form method="post">
        <fieldset>
          <label for="name">Judul</label>
          <input type="text" placeholder="Judul Portfolio" id="title" name="title" value="<?= $portfolio['title'] ?>">
          <label for="konten">Konten</label>
          <textarea placeholder="Konten Portfolio" id="konten" name="konten"><?= $portfolio['content'] ?></textarea>
          <input class="button-primary" type="submit" value="Simpan">
        </fieldset>
      </form>
      </div>
    </div>
    <!-- ./row -->

  </main><?php

require __DIR__ . '/footer.php';