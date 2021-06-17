<?php

namespace Fifthgate\Objectivity\StringTokens\Domain;

use Fifthgate\Objectivity\StringTokens\Domain\Interfaces\StringTokenDefinitionInterface;
use Fifthgate\Objectivity\Core\Domain\AbstractDomainEntity;

abstract class AbstractStringTokenDefinition extends AbstractDomainEntity implements StringTokenDefinitionInterface
{
    const TOKEN_NAME = 'Abstract Token Name';

    const TOKEN_DESCRIPTION = 'Abstract Token Definition';

    const TOKEN_PLACEHOLDER = 'abstracttokenplaceholder';

    const TOKEN_MACHINE_NAME = 'abstracttoken';

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

    public function getTokenMachineName() : string
    {
        return $this::TOKEN_MACHINE_NAME;
    }

    public function getEncapsulatedPlaceholder() : string
    {
        return '['.$this::TOKEN_PLACEHOLDER.']';
    }

    abstract public function isValidContext($context) : bool;
}
