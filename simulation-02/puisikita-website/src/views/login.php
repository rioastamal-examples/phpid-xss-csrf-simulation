<?php require __DIR__ . '/header.php'

?><main>
    <div class="row mt-100">
      <div class="column column-50">
        <h2>Login Puisi Kita</h2>
        <p>Masukkan username dan password untuk masuk ke
            Member Area Puisi Kita. Setelah
            masuk anda dapat membuat dan melakukan like puisi.</p>
      </div>

      <div class="column column-50">
        <form method="post">
          <fieldset>
            <input type="text" placeholder="Username" id="email" name="email">
            <input type="password" placeholder="Password" id="password" name="password">
            <input class="button-primary" type="submit" value="Login">
          </fieldset>
        </form>
      </div>
    </div>
  </main><?php

require __DIR__ . '/footer.php';