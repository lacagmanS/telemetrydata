<?php
/**
 * RegisterUserController.php
 *
 *
 * @author CF Ingrams - cfi@dmu.ac.uk
 * @copyright De Montfort University
 * @package Telemetry
 */

namespace Telemetry;

class LoginStatusController
{

    public function createHtmlOutput(object $container, object $request, object $response): void
    {
        $tainted_parameters = $request->getParsedBody();

        $view = $container->get('view');
        $settings = $container->get('settings');

        $validator = $container->get('validator');


        $loginstatus_model = $container->get('LoginStatusModel');
        $loginstatus_view = $container->get('LoginStatusView');
        $bcrypt_wrapper = $container->get('bcryptWrapper');
        $database_connection_settings = $settings['doctrine_settings'];
        $doctrine_queries = $container->get('doctrineSqlQueries');

        $cleaned_parameters = $loginstatus_model->cleanupParameters($validator, $tainted_parameters);


        $storage_result = $loginstatus_model->authenticateUser($database_connection_settings, $doctrine_queries, $cleaned_parameters, $bcrypt_wrapper);
        $loginsucess = $loginstatus_model->loginSuccess($storage_result);

        $loginstatus_view->CreateLoginStatusView($view, $response, $settings, $storage_result, $loginsucess);
    }
}