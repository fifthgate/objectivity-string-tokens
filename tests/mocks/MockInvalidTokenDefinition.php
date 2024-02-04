<?php

namespace Fifthgate\Objectivity\StringTokens\Tests\Mocks;

use Fifthgate\Objectivity\StringTokens\Domain\Interfaces\StringTokenDefinitionInterface;
use Fifthgate\Objectivity\StringTokens\Domain\TokenDefinitions\AbstractStringTokenDefinition;
use DateTimeInterface;

class MockInvalidTokenDefinition extends AbstractStringTokenDefinition implements StringTokenDefinitionInterface
{
    public const TOKEN_MACHINE_NAME = 'mockinvalidtoken';

    public const TOKEN_NAME = 'Mock Invalid Token';

    public const TOKEN_DESCRIPTION = 'Mock Invalid Doken';

    public const TOKEN_PLACEHOLDER = 'mock_invalid_token';

    public function processToken(string $input, $context = null): string
    {
        return $input;
    }

    public function isValidContext($context = null): bool
    {
        return false;
    }
}
