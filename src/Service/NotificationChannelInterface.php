<?php

namespace App\Service;

use App\Dto\AbstractSendNotificationDto;

interface NotificationChannelInterface
{
    public const CHANNEL_SMS = 0;
    public const CHANNEL_EMAIL = 1;

    public function send(AbstractSendNotificationDto $request): void;

    public function getChannelType(): int;
}
