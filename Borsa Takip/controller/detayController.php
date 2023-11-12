<?php
include "../models/model.php";
$model = new MODEL();

session_start();
$id = $_SESSION["id"];
$hisseDetay = $model->hisseDetay($id);

if (isset($_POST["guncelle"])) {
    $hisseAdi = $_POST["hisseAdi"] ?? "";
    $alisMaliyeti = $_POST["alisMaliyeti"] ?? "";
    $satisFiyati = $_POST["satisFiyati"] ?? "";
    $adet = $_POST["adet"] ?? "";

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
        $id = $_SESSION["id"];
        $hisseBilgisi = [
            "value1" => $hisseAdi,
            "value2" => $alisMaliyeti,
            "value3" => $satisFiyati,
            "value4" => $adet,
            "value5" => $karZarar,
        ];

        $stmt = $model->hisseGuncelleme($id, $hisseBilgisi);

        if ($stmt) {
            header("Location: index.php");
        } else {
            echo "Hata oluştu!";
        }
    }
}
