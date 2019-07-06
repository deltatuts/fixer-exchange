<?php

namespace Deltatuts\Fixer\Tests\Endpoint;

use Deltatuts\Fixer\Endpoint\AbstractBaseEndpoint;
use Deltatuts\Fixer\FixerHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractBaseEndpointTest
 * @package Deltatuts\Fixer\Tests\Endpoint
 */
class AbstractBaseEndpointTest extends TestCase
{
    public function testBuildUri()
    {
        $client = new FixerHttpClient('api-key');
        $e = $this->getMockForAbstractClass(AbstractBaseEndpoint::class, [$client]);
        $this->assertStringContainsString('access_key=api-key', $e->buildUri());
        $this->assertStringContainsString('foo=bar', $e->buildUri(['foo' => 'bar']));
    }
}
