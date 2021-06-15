<?php

namespace Fifthgate\Objectivity\StringTokens\Domain;

use Fifthgate\Objectivity\StringTokens\Domain\Interfaces\StringTokenDefinitionInterface;
use Fifthgate\Objectivity\Core\Domain\AbstractDomainEntity;

abstract class AbstractStringTokenDefinition extends AbstractDomainEntity implements StringTokenDefinitionInterface
{
    const TOKEN_NAME = 'Abstract Token Name';

    const TOKEN_DESCRIPTION = 'Abstract Token Definition';

    const TOKEN_PLACEHOLDER = 'abstracttokenplaceholder';

    public function getTokenName() : string
    {
        return $this::TOKEN_NAME;
    }

    public function getTokenDescription() : string
    {
        return $this::TOKEN_DESCRIPTION;
    }

    public function getTokenPlaceholder() : string
    {
        return $this::TOKEN_PLACEHOLDER;
    }
}
