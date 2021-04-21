<?php require __DIR__ . '/header.php'

?><main>
    <div class="row mt-100">
      <div class="column column-50">
        <h2>Control Panel Login</h2>
        <p>Masukkan username dan password untuk masuk ke
            Control Panel Mas John Website. Setelah
            masuk anda dapat mengelola portfolio dan
            pesan.</p>
      </div>

      <div class="column column-50">
        <form method="post">
          <fieldset>
            <input type="text" placeholder="Username" id="username" name="username">
            <input type="text" placeholder="Password" id="password" name="password">
            <input class="button-primary" type="submit" value="Login">
          </fieldset>
        </form>
      </div>
    </div>
  </main><?php

require __DIR__ . '/footer.php';