<?php


namespace Telemetry;

class SendMessageController
{

    public function createHtmlOutput(object $container, object $request, object $response): void
    {
        $login_view = $container->get('SendMessageView');
        $view = $container->get('view');
        $settings = $container->get('settings');

        $login_view->createSendMessagePageView($view, $settings, $response);
    }

    public function createHtmlOutput2(object $container, object $request, object $response): void
    {
        $view = $container->get('view');
        $settings = $container->get('settings');
        $soap_wrapper = $container->get('soapWrapper');
        $validator = $container->get('validator');


        $sendMessageModel = $container->get('SendMessageModel');
        $sendMessageView = $container->get('SendMessageView');

        $tainted_parameters = $request->getParsedBody();
        $messagesent = false;
        $cleaned_parameters = $sendMessageModel->cleanupParameters($validator, $tainted_parameters);
        if ($cleaned_parameters['phoneNumber'] == '') {
            $error = "Invalid phone number given";
            $sendMessageView->createSendMessagePageView2($view, $settings, $response, $error, $messagesent);
        }

        $messagesent = $sendMessageModel->sendMessage($cleaned_parameters['message'], $cleaned_parameters['phoneNumber'], $soap_wrapper);
        var_dump($messagesent);


        $sendMessageView->createSendMessagePageView2($view, $settings, $response, $cleaned_parameters['message'],$messagesent);
    }


}