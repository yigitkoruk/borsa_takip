<?php
include "../models/model.php";
$model = new MODEL();

//Ekle butonuna tıklandığında.
if (isset($_POST["ekle"])) {
    $hisseAdi = trim($_POST["hisseAdi"]);
    $alisMaliyeti = trim(str_replace(',', '.', $_POST["alisMaliyeti"]));
    $adet = trim($_POST["adet"]);

    if (empty($hisseAdi)) {
        $hisseAdi_Hata = '<p style="font-size: 13px; color: red;">Lütfen hisse adı giriniz!</p>';
    }

    if (empty($alisMaliyeti)) {
        $alisMaliyeti_Hata = '<p style="font-size: 13px; color: red;">Lütfen hisse maliyeti giriniz!</p>';
    }

    if (empty($adet)) {
        $Adet_Hata = '<p style="font-size: 13px; color: red;">Lütfen adet giriniz!</p>';
    }

    //Tüm koşullar sağlanır ve hata oluşmaz ise ekleme işlemi gerçekleşir.
    if (empty($hisseAdi_Hata) && empty($alisMaliyeti_Hata) && empty($Adet_Hata)) {
        // Formdan gelen veriyi içeren URL'yi oluştur
        $url = "https://www.google.com/finance/quote/{$hisseAdi}:IST?hl=tr";

        if ($url !== null) {
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

        $karZarar = ($guncelFiyat - $item["alis_maliyeti"]) * $adet;

        $hisseBilgisi = [
            "value1" => $hisseAdi,
            "value2" => $alisMaliyeti,
            "value3" => $guncelFiyat,
            "value4" => $adet,
            "value5" => $karZarar,
        ];
        $model->hisseEkleme($hisseBilgisi);
        header("Location: index.php");
    }
}

include "../views/partials/contents/alımİslemiContents.php";