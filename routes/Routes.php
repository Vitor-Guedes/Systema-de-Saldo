<?php

$app->get('/', function ($req, $res, $args) {
    return $this->view->render($res, 'home.phtml', ['title' => "Systema de Saldo"]);
})->setName('home');

$app->get('/login', function ($req, $res, $args) {
    return $this->view->render($res, 'formLogin.phtml', ['title' => "Entrar"]);
})->setName('formLogin');

$app->get('/cadastro', function ($req, $res, $args) {
    return $this->view->render($res, 'formRegister.phtml', ['title' => "Cadastrar-se"]);
})->setName('formRegister');

$app->post('/auth', \App\Controller\User::class . ':authenticate')
->setName('authenticateUser');