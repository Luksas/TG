<?php

namespace App\Service;

use App\Exception\NotificationChannelFailureException;

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

    /**
     * @throws NotificationChannelFailureException
     */
    public function getChannel(int $channelType): NotificationChannelInterface
    {
        foreach ($this->notificationChannels as $channel) {
            if ($channel->isAvailable() && $channelType === $channel->getChannelType()) {
                return $channel;
            }
        }

        throw new NotificationChannelFailureException("Channel $channelType is unavailable.");
    }
}
