<?php
/**
 * Shop System Plugins:
 * - License can be found under:
 * https://github.com/wirecard/paymentSDK-php/blob/master/LICENSE
 */

namespace Helper;

class Acceptance extends \Codeception\Module
{
    /**
     * Method returns modified link
     *
     * @param string $link
     * @param string $username
     * @param string $password
     * @return string
     */
    public static function formAuthLink($link, $username, $password)
    {
        $link_parts = parse_url($link);
        $link_parts["user"] = $username;
        $link_parts["pass"] = $password;

        $new_link = $link_parts['scheme'] . '://' . $link_parts["user"] . ":" . $link_parts["pass"] . "@" . $link_parts['host'] . $link_parts['path'];
        return $new_link;
    }

    /**
     * Method returns last part of the link
     *
     * @param string $link
     * @return string
     */
    public static function getTransactionIDFromLink($link)
    {
        $transaction_id = explode('/', $link);
        return $transaction_id = end($transaction_id);
    }

    public static function getCardDataFromDataFile($cardDataType) {
        $gatewayEnv = getenv('GATEWAY');
        if ('NOVA' == $gatewayEnv || 'API-TEST' == $gatewayEnv || 'API-WDCEE-TEST' == $gatewayEnv) {
            $gateway = 'default_gateway';
        } else if ('SECURE-TEST-SG' == $gatewayEnv) {
            $gateway = 'sg_secure_gateway';
        } else if ('TEST-SG' == $gatewayEnv) {
            $gateway = 'sg_gateway';
        }

        $fileData = file_get_contents('tests/_support/data.json');
        $data = json_decode($fileData); // decode the JSON feed
        return $data->$gateway->$cardDataType;
    }
}
