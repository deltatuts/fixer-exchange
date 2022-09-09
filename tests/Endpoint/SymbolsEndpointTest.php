<?php

namespace Deltatuts\Fixer\Tests\Endpoint;

use Deltatuts\Fixer\Endpoint\SymbolsEndpoint;
use Deltatuts\Fixer\Exception\MissingAPIKeyException;
use Deltatuts\Fixer\FixerHttpClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class SymbolsEndpointTest extends TestCase
{
    /**
     * @var MockHandler
     */
    private $handler;

    /**
     * tests setup.
     */
    public function setUp(): void
    {
        $this->handler = new MockHandler();
    }

    /**
     * @throws MissingAPIKeyException
     * @throws GuzzleException
     */
    public function testSupported()
    {
        $res = new Response(200, [], file_get_contents(__DIR__ . '/../_data/symbols-response.json'));
        $this->handler->append($res);
        $client = new FixerHttpClient('mock-key', ['handler' => $this->handler]);
        $e = new SymbolsEndpoint($client);

        $response = $e->supported();
        $content = json_decode($response->getBody()->getContents(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('success', $content);
        $this->assertTrue($content['success']);
        $this->assertArrayHasKey('symbols', $content);
        $this->assertArrayHasKey('AMD', $content['symbols']);
        $this->assertEquals('Armenian Dram', $content['symbols']['AMD']);
    }

    public function testBuildUri()
    {
        $client = new FixerHttpClient('mock-key');
        $e = new SymbolsEndpoint($client);

        $this->assertStringContainsString('symbols', $e->buildUri());
        $this->assertStringContainsString('mock-key', $e->buildUri());
        $this->assertStringContainsString('mock-key', $e->buildUri());
    }
}
