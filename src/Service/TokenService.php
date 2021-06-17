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

    /**
     * Retrieve an individual token by its placeholder.
     *
     * @param  string $tokenPlaceholder A token placeholder
     *
     * @return StringTokenDefinitionInterface|null A Token definition, or none if not found.
     */
    public function getTokenByPlaceholder(string $tokenPlaceholder) : ? StringTokenDefinitionInterface
    {
        foreach ($this->tokenDefinitions as $tokenDefinition) {
            if ($tokenDefinition->getTokenPlaceholder() == $tokenPlaceholder) {
                return $tokenDefinition;
            }
        }
        return null;
    }

    /**
     * Retrieve an individual token by its machine name.
     *
     * @param  string $tokenMachineName A token machine name
     *
     * @return StringTokenDefinitionInterface|null A Token definition, or none if not found.
     */
    public function getTokenByMachineName(string $tokenMachineName) : ? StringTokenDefinitionInterface
    {
        foreach ($this->tokenDefinitions as $tokenDefinition) {
            if ($tokenDefinition->getTokenMachineName() == $tokenMachineName) {
                return $tokenDefinition;
            }
        }
        return null;
    }

    /**
     * Process a string to detect and replace tokens within it.
     *
     * @param  string $input          The Input string
     * @param  array  $tokenWhitelist A list of tokens allowed for this substitution. If empty, all tokens are allowed.
     * @param  mixed  $context        A contect object required by the token.
     *
     * @return string                 The string, with substitutions made.
     */
    public function processTokens(string $input, array $tokenWhitelist = [], $context = null) : string
    {
        $detectedTokens = $this->detectTokens($input);
        
        if (!empty($tokenWhitelist)) {
            $tokensToProcess = [];
            foreach ($detectedTokens as $token) {
                if (in_array($token->getTokenMachineName(), $tokenWhitelist)) {
                    $tokensToProcess[$token->getTokenMachineName()] = $token;
                }
            }
        } else {
            $tokensToProcess = $detectedTokens;
        }

        if (!empty($tokensToProcess)) {
            $output = $input;
            foreach ($tokensToProcess as $token) {
                if ($token->isValidContext($context)) {
                    $output = $token->processToken($output, $context);
                }
            }
            return $output;
        }
        return $input;
    }



    /**
     * Detect all the tokens within an input string.
     *
     * @param  string $input The input string.
     *
     * @return array|null An array of token objects, ready for processing, or null if no tokens were detected,
     */
    public function detectTokens(string $input): ? array
    {
        $tokenDetectionPattern =  '/\[(.*?)\]/';
        
        preg_match_all($tokenDetectionPattern, $input, $detectedTokens);

        $possibleTokens = $this->flattenStripAndDeduplicateTokens($detectedTokens);
        $tokenManifest = [];
        foreach ($possibleTokens as $possibleToken) {
            if ($this->getTokenByPlaceholder($possibleToken)) {
                $tokenManifest[$possibleToken] = $this->getTokenByPlaceholder($possibleToken);
            }
        }
        
        return !empty($tokenManifest) ? $tokenManifest : null;
    }

    //@codeCoverageIgnoreStart
    /**
     * A utility function to flatten tokens into a more usable structure.
     *
     * Note: This and its recursive pattern are not under testing as they're quite simple.
     *
     * @param  array  $tokens An array of detected tokens.
     *
     * @return [type]         [description]
     */
    protected function flattenStripAndDeduplicateTokens(array $tokens)
    {
     
        $flattenedTokens = [];
        //Process through our initial list.
        foreach ($tokens as $delta => $token) {
            if (is_string($token)) {
                $flattenedTokens[] = $token;
            } elseif (is_array($token)) {
                $this->recursiveFlatten($token, $flattenedTokens);
            }
        }
        $strippedTokens = [];
        if (!empty($flattenedTokens)) {
            foreach ($flattenedTokens as $flattenedToken) {
                $strippedToken = str_replace('[', '', $flattenedToken);
                $strippedToken = str_replace(']', '', $strippedToken);
                $strippedTokens[] = $strippedToken;
            }
        }

        return array_unique($strippedTokens);
    }

    protected function recursiveFlatten(array $subtokens, array &$flattenedTokens = [])
    {
        foreach ($subtokens as $subtoken) {
            if (is_string($subtoken)) {
                $flattenedTokens[] = $subtoken;
            } elseif (is_array($subtoken)) {
                $this->recursiveFlatten($subtoken, $flattenedTokens);
            }
        }
    }
    //@codeCoverageIgnoreEnd
}
