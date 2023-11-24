<?php include "../controller/detayController.php";
include "partials/header.php";
?>

<body>
    <div class="container" id="1">
        <a href="index.php"><i class="fa-solid fa-circle-chevron-left" style="color: #d01b1b; font-size: xxx-large;"></i></a>
        <h1 style="text-align: center;">Hisse Güncelleme</h1>
        <form id="borsaForm" method="POST">
            <label for="hisseAdi">Hisse Adı:</label>
            <input type="text" id="hisseAdi" name="hisseAdi" value="<?= $hisseDetay[0]["hisse_adi"] ? $hisseDetay[0]["hisse_adi"] : "Hata" ?>">
            <?= $hisseAdi_Hata ?? "" ?><br>

            <label for="alisMaliyeti">Alış Maliyeti:</label>
            <input type="number" id="alisMaliyeti" name="alisMaliyeti" value="<?= $hisseDetay[0]["alis_maliyeti"] ? $hisseDetay[0]["alis_maliyeti"] : "Hata" ?>">
            <?= $alisMaliyeti_Hata ?? "" ?><br>

            <label for="satisFiyati">Güncel Fiyat:</label>
            <input type="number" id="satisFiyati" name="satisFiyati" value="<?= $hisseDetay[0]["guncel_fiyat"] ? $hisseDetay[0]["guncel_fiyat"] : "Hata" ?>">
            <?= $satisFiyati_Hata ?? "" ?><br>

            <label for="adet">Adet:</label>
            <input type="number" id="adet" name="adet" value="<?= $hisseDetay[0]["adet"] ? $hisseDetay[0]["adet"] : "Hata" ?>">
            <?= $Adet_Hata ?? "" ?><br>

            <input type="submit" name="guncelle" value="Güncelle">
        </form>

        <h2>Hisse Kar/Zarar</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Gün</th>
                    <th>Kar/Zarar</th>
                </tr>
            </thead>
            <?php foreach ($hisseKarZarar as $hisse) : ?>
                <tr>
                    <td><?= $hisse["id"] ?? "" ?></td>
                    <td><?= $hisse["gun"] ?? "" ?></td>
                    <td><?= $hisse["kar_zarar"] ?? "" ?></td>
                </tr>
            <?php endforeach; ?>
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