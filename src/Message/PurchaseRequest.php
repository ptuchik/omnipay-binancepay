<?php

namespace Omnipay\BinancePay\Message;

/**
 * Class PurchaseRequest
 *
 * @package Omnipay\BinancePay\Message
 */
class PurchaseRequest extends Request
{
    protected function getEndpoint()
    {
        return $this->endpoint.'/binancepay/openapi/v2/order';
    }

    /**
     * Prepare data to send
     *
     * @return array
     */
    public function getData()
    {
        return [
            'env'             => [
                'terminalType' => 'WEB'
            ],
            'merchantTradeNo' => $this->getTransactionId(),
            'orderAmount'     => $this->getAmount(),
            'currency'        => $this->getCryptoCurrency(),
            'goods'           => [
                'goodsType'        => '01',
                'goodsCategory'    => 'Z000',
                'referenceGoodsId' => $this->getTransactionId(),
                'goodsName'        => $this->getDescription()
            ],
            'returnUrl'       => $this->getReturnUrl(),
            'cancelUrl'       => $this->getCancelUrl()
        ];
    }

    protected function getResponseInstance(array $data)
    {
        return new PurchaseResponse($this, $data);
    }
}