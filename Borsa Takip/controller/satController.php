<?php
include_once "../models/model.php";
session_start();
$id = $_SESSION["id"];
$model = new MODEL();

if (isset($_POST["sat"])) {
    $satisFiyati = $_POST["satisFiyati"];
    $satisAdet = $_POST["satisAdet"];
    if (empty($satisFiyati)) {
        $satisFiyati_Hata = '<p style="font-size: 13px; color: red;"><b>Lütfen satış fiyatı giriniz!</b></p>';
    } else {
        $hisseDetay = $model->hisseDetay($id);
        @$karZarar = ($satisFiyati - $hisseDetay[0]["alis_maliyeti"]) * $satisAdet;
        $adet = $hisseDetay[0]["adet"] - $satisAdet;
        if ($hisseDetay[0]["adet"] == $satisAdet) {
            $islemDurumu = false;
        } else {
            $islemDurumu = true;
        }

        $hisseBilgisi = [
            "value1" => $adet,
            "value2" => $islemDurumu,
        ];
        $model->hisseSat($id, $hisseBilgisi);
    
        $hisseBilgisi = [
            "value1" => $hisseDetay[0]["id"],
            "value2" => $hisseDetay[0]["alis_maliyeti"],
            "value3" => $satisFiyati,
            "value4" => $satisAdet,
            "value5" => $karZarar,
        ];
        $model->satımIslemi($hisseBilgisi);
        header("Location: index.php");
    }
}
