<?php
/**
 * Shop System SDK - Terms of Use
 *
 * The SDK offered are provided free of charge by Wirecard AG and are explicitly not part
 * of the Wirecard AG range of products and services.
 *
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public
 * License Version 3 (GPLv3) and can be used, developed and passed on to third parties under
 * the same terms.
 *
 * However, Wirecard AG does not provide any guarantee or accept any liability for any errors
 * occurring when used in an enhanced, customized shop system configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 *
 * Customers use the SDK at their own risk. Wirecard AG does not guarantee their full
 * functionality neither does Wirecard AG assume liability for any disadvantages related to
 * the use of the SDK. Additionally, Wirecard AG does not guarantee the full functionality
 * for customized shop systems or installed SDK of other vendors of plugins within the same
 * shop system.
 *
 * Customers are responsible for testing the SDK's functionality before starting productive
 * operation.
 *
 * By installing the SDK into the shop system the customer agrees to these terms of use.
 * Please do not use the SDK if you do not agree to these terms of use!
 */


namespace Wirecard\PaymentSdk\Transaction;

use Wirecard\PaymentSdk\Exception\MandatoryFieldMissingException;
use Wirecard\PaymentSdk\Exception\UnsupportedOperationException;

/**
 * Class WPPTransaction
 * @package Wirecard\PaymentSdk\Transaction
 * @since 3.5.0
 */
class WPPTransaction extends Transaction implements Reservable
{
    const ENDPOINT_PAYMENTS = '/api/payment/register';
    const NAME = 'wpp';
    const TYPE_AUTOSALE = 'auto-sale';

    /**
     * @var WPPConfig
     */
    private $config;

    /**
     * @var Mandate
     */
    private $mandate;

    /**
     * @param WPPConfig $config
     * @return WPPTransaction
     * @since 3.5.0
     */
    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return string
     * @since 3.5.0
     */
    public function getEndpoint()
    {
        return self::ENDPOINT_PAYMENTS;
    }

    /**
     * @param Mandate $mandate
     */
    public function setMandate($mandate)
    {
        $this->mandate = $mandate;
    }

    /**
     * @throws MandatoryFieldMissingException|UnsupportedOperationException
     * @return array
     * @since 3.5.0
     */
    protected function mappedSpecificProperties()
    {
        $data = [];
        if (null !== $this->mandate) {
            $data['mandate'] = $this->mandate->mappedProperties();
        }
        return $data;
    }

    /**
     * @throws UnsupportedOperationException|MandatoryFieldMissingException
     * @return string
     * @since 3.5.0
     */
    protected function retrieveTransactionType()
    {
        return parent::retrieveTransactionType();
    }

    /**
     * @return string
     * @since 3.5.0
     */
    protected function retrieveTransactionTypeForReserve()
    {
        return self::TYPE_AUTHORIZATION;
    }

    /**
     * @return string
     * @since 3.5.0
     */
    protected function retrieveTransactionTypeForAutoSale()
    {
        return self::TYPE_AUTOSALE;
    }

    /**
     * @return string
     * @since 3.5.0
     */
    public function retrieveOperationType()
    {
        return self::TYPE_AUTOSALE;
    }
}
