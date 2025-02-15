<?php

namespace Aristech\NimbaSms\Config;

class NimbaSmsConfig
{
    private $serviceId;
    private $secret;
    private $baseUrl;

    public function __construct(string $serviceId, string $secret, string $baseUrl)
    {
        $this->serviceId = $serviceId;
        $this->secret = $secret;
        $this->baseUrl = rtrim($baseUrl, '/') . '/';
    }

    public function getServiceId(): string
    {
        return $this->serviceId;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }
} 