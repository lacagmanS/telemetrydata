<?php
/**
 * Wrapper class for the Base 64 encoding/decoding library
 *
 * Methods available are:
 *
 * Encode/Decode the given string with base 64 encoding
 *
 * @author CF Ingrams <cfi@dmu.ac.uk>
 * @copyright De Montfort University
 */

namespace Telemetry;

class Base64Wrapper
{
  public function __construct(){}

  public function __destruct(){}

  public function encode_base64(string $string_to_encode): string
  {
    $encoded_string = false;
    if (!empty($string_to_encode))
    {
      $encoded_string = base64_encode($string_to_encode);
    }
    return $encoded_string;
  }

  public function decode_base64(string $string_to_decode): string
  {
    $decoded_string = false;
    if (!empty($string_to_decode))
    {
      $decoded_string = base64_decode($string_to_decode);
    }
    return $decoded_string;
  }
}
