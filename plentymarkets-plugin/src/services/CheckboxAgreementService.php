<?php

namespace easyCredit\Services;

use easyCredit\Api\BaseClient;
use Plenty\Plugin\ConfigRepository;
use Plenty\Plugin\Log\Loggable;

class CheckboxAgreementService
{
    use Loggable;

    private $baseClient;
    private $config;

    public function __construct(BaseClient $baseClient, ConfigRepository $config)
    {
        $this->baseClient = $baseClient;
        $this->config = $config;
    }

    public function setUsernameAndPassword()
    {
        $username = $this->config->get('easyCredit.username');
        $password = $this->config->get('easyCredit.password');

        if (is_null($username)) {
            $this->getLogger(__METHOD__)->error('easyCredit::setUsername', 'Username is null. Please check the configuration.');
            throw new \InvalidArgumentException('Username cannot be null');
        }

        if (is_null($password)) {
            $this->getLogger(__METHOD__)->error('easyCredit::setPassword', 'Password is null. Please check the configuration.');
            throw new \InvalidArgumentException('Password cannot be null');
        }

        $this->baseClient->setUsername($username);
        $this->baseClient->setPassword($password);
    }
}
