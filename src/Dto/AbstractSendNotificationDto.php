<?php

namespace App\Dto;

abstract class AbstractSendNotificationDto
{
    private string $channelName;
    private string $failOverChannelName;

    /**
     * @return string
     */
    public function getFailOverChannelName(): string
    {
        return $this->failOverChannelName;
    }

    /**
     * @param string $failOverChannelName
     */
    public function setFailOverChannelName(string $failOverChannelName): void
    {
        $this->failOverChannelName = $failOverChannelName;
    }

    /**
     * @return string
     */
    public function getChannelName(): string
    {
        return $this->channelName;
    }

    /**
     * @param string $channelName
     */
    public function setChannelName(string $channelName): void
    {
        $this->channelName = $channelName;
    }
}
