<?php
include "../controller/toplamKarZararController.php";
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
    </div>
    <br><br>
</body>

<?php include "partials/footer.php"; ?>