<?php

$userAuth = new \Middleware\Auth();

//User Routes
$app->post('/user', \Controller\User\UserController::class . ':create');
$app->post('/user/{id}', \Controller\User\UserController::class . ':update');

//Trader Routes
$app->post('/trader', \Controller\Trader\TraderController::class . ':create');
$app->get('/trader/current', \Controller\Trader\TraderController::class . ':me')->add($userAuth);
$app->post('/trader/profile', \Controller\Trader\ProfileController::class . ':set')->add($userAuth);
$app->post('/trader/location', \Controller\Trader\LocationController::class . ':add')->add($userAuth);
$app->get('/trader/{id}', \Controller\Trader\TraderController::class . ':get');
$app->post('/trader/tag/{id}', \Controller\Trader\TagController::class . ':add')->add($userAuth);

$app->get('/tag/autocomplete', \Controller\TagController::class . ':autocomplete');

$app->post('/login', \Controller\LoginController::class . ':login');
$app->get('/search', \Controller\SearchController::class . ':search');
