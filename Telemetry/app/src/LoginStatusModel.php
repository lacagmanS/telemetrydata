<?php
/**
 * Model.php
 *
 * stores the validated values in the relevant storage location
 *
 * Author: CF Ingrams
 * Email: <clinton@cfing.co.uk>
 * Date: 22/10/2017
 *
 *
 * @author CF Ingrams <clinton@cfing.co.uk>
 * @copyright CFI
 *
 */

namespace Telemetry;

use Doctrine\DBAL\DriverManager;

class LoginStatusModel
{

    public function __construct()
    {
    }

    public function __destruct()
    {
    }


    function cleanupParameters(object $validator, array $tainted_parameters): array
    {
        $cleaned_parameters = [];

        $tainted_username = $tainted_parameters['username'];

        $cleaned_parameters['password'] = $tainted_parameters['password'];
        $cleaned_parameters['sanitised_username'] = $validator->sanitiseString($tainted_username);

        return $cleaned_parameters;
    }


    public static function authenticateUser(
        array  $database_connection_settings,
        object $doctrine_queries,
        array  $cleaned_parameters,
               $bcrypt_wrapper
    ): string {
        $loginMessage = null;
        $is_authenticated = null;

        $database_connection = DriverManager::getConnection($database_connection_settings);

        $queryBuilder = $database_connection->createQueryBuilder();

        $is_authenticated = $doctrine_queries::queryAuthenticateUser($queryBuilder, $cleaned_parameters, $bcrypt_wrapper);

        if ($is_authenticated === 'Username and Password Correct') {
            $loginMessage = "Username and Password Correct";
        } else if ($is_authenticated === 'Incorrect Password') {
            $loginMessage = "Incorrect Password";
        } else if ($is_authenticated === 'Authentication Failed') {
            $loginMessage = "Username not recognized";
        }

        return $loginMessage;
    }

    public static function loginSuccess($loginMessage): bool {
        return $loginMessage === "Username and Password Correct";
    }
}
