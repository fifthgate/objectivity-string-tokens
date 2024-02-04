<?php

namespace Fifthgate\Objectivity\StringTokens\Tests\Mocks;

use Fifthgate\Objectivity\StringTokens\Domain\Interfaces\StringTokenDefinitionInterface;
use Fifthgate\Objectivity\StringTokens\Domain\TokenDefinitions\AbstractStringTokenDefinition;

class MockTokenDefinition extends AbstractStringTokenDefinition implements StringTokenDefinitionInterface
{
    public const TOKEN_MACHINE_NAME = 'mocktoken';

    public const TOKEN_NAME = 'Mock Token Name';

    public const TOKEN_DESCRIPTION = 'Mock Token Description';

    public const TOKEN_PLACEHOLDER = 'mock_token';

    public function processToken(string $input, $context = null): string
    {
        $replacementString = "[".$this::TOKEN_PLACEHOLDER."]";
        return str_replace($replacementString, "Wo0t!", $input);
    }

    public function isValidContext($context = null): bool
    {
        return true;
    }
}
