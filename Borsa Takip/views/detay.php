<?php include "../controller/detayControl.php";
include "partials/header.php";
?>

<body>
    <div class="container">
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
    </div>
</body>

<?php include "partials/footer.php"; ?>