<?php

namespace Deltatuts\Fixer\Tests;

use Deltatuts\Fixer\Exception\MissingAPIKeyException;
use Deltatuts\Fixer\FixerHttpClient;
use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class FixerHttpClientTest
 * @package Deltatuts\Fixer\Test
 */
class FixerHttpClientTest extends TestCase
{
    /**
     * @throws MissingAPIKeyException
     */
    public function testFixerHttpClientIsAValidImplementationOfClientInterface()
    {
        $client = new FixerHttpClient('some-key');

        $this->assertInstanceOf(ClientInterface::class, $client);
    }

    /**
     * @throws MissingAPIKeyException
     */
    public function testMissingAPIKeyExceptionIsThrownWhenTheAPIKeyIsEmpty()
    {
        $this->expectException(MissingAPIKeyException::class);
        new FixerHttpClient('');
    }

    /**
     * @throws MissingAPIKeyException
     */
    public function testConfigIsOverwrittenWithCustomConfig()
    {
        $client = new FixerHttpClient('asdasdad', ['timeout' => 10, 'base_uri' => 'https://victoravelar.com']);
        $this->assertArrayHasKey('timeout', $client->getConfig());
        $this->assertArrayHasKey('base_uri', $client->getConfig());
        $this->assertEquals(10, $client->getConfig('timeout'));
        $this->assertEquals('https://victoravelar.com', $client->getConfig('base_uri'));
    }
}
