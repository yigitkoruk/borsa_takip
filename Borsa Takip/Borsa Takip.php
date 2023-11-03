<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "borsa_takip";

$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_error) {
    die("Connect Error: " . $connect->connect_error);
}

$sql = "SELECT * FROM  hisseler WHERE islem_durumu = true";
$list = $connect->query($sql);

if (isset($_POST["ekle"])) {
    $hisseAdi = $_POST["hisseAdi"];
    $alisMaliyeti = $_POST["alisMaliyeti"];
    $satisFiyati = $_POST["satisFiyati"];
    $adet = $_POST["adet"];

    if (empty($hisseAdi)) {
        $hisseAdi_Hata = '<p style="font-size: 13px; color: red;">Lütfen hisse adı giriniz!</p>';
    }

    if (empty($alisMaliyeti)) {
        $alisMaliyeti_Hata = '<p style="font-size: 13px; color: red;">Lütfen hisse maliyeti giriniz!</p>';
    }

    if (empty($satisFiyati)) {
        $satisFiyati_Hata ='<p style="font-size: 13px; color: red;">Lütfen güncel fiyat giriniz!</p>';
    }

    if (empty($adet)) {
        $Adet_Hata = '<p style="font-size: 13px; color: red;">Lütfen adet giriniz!</p>';
    }

    if (empty($hisseAdi_Hata) && empty($alisMaliyeti_Hata) && empty($satisFiyati_Hata) && empty($Adet_Hata)) {
        $karZarar = ($satisFiyati - $alisMaliyeti) * $adet;
        $tarih = date("F");

        $sql = "INSERT INTO hisseler (hisse_adi, alis_maliyeti, guncel_fiyat, adet, kar_zarar, tarih) VALUES ('$hisseAdi', '$alisMaliyeti', '$satisFiyati', '$adet', '$karZarar', '$tarih')";

        if ($connect->query($sql) === TRUE) {
            echo "Veri başarıyla eklendi.";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
        $connect->close();
        header("Location: Borsa Takip.php");
    }
}

if (isset($_POST["sat"])) {
    $id = $_POST["hidden"];
    $false = "false";

    $updateSql = "UPDATE hisseler SET islem_durumu = $false WHERE id = $id";
    $connect->query($updateSql);
    header("Location: Borsa Takip.php");
}

if (isset($_POST["duzenle"])) {
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borsa Takip Sayfası</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        h1,
        h2 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            outline: none;
            border-color: #4caf50;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Borsa Takip Sayfası</h1>
        <form id="borsaForm">
            <label for="hisseAdi">Hisse Adı:</label>
            <input type="text" id="hisseAdi" required><br><br>
            <label for="alisMaliyeti">Alış Maliyeti:</label>
            <input type="number" id="alisMaliyeti" required><br><br>
            <label for="satisFiyati">Satış Fiyatı:</label>
            <input type="number" id="satisFiyati" required><br><br>
            <label for="adet">Adet:</label>
            <input type="number" id="adet" required><br><br>
            <button type="button" onclick="ekle()">Ekle</button>
        </form>
        <h2>Alış Satış İşlemleri</h2>
        <table id="borsaTablosu">
            <tr>
                <th>Hisse Adı</th>
                <th>Alış Maliyeti</th>
                <th>Satış Fiyatı</th>
                <th>Adet</th>
                <th>Kar/Zarar</th>
                <th>İşlemler</th>
            </tr>
        </table>

        <div id="detayModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="kapatDetayModal()">&times;</span>
                <h2>Detaylar</h2>
                <div id="detayIcerik"></div>
            </div>
        </div>

        <h2>Aylık Kar/Zarar Tablosu</h2>
        <table id="aylikKarZararTablosu">
            <tr>
                <th>Ay</th>
                <th>Kar/Zarar</th>
            </tr>
        </table>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Düzenle</h2>
            <label for="hisseAdiModal">Hisse Adı:</label>
            <input type="text" id="hisseAdiModal" required><br><br>
            <label for="alisMaliyetiModal">Alış Maliyeti:</label>
            <input type="number" id="alisMaliyetiModal" required><br><br>
            <label for="satisFiyatiModal">Satış Fiyatı:</label>
            <input type="number" id="satisFiyatiModal" required><br><br>
            <label for="adetModal">Adet:</label>
            <input type="number" id="adetModal" required><br><br>
            <button type="button" onclick="kaydet()">Kaydet</button>
        </div>
    </div>

    <script>
        let borsaVerileri = [];
        let duzenleIndex = null;

        window.onload = function () {
            borsaVerileri = JSON.parse(localStorage.getItem("borsaVerileri")) || [];
            guncelleTablolar();
        };

        function ekle() {
            let hisseAdi = document.getElementById("hisseAdi").value;
            let alisMaliyeti = parseFloat(document.getElementById("alisMaliyeti").value);
            let satisFiyati = parseFloat(document.getElementById("satisFiyati").value);
            let adet = parseInt(document.getElementById("adet").value);
            let karZarar = (satisFiyati - alisMaliyeti) * adet;
            let ay = new Date().toLocaleString('default', { month: 'long' });

            if (duzenleIndex !== null) {
                borsaVerileri[duzenleIndex] = {
                    hisseAdi: hisseAdi,
                    alisMaliyeti: alisMaliyeti,
                    satisFiyati: satisFiyati,
                    adet: adet,
                    karZarar: karZarar,
                    ay: ay
                };
                duzenleIndex = null;
            } else {
                borsaVerileri.push({
                    hisseAdi: hisseAdi,
                    alisMaliyeti: alisMaliyeti,
                    satisFiyati: satisFiyati,
                    adet: adet,
                    karZarar: karZarar,
                    ay: ay
                });
            }

            localStorage.setItem("borsaVerileri", JSON.stringify(borsaVerileri));
            guncelleTablolar();
            document.getElementById("borsaForm").reset();
        }

        function duzenle(index) {
            duzenleIndex = index;
            let seciliHisse = borsaVerileri[index];
            document.getElementById("hisseAdi").value = seciliHisse.hisseAdi;
            document.getElementById("alisMaliyeti").value = seciliHisse.alisMaliyeti;
            document.getElementById("satisFiyati").value = seciliHisse.satisFiyati;
            document.getElementById("adet").value = seciliHisse.adet;
        }

        function sil(index) {
            borsaVerileri.splice(index, 1);
            localStorage.setItem("borsaVerileri", JSON.stringify(borsaVerileri));
            guncelleTablolar();
        }

        function guncelleTablolar() {
            let borsaTablosu = document.getElementById("borsaTablosu");
            let aylikKarZararTablosu = document.getElementById("aylikKarZararTablosu");
            borsaTablosu.innerHTML = "<tr><th>Hisse Adı</th><th>Alış Maliyeti</th><th>Satış Fiyatı</th><th>Adet</th><th>Kar/Zarar</th><th>İşlemler</th></tr>";
            aylikKarZararTablosu.innerHTML = "<tr><th>Ay</th><th>Kar/Zarar</th></tr>";

            let toplamKarZarar = {};

            borsaVerileri.forEach(function (hisse, index) {
                let row = borsaTablosu.insertRow();
                row.innerHTML = `<td>${hisse.hisseAdi}</td><td>${hisse.alisMaliyeti}</td><td>${hisse.satisFiyati}</td><td>${hisse.adet}</td><td>${hisse.karZarar}</td><td><button onclick="duzenle(${index})">Düzenle</button> <button onclick="sil(${index})">Sil</button> <button onclick="detay(${index})">Detay</button></td>`;



                let aylar = aylikKarZararTablosu.getElementsByTagName("tr");
                let bulundu = false;

                for (let i = 1; i < aylar.length; i++) {
                    let ayAdi = aylar[i].getElementsByTagName("td")[0].innerText;
                    if (ayAdi === hisse.ay) {
                        let mevcutKarZarar = parseInt(aylar[i].getElementsByTagName("td")[1].innerText);
                        mevcutKarZarar += hisse.karZarar;
                        aylar[i].getElementsByTagName("td")[1].innerText = mevcutKarZarar;
                        bulundu = true;
                        break;
                    }
                }

                if (!bulundu) {
                    let aylikKarZararRow = aylikKarZararTablosu.insertRow();
                    aylikKarZararRow.innerHTML = `<td>${hisse.ay}</td><td>${hisse.karZarar}</td>`;
                }

                if (!toplamKarZarar[hisse.ay]) {
                    toplamKarZarar[hisse.ay] = 0;
                }

                toplamKarZarar[hisse.ay] += hisse.karZarar;
            });

            let toplamKarZararRow = aylikKarZararTablosu.insertRow();
            toplamKarZararRow.innerHTML = `<td>Toplam</td><td>${Object.values(toplamKarZarar).reduce((a, b) => a + b, 0)}</td>`;
        }

        let modal = document.getElementById("myModal");
        let span = document.getElementsByClassName("close")[0];

        function duzenle(index) {
            // Düzenleme butonuna basıldığında modalı göster
            modal.style.display = "block";

            // Seçili hissenin verilerini modal içine yerleştir
            let seciliHisse = borsaVerileri[index];
            document.getElementById("hisseAdiModal").value = seciliHisse.hisseAdi;
            document.getElementById("alisMaliyetiModal").value = seciliHisse.alisMaliyeti;
            document.getElementById("satisFiyatiModal").value = seciliHisse.satisFiyati;
            document.getElementById("adetModal").value = seciliHisse.adet;

            // Modal üzerindeki kaydet (save) butonuna tıklandığında yapılacak işlem
            window.kaydet = function () {
                // Düzenlenen verileri al
                let hisseAdi = document.getElementById("hisseAdiModal").value;
                let alisMaliyeti = parseFloat(document.getElementById("alisMaliyetiModal").value);
                let satisFiyati = parseFloat(document.getElementById("satisFiyatiModal").value);
                let adet = parseInt(document.getElementById("adetModal").value);
                let karZarar = (satisFiyati - alisMaliyeti) * adet;
                let ay = new Date().toLocaleString('default', { month: 'long' });

                // Düzenleme yapılan veriyi güncelle
                borsaVerileri[index] = {
                    hisseAdi: hisseAdi,
                    alisMaliyeti: alisMaliyeti,
                    satisFiyati: satisFiyati,
                    adet: adet,
                    karZarar: karZarar,
                    ay: ay
                };

                // Local storage ve tabloları güncelle
                localStorage.setItem("borsaVerileri", JSON.stringify(borsaVerileri));
                guncelleTablolar();

                // Modalı gizle
                modal.style.display = "none";
            }
        }

        // Modalın üstündeki "x" butonuna basıldığında modalı gizle
        span.onclick = function () {
            modal.style.display = "none";
        }

        // Modal dışına tıklandığında modalı gizle
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function detay(index) {
        // Detay butonuna basıldığında modalı göster
        let seciliHisse = borsaVerileri[index];
        let detayIcerik = `<p><strong>Hisse Adı:</strong> ${seciliHisse.hisseAdi}</p>`;
        detayIcerik += `<p><strong>Alış Maliyeti:</strong> ${seciliHisse.alisMaliyeti}</p>`;
        detayIcerik += `<p><strong>Satış Fiyatı:</strong> ${seciliHisse.satisFiyati}</p>`;
        detayIcerik += `<p><strong>Adet:</strong> ${seciliHisse.adet}</p>`;
        detayIcerik += `<p><strong>Kar/Zarar:</strong> ${seciliHisse.karZarar}</p>`;
        detayIcerik += `<p><strong>Ay:</strong> ${seciliHisse.ay}</p>`;

        document.getElementById("detayIcerik").innerHTML = detayIcerik;
        document.getElementById("detayModal").style.display = "block";
        }

        function kapatDetayModal() {
        document.getElementById("detayModal").style.display = "none";
        }
    </script>
</body>

</html>
