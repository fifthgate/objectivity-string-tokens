<?php

namespace Fifthgate\Objectivity\StringTokens\Tests;

use Fifthgate\Objectivity\StringTokens\Tests\ObjectivityStringTokensTestCase;
use Fifthgate\Objectivity\StringTokens\Tests\Mocks\MockTokenDefinition;

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
}
