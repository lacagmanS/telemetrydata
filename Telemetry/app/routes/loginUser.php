<?php


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
//use Doctrine\DBAL\DriverManager;

$app->get(
    '/loginUser',
    function(Request $request, Response $response)
    use ($app)
    {
        $container = $app->getContainer();

        $login_controller = $container->get('LoginUserController');
        $login_controller->createHtmlOutput($container, $request, $response);
        return $response;
    }
);
