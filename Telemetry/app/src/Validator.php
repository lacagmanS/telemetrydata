<?php

namespace Telemetry;
use DateTime;
class Validator
{
    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    public function validateInt(int $age_to_validate): int
    {
        $validated_age = false;

        $options = [
            'options' => [
                'default' => -1, // value to return if the filter fails
                'min_range' => 0,
                'max_range' => 150,
            ]
        ];

        $sanitised_age = filter_var($age_to_validate, FILTER_SANITIZE_NUMBER_INT);
        $validated_age = filter_var($sanitised_age, FILTER_VALIDATE_INT, $options);

        return $validated_age;
    }

    public function sanitiseString(string $string_to_sanitise): string
    {
        $sanitised_string = false;

        if (!empty($string_to_sanitise)) {
            $sanitised_string = htmlspecialchars($string_to_sanitise);
        }
        return $sanitised_string;
    }

    public function sanitiseEmail(string $email_to_sanitise): string
    {
        $cleaned_string = false;

        if (!empty($email_to_sanitise)) {
            $sanitised_email = filter_var($email_to_sanitise, FILTER_SANITIZE_EMAIL);
            $cleaned_string = filter_var($sanitised_email, FILTER_VALIDATE_EMAIL);
        }
        return $cleaned_string;
    }
//    public function sanitizeMessage(string $message): string
//    {
//
//        return $cleaned_message
//    }
    public function filterString($string_to_sanitise)
    {
        $sanitised_string = false;

        if (!empty($string_to_sanitise)) {
            $sanitised_string = filter_var($string_to_sanitise, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
        }
        return $sanitised_string;
    }


    function sanitizeEachValue($parsedmessage): array
    {
        $sanitizedContent = [];

        foreach ($parsedmessage as $key => $value) {
            // Initialize the sanitizedContent array for the current message
            $sanitizedContent[$key] = [];

            foreach ($value as $innerKey => $innerValue) {
                switch ($innerKey) {
                    case 'destinationMsisdn':
                    case 'sourceMsisdn':
                        // Validate as integer
                        $sanitizedContent[$key][$innerKey] = filter_var($innerValue, FILTER_VALIDATE_INT);
                        // If validation fails, set to null or handle accordingly
                        if ($sanitizedContent[$key][$innerKey] === false) {
                            $sanitizedContent[$key][$innerKey] = null;
                        }
                        break;

//                    case 'receivedTime':
//                        $format = 'd/m/Y H:i:s';
//                        $dateTime = DateTime::createFromFormat($format, $innerValue);
//
//                        // Check if DateTime creation was successful
//                        if ($dateTime !== false) {
//                            // Format the DateTime as a string
//                            $sanitizedContent[$key][$innerKey] = $dateTime->format('Y-m-d H:i:s');
//                        } else {
//                            // Handle invalid date format
//                            $sanitizedContent[$key][$innerKey] = null;
//                        }
//                        break;

                    default:
                        // Sanitize other values as strings
                        $sanitizedContent[$key][$innerKey] = filter_var($innerValue, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        break;
                }
            }
        }

        return $sanitizedContent;
    }
}