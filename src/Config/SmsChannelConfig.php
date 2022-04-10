<?php

namespace App\Config;

class SmsChannelConfig
{
    private string $providerUrl;
    private bool $available;

    /**
     * @return string
     */
    public function getProviderUrl(): string
    {
        return $this->providerUrl;
    }

    /**
     * @param string $providerUrl
     */
    public function setProviderUrl(string $providerUrl): void
    {
        $this->providerUrl = $providerUrl;
    }

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * @param bool $available
     */
    public function setAvailable(bool $available): void
    {
        $this->available = $available;
    }
}
