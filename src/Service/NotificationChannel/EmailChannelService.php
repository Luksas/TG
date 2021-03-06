<?php

namespace App\Service\NotificationChannel;

use App\Config\EmailChannelConfig;
use App\Dto\AbstractSendNotificationDto;
use App\Dto\SendEmailNotificationDto;
use App\Exception\NotificationChannelFailureException;
use App\Service\NotificationChannelInterface;

class EmailChannelService implements NotificationChannelInterface
{
    private EmailChannelConfig $config;

    /**
     * @param EmailChannelConfig $config
     */
    public function __construct(EmailChannelConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @throws NotificationChannelFailureException
     */
    public function send(AbstractSendNotificationDto $request): void
    {
        // Here we can inject any configuration, enable or disable a service etc..

        if ($request instanceof SendEmailNotificationDto) {
            // send here
            echo $this->config->getProviderUrl();
        } else {
            throw new NotificationChannelFailureException("Email notification channel failure.");
        }
    }

    public function getChannelType(): int
    {
        return NotificationChannelInterface::CHANNEL_EMAIL;
    }

    public function isAvailable(): bool
    {
        return $this->config->isAvailable();
    }
}
