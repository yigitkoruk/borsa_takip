<?php
include "../models/model.php";
$model = new MODEL();
$gunlukKarZarar = $model->gunlukKarZarar();

include "../views/partials/contents/gunlukKarZararContents.php";