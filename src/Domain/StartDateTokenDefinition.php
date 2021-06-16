<?php

namespace Fifthgate\Objectivity\StringTokens\Domain;

use Fifthgate\Objectivity\StringTokens\Domain\Interfaces\StringTokenDefinitionInterface;
use Fifthgate\Objectivity\StringTokens\Domain\AbstractStringTokenDefinition;

class StartDateTokenDefinition extends AbstractStringTokenDefinition implements StringTokenDefinitionInterface
{
    const TOKEN_NAME = 'Start Date';

    const TOKEN_DESCRIPTION = 'Replaces a token with a date from context';

    const TOKEN_PLACEHOLDER = 'start_date';

    public function processToken(string $input, $context = null) : string
    {

        return str_replace($this->getEncapsulatedPlaceholder(), $context->format('Y-m-d'), $input);
    }
}
