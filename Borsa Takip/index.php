<?php include "control.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borsa Takip Sayfası</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Borsa Takip Sayfası</h1>
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

            <!--<button type="button" onclick="ekle()">Ekle</button>-->
            <input type="submit" name="ekle" value="Ekle">
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
    <script src="script.js"></script>
</body>

</html>