<?php

namespace PaymentMethod\Providers;

use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;

class TargonPaymentRouteServiceProvider extends RouteServiceProvider
{
    public function map(Router $router)
    {
        $router->get('payment/paymentMethod/checkoutSuccess', 'PaymentMethod\Controllers\TargonPaymentController@checkoutSuccess');
        $router->get('payment/paymentMethod/checkoutCancel', 'PaymentMethod\Controllers\TargonPaymentController@checkoutCancel');
        $router->post('payment/paymentMethod/notification', 'PaymentMethod\Controllers\TargonPaymentController@notification');
    }
}
