<?php

namespace Omnipay\BinancePay\Message;

use Exception;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class PurchaseResponse
 *
 * @package Omnipay\BinancePay\Message
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    const SUCCESS = '000000';

    /**
     * Set successful to false, as transaction is not completed yet
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * Mark purchase as redirect type
     *
     * @return bool
     */
    public function isRedirect()
    {
        return ($this->data['code'] ?? '') === static::SUCCESS);
    }

    /**
     * Get redirect URL
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        if (empty($this->data['data']['checkoutUrl'])) {
            throw new Exception($this->data['errorMessage'] ?? trans('messages.something_went_wrong'));
        }

        return $this->data['data']['checkoutUrl'];
    }
}