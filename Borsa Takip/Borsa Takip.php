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
        $satisFiyati_Hata ='<p style="font-size: 13px; color: red;">Lütfen satış fiyatı giriniz!</p>';
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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form id="borsaForm" method="POST">
        <label for="hisseAdi">Hisse Adı:</label>
        <input type="text" id="hisseAdi" name="hisseAdi">
        <?= $hisseAdi_Hata ?? "" ?><br><br>

        <label for="alisMaliyeti">Alış Maliyeti:</label>
        <input type="number" id="alisMaliyeti" name="alisMaliyeti">
        <?= $alisMaliyeti_Hata ?? "" ?><br><br>

        <label for="satisFiyati">Güncel Fiyat:</label>
        <input type="number" id="satisFiyati" name="satisFiyati">
        <?= $satisFiyati_Hata ?? "" ?><br><br>

        <label for="adet">Adet:</label>
        <input type="number" id="adet" name="adet">
        <?= $Adet_Hata ?? "" ?><br><br>

        <button type="button" onclick="ekle()">Ekle</button>
        <input type="submit" name="ekle" value="Submit">
    </form>

    <h2>Aylık Kar/Zarar Tablosu</h2>
    <table id="aylikKarZararTablosu">
        <tr>
            <th>Ay</th>
            <th>Kar/Zarar</th>
        </tr>
    </table>

    <table>
        <h2>Alış Satış İşlemleri</h2>
        <thead>
            <tr>
                <th>Hisse Adı</th>
                <th>Alış Maliyeti</th>
                <th>Satış Fiyatı</th>
                <th>Adet</th>
                <th>Kar/Zarar</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $item) : ?>
                <tr>
                    <td><?= $item["hisse_adi"] ?? "" ?></td>
                    <td><?= $item["alis_maliyeti"] ?? "" ?></td>
                    <td><?= $item["guncel_fiyat"] ?? "" ?></td>
                    <td><?= $item["adet"] ?? "" ?></td>
                    <td><?= $item["kar_zarar"] ?? "" ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" value="<?= $item["id"] ?? "" ?>" name="hidden">
                            <input type="submit" value="Düzenle" name="duzenle" class="button">
                            <input type="submit" value="Sat" name="sat" class="button">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        let borsaVerileri = [];
        let duzenleIndex = null;

        window.onload = function() {
            borsaVerileri = JSON.parse(localStorage.getItem("borsaVerileri")) || [];
            guncelleTablolar();
        };

        function ekle() {
            let hisseAdi = document.getElementById("hisseAdi").value;
            let alisMaliyeti = parseFloat(document.getElementById("alisMaliyeti").value);
            let satisFiyati = parseFloat(document.getElementById("satisFiyati").value);
            let adet = parseInt(document.getElementById("adet").value);
            let karZarar = (satisFiyati - alisMaliyeti) * adet;
            let ay = new Date().toLocaleString('default', {
                month: 'long'
            });

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
                // Düzenleme yapılmiyorsa var olan bir veriyi güncelleme
                let existingIndex = borsaVerileri.findIndex(veri => veri.hisseAdi === hisseAdi);
                if (existingIndex !== -1) {
                    borsaVerileri[existingIndex] = {
                        hisseAdi: hisseAdi,
                        alisMaliyeti: alisMaliyeti,
                        satisFiyati: satisFiyati,
                        adet: adet,
                        karZarar: karZarar,
                        ay: ay
                    };
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
            document.getElementById("borsaTablosu").innerHTML = "<tr><th>Hisse Adı</th><th>Alış Maliyeti</th><th>Satış Fiyatı</th><th>Adet</th><th>Kar/Zarar</th><th>İşlemler</th></tr>";
            document.getElementById("aylikKarZararTablosu").innerHTML = "<tr><th>Ay</th><th>Kar/Zarar</th></tr>";

            let toplamKarZarar = {};

            let borsaTablosu = document.getElementById("borsaTablosu");
            let aylikKarZararTablosu = document.getElementById("aylikKarZararTablosu");
            borsaVerileri.forEach(function(hisse, index) {
                let row = borsaTablosu.insertRow();
                row.innerHTML = `<td>${hisse.hisseAdi}</td><td>${hisse.alisMaliyeti}</td><td>${hisse.satisFiyati}</td><td>${hisse.adet}</td><td>${hisse.karZarar}</td><td><button onclick="duzenle(${index})">Düzenle</button> <button onclick="sil(${index})">Sil</button></td>`;

                let aylar = aylikKarZararTablosu.getElementsByTagName("tr");
                let found = false;
                for (let i = 1; i < aylar.length; i++) {
                    let ayAdi = aylar[i].getElementsByTagName("td")[0].innerText;
                    if (ayAdi === hisse.ay) {
                        let mevcutKarZarar = parseInt(aylar[i].getElementsByTagName("td")[1].innerText);
                        mevcutKarZarar += hisse.karZarar;
                        aylar[i].getElementsByTagName("td")[1].innerText = mevcutKarZarar;
                        found = true;
                        break;
                    }
                }

                if (!found) {
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
    </script>
</body>

</html>