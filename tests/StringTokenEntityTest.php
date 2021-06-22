<?php

namespace Fifthgate\Objectivity\StringTokens\Tests;

use Fifthgate\Objectivity\StringTokens\Tests\ObjectivityStringTokensTestCase;
use Fifthgate\Objectivity\StringTokens\Tests\Mocks\MockTokenDefinition;
use Fifthgate\Objectivity\StringTokens\Tests\Mocks\MockInvalidTokenDefinition;

use Fifthgate\Objectivity\StringTokens\Tests\Mocks\MockDateTokenDefinition;

use Fifthgate\Objectivity\StringTokens\Domain\Collection\StringTokenDefinitionCollection;

class StringTokenEntityTest extends ObjectivityStringTokensTestCase
{
    public function testTokenDefinitionIntegrity()
    {
        $definition = new MockTokenDefinition;

        $this->assertEquals('Mock Token Name', $definition->getTokenName());
        $this->assertEquals('mocktoken', $definition->getTokenMachineName());
        $this->assertEquals('Mock Token Description', $definition->getTokenDescription());
        $this->assertEquals('mock_token', $definition->getTokenPlaceholder());
        $this->assertEquals("Mock token Wo0t! goes here", $definition->processToken("Mock token [mock_token] goes here"));
    }

    public function testCollection()
    {
        $collection = new StringTokenDefinitionCollection;
        $mockToken = new MockInvalidTokenDefinition;
        $mockToken2 = new MockDateTokenDefinition;
        $collection->add($mockToken);
        $collection->add($mockToken2);
        $this->assertEquals($mockToken, $collection->first());
        $this->assertEquals($mockToken2, $collection->last());
        $this->assertEquals(2, $collection->count());
        $date = new \DateTime;
        $this->assertEquals(1, $collection->filterByContextValidity($date)->count());
        $this->assertEquals($mockToken2, $collection->filterByContextValidity($date)->first());
    }
}
