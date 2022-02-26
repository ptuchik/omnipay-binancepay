<?php

namespace Omnipay\BinancePay\Message;

use Omnipay\Common\Message\AbstractRequest;
use Str;

abstract class Request extends AbstractRequest
{
    /**
     * Gateway endpoint
     *
     * @var string
     */
    protected $endpoint = 'https://bpay.binanceapi.com';

    /**
     * Sets the request crypto currency.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setCryptoCurrency($value)
    {
        return $this->setParameter('cryptoCurrency', $value);
    }

    /**
     * Get the request crypto currency.
     *
     * @return $this
     */
    public function getCryptoCurrency()
    {
        return $this->getParameter('cryptoCurrency');
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
     * Sets the request nonce.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setNonce($value)
    {
        return $this->setParameter('nonce', $value);
    }

    /**
     * Get the request nonce.
     *
     * @return $this
     */
    public function getNonce()
    {
        return $this->getParameter('nonce');
    }

    /**
     * Generate signature
     *
     * @param string $body
     * @param int    $timestamp
     *
     * @return string
     */
    protected function getSignature(string $body, int $timestamp)
    {
        $payload = $timestamp."\n".$this->getNonce()."\n".$body."\n";

        return Str::upper(hash_hmac('SHA512', $payload, $this->getSecret()));
    }

    /**
     * Send data and return response instance
     *
     * @param mixed $data
     *
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function sendData($data)
    {
        $payload = json_encode($data);
        $timestamp = round(microtime(true) * 1000);
        $headers = [
            'content-type'              => 'application/json',
            'BinancePay-Timestamp'      => $timestamp,
            'BinancePay-Nonce'          => $this->getNonce(),
            'BinancePay-Certificate-SN' => $this->getApiKey(),
            'BinancePay-Signature'      => $this->getSignature($payload, $timestamp)
        ];

        $response = $this->httpClient->request('POST', $this->getEndpoint(), $headers, $payload);

        return $this->response = $this->getResponseInstance(json_decode($response->getBody()->getContents(), true));
    }

    abstract public function getData();

    abstract protected function getEndpoint();

    abstract protected function getResponseInstance(array $data);

}