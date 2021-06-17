<?php

namespace Fifthgate\Objectivity\StringTokens\Service\Factories;

use Fifthgate\Objectivity\StringTokens\Service\Factories\Exceptions\InvalidStringTokenConfigException;
use \ReflectionClass;
use Fifthgate\Objectivity\StringTokens\Service\Interfaces\TokenServiceInterface;
use \ReflectionException;
use Fifthgate\Objectivity\StringTokens\Domain\Interfaces\StringTokenDefinitionInterface;
use Fifthgate\Objectivity\StringTokens\Domain\Collection\StringTokenDefinitionCollection;
use Fifthgate\Objectivity\StringTokens\Service\TokenService;
use HaydenPierce\ClassFinder\ClassFinder;

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
        foreach ($config['autoload_namespaces'] as $autoloadNamespace) {
            foreach (ClassFinder::getClassesInNamespace($autoloadNamespace) as $candidateClass) {
                $class = new ReflectionClass($candidateClass);
                if (!$class->isAbstract() && $class->isInstantiable() && $class->implementsInterface(StringTokenDefinitionInterface::class)) {
                    $definitionCollection->add(new $candidateClass());
                }
            }
        }
        return new TokenService($definitionCollection);
    }







    //@codeCoverageIgnoreStart
    public function validateConfig(array $config)
    {
        $isValid = true;
        $errors = [];

        try {
            /**
             * Validation routine
             */
            if (!isset($config['autoload_namespaces'])) {
                throw new InvalidStringTokenConfigException("The 'autoload_namespaces' key is not set. This is required for the stringTokens system to function");
            } elseif (empty($config['autoload_namespaces'])) {
                throw new InvalidStringTokenConfigException("The 'autoload_namespaces' key is empty. This is required for the stringTokens system to function");
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
    //@codeCoverageIgnoreEnd
}
