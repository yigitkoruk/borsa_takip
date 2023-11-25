<?php
include_once "../models/model.php";
$model = new MODEL();

date_default_timezone_set('Europe/Istanbul');
$saat = date('H');
$gün = date('d');
$ay = date("F");

$list = $model->hisseList();
$row = $model->gunlukHisse2();

$toplamKarZarar = 0;
foreach ($list as $item) {
    $toplamKarZarar += $item["kar_zarar"];
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
