<?php

namespace App\Service\NotificationChannel;

use App\Config\BackupSmsChannelConfig;
use App\Dto\AbstractSendNotificationDto;
use App\Dto\SendSmsNotificationDto;
use App\Exception\NotificationChannelFailureException;
use App\Service\NotificationChannelInterface;

class BackupSmsChannelService implements NotificationChannelInterface
{
    private BackupSmsChannelConfig $config;

    /**
     * @param BackupSmsChannelConfig $config
     */
    public function __construct(BackupSmsChannelConfig $config)
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
            throw new NotificationChannelFailureException("Backup sms channel failure.");
        }
    }

    public function getChannelType(): int
    {
        return NotificationChannelInterface::CHANNEL_SMS_BACKUP;
    }

    public function isAvailable(): bool
    {
        return $this->config->isAvailable();
    }
}
