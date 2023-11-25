<?php
include "../models/model.php";
$model = new MODEL();

$list = $model->hisseList();

$toplamKarZarar = 0;
foreach ($list as $item) {
    $toplamKarZarar += $item["kar_zarar"];
}
