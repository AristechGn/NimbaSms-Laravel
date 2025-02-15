<?php

namespace Aristech\NimbaSms\Tests\Unit;

use Aristech\NimbaSms\Tests\TestCase;
use Aristech\NimbaSms\NimbaSmsClient;
use Aristech\NimbaSms\Config\NimbaSmsConfig;
use Aristech\NimbaSms\Exceptions\NimbaSmsException;
use Illuminate\Support\Facades\Http;

class NimbaSmsClientTest extends TestCase
{
    protected NimbaSmsClient $client;

    protected function setUp(): void
    {
        parent::setUp();
        
        $config = new NimbaSmsConfig(
            'test_service_id',
            'test_secret',
            'https://api.nimbasms.com/'
        );
        
        $this->client = new NimbaSmsClient($config);
    }

    /** @test */
    public function it_can_send_sms()
    {
        Http::fake([
            'https://api.nimbasms.com/send' => Http::response([
                'status'  => 'success',
                'message' => 'SMS sent successfully'
            ], 200)
        ]);

        $response = $this->client->send(
            'TestSender',
            ['+22457123456'],
            'Test message'
        );

        Http::assertSent(function ($request) {
            return str_starts_with($request->url(), 'https://api.nimbasms.com/send')
                && ($request->data()['serviceId'] ?? null) === 'test_service_id'
                && ($request->data()['secret'] ?? null) === 'test_secret'
                && ($request->data()['senderName'] ?? null) === 'TestSender';
        });

        $this->assertEquals('success', $response['status']);
    }

    /** @test */
    public function it_throws_exception_on_error()
    {
        Http::fake([
            'https://api.nimbasms.com/send' => Http::response([
                'error' => [
                    'code'    => 'invalid_credentials',
                    'message' => 'Invalid credentials provided'
                ]
            ], 401)
        ]);

        $this->expectException(NimbaSmsException::class);
        $this->expectExceptionMessage('Invalid credentials provided');

        $this->client->send(
            'TestSender',
            ['+22457123456'],
            'Test message'
        );
    }

    /** @test */
    public function it_can_create_contact()
    {
        Http::fake([
            'https://api.nimbasms.com/contacts/create' => Http::response([
                'status' => 'success',
                'data'   => ['id' => '123']
            ], 200)
        ]);

        $response = $this->client->createContact(
            'John Doe',
            ['Group1'],
            '+22457123456'
        );

        Http::assertSent(function ($request) {
            return $request->url() === 'https://api.nimbasms.com/contacts/create';
        });

        $this->assertEquals('success', $response['status']);
    }

    /** @test */
    public function it_can_get_account_details()
    {
        Http::fake([
            'https://api.nimbasms.com/account/details*' => Http::response([
                'status' => 'success',
                'data'   => ['balance' => 100]
            ], 200)
        ]);

        $response = $this->client->getAccountDetails();

        Http::assertSent(function ($request) {
            return str_starts_with($request->url(), 'https://api.nimbasms.com/account/details')
                && ($request->data()['serviceId'] ?? null) === 'test_service_id'
                && ($request->data()['secret'] ?? null) === 'test_secret';
        });

        $this->assertEquals('success', $response['status']);
    }
} 