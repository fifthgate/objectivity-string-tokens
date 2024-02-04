<?php

namespace Fifthgate\Objectivity\StringTokens\Domain\Collection;

use Fifthgate\Objectivity\StringTokens\Domain\Collection\Interfaces\StringTokenDefinitionCollectionInterface;
use Fifthgate\Objectivity\Core\Domain\Collection\AbstractDomainEntityCollection;
use Fifthgate\Objectivity\Core\Domain\Interfaces\DomainEntityInterface;
use Fifthgate\Objectivity\StringTokens\Domain\Interfaces\StringTokenDefinitionInterface;
use Fifthgate\Objectivity\StringTokens\Domain\Collection\Exceptions\StringTokenClashException;

class StringTokenDefinitionCollection extends AbstractDomainEntityCollection implements StringTokenDefinitionCollectionInterface
{
    public function filterByContextValidity($context): StringTokenDefinitionCollectionInterface
    {
        $filteredCollection = new StringTokenDefinitionCollection();
        foreach ($this->collection as $token) {
            if ($token->isValidContext($context)) {
                $filteredCollection->add($token);
            }
        }
        return $filteredCollection;
    }

    public function add(DomainEntityInterface $domainEntity)
    {
        $errors = $this->validateProposedTokenAddition($domainEntity);
        if (!empty($errors)) {
            $message = implode(", ", $errors);
            throw new StringTokenClashException($message);
        } else {
            parent::add($domainEntity);
        }
    }

    private function validateProposedTokenAddition(StringTokenDefinitionInterface $proposedToken): array
    {
        $errors = [];
        $proposedTokenClassName = $proposedToken->getClassName();

        foreach ($this->collection as $token) {
            $tokenClassName = $token->getClassName();
            if ($token->getTokenName() == $proposedToken->getTokenName()) {
                $errors[] = "Proposed Token `{$proposedTokenClassName}`'s name clashes with {$tokenClassName}";
            }
            if ($token->getTokenPlaceholder() == $proposedToken->getTokenPlaceholder()) {
                $errors[] = "Proposed Token `{$proposedTokenClassName}`'s placeholder clashes with {$tokenClassName}";
            }

            if ($token->getTokenMachineName() == $proposedToken->getTokenMachineName()) {
                $errors[] = "Proposed Token `{$proposedTokenClassName}`'s machine name clashes with {$tokenClassName}";
            }
        }
        return $errors;
    }
}
