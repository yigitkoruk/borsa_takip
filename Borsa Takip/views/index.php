<?php
include "../controller/indexController.php";
include "partials/header.php";
include "partials/navbar.php";
?>

<body>
    <div class="container">
        <h2>Alış Satış İşlemleri</h2>
        <form id="borsaForm" method="POST">
            <label for="hisseAdi">Hisse Adı:</label>
            <input type="text" id="hisseAdi" name="hisseAdi">
            <?= $hisseAdi_Hata ?? "" ?><br>

            <label for="alisMaliyeti">Alış Maliyeti:</label>
            <input type="text" id="alisMaliyeti" name="alisMaliyeti">
            <?= $alisMaliyeti_Hata ?? "" ?><br>

            <label for="satisFiyati">Güncel Fiyat:</label>
            <input type="text" id="satisFiyati" name="satisFiyati">
            <?= $satisFiyati_Hata ?? "" ?><br>

            <label for="adet">Adet:</label>
            <input type="number" id="adet" name="adet">
            <?= $Adet_Hata ?? "" ?><br>

            <input type="submit" name="ekle" value="Ekle">
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
                                <input type="submit" value="Detay" name="detay">
                                <input type="submit" value="Sat" name="sat">
                                <input type="checkbox" name="checkbox">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <br><br>
</body>

<?php include "partials/footer.php"; ?>