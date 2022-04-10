<?php

namespace App\Service;

use App\Dto\AbstractSendNotificationDto;

interface NotificationChannelInterface
{
    public const CHANNEL_SMS = 0;
    public const CHANNEL_SMS_BACKUP = 1;
    public const CHANNEL_EMAIL = 2;

    public function send(AbstractSendNotificationDto $request): void;

    public function getChannelType(): int;

    public function isAvailable(): bool;
}
