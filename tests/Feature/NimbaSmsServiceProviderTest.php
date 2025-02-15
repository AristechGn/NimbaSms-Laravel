<?php

namespace Aristech\NimbaSms\Tests\Feature;

use Aristech\NimbaSms\Tests\TestCase;
use Aristech\NimbaSms\Contracts\SmsClientInterface;

class NimbaSmsServiceProviderTest extends TestCase
{
    /** @test */
    public function it_registers_nimba_sms_client()
    {
        $this->assertTrue($this->app->bound(SmsClientInterface::class));
    }

    /** @test */
    public function it_provides_config_values()
    {
        $this->assertEquals('test_service_id', config('nimbasms.serviceId'));
        $this->assertEquals('test_secret', config('nimbasms.secret'));
    }
} 