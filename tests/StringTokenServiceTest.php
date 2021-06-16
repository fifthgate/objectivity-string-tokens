<?php

namespace Fifthgate\Objectivity\StringTokens\Tests;

use Fifthgate\Objectivity\StringTokens\Tests\ObjectivityStringTokensTestCase;
use Fifthgate\Objectivity\StringTokens\Service\TokenService;
use Fifthgate\Objectivity\StringTokens\Domain\Collection\StringTokenDefinitionCollection;
use Fifthgate\Objectivity\StringTokens\Tests\Mocks\MockTokenDefinition;
use Fifthgate\Objectivity\StringTokens\Domain\StartDateTokenDefinition;
use Carbon\Carbon;

class StringTokenServiceTest extends ObjectivityStringTokensTestCase
{
    public function testServiceConstruction()
    {
        $collection = new StringTokenDefinitionCollection;
        $mockToken = new MockTokenDefinition;
        $collection->add($mockToken);

        $dateToken = new StartDateTokenDefinition;
        $collection->add($dateToken);
        $service = new TokenService($collection);

        $this->assertEquals($service->getTokenByMachineName('mocktoken'), $mockToken);
        $this->assertEquals($service->getTokenByPlaceholder('mock_token'), $mockToken);
        $this->assertNull($service->getTokenByMachineName('faketoken'));
        $this->assertNull($service->getTokenByPlaceholder('faketoken'));
        $this->assertNull($service->detectTokens('There are no tokens in this string'));

        $inputText = "Lorem ipsum dolor sit amet, ad conspectitur adelescing [mock_token], @ [start_date]";
        $date = new Carbon;
        $outputText = $service->processTokens($inputText, [], $date);
        $this->assertEquals("Lorem ipsum dolor sit amet, ad conspectitur adelescing Wo0t!, @ {$date->format('Y-m-d')}", $outputText);
    }
}
