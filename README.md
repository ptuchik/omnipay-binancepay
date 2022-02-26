# Omnipay: BinancePay

**BinancePay driver for the Omnipay Laravel payment processing library**

[![Latest Stable Version](https://poser.pugx.org/ptuchik/omnipay-binancepay/version.png)](https://packagist.org/packages/ptuchik/omnipay-binancepay)
[![Total Downloads](https://poser.pugx.org/ptuchik/omnipay-binancepay/d/total.png)](https://packagist.org/packages/ptuchik/omnipay-binancepay)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment processing library for
PHP 5.5+. This package implements BinancePay support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it to your `composer.json` file:

```json
{
    "require": {
        "ptuchik/omnipay-binancepay": "~1.0"
    }
}
```

And run composer to update your dependencies:

    composer update

Or you can simply run

    composer require ptuchik/omnipay-binancepay

## Basic Usage

1. Use Omnipay gateway class:

```php
    use Omnipay\Omnipay;
```

2. Initialize BinancePay gateway:

```php

    $gateway = Omnipay::create('BinancePay');
    $gateway->setApiKey(env('API_KEY'));
    $gateway->setSecret(env('SECRET'));

```

3. Call purchase, it will automatically redirect to BinancePay's hosted page

```php

    $purchase = $gateway->purchase();
    $purchase->setCryptoCurrency('USDT'); // Currenctly supports only USDT
    $purchase->setNonce(\Str::random(32));
    $purchase->setAmount(10); // Amount to charge
    $purchase->setDescription(XXXX); // Some description about the items you sell
    $purchase->setReturnUrl(XXXX); // Set the URL where the customer will be directed after successful payment
    $purchase->setCancelUrl(XXXX); // Set the URL where the customer will be directed on failed or cancelled payment
    
    $purchase->send()->redirect();

```

4. Create a webhook controller to handle the callback request at your webhook endpoint and catch the webhook as follows

```php

    $gateway = Omnipay::create('BinancePay');
    $gateway->setApiKey(env('API_KEY'));
    $gateway->setSecret(env('SECRET'));
    
    $request = $gateway->completePurchase()
    $request->setNonce(\Str::random(32));
    $request$request->setTransactionId(XXXX); // Transaction ID from your system
    
    $purchase = $request->send();
    
    // Do the rest with $purchase and response with 'OK'
    if ($purchase->isSuccessful()) {
        
        // Your logic
        
    }
    
    return \Response::json([
            'returnCode'    => 'SUCCESS',
            'returnMessage' => null
        ]);

```

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project, or ask more detailed questions,
there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which you can subscribe to.

If you believe you have found a bug, please report it using
the [GitHub issue tracker](https://github.com/ptuchik/omnipay-binancepay/issues), or better yet, fork the library and
submit a pull request.
