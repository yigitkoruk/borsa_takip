<?php
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

            <label for="adet">Adet:</label>
            <input type="number" id="adet" name="adet">
            <?= $Adet_Hata ?? "" ?><br>

            <input type="submit" name="ekle" value="Ekle">
        </form>
        <br><br>
</body>

<?php include "partials/footer.php"; ?>