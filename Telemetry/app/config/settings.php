<?php
/**
 * Created by PhpStorm.
 * User: slim
 * Date: 13/10/17
 * Time: 12:33
 */

declare (strict_types = 1);

use DI\Container;


// callback function to make settings available in an array

return function (Container $container, string $app_dir)
{

    $app_url = dirname($_SERVER['SCRIPT_NAME']);

    $container->set(
        'settings',
        function()
        use ($app_dir, $app_url)
        {
            return [
                'application_name' => 'Telemetry Data',
                'landing_page' => '/ctec3110/lab_07/Telemetry/',
                '$log_file_path' => '/p3t/phpappfolder/logs/',
                'css_path' => $app_url . '/css/standard.css',
                'displayErrorDetails' => true,
                'logErrorDetails' => true,
                'logErrors' => true,
                'addContentLengthHeader' => false,
                'mode' => 'development',
                'debug' => true,
                'bcrypt_cost' => 12,
                'bcrypt_algorithm' => PASSWORD_DEFAULT,
                'view' => [
                    'template_path' => $app_dir . 'templates/',
                    'cache_path' => $app_dir . 'cache/',
                    'twig' => [
                        'cache' => false,
                        'auto_reload' => true
                    ],
                ],
                'doctrine_settings' => [
                    'rdbms' => 'mysql',
                    'driver' => 'pdo_mysql',
                    'host' => 'localhost',
                    'dbname' => 'telemetrydatabase',
                    'db_name' => 'telemetrydatabase',
                    'user_name' => 'telemetry',
                    'port' => '3306',
                    'user' => 'telemetry',
                    'user_password' => 'telemetry_user_pass',
                    'password' => 'telemetry_user_pass',

                    'charset' => 'utf8mb4',
                    'options' => [

            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => true,
        ],



                ],
            ];
        }
    );
};
