<?php

namespace Fifthgate\Objectivity\StringTokens\Service\Factories;

use Fifthgate\Objectivity\StringTokens\Service\Factories\Exceptions\InvalidStringTokenConfigException;

use Fifthgate\Objectivity\StringTokens\Service\Interfaces\TokenServiceInterface;

/**
 * Builds and populates a TokenServiceInterface-compatible TokenService.
 */
class StringTokenServiceFactory
{

    /**
     * Run this factory.
     *
     * @param  array        $config   The configuration array, as injected from the container.
     * @param  bool|boolean $testMode Whether we're in testmode or not. If so, we will skip config caching and always run on the latest variables.
     *
     * @return TokenServiceInterface  A fully-populated token service
     */
    public function __invoke(array $config, bool $testMode = false) : TokenServiceInterface
    {
        $this->validateConfig($config);
        
        var_dump($config);
        die("Factory invoked");
    }

    public function validateConfig(array $config)
    {
        $isValid = true;
        $errors = [];

        try {
            /**
             * Validation routine
             */
            if (!isset($config['tokens'])) {
                throw new InvalidStringTokenConfigException("The configuration is missing the 'tokens' key");
            } else {
                $tokenDefinitionRequiredfields = [
                    'weight' => 'int',
                    'label' => 'string',
                    'description' => 'string',
                    'class' => 'class'
                ];

                foreach ($tokenDefinitionRequiredfields as $fieldName => $type) {
                    if (!isset($config['tokens'][$fieldName])) {
                        throw new InvalidStringTokenConfigException("The field '{$fieldName}' is required");
                    } else {
                        switch ($type) {
                            case 'int':
                                if (!is_int($config['tokens'][$fieldName])) {
                                    throw new InvalidStringTokenConfigException("The field '{$fieldName}' must be an integer");
                                }
                                break;
                            case 'string':
                                if (!is_string($config['tokens'][$fieldName])) {
                                    throw new InvalidStringTokenConfigException("The field '{$fieldName}' must be a string");
                                }
                                break;
                            default:
                                throw new InvalidStringTokenConfigException("The field '{$fieldName}' is of the unknown type '{$type}'");
                                break;
                        }
                    }
                }
            }
        } catch (InvalidStringTokenConfigException $e) {
            $isValid = false;
            $errors[] = $e->getMessage();
        }

        if (!$isValid) {
            $message = implode(", ", $errors);
            throw new InvalidStringTokenConfigException("The Token Service Config is invalid, for the following reasons: {$message}. \n The Service cannot start.");
        }
    }
}
