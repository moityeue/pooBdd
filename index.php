<?php

use App\Autoloader;
use App\Models\AnnoncesModel;

require_once 'Autoloader.php';

Autoloader::register();

$model = new AnnoncesModel;

//  $annonces = $model->findBy(['actif = 0']);

//  var_dump($annonces);