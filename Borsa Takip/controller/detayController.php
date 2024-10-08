<?php
include "../models/model.php";
$model = new MODEL();

session_start();
$id = $_SESSION["id"];
$hisseDetay = $model->hisseDetay($id);
$hisseKarZarar = $model->hisseKarZarar($id);

//Güncelle butonuna basıldığında.
if (isset($_POST["guncelle"])) {
    $hisseAdi = $_POST["hisseAdi"] ?? "";
    $alisMaliyeti = str_replace(',', '.', $_POST["alisMaliyeti"]) ?? "";
    $satisFiyati = str_replace(',', '.', $_POST["satisFiyati"]) ?? "";
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

    //Tüm koşullar doğrulanır ve hata olmaz ise güncelleme işlemi gerçekleşir.
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

        //Güncelleme işleminin doğrulaması yapılır.
        if ($stmt) {
            header("Location: index.php");
        } else {
            echo "Hata oluştu!";
        }
    }
}


include "../views/partials/contents/detayContents.php";