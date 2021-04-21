<?php require __DIR__ . '/header.php'

?><main>
    <div class="row mt-100">
      <div class="column column-20">
        <img src="/assets/img/mas-john.jpg">
      </div>
      <div class="column column-80">
        <p>Halo nama saya <b>Mas John</b>, saya adalah seorang Full Stack web developer <b>baik hati</b> dengan fokus utama
        ke bahasa pemrograman PHP dan Framework Laravel. Saat ini saya bekerja sebagai freelance web developer.
        Beberapa tipe website yang sering saya kerjakan adalah website company profile, sistem informasi aduan dan
        sejenisnya.</p>

        <p>Dalam mengerjakan suatu project saya selalu mengutamakan kebutuhan pelanggan dengan meminta mereka untuk
          berdiskusi dulu secara intens tentang masalah yang dihadapi. Baru kemudian dokumen requirements disusun
        dan kontrak dibuat.</p>

        <p>Silahkan kontak saya jika membutuhkan konsultasi tentang pembuatan website anda. Salam Mas John.</p>
      </div>
    </div>

    <div class="row mt-100">
      <h2>Portfolio</h2>
    </div>

    <?php foreach ($portfolios as $index => $portfolio) : ?>
    <?= ($index + 1) % 2 !== 0 ? '<div class="row portfolio ' . $index . '">' . "\n" : '' ?>

      <div class="column column-50">
        <article>
          <div>
            <h3><a href="<?= $portfolio['url'] ?>"><?= $portfolio['title'] ?></a></h3>

            <?php if ($loggedIn) : ?>
            <a class="button" href="/portfolio/?id=<?= $portfolio['id'] ?>">Edit</a>
            <?php endif; ?>

            <img class="float-left mr-8" v-bind:src="parseFeaturedMedia(post, 'thumbnail')">
            <p v-html="post.excerpt.rendered"><?= $portfolio['content'] ?> </p>
          </div>
        </article>
      </div>

    <?= ($index + 1)  % 2 === 0 || ($index + 1 === count($portfolio)) ? '</div><!-- row -->' . "\n" : '' ?>
    <?php endforeach ?>

    <div class="row mt-100">
      <h2>Contact Us</h2>
    </div>

    <div class="row">
      <div class="column column-40">
        <p>Silahkan gunakan form berikut untuk menghubungi saya perihal pertanyaan
        atau ketersediaan saya terhadap suatu project. Saya akan dengan senang hati
        menerima pesan anda.</p>
      </div>
      <div class="column column-60">
      <form method="post">
        <fieldset>
          <label for="name">Nama*</label>
          <input type="text" placeholder="Mohon isi nama anda" id="name" name="name">
          <label for="email">Email*</label>
          <input type="text" placeholder="Mohon isi email anda" id="email" name="email">
          <label for="url">URL</label>
          <input type="text" placeholder="Contoh https://websiteku.com" id="url" name="url">
          <label for="message">Pesan</label>
          <textarea placeholder="Halo Mas John," id="message" name="message"></textarea>
          <input class="button-primary" type="submit" value="Send">
        </fieldset>
      </form>
      </div>
    </div>
    <!-- ./row -->
  </main><?php

  require __DIR__ . '/footer.php';