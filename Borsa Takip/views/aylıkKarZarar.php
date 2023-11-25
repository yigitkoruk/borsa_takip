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
            <?php
            foreach ($aylikKarZarar as $karZarar) :
                // Türkçe ay isimlerini içeren dizi
                $turkceAylar = [
                    "January"   => "Ocak",
                    "February"  => "Şubat",
                    "March"     => "Mart",
                    "April"     => "Nisan",
                    "May"       => "Mayıs",
                    "June"      => "Haziran",
                    "July"      => "Temmuz",
                    "August"    => "Ağustos",
                    "September" => "Eylül",
                    "October"   => "Ekim",
                    "November"  => "Kasım",
                    "December"  => "Aralık"
                ];

                // Verilen ay isminin Türkçe karşılığını bulma
                if (isset($turkceAylar[$karZarar["ay"]])) {
                    $ay = $turkceAylar[$karZarar["ay"]];
                }
            ?>
                <tr>
                    <td><?= $ay ?? "" ?></td>
                    <td><?= $karZarar["kar_zarar"] ?? "" ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <br><br>
</body>

<?php include "partials/footer.php"; ?>