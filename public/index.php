<?php

include "../vendor/autoload.php";

/** Configurações */
$config = [
    'displayErrorDetails' => true,
    'addContentLengthHeader' => false,
    'db' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'sysaldo',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ]
];

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig("../views");
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(
        new \Slim\Http\Environment($_SERVER)
    );
    $view->addExtension(
        new \Slim\Views\TwigExtension($router, $uri)
    );
    return $view;
};

$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
};
/** */

/** Error handles */
$container['errorHandler'] = function ($container) {
    return function ($req, $res, $exception) use ($container) {
        $view = $container->get('view');
        var_dump($exception->getMessage());
        $view->render($res, 'error.phtml', [
            'title' => "Erro",
            'msg' => "Ops! Ocorreu um erro."
        ]);
        return $res;
    };
};

$container['notFoundHandler'] = function ($container) {
    return function ($req, $res) use ($container) {
        $view  = $container->get('view');
        $view->render($res, 'error.phtml', [
            'title' => "Erro 404",
            'error' => "Erro 404",
            'msg' => "Ops! Página Não Encontrada."
        ]);
        return $res;
    };
};
/** */

/** Lista de rotas do systema */
include "../routes/Routes.php";
/** */

$app->run();