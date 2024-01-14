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
        var_dump($cleaned_parameters['switch1']);
        try {
            if ($cleaned_parameters['phoneNumber'] == '') {
                throw new \Exception("Invalid phone number given");
            }
            $messagecontent =$sendMessageModel->buildMessageString($cleaned_parameters);
            var_dump($messagecontent);
            $messagesent = $sendMessageModel->sendMessage($messagecontent, $cleaned_parameters['phoneNumber'], $soap_wrapper);
            var_dump($messagesent);

            $sendMessageView->createSendMessagePageView2($view, $settings, $response, $messagecontent, $messagesent);
        } catch (\Exception $e) {
           var_dump($messagesent);
            $errorMessage = $e->getMessage();
            $sendMessageView->createSendMessagePageView3($view, $settings, $response, $errorMessage );
        }

    }
}