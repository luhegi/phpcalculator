<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Jakmall\Recruitment\Calculator\Commands\Utility;

class PowCommand extends Utility 
{

    protected function configure() 
    {
        $this->setName('pow')
            ->setDescription('Exponent the given Numbers.')
            ->addArgument(
                'base',
                InputArgument::REQUIRED,
                'The base number'
            )
            ->addArgument(
                'exp',
                InputArgument::REQUIRED,
                'The exponent number'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output) 
    {
        $result = pow( $input->getArgument('base'), $input->getArgument('exp') );
        $text = $input->getArgument('base') ." ^ ". $input->getArgument('exp');

        $textoutput = $text ." = ";

        $this->addHistory(
            'pow',
            $text,
            $result,
            $textoutput .$result
        );

        $output->writeln($textoutput .$result);
    }
}
