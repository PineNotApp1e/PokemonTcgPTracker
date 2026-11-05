<?php
use App\Controllers\AccueilController;
use App\Controllers\EquipesController;
use Slim\App;
return function (App $app) {
    $app->get('/', [AccueilController::class, 'index']);
    $app->get('/equipes', [EquipesController::class, 'getAllEquipes']);
};