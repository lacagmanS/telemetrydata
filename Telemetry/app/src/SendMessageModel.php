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

class SendMessageModel
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

        $cleaned_parameters['phoneNumber'] = $validator->sanitizePhoneNumber($tainted_parameters['phone_number']);

        $cleaned_parameters['message'] = $validator->sanitiseString($tainted_parameters['message']);

        $cleaned_parameters['switch1'] = $validator->validateRadioOption($tainted_parameters['switch1']);
        $cleaned_parameters['switch2'] = $validator->validateRadioOption($tainted_parameters['switch2']);
        $cleaned_parameters['switch3'] = $validator->validateRadioOption($tainted_parameters['switch3']);
        $cleaned_parameters['switch4'] = $validator->validateRadioOption($tainted_parameters['switch4']);

        $cleaned_parameters['fan'] = $validator->validateRadioOption($tainted_parameters['fan']);

        $cleaned_parameters['keypad'] = $validator->sanitiseString($tainted_parameters['keypad']);

        $cleaned_parameters['temperature'] = $validator->validateInt($tainted_parameters['temperature']);
//        if ($cleaned_parameters['phoneNumber'] == ''|| ){
//
//        }

        return $cleaned_parameters;
    }
    public function sendMessage($message, $deviceMSISDN, $soap_wrapper)
    {
        $username = '23_2762781';
        $password = 'Salahudiin@123';




        $webservice_call_parameters = [
            'username' => $username,
            'password' => $password,
            'deviceMSISDN' => $deviceMSISDN,
            'message' => $message,
            'deliveryReport' => true,
            'mtBearer' => 'SMS',
        ];
        $webservice_function = 'sendMessage';
        $soap_client_handle = $soap_wrapper->createSoapClient();
        return $soap_wrapper->performSoapCall($soap_client_handle, $webservice_function, $webservice_call_parameters);


    }
    public function buildMessageString( $cleaned_parameters)
    {
        $messageString = '';




        $switchs = ['switch1','switch2', 'switch3', 'switch4'];
        foreach ($switchs as $switch) {
            if ($cleaned_parameters[$switch] == 'on') {
                $messageString .= $switch . '=on, ';
            } else {
                $messageString .= $switch . '=off, ';
            }
        }
        if ($cleaned_parameters['fan']){
            $messageString .= 'fan=reverse, ';
        }
        else{
            $messageString .= 'fan=forward, ';
        }
        $messageString .= 'keypad=' . $cleaned_parameters['keypad'] . ' ';
        $messageString .= 'temperature=' . $cleaned_parameters['temperature'];

        return $messageString;
    }


}
