<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Jakmall\Recruitment\Calculator\Commands\Utility;

class SubstractCommand extends Utility 
{

    protected function configure() 
    {
        $this->setName('substract')
            ->setDescription('Substract all given Numbers.')
            ->addArgument(
                'numbers',
                InputArgument::IS_ARRAY | InputArgument::REQUIRED,
                'The numbers to be substracted'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output) 
    {
        $this->operation(
            $input,
            $output,
            'substract'
        );
    }
}
