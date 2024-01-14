<?php

namespace Telemetry;

class SoapWrapper
{
    public function createSoapClient(): object
    {
        $soap_client_handle = false;
        $soap_client_parameters = [];
        $exception = '';

        $wsdl = 'https://m2mconnect.ee.co.uk/orange-soap/services/MessageServiceByCountry?wsdl';
        $soap_client_parameters = ['trace' => true, 'exceptions' => true];

        try {
            $soap_client_handle = new \SoapClient($wsdl, $soap_client_parameters);

        } catch (\SoapFault $exception) {
            $soap_client_handle = false;
            echo 'Ooops - something went wrong when connecting to the data supplier.  Please try again later';
        }

        return $soap_client_handle;
    }
    public function performSoapCall($soap_client_handle, $webservice_function, $webservice_call_parameters)
    {
        var_dump($webservice_function);
        var_dump($webservice_call_parameters);

        return $soap_client_handle->__soapCall($webservice_function, $webservice_call_parameters ) ;
    }
}