<?php

namespace Omnipay\BinancePay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\BinancePay\Message\PurchaseResponse;

/**
 * Class CompletePurchaseResponse
 * @package Omnipay\BinancePay\Message
 */
class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * Indicates whether transaction was successful
     * @return bool
     */
    public function isSuccessful()
    {
        return ($this->data['code'] ?? '') === PurchaseResponse::SUCCESS;
    }

    /**
     * Get transaction ID, generated by merchant
     * @return mixed|string
     */
    public function getTransactionId()
    {
        return array_get($this->data, 'data.prepayId');
    }

    /**
     * Get transaction reference, generated by gateway
     * @return mixed|null|string
     */
    public function getTransactionReference()
    {
        return array_get($this->data, 'data.transactionId');
    }

    public function getMessage()
    {
        return json_encode($this->getData());
    }
}