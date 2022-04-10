<?php

namespace App\Service\NotificationChannel;

use App\Config\EmailChannelConfig;
use App\Dto\AbstractSendNotificationDto;
use App\Dto\SendEmailNotificationDto;
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


    public function send(AbstractSendNotificationDto $request): void
    {
        // Here we can inject any configuration, enable or disable a service etc..

        if ($request instanceof SendEmailNotificationDto)
        {
            // send here
            echo $this->config->getProviderUrl();
        }
    }

    public function getChannelType(): int
    {
        return NotificationChannelInterface::CHANNEL_EMAIL;
    }
}
