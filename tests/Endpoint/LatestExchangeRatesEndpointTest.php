<?php

namespace Deltatuts\Fixer\Tests\Endpoint;

use Deltatuts\Fixer\Endpoint\LatestExchangeRatesEndpoint;
use Deltatuts\Fixer\Exception\InvalidCurrencyCodeException;
use Deltatuts\Fixer\Exception\MissingAPIKeyException;
use Deltatuts\Fixer\FixerHttpClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class LatestExchangeRatesEndpointTest extends TestCase
{
    /**
     * @var MockHandler
     */
    private $handler;

    public function setUp(): void
    {
        $this->handler = new MockHandler();
    }

    public function testBuildUri()
    {
        $client = new FixerHttpClient('mock-key');
        $e = new LatestExchangeRatesEndpoint($client);

        $this->assertStringContainsString('mock-key', $e->buildUri());
        $this->assertStringContainsString('mock-key', $e->buildUri());

        $params = [
            'base' => 'MXN',
            'symbols' => 'USD,EUR'
        ];

        $this->assertStringContainsString('USD', $e->buildUri($params));
        $this->assertStringContainsString('EUR', $e->buildUri($params));
        $this->assertStringContainsString('MXN', $e->buildUri($params));
    }

    /**
     * @throws MissingAPIKeyException
     * @throws InvalidCurrencyCodeException
     * @throws GuzzleException
     */
    public function testLatest()
    {
        $res = new Response(200, [], file_get_contents(__DIR__.'/../_data/latest-response.json'));
        $this->handler->append($res);
        $client = new FixerHttpClient('mock-key', ['handler' => $this->handler]);
        $e = new LatestExchangeRatesEndpoint($client);

        $response = $e->latest('USD', ['MXN', 'EUR']);

        $content = json_decode($response->getBody()->getContents(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertArrayHasKey('success', $content);
        $this->assertTrue($content['success']);
        $this->assertArrayHasKey('rates', $content);
    }

    /**
     * @throws GuzzleException
     * @throws InvalidCurrencyCodeException
     * @throws MissingAPIKeyException
     */
    public function testThrowsExceptionOnInvalidCurrencyCode()
    {
        $this->expectException(InvalidCurrencyCodeException::class);
        (new LatestExchangeRatesEndpoint(new FixerHttpClient('lslsls')))->latest('dollar');
    }
}
