<?php

namespace Omnipay\BinancePay;

use Omnipay\Common\AbstractGateway;
use Omnipay\BinancePay\Message\CompletePurchaseRequest;
use Omnipay\BinancePay\Message\PurchaseRequest;

/**
 * Braintree Gateway
 */
class Gateway extends AbstractGateway
{
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return 'BinancePay';
    }

    /**
     * Sets the request API key.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * Get the request API key.
     *
     * @return $this
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * Sets the request secret.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setSecret($value)
    {
        return $this->setParameter('secret', $value);
    }

    /**
     * Get the request secret.
     *
     * @return $this
     */
    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    /**
     * Create a purchase request
     *
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function purchase(array $options = array())
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * Complete purchase
     *
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function completePurchase(array $options = array())
    {
        return $this->createRequest(CompletePurchaseRequest::class, $options);
    }
}
