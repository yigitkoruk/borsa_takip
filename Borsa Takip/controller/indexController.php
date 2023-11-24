<?php
include "../models/model.php";
$model = new MODEL();
date_default_timezone_set('Europe/Istanbul');
$saat = date('H');
$gün = date('d');
$ay = date("F");
$list = $model->hisseList();
$gunlukKarZarar = $model->gunlukKarZarar();
$row = $model->gunlukHisse2();
$aylikKarZarar = $model->aylıkKarZararListe();

$toplamKarZarar = 0;
foreach ($list as $item) {
    $toplamKarZarar += $item["kar_zarar"];
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

        $hisseBilgisi = [
            "value1" => $hisseAdi,
            "value2" => $alisMaliyeti,
            "value3" => $satisFiyati,
            "value4" => $adet,
            "value5" => $karZarar,
        ];
        $model->hisseEkleme($hisseBilgisi);
        header("Location: index.php");
    }
}

if (isset($_POST["sat"])) {
    if ($_POST["checkbox"] == TRUE) {
        $id = $_POST["hidden"];

        $model->hisseSat($id);
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

if ($saat == '18') {
    foreach ($list as $item) {
        $hisseBilgisi = [
            "value1" => $item["id"],
            "value2" => $item["alis_maliyeti"],
            "value3" => $item["guncel_fiyat"],
            "value4" => $item["adet"],
            "value5" => $item["kar_zarar"],
            "value6" => $ay,
        ];
        $model->gunlukHisse($hisseBilgisi);
    }

    $hisseBilgisi = [
        "value1" => $toplamKarZarar,
        "value2" => $gün,
        "value3" => $ay,
    ];
    $model->toplamGunlukKarZarar($hisseBilgisi);
}

if ($gün == 1) {
    $aylıkHesapama = $model->aylıkHesaplama($ay);
    
    foreach ($aylıkHesapama as $item) {
        $aylıkKarZarar += $item["kar_zarar"];
    }

    $hisseBilgisi = [
        "value1" => $ay,
        "value2" => $aylıkKarZarar,
    ];
    $model->aylıkKarZarar($hisseBilgisi);
}
