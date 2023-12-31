<?php

/**
 * SQLQueries.php
 *
 * hosts all SQL queries to be used by the Model
 *
 * Author: CF Ingrams
 * Email: <clinton@cfing.co.uk>
 * Date: 22/10/2017
 *
 * @author CF Ingrams <clinton@cfing.co.uk>
 * @copyright CFI
 */

namespace Telemetry;

class SQLQueries
{
    public function __construct() { }

    public function __destruct() { }

    public function getMostRecentUserName()
    {
        $query_string  = "SELECT user_name ";
        $query_string .= "FROM user_data ";
        $query_string .= "ORDER BY auto_id DESC ";
        $query_string .= "LIMIT 1";
        return $query_string;
    }



    public function storeMessageData()
    {
        $query_string  = "INSERT INTO message_data ";
        $query_string .= "SET ";
        $query_string .= "sourceMsisdn = :source_msisdn, ";
        $query_string .= "destinationMsisdn = :destination_msisdn, ";
        $query_string .= "receivedTime = :received_time, ";
        $query_string .= "bearer = :bearer, ";
        $query_string .= "messageref = :messageref, ";
        $query_string .= "message = :message;";
        return $query_string;
    }
    public function getMostRecentMessage()
    {
        $query_string  = "SELECT message, sourceMsisdn, destinationMsisdn, bearer, messageref, receivedTime ";
        $query_string .= "FROM message_data ";
        $query_string .= "ORDER BY message_id DESC ";
        $query_string .= "LIMIT 1";

        return $query_string;
    }

}
