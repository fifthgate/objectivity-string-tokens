<?php

namespace Fifthgate\Objectivity\StringTokens\Laravel\Commands;
 
use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class CreateStringToken extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:stringtoken {tokenName} : The name of the token to be generated.';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a new string token';

    protected $type = 'StringToken';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct($files);
    }
 
    /**
     * Execute the console command.
     *
     * @return mixed
     *
    public function handle()
    {
        $this->tokenName = $this->argument('tokenName');
        $this->info($this->tokenName.' created successfully.');
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return trim($this->argument('tokenName'));
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        $path = $this->laravel['path'].'/StringTokens/'.str_replace('\\', '/', $name).'.php';
        
        return $path;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = __DIR__.'/../Stubs/stringtoken.stub';
        return $stub;
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return $this->laravel->getNamespace().'StringTokens';
    }
}
