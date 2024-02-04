<?php

namespace Fifthgate\Objectivity\StringTokens\Domain\TokenDefinitions;

use Fifthgate\Objectivity\StringTokens\Domain\Interfaces\StringTokenDefinitionInterface;
use Fifthgate\Objectivity\Core\Domain\AbstractDomainEntity;

abstract class AbstractStringTokenDefinition extends AbstractDomainEntity implements StringTokenDefinitionInterface
{
    public const TOKEN_NAME = 'Abstract Token Name';

    public const TOKEN_DESCRIPTION = 'Abstract Token Definition';

    public const TOKEN_PLACEHOLDER = 'abstracttokenplaceholder';

    public const TOKEN_MACHINE_NAME = 'abstracttoken';

    public function getTokenName(): string
    {
        return $this::TOKEN_NAME;
    }

    public function getTokenDescription(): string
    {
        return $this::TOKEN_DESCRIPTION;
    }

    public function getTokenPlaceholder(): string
    {
        return $this::TOKEN_PLACEHOLDER;
    }

    public function getTokenMachineName(): string
    {
        return $this::TOKEN_MACHINE_NAME;
    }

    public function getEncapsulatedPlaceholder(): string
    {
        return '['.$this::TOKEN_PLACEHOLDER.']';
    }

    abstract public function isValidContext($context = null): bool;

    public function getClassName(): string
    {
        return static::class;
    }
}
