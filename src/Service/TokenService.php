<?php

namespace Fifthgate\Objectivity\StringTokens\Service;

use Fifthgate\Objectivity\StringTokens\Service\Interfaces\TokenServiceInterface;
use Fifthgate\Objectivity\StringTokens\Domain\Collection\Interfaces\StringTokenDefinitionCollectionInterface;
use Fifthgate\Objectivity\StringTokens\Domain\Interfaces\StringTokenDefinitionInterface;

class TokenService implements TokenServiceInterface
{
    protected StringTokenDefinitionCollectionInterface $tokenDefinitions;

    public function __construct(StringTokenDefinitionCollectionInterface $tokenDefinitions)
    {
        $this->tokenDefinitions = $tokenDefinitions;
    }

    public function getTokenByMachineName(string $tokenMachineName) : ? StringTokenDefinitionInterface
    {
        foreach ($this->tokenDefinitions as $tokenDefinition) {
            if ($tokenDefinition->getTokenMachineName() == $tokenMachineName) {
                return $tokenDefinition;
            }
            return null;
        }
    }
}
