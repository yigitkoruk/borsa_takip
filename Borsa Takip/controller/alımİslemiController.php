<?php
include "../models/model.php";
$model = new MODEL();

//Ekle butonuna tıklandığında.
if (isset($_POST["ekle"])) {
    $hisseAdi = trim($_POST["hisseAdi"]);
    $alisMaliyeti = trim($_POST["alisMaliyeti"]);
    $satisFiyati = trim($_POST["satisFiyati"]);
    $adet = trim($_POST["adet"]);

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

    //Tüm koşullar sağlanır ve hata oluşmaz ise ekleme işlemi gerçekleşir.
    if (empty($hisseAdi_Hata) && empty($alisMaliyeti_Hata) && empty($satisFiyati_Hata) && empty($Adet_Hata)) {
        $karZarar = (floatval(str_replace(array('.', ','), '', $satisFiyati)) - floatval(str_replace(array('.', ','), '', $item["alis_maliyeti"]))) * $adet;
        $karZarar = number_format($karZarar, 2, ',');

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
