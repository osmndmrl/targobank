<?php

namespace PaymentMethod\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodContainer;
use Plenty\Modules\Basket\Events\Basket\AfterBasketCreate;
use Plenty\Modules\Basket\Events\Basket\AfterBasketChanged;
use Plenty\Modules\Basket\Events\BasketItem\AfterBasketItemAdd;
use Plenty\Modules\Basket\Events\BasketItem\AfterBasketItemUpdate;
use Plenty\Modules\Basket\Events\BasketItem\AfterBasketItemRemove;
use Plenty\Modules\Frontend\Services\FrontendSessionStorageFactoryContract;
use Plenty\Modules\Frontend\Events\FrontendLanguageChanged;
use Plenty\Modules\Frontend\Events\FrontendShippingCountryChanged;
use Plenty\Modules\Frontend\Events\FrontendCustomerAddressChanged;

class TargonPaymentServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot(PaymentMethodContainer $payContainer)
    {
        $payContainer->register('TargonPayment::Targon', \PaymentMethod\Methods\TargonPaymentMethod::class,
            [
                AfterBasketChanged::class,
                AfterBasketItemAdd::class,
                AfterBasketCreate::class,
                AfterBasketItemUpdate::class,
                AfterBasketItemRemove::class,
                FrontendLanguageChanged::class,
                FrontendShippingCountryChanged::class,
                FrontendCustomerAddressChanged::class
            ]
        );
    }
}
