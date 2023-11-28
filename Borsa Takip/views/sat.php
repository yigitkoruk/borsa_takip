<?php
include "../controller/satController.php";
include "partials/header.php";
include "partials/navbar.php";
?>

<body>
    <div class="container">
        <h2>Satış Fiyatı</h2>
        <form id="borsaForm" method="POST">
            <label for="satisFiyati">Fiyat:</label>
            <input type="text" id="satisFiyati" name="satisFiyati">
            <?= $satisFiyati_Hata ?? "" ?><br>

            <input type="submit" name="sat" value="Sat">
        </form>
    </div>
    <br><br>
</body>

<?php include "partials/footer.php"; ?>