<?php

namespace Telemetry;

use function PHPUnit\Framework\isEmpty;

class TelemetryAttemptModel
{
    public function __construct()
    {

    }

    public function __destruct()
    {

    }

    public function telemetry_message($soap_wrapper): array
    {
        $username = '23_2762781';
        $password = 'Salahudiin@123';
        $count = 10;
        $deviceMSISDN = '+447443036857';
        $countryCode = '+44';


        $webservice_call_parameters = [
            'username' => $username,
            'password' => $password,
            'count' => $count,
            'deviceMSISDN' => $deviceMSISDN,
            'countryCode' => $countryCode,
        ];
        $webservice_function = 'readMessages';
        $soap_client_handle = $soap_wrapper->createSoapClient();
        return $soap_wrapper->performSoapCall($soap_client_handle, $webservice_function, $webservice_call_parameters);


    }

    public function parseMessage($telemetry_message): array
    {
        $parsedMessages = [];

        foreach ($telemetry_message as $mes) {
            $xmlstring = simplexml_load_string($mes);

            // Check if XML parsing was successful
            if ($xmlstring !== false) {
                $sourceMsisdn = (string)$xmlstring->sourcemsisdn;
                $destinationMsisdn = (string)$xmlstring->destinationmsisdn;
                $receivedTime = (string)$xmlstring->receivedtime;
                $bearer = (string)$xmlstring->bearer;
                $messageRef = (string)$xmlstring->messageref;
                $message = (string)$xmlstring->message;


                $messagecontent = ['sourceMsisdn' => $sourceMsisdn, 'destinationMsisdn' => $destinationMsisdn, 'receivedTime' => $receivedTime,
                    'bearer' => $bearer, 'messageRef' => $messageRef, 'message' => $message];
                $parsedMessages[] = $messagecontent;

            }
        }
        return $parsedMessages;


    }

//    public function StoreMessage($container, $cleaned_parameters)
//    {
//        $view = $container->get('view');
//        $settings = $container->get('settings');
//        $database_connection_settings = $settings['doctrine_settings'];
//
//
////        $chart_model = $container->get('companyDetailsChartModel');
//        $database_wrapper = $container->get('DatabaseWrapper');
//        $sql_queries = $container->get('sqlQueries');
//
//        $successfullyStored->StoreMessageInDatabase($cleaned_parameters, $database_connection_settings, $database_wrapper, $sql_queries);
////        $chart_model = $container->get('companyDetailsChartModel');
////        $chart_location = $chart_model->createChart($cleaned_parameters, $company_stored_data, $settings);
////        $chart_location = '';
//        return $successfullyStored;
//    }

    public function StoreMessageInDatabase($cleaned_parameters, $database_connection_settings, $database_wrapper, $sql_queries)
    {
        $storedSucess = false;
        $database_wrapper->setDatabaseConnectionSettings($database_connection_settings);
        $query_string = $sql_queries->storeMessageData();
        $query_parameters = [];

        foreach ($cleaned_parameters as $data) {
            $query_parameters[] = [
                'message' => $data['message'],
                'sourceMsisdn' => $data['sourceMsisdn'],
                'destinationMsisdn' => $data['destinationMsisdn'],
                'receivedTime' => $data['receivedTime'],
                'bearer' => $data['bearer'],
                'messageref' => $data['messageRef']
            ];
        }

        $database_wrapper->makeDatabaseConnection();


        foreach ($query_parameters as $params) {
            // Flatten the array and ensure placeholder names match the SQL query

            $flattened_params = [
                ':source_msisdn' => $params['sourceMsisdn'],
                ':destination_msisdn' => $params['destinationMsisdn'],
                ':received_time' => $params['receivedTime'],
                ':bearer' => $params['bearer'],
                ':messageref' => $params['messageref'],
                ':message' => $params['message'],
            ];

            $database_wrapper->safeQuery($query_string, $flattened_params);
        }


        $number_of_stored_values = $database_wrapper->countRows();

        if ($number_of_stored_values > 0) {

            $storedSucess = true;

        } else {

        }

        return $storedSucess;


    }

    function processMessageDetails($messageDetails)
    {
        $statusArray = [];

        // Split the message by space to get individual key-value pairs
        $keyValuePairs = explode(' ', $messageDetails);

        // Define the keys to check for 'not given'
        $keys = ['switch1', 'switch2', 'switch3', 'switch4', 'fan', 'keypad', 'temperature'];

        // Initialize a flag to check if all keys are 'not given'
        $allNotGiven = true;

        foreach ($keyValuePairs as $pair) {
            // Split each key-value pair by '='
            $pairParts = explode('=', $pair);

            // Check if the pair is valid
            if (count($pairParts) == 2) {
                $key = strtolower(trim($pairParts[0])); // Convert to lowercase for case-insensitive comparison
                $value = trim($pairParts[1]);

                // Validate key and assign to the status array
                switch ($key) {
                    case 'switch1':
                    case 'switch2':
                    case 'switch3':
                    case 'switch4':
                        if (strtolower($value) === 'on' || strtolower($value) === 'off') {
                            $statusArray[$key] = strtolower($value); // Store as lowercase
                        } else {
                            $statusArray[$key] = "Incorrect switch status inputted. You said '{$value}' for {$key}.";
                        }
                        break;

                    case 'fan':
                        if (strtolower($value) === 'forward' || strtolower($value) === 'reverse') {
                            $statusArray[$key] = strtolower($value); // Store as lowercase
                        } else {
                            $statusArray[$key] = "Incorrect fan status inputted. You said '{$value}' for fan.";
                        }
                        break;

                    case 'temperature':
                        // Add validation logic for temperature if needed
                        $statusArray[$key] = $value;
                        break;

                    case 'keypad':
                        if (ctype_digit($value) && strlen($value) === 1) {
                            $statusArray[$key] = $value;
                        } else {
                            $statusArray[$key] = "Incorrect keypad value inputted. Keypad value must be a single digit (0-9). You said '{$value}'.";
                        }
                        break;

                    default:
                        $statusArray[$key] = "Unrecognized CircuitBoard Status '{$key}'.";
                }

                // Check if any data is given for the current key
                if (in_array($key, $keys) && isset($statusArray[$key]) && $statusArray[$key] !== 'not given') {
                    $allNotGiven = false;
                }
            }
        }

        // Set 'not given' for any missing keys
        foreach ($keys as $eachone) {
            if (!isset($statusArray[$eachone])) {
                $statusArray[$eachone] = 'not given';
            }
        }

        // If all keys are 'not given', set 'error'
        if ($allNotGiven) {
            $statusArray['error'] = "No circuitBoard Data";
        }

        return $statusArray;
    }
    public function getMostRecentMessageFromDatabase($database_wrapper, $sql_queries,$database_connection_settings)
    {
        $query_string = $sql_queries->getMostRecentMessage();
        $database_wrapper->setDatabaseConnectionSettings($database_connection_settings);
        $database_wrapper->makeDatabaseConnection();
        $database_wrapper->safeQuery($query_string);

        // Fetch the most recent message as an associative array
        $mostRecentMessage = $database_wrapper->safeFetchArray();
        var_dump($mostRecentMessage);

        return $mostRecentMessage;
    }


}