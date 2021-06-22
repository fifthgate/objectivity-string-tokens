<?php

namespace Fifthgate\Objectivity\StringTokens\Domain\Collection;

use Fifthgate\Objectivity\StringTokens\Domain\Collection\Interfaces\StringTokenDefinitionCollectionInterface;
use Fifthgate\Objectivity\Core\Domain\Collection\AbstractDomainEntityCollection;

class StringTokenDefinitionCollection extends AbstractDomainEntityCollection implements StringTokenDefinitionCollectionInterface
{
    public function filterByContextValidity($context) : StringTokenDefinitionCollectionInterface
    {
        $filteredCollection = new StringTokenDefinitionCollection;
        foreach ($this->collection as $token) {
            if ($token->isValidContext($context)) {
                $filteredCollection->add($token);
            }
        }
        return $filteredCollection;
    }
}
