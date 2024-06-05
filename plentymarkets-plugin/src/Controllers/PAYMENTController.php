<?php

namespace PaymentMethod\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Http\Request;
use Plenty\Plugin\Http\Response;
use Plenty\Modules\Payment\Contracts\PaymentRepositoryContract;
use Plenty\Modules\Order\Contracts\OrderRepositoryContract;
use Plenty\Modules\Payment\Models\Payment;
use Plenty\Modules\Payment\Models\PaymentProperty;

class TargonPaymentController extends Controller
{
    private $paymentRepository;
    private $orderRepository;

    public function __construct(
        PaymentRepositoryContract $paymentRepository,
        OrderRepositoryContract $orderRepository
    ) {
        $this->paymentRepository = $paymentRepository;
        $this->orderRepository = $orderRepository;
    }

    public function checkoutSuccess(Request $request, Response $response)
    {
        $orderId = $request->get('orderId');
        $paymentStatus = $request->get('paid');
        $transactionId = $request->get('transactionId');

        if ($paymentStatus === 'YES') {
            $order = $this->orderRepository->findOrderById($orderId);

            $paymentData = [
                'mopId' => 123, // Replace with the correct method of payment ID
                'transactionType' => Payment::TRANSACTION_TYPE_BOOKED_POSTING,
                'status' => Payment::STATUS_CAPTURED,
                'currency' => $order->amount->currency,
                'amount' => $order->amount->priceGross,
                'receivedAt' => date('Y-m-d H:i:s'),
                'properties' => [
                    [
                        'typeId' => PaymentProperty::TYPE_TRANSACTION_ID,
                        'value' => $transactionId
                    ]
                ]
            ];

            $payment = $this->paymentRepository->createPayment($paymentData);

            $this->paymentRepository->createOrderRelation($payment, $orderId);

            return $response->redirectTo('/checkout/success');
        } else if ($paymentStatus === 'NO') {
            return $response->redirectTo('/checkout/error');
        }
    }

    public function checkoutCancel(Request $request, Response $response)
    {
        return $response->redirectTo('/checkout/cancel');
    }

    public function notification(Request $request, Response $response)
    {
        // Handle payment notification
    }
}
