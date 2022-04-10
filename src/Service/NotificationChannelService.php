<?php

namespace App\Service;

use InvalidArgumentException;

class NotificationChannelService
{
    /**
     * @var NotificationChannelInterface[]|iterable
     */
    private iterable $notificationChannels;

    /**
     * @param NotificationChannelInterface[]|iterable $notificationChannels
     */
    public function __construct(iterable $notificationChannels)
    {
        $this->notificationChannels = $notificationChannels;
    }

    public function getChannel(int $channel): NotificationChannelInterface
    {
        foreach ($this->notificationChannels as $notificationChannel) {
            if ($channel === $notificationChannel->getChannelType()) {
                return $notificationChannel;
            }
        }

        throw new InvalidArgumentException("Invalid notification channel.");
    }
}
