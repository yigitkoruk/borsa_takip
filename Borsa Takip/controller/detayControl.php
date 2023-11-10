<?php
include "../models/model.php";

session_start();
$id = $_SESSION["id"];

$sql = "SELECT * FROM hisseler WHERE id = $id";
$details = $connect->query($sql);
$row = $details->fetch_assoc();

if (isset($_POST["guncelle"])) {
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
        $id = $_SESSION["id"];
        $sql = "UPDATE hisseler SET hisse_adi = $hisseAdi, alis_maliyeti = $alisMaliyeti, guncel_fiyat = $satisFiyati, adet = $adet WHERE id = $id";
        $connect->query($sql);

        if ($connect->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Hata oluştu: " . $connect->error;
        }
    }
}
