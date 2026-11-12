<?php
use App\Controllers\AccueilController;
use App\Controllers\DataController;
use App\Controllers\ConnectionController;
use Slim\App;
return function (App $app) {
    $app->get('/', [AccueilController::class, 'index']);
    $app->get('/data', [DataController::class, 'render']);
    $app->get('/signup', [ConnectionController::class, 'afficherFormulaire']);
    $app->post('/signup', [ConnectionController::class, 'traiterFormulaire']);
};
