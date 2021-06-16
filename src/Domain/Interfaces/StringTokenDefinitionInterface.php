<?php

namespace Fifthgate\Objectivity\StringTokens\Domain\Interfaces;

use Fifthgate\Objectivity\Core\Domain\Interfaces\DomainEntityInterface;

interface StringTokenDefinitionInterface extends DomainEntityInterface
{
    public function getTokenName() : string;

    public function getTokenDescription() : string;

    public function getTokenPlaceholder() : string;

    public function getTokenMachineName() : string;

    public function processToken(string $input, $context = null) : string;
}
