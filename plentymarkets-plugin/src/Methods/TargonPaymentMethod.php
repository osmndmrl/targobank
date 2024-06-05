<?php

namespace PaymentMethod\Methods;

use Plenty\Modules\Payment\Method\Services\PaymentMethodBaseService;

class TargonPaymentMethod extends PaymentMethodBaseService
{
    public function isActive(): bool
    {
        return true;
    }

    public function getName(string $lang = 'de'): string
    {
        return 'Targon Payment';
    }

    public function getFee(): float
    {
        return 0.00;
    }

    public function getIcon(string $lang): string
    {
        return '/path/to/icon.png';
    }

    public function getDescription(string $lang): string
    {
        return 'Pay securely using Targon Payment.';
    }

    public function getSourceUrl(string $lang): string
    {
        return '';
    }

    public function isSwitchableTo(): bool
    {
        return true;
    }

    public function isSwitchableFrom(): bool
    {
        return true;
    }

    public function isBackendSearchable(): bool
    {
        return true;
    }

    public function isBackendActive(): bool
    {
        return true;
    }

    public function getBackendName(string $lang): string
    {
        return $this->getName($lang);
    }

    public function canHandleSubscriptions(): bool
    {
        return true;
    }

    public function getBackendIcon(): string
    {
        return '/path/to/backend_icon.svg';
    }
}
