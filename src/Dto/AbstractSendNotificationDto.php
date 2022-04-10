<?php

namespace App\Dto;

abstract class AbstractSendNotificationDto
{
    private const MAX_RETRY_COUNT = 1;

    private int $retryCount = 0;
    private int $channelType;
    private int $failOverChannelType;

    /**
     * @return int
     */
    public function getFailOverChannelType(): int
    {
        return $this->failOverChannelType;
    }

    /**
     * @param int $failOverChannelType
     */
    public function setFailOverChannelType(int $failOverChannelType): void
    {
        $this->failOverChannelType = $failOverChannelType;
    }

    /**
     * @return int
     */
    public function getChannelType(): int
    {
        return $this->channelType;
    }

    /**
     * @param string $channelType
     */
    public function setChannelType(string $channelType): void
    {
        $this->channelType = $channelType;
    }

    /**
     * @return bool
     */
    public function canRetry(): bool
    {
        return $this->retryCount < AbstractSendNotificationDto::MAX_RETRY_COUNT;
    }

    public function incrementRetryCount(): void
    {
        $this->retryCount++;
    }
}
