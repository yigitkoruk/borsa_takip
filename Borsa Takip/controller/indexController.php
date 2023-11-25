<?php
include "backRound.php";
include_once "../models/model.php";
$model = new MODEL();
$list = $model->hisseList();
$row = $model->gunlukHisse2();

//Ekle butonuna tıklandığında.
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

    //Tüm koşullar sağlanır ve hata oluşmaz ise ekleme işlemi gerçekleşir.
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

//Sat butonuna tıklandığında.
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

//Detay botunona tıklandığında.
if (isset($_POST["detay"])) {
    session_start();
    $_SESSION["id"] = $_POST["hidden"];
    header("Location: detay.php");
}
