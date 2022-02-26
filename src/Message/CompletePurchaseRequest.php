<?php

namespace Omnipay\BinancePay\Message;

/**
 * Class CompletePurchaseRequest
 *
 * @package Omnipay\BinancePay\Message
 */
class CompletePurchaseRequest extends Request
{
    protected function getEndpoint()
    {
        return $this->endpoint.'/binancepay/openapi/v2/order/query';
    }

    /**
     * Prepare and get data
     *
     * @return mixed|void
     */
    public function getData()
    {
        return [
            'merchantTradeNo' => $this->getTransactionId()
        ];
    }

    protected function getResponseInstance(array $data)
    {
        return new CompletePurchaseResponse($this, $data);
    }
}