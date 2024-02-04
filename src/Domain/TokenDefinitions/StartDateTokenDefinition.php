<?php

namespace Fifthgate\Objectivity\StringTokens\Domain\TokenDefinitions;

use Fifthgate\Objectivity\StringTokens\Domain\Interfaces\StringTokenDefinitionInterface;
use Fifthgate\Objectivity\StringTokens\Domain\TokenDefinitions\AbstractStringTokenDefinition;
use DateTimeInterface;

class StartDateTokenDefinition extends AbstractStringTokenDefinition implements StringTokenDefinitionInterface
{
    public const TOKEN_NAME = 'Start Date';

    public const TOKEN_DESCRIPTION = 'Replaces a token with a date from context';

    public const TOKEN_PLACEHOLDER = 'start_date';

    public function processToken(string $input, $context = null): string
    {
        return str_replace($this->getEncapsulatedPlaceholder(), $context->format('Y-m-d'), $input);
    }

    public function isValidContext($context = null): bool
    {
        return $context instanceof DateTimeInterface;
    }
}
