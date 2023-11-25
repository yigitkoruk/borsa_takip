<?php
include "../controller/aylıkKarZararController.php";
include "partials/header.php";
include "partials/navbar.php";
?>

<body>
    <div class="container">
        <h2>Aylık Kar/Zarar Tablosu</h2>
        <table id="aylikKarZararTablosu">
            <tr>
                <th>Ay</th>
                <th>Kar/Zarar</th>
            </tr>
            <?php foreach ($aylikKarZarar as $aylikKarZarar) : ?>
                <tr>
                    <td><?= $aylikKarZarar["ay"] ?? "" ?></td>
                    <td><?= $aylikKarZarar["kar_zarar"] ?? "" ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <br><br>
</body>

<?php include "partials/footer.php"; ?>