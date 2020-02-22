<?php

$app->get('/', function ($req, $res, $args) {
    return $this->view->render($res, 'home.phtml', ['title' => "Systema de Saldo"]);
})->setName('home');

$app->get('/login', function ($req, $res, $args) {
    return $this->view->render($res, 'formLogin.phtml', ['title' => "Entrar"]);
})->setName('formLogin');