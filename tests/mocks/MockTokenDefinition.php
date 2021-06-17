<?php

namespace Fifthgate\Objectivity\StringTokens\Tests\Mocks;

use Fifthgate\Objectivity\StringTokens\Domain\Interfaces\StringTokenDefinitionInterface;
use Fifthgate\Objectivity\StringTokens\Domain\AbstractStringTokenDefinition;

class MockTokenDefinition extends AbstractStringTokenDefinition implements StringTokenDefinitionInterface
{
    const TOKEN_MACHINE_NAME = 'mocktoken';
    
    const TOKEN_NAME = 'Mock Token Name';

    const TOKEN_DESCRIPTION = 'Mock Token Description';

    const TOKEN_PLACEHOLDER = 'mock_token';

    public function processToken(string $input, $context = null) : string
    {
        $replacementString = "[".$this::TOKEN_PLACEHOLDER."]";
        return str_replace($replacementString, "Wo0t!", $input);
    }

    public function isValidContext($context) : bool
    {
        return true;
    }
}
