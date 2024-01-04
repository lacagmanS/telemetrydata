<?php

declare (strict_types=1);

use Encryption\HomePageController;
use Encryption\HomePageView;

use DI\Container;
use Slim\Views\Twig;
use Slim\App;

// Register components in a container

return function (Container $container, App $app) {
    $settings = $container->get('settings');
    $template_path = $settings['view']['template_path'];
    $cache_path = $settings['view']['cache_path'];

    $container->set(
        'view',
        function ()
        use ($template_path, $cache_path) {
            {
                return Twig::create($template_path, ['cache' => false]);
            }
        }
    );

    /**
     * Using Doctrine
     * @param $c
     * @return \Doctrine\ORM\EntityManager
     * @throws \Doctrine\ORM\Exception\ORMException
     */

    $container->set('em', function ($c) {
        $settings = $c->get('settings');
        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
            $settings['doctrine']['meta']['entity_path'],
            $settings['doctrine']['meta']['auto_generate_proxies'],
            $settings['doctrine']['meta']['proxy_dir'],
            $settings['doctrine']['meta']['cache'],
            false
        );
        return \Doctrine\ORM\EntityManager::create($settings['doctrine']['connection'], $config);
    });

    $container->set('homePageController', function () {
        $controller = new Telemetry\HomePageController();
        return $controller;
    });

    $container->set('homePageView', function () {
        $view = new Telemetry\HomePageView();
        return $view;
    });

    $container->set('registerUserController', function () {
        return new Telemetry\RegisterUserController();
    });

    $container->set('registerUserModel', function () {
        return new Telemetry\RegisterUserModel();
    });

    $container->set('registerUserView', function () {
        return new Telemetry\RegisterUserView();
    });

    $container->set('validator', function () {
        $validator = new Telemetry\Validator();
        return $validator;
    });

    $container->set('libSodiumWrapper', function () {
        return new Telemetry\LibSodiumWrapper();
    });

    $container->set('base64Wrapper', function () {
        return new Telemetry\Base64Wrapper();
    });

    $container->set('bcryptWrapper', function () {
        return new Telemetry\BcryptWrapper();
    });

    $container->set('doctrineSqlQueries', function () {
        return new Telemetry\DoctrineSqlQueries();
    });
    $container->set('TelemetryAttemptView', function () {
        return new Telemetry\TelemetryAttemptView();
    });
    $container->set('TelemetryAttemptController', function () {
        return new Telemetry\TelemetryAttemptController();
    });
    $container->set('TelemetryAttemptModel', function () {
        return new Telemetry\TelemetryAttemptModel();
    });
    $container->set('soapWrapper', function () {
        return new Telemetry\SoapWrapper();
    });
    $container->set('DisplayStoredDataModel', function () {
        return new Telemetry\DisplayStoredDataModel();
    });
    $container->set('displayStoredDataController', function () {
        return new Telemetry\displayStoredDataController();
    });
    $container->set('DatabaseWrapper', function () {
        return new Telemetry\DatabaseWrapper();
    });
    $container->set('sqlQueries', function () {
        return new Telemetry\SQLQueries();
    });
    $container->set('TelemetryDetailsController', function () {
        return new Telemetry\TelemetryDetailsController();
    });
    $container->set('TelemetryDetailsView', function () {
        return new Telemetry\TelemetryDetailsView();
    });
    $container->set('LoginUserController', function () {
        return new Telemetry\LoginUserController();
    });
    $container->set('LoginUserView', function () {
        return new Telemetry\LoginUserView();
    });
    $container->set('LoginStatusController', function () {
        return new Telemetry\LoginStatusController();
    });
    $container->set('LoginStatusModel', function () {
        return new Telemetry\LoginStatusModel();
    });
    $container->set('LoginStatusView', function () {
        return new Telemetry\LoginStatusView();
    });





};