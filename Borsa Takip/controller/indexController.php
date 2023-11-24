<?php
include "../models/model.php";
$model = new MODEL();
date_default_timezone_set('Europe/Istanbul');
$saat = date('H');
$gün = date('d');
$list = $model->hisseList();
$gunlukKarZarar = $model->gunlukKarZarar();
$row = $model->gunlukHisse2();

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

$toplamKarZarar = 0;

if ($saat == '18') {
    foreach ($list as $item) {
        $dunkiKarZarar = $bugunkuKarZarar = 0;
        $id = $item["id"];
        $alisMaliyeti = $item["alis_maliyeti"];
        $satisFiyati = $item["guncel_fiyat"];
        $adet = $item["adet"];
        $karZarar = $item["kar_zarar"];

        $dunkiKarZarar = $model->dunkiKarZarar($id);
        $dunkiKarZarar = $dunkiKarZarar[0]["kar_zarar"];
        $bugunkuKarZarar = $karZarar - $dunkiKarZarar;

        $hisseBilgisi = [
            "value1" => $id,
            "value2" => $alisMaliyeti,
            "value3" => $satisFiyati,
            "value4" => $adet,
            "value5" => $bugunkuKarZarar,
        ];
        $model->gunlukHisse($hisseBilgisi);
    }

    $veri = $model->karZarar();
    $sonKarZarar = $veri[0]["kar_zarar"];
    $sonKarZarar -= $toplamKarZarar;

    $hisseBilgisi = [
        "value1" => $sonKarZarar,
        "value2" => $gün,
    ];
    $model->toplamGunlukKarZarar($hisseBilgisi);
}

if ($gün == 1) {
    $gecenAyKarZarar = $model->gecenAyKarZarar();
    $aylıkKarZarar = $toplamKarZarar - $gecenAyKarZarar;

    $hisseBilgisi = [
        "value1" => $aylıkKarZarar,
    ];
    $model->aylıkKarZarar($hisseBilgisi);
}

// $gunler = array('Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi');
// $bugunun_gunu = date('w');
// $gun = $gunler[$bugunun_gunu];

// if ($gun == "Cuma") {
// $gecmisHaftaKarZarar = $model->gecmisHaftaKarZarar();

// $karZarar = $karZarar - $gecmisHaftaKarZarar;

// }