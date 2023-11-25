<?php
include_once "../models/model.php";
$model = new MODEL();

//Sistem saati türkiye olarak ayarlandı.
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

//Saat 18 olduğunda gerçekleşecek işlemler.
//Her borsa kapanışında her hisseenin tekrar kayıdını alarak hisse bazlı kar ve zararı hesaplanır.
//Her borsa kapanışında tüm hisselerin toplam kar ve zararı hesaplanır.
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

//Ayın 1. günü gerçekleşecek işlemler.
//Her işlem gerçekleştiğinde ay koşulu sağlanarak günlük kar ve zararları hesaplayarak aylık kar ve zararlar hesaplanır.
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
