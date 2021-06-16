<?php

namespace Fifthgate\Objectivity\StringTokens\Service\Factories;

use Fifthgate\Objectivity\StringTokens\Service\Factories\Exceptions\InvalidStringTokenConfigException;
use \ReflectionClass;
use Fifthgate\Objectivity\StringTokens\Service\Interfaces\TokenServiceInterface;
use \ReflectionException;
use Fifthgate\Objectivity\StringTokens\Domain\Interfaces\StringTokenDefinitionInterface;
use Fifthgate\Objectivity\StringTokens\Domain\Collection\StringTokenDefinitionCollection;
use Fifthgate\Objectivity\StringTokens\Service\TokenService;

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
        
        //Validation safely passed, we continue to build the system.
        $definitionCollection = new StringTokenDefinitionCollection;

        foreach ($config['tokens'] as $tokenMachineName => $tokenClassName) {
            $definitionCollection->add(new $tokenClassName());
        }
        return new TokenService($definitionCollection);
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
                foreach ($config['tokens'] as $tokenMachineName => $className) {
                    $classFound = true;
                    try {
                        $reflection = new ReflectionClass($className);
                    } catch (ReflectionException $e) {
                        $classFound = false;
                    }
                    
                    if (!$classFound) {
                        throw new InvalidStringTokenConfigException("The token '{$tokenMachineName}' references the class '{$className}', which does not exist");
                    } else {
                        if (!$reflection->isInstantiable()) {
                            throw new InvalidStringTokenConfigException("The field '{$tokenMachineName}' references the class '{$className}', which is not instantiable");
                        } else {
                            $class = new $className();
                            if (!$class instanceof StringTokenDefinitionInterface) {
                                throw new InvalidStringTokenConfigException("The field '{$tokenMachineName}' references the class '{$className}'. The class exists and is instantiable, but does not implement StringTokenDefinitionInterface");
                            }
                        }
                    }
                }
            }
        } catch (InvalidStringTokenConfigException $e) {
            $isValid = false;
            $errors[] = $e->getMessage();
        }

        if (!$isValid) {
            $message = "* ";
            $message .= implode(",\n* ", $errors);
            throw new InvalidStringTokenConfigException("The Token Service Config is invalid, for the following reasons:\n {$message}. \n The Service cannot start.");
        }
    }
}
