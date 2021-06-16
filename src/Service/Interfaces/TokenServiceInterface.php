<?php

namespace Fifthgate\Objectivity\StringTokens\Service\Interfaces;

use Fifthgate\Objectivity\StringTokens\Domain\Interfaces\StringTokenDefinitionInterface;

interface TokenServiceInterface
{
    public function getTokenByMachineName(string $tokenMachineName) : ? StringTokenDefinitionInterface;
}
