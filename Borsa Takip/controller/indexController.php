<?php
include "backRound.php";
include_once "../models/model.php";
session_start();
$model = new MODEL();
$list = $model->hisseList();
$row = $model->gunlukHisse2();

$toplamKarZarar = 0;
foreach ($list as $item) {
    $toplamKarZarar += $item["kar_zarar"];
}

//Sat butonuna tıklandığında.
if (isset($_POST["sat"])) {
    if ($_POST["checkbox"] == TRUE) {
        $_SESSION["id"] = $_POST["hidden"];
        header("Location: sat.php");
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
