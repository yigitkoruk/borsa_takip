<?php
include_once "../models/model.php";
session_start();
$id = $_SESSION["id"];
$model = new MODEL();

if (isset($_POST["sat"])) {
    $satisFiyati = $_POST["satisFiyati"];
    if (empty($satisFiyati)) {
        $satisFiyati_Hata = '<p style="font-size: 13px; color: red;"><b>Lütfen satış fiyatı giriniz!</b></p>';
    } else {
        $hisseDetay = $model->hisseDetay($id);
        @$karZarar = ($satisFiyati - $hisseDetay[0]["alis_maliyeti"]) * $hisseDetay[0]["adet"];
        // echo $karZarar;
        // exit();
        $hisseBilgisi = [
            "value1" => $satisFiyati,
            "value2" => $karZarar,
            "value3" => false,
        ];
        $model->hisseSat($id, $hisseBilgisi);
        header("Location: index.php");
    }
}
