<?php
include "../models/model.php";

$sql = "SELECT * FROM  hisseler WHERE islem_durumu = true";
$list = $connect->query($sql);

$aylıkKarZarar = 0;
foreach ($list as $item) {
    $aylıkKarZarar += $item["kar_zarar"];
}

if (isset($_POST["ekle"])) {
    $hisseAdi = $_POST["hisseAdi"];
    $alisMaliyeti = $_POST["alisMaliyeti"];
    $satisFiyati = $_POST["satisFiyati"];
    $adet = $_POST["adet"];

    if (empty($hisseAdi)) {
        $hisseAdi_Hata = '<p style="font-size: 13px; color: red;">Lütfen hisse adı giriniz!</p>';
    }

    if (empty($alisMaliyeti)) {
        $alisMaliyeti_Hata = '<p style="font-size: 13px; color: red;">Lütfen hisse maliyeti giriniz!</p>';
    }

    if (empty($satisFiyati)) {
        $satisFiyati_Hata = '<p style="font-size: 13px; color: red;">Lütfen güncel fiyat giriniz!</p>';
    }

    if (empty($adet)) {
        $Adet_Hata = '<p style="font-size: 13px; color: red;">Lütfen adet giriniz!</p>';
    }

    if (empty($hisseAdi_Hata) && empty($alisMaliyeti_Hata) && empty($satisFiyati_Hata) && empty($Adet_Hata)) {
        $karZarar = ($satisFiyati - $alisMaliyeti) * $adet;
        $tarih = date("F");

        $sql = "INSERT INTO hisseler (hisse_adi, alis_maliyeti, guncel_fiyat, adet, kar_zarar) VALUES ('$hisseAdi', $alisMaliyeti, $satisFiyati, $adet, $karZarar)";

        if ($connect->query($sql) === TRUE) {
            echo "Veri başarıyla eklendi.";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
        $connect->close();
        header("Location: index.php");
    }
}

if (isset($_POST["sat"])) {
    if ($_POST["checkbox"] == TRUE) {
        $id = $_POST["hidden"];
        $false = "false";

        $updateSql = "UPDATE hisseler SET islem_durumu = $false WHERE id = $id";
        $connect->query($updateSql);
        header("Location: index.php");
    } else {
        $_POST["checkbox"] == false;
        header("Location: index.php");
    }
}

if (isset($_POST["detay"])) {
    session_start();
    $_SESSION["id"] = $_POST["hidden"];
    header("Location: detay.php");
}
