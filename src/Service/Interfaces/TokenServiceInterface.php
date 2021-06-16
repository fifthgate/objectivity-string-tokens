<?php

namespace Fifthgate\Objectivity\StringTokens\Service\Interfaces;

use Fifthgate\Objectivity\StringTokens\Domain\Interfaces\StringTokenDefinitionInterface;

interface TokenServiceInterface
{
     /**
     * Retrieve an individual token by its machine name.
     *
     * @param  string $tokenMachineName A token machine name
     *
     * @return StringTokenDefinitionInterface|null A Token definition, or none if not found.
     */
    public function getTokenByMachineName(string $tokenMachineName) : ? StringTokenDefinitionInterface;

    /**
     * Retrieve an individual token by its placeholder.
     *
     * @param  string $tokenPlaceholder A token placeholder
     *
     * @return StringTokenDefinitionInterface|null A Token definition, or none if not found.
     */
    public function getTokenByPlaceholder(string $tokenPlaceholder) : ? StringTokenDefinitionInterface;

    /**
     * Detect all the tokens within an input string.
     *
     * @param  string $input The input string.
     *
     * @return array|null An array of token objects, ready for processing, or null if no tokens were detected,
     */
    public function detectTokens(string $input): ? array;

    /**
     * Process a string to detect and replace tokens within it.
     *
     * @param  string $input          The Input string
     * @param  array  $tokenWhitelist A list of tokens allowed for this substitution. If empty, all tokens are allowed.
     * @param  mixed  $context        A contect object required by the token.
     *
     * @return string                 The string, with substitutions made.
     */
    public function processTokens(string $input, array $tokenWhitelist = [], $context = null) : string;
}
