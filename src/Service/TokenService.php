<?php

namespace Fifthgate\Objectivity\StringTokens\Service;

use Fifthgate\Objectivity\StringTokens\Service\Interfaces\TokenServiceInterface;
use Fifthgate\Objectivity\StringTokens\Domain\Collection\Interfaces\StringTokenDefinitionCollectionInterface;

class TokenService implements TokenServiceInterface
{
    protected StringTokenDefinitionCollectionInterface $tokenDefinitions;

    public function __construct(StringTokenDefinitionCollectionInterface $tokenDefinitions)
    {
        $this->tokenDefinitions = $tokenDefinitions;
    }
}
