<?php

namespace Fifthgate\Objectivity\StringTokens\Tests;

use Orchestra\Testbench\TestCase;
use Fifthgate\Objectivity\StringTokens\Service\Interfaces\TokenServiceInterface;
use Fifthgate\Objectivity\StringTokens\Laravel\Provider\StringTokenServiceProvider;

abstract class ObjectivityStringTokensTestCase extends TestCase
{
    protected TokenServiceInterface $tokenService;

    protected function getPackageProviders($app)
    {
        return [
            StringTokenServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('key', 'base64:j84cxCjod/fon4Ks52qdMKiJXOrO5OSDBpXjVUMz61s=');
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->tokenService = $this->app->get(TokenServiceInterface::class);
    }
}
