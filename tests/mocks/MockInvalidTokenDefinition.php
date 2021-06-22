<?php

namespace Fifthgate\Objectivity\StringTokens\Tests\Mocks;

use Fifthgate\Objectivity\StringTokens\Domain\Interfaces\StringTokenDefinitionInterface;
use Fifthgate\Objectivity\StringTokens\Domain\TokenDefinitions\AbstractStringTokenDefinition;
use \DateTimeInterface;

class MockInvalidTokenDefinition extends AbstractStringTokenDefinition implements StringTokenDefinitionInterface
{
    const TOKEN_MACHINE_NAME = 'mockinvalidtoken';
    
    const TOKEN_NAME = 'Mock Invalid Token';

    const TOKEN_DESCRIPTION = 'Mock Invalid Doken';

    const TOKEN_PLACEHOLDER = 'mock_invalid_token';

    public function processToken(string $input, $context = null) : string
    {
        return $input;
    }

    public function isValidContext($context = null) : bool
    {
        return false;
    }
}
