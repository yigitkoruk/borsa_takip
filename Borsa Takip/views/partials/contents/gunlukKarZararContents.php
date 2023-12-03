<?php
include "partials/header.php";
include "partials/navbar.php";
?>

<body>
    <div class="container">
        <h2>Günlük Kar/Zarar</h2>
        <table>
            <thead>
                <tr>
                    <th>Gün</th>
                    <th>Kar/Zarar</th>
                </tr>
            </thead>
            <?php foreach ($gunlukKarZarar as $gunKarZarar) : ?>
                <tr>
                    <td><?= $gunKarZarar["tarih"] ?? "" ?></td>
                    <td><?= $gunKarZarar["kar_zarar"] ?? "" ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <br><br>
</body>

<?php include "partials/footer.php"; ?>