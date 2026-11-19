<?php
use App\Controllers\AccueilController;
use App\Controllers\DataController;
use App\Controllers\ConnectionController;
use Slim\App;
return function (App $app) {
    $app->get('/', [AccueilController::class, 'index']);
    $app->post('/data', [ConnectionController::class, 'Connection']);
    $app->get('/signup', [ConnectionController::class, 'afficherFormulaire']);
    $app->post('/signup', [ConnectionController::class, 'traiterFormulaire']);
    $app->get('/signin', [ConnectionController::class, 'ConnectionFormulaire']);

};
