<?php

namespace App\Service\NotificationChannel;

use App\Config\SmsChannelConfig;
use App\Dto\SendSmsNotificationDto;
use App\Exception\NotificationChannelFailureException;
use App\Service\NotificationChannelInterface;
use App\Dto\AbstractSendNotificationDto;

class SmsChannelService implements NotificationChannelInterface
{
    private SmsChannelConfig $config;

    /**
     * @param SmsChannelConfig $config
     */
    public function __construct(SmsChannelConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @throws NotificationChannelFailureException
     */
    public function send(AbstractSendNotificationDto $request): void
    {
        // Here we can inject any configuration, enable or disable a service etc..

        if ($request instanceof SendSmsNotificationDto) {
            // send here
            echo $this->config->getProviderUrl();
        } else {
            throw new NotificationChannelFailureException("Sms channel failure.");
        }
    }

    public function getChannelType(): int
    {
        return NotificationChannelInterface::CHANNEL_SMS;
    }

    public function isAvailable(): bool
    {
        return $this->config->isAvailable();
    }
}
