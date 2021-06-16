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
        $this->assertEquals($service->getTokenByPlaceholder('mock_token'), $mockToken);
        $this->assertNull($service->getTokenByMachineName('faketoken'));
        $this->assertNull($service->getTokenByPlaceholder('faketoken'));
        $this->assertNull($service->detectTokens('There are no tokens in this string'));

        $inputText = "Lorem ipsum dolor sit amet, ad conspectitur adelescing [mock_token]";
        $outputText = $service->processTokens($inputText);
        $this->assertEquals("Lorem ipsum dolor sit amet, ad conspectitur adelescing Wo0t!", $outputText);
    }
}
