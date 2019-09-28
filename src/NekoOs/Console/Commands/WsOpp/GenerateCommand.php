<?php

namespace NekoOs\Console\Commands\WsOpp;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Wsdl2PhpGenerator\Config;
use Wsdl2PhpGenerator\Generator;

class GenerateCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'wsopp:generate';

//    protected $signature = 'wsopp:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "WSDL to Object PHP package generator";


    public function fire()
    {
        $wsdl = $this->input->getOption('wsdl');

        $namespace = $this->input->getOption('namespace');

        $target = $this->input->getOption('target');

        $composer = base_path('composer.json');
        if (file_exists($composer)) {
            $composer = json_decode(file_get_contents($composer));
        }
        $key = array_search('app/', (array)data_get($composer, 'autoload.psr-4') ?? []);

        $path = $namespace;
        if (strpos($target, 'app/') === 0) {
            $namespace = preg_replace(['(app/)', "(/)"], [$key, "\\"], "$target\\$namespace");
        }

        $dirname = str_replace(["\\", '//'], '/', base_path("$target/$path"));

        $this->info("Objects definition created in {$dirname} $namespace");

        $generator = new Generator();
        $generator->generate(
            new Config([
                'inputFile' => $wsdl,
                'outputDir' => $dirname,
                'namespaceName' => $namespace,
            ])
        );
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->fire();
    }

    public function puto()
    {
        $this->info("Happy egg pascua");
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['wsdl', null, InputOption::VALUE_REQUIRED, 'The definition contract.'],
            ['namespace', null, InputOption::VALUE_OPTIONAL, 'The namespace of generated objects.', null],
            ['target', null, InputOption::VALUE_OPTIONAL, 'The target folder of generated objects.', 'app/Service/Soap'],
        ];
    }

}
