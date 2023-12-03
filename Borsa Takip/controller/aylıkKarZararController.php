<?php
include "../models/model.php";
$model = new MODEL();
$aylikKarZarar = $model->aylıkKarZararListe();

include "../views/partials/contents/aylıkKarZararContents.php";