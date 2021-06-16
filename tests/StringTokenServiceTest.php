<?php

namespace Fifthgate\Objectivity\StringTokens\Tests;

use Fifthgate\Objectivity\StringTokens\Tests\ObjectivityStringTokensTestCase;
use Fifthgate\Objectivity\StringTokens\Service\TokenService;
use Fifthgate\Objectivity\StringTokens\Domain\Collection\StringTokenDefinitionCollection;
use Fifthgate\Objectivity\StringTokens\Tests\Mocks\MockTokenDefinition;

class StringTokenServiceTest extends ObjectivityStringTokensTestCase
{
    public function testServiceConstruction()
    {
        $collection = new StringTokenDefinitionCollection;
        $mockToken = new MockTokenDefinition;
        $collection->add($mockToken);
        $service = new TokenService($collection);

        $this->assertEquals($service->getTokenByMachineName('mocktoken'), $mockToken);
        $this->assertNull($service->getTokenByMachineName('faketoken'));
    }
}
