<?php
include "../controller/indexController.php";
include "partials/header.php";
include "partials/navbar.php";
?>

<body>
    <div class="container">
        <h2>Toplam Kar/Zarar</h2>
        <table id="aylikKarZararTablosu">
            <tr>
                <th>Kar/Zarar</th>
            </tr>
            <tr>
                <td><?= $toplamKarZarar; ?></td>
            </tr>
        </table>

        <table>
            <h2>Pörtföy</h2>
            <thead>
                <tr>
                    <th>Hisse Adı</th>
                    <th>Alış Maliyeti</th>
                    <th>Güncel Fiyatı</th>
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