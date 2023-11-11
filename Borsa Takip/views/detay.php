<?php include "../controller/detayControl.php";
include "partials/header.php";
?>

<body>
    <div class="container" id="1">
        <a href="index.php"><i class="fa-solid fa-circle-chevron-left" style="color: #d01b1b; font-size: xxx-large;"></i></a>
    <h1 style="text-align: center;">Hisse Güncelleme</h1>
        <form id="borsaForm" method="POST">
            <label for="hisseAdi">Hisse Adı:</label>
            <input type="text" id="hisseAdi" name="hisseAdi" value="<?= $row["hisse_adi"] ? $row["hisse_adi"] : "Hata" ?>">
            <?= $hisseAdi_Hata ?? "" ?><br>

            <label for="alisMaliyeti">Alış Maliyeti:</label>
            <input type="number" id="alisMaliyeti" name="alisMaliyeti" value="<?= $row["alis_maliyeti"] ? $row["alis_maliyeti"] : "Hata" ?>">
            <?= $alisMaliyeti_Hata ?? "" ?><br>

            <label for="satisFiyati">Güncel Fiyat:</label>
            <input type="number" id="satisFiyati" name="satisFiyati" value="<?= $row["guncel_fiyat"] ? $row["guncel_fiyat"] : "Hata" ?>">
            <?= $satisFiyati_Hata ?? "" ?><br>

            <label for="adet">Adet:</label>
            <input type="number" id="adet" name="adet" value="<?= $row["adet"] ? $row["adet"] : "Hata" ?>">
            <?= $Adet_Hata ?? "" ?><br>

            <input type="submit" name="guncelle" value="Güncelle">
        </form>

        <table>
            <h2>Alış Satış İşlemleri</h2>
            <thead>
                <tr>
                    <th>Hisse Adı</th>
                    <th>Alış Maliyeti</th>
                    <th>Satış Fiyatı</th>
                    <th>Adet</th>
                    <th>Kar/Zarar</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td><?= $item["hisse_adi"] ?? "" ?></td>
                        <td><?= $item["alis_maliyeti"] ?? "" ?></td>
                        <td><?= $item["guncel_fiyat"] ?? "" ?></td>
                        <td><?= $item["adet"] ?? "" ?></td>
                        <td><?= $item["kar_zarar"] ?? "" ?></td>
                    </tr>
            </tbody>
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
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td><?= $item["hisse_adi"] ?? "" ?></td>
                        <td><?= $item["alis_maliyeti"] ?? "" ?></td>
                        <td><?= $item["guncel_fiyat"] ?? "" ?></td>
                        <td><?= $item["adet"] ?? "" ?></td>
                        <td><?= $item["kar_zarar"] ?? "" ?></td>
                    </tr>
            </tbody>
        </table>

<br><br>
    <center>
        <a href="#1">
            <i class="fa-solid fa-circle-chevron-up" style="color: #d01b1b; font-size: xxx-large;"></i>
        </a>    
    </center>
</div>
</body>

<?php include "partials/footer.php"; ?>