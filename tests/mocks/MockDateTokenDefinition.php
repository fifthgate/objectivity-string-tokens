<?php

namespace Fifthgate\Objectivity\StringTokens\Tests\Mocks;

use Fifthgate\Objectivity\StringTokens\Domain\Interfaces\StringTokenDefinitionInterface;
use Fifthgate\Objectivity\StringTokens\Domain\TokenDefinitions\AbstractStringTokenDefinition;
use \DateTimeInterface;

class MockDateTokenDefinition extends AbstractStringTokenDefinition implements StringTokenDefinitionInterface
{
    const TOKEN_MACHINE_NAME = 'mockdatetoken';
    
    const TOKEN_NAME = 'Mock Date Token';

    const TOKEN_DESCRIPTION = 'Mock Date Doken';

    const TOKEN_PLACEHOLDER = 'mock_date_token';

    public function processToken(string $input, $context = null) : string
    {
        $replacementString = "[".$this::TOKEN_PLACEHOLDER."]";
        return str_replace($replacementString, "Wo0t!", $input);
    }

    public function isValidContext($context = null) : bool
    {
        return $context != null && ($context instanceof DateTimeInterface);
    }
}
