<?php
include_once "../models/model.php";
$model = new MODEL();

//Sistem saati türkiye olarak ayarlandı.
date_default_timezone_set('Europe/Istanbul');
$saat = date('H');
$dk = date('i');
$gün = date('d');
$ay = date("F");

$list = $model->hisseList();
$row = $model->gunlukHisse2();

$toplamKarZarar = 00.00;
foreach ($list as $item) {
    $toplamKarZarar += $item["kar_zarar"];
}

//Saat 18:30 olduğunda gerçekleşecek işlemler.
//Her borsa kapanışında her hisseenin tekrar kayıdını alarak hisse bazlı kar ve zararı hesaplanır.
//Her borsa kapanışında tüm hisselerin toplam kar ve zararını hesaplanır.
$islemZamanı = $saat . ":" . $dk;
if ($islemZamanı == '18:30') {
    foreach ($list as $item) {
        // Kullanıcının girdiği hisse adını al
        $stockSymbol = $item["hisse_adi"];

        // Formdan gelen veriyi içeren URL'yi oluştur
        $url = "https://www.google.com/finance/quote/{$stockSymbol}:IST?hl=tr";

        if (file_get_contents($url) !== null) {
            $html = file_get_contents($url);
        } else {
            header("Location: index.php");
        }

        // DOMDocument ile HTML'i işlemeden önce uygun hale getirme
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        // XPath nesnesini oluştur
        $xpath = new DOMXPath($dom);

        // data-last-price değerlerini al
        $guncelFiyat = $xpath->query('//div[@data-last-price]')->item(0)->getAttribute('data-last-price');

        $karZarar = ($guncelFiyat - (float) $item["alis_maliyeti"]) * $item["adet"];

        $hisseBilgisi = [
            "value1" => $item["id"],
            "value2" => $item["alis_maliyeti"],
            "value3" => $guncelFiyat,
            "value4" => $item["adet"],
            "value5" => $karZarar,
            "value6" => $ay,
        ];
        $model->gunlukHisse($hisseBilgisi);
        $id = $item["id"];
        $hisseBilgisi = [
            "value1" => $guncelFiyat,
            "value2" => $karZarar,
        ];
        $model->guncelleme1830($id, $hisseBilgisi);
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
$gün = 1;
if ($gün == 1) {
    $oncekiAy = [
        "January"   => "December",
        "February"  => "January",
        "March"     => "February",
        "April"     => "March",
        "May"       => "April",
        "June"      => "May",
        "July"      => "June",
        "August"    => "July",
        "September" => "August",
        "October"   => "September",
        "November"  => "October",
        "December"  => "November"
    ];
    $ay = $oncekiAy[$ay];
    $aylıkHesapama = $model->aylıkHesaplama($ay);

    $aylıkKarZarar = 0;
    foreach ($aylıkHesapama as $item) {
        $aylıkKarZarar += (float) $item["kar_zarar"];
    }
    $aylıkKarZarar = number_format($aylıkKarZarar, 2, ',', '.');

    $hisseBilgisi = [
        "value1" => $ay,
        "value2" => $aylıkKarZarar,
    ];
    $model->aylıkKarZarar($hisseBilgisi);
}
