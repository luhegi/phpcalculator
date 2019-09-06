<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Add command.
 */
class AddCommand extends Command {
    /**
     * Configure command, set parameters definition.
     */
    protected function configure() {
        $this->setName('add')
            ->setDescription('Add all given Numbers.')
            ->addArgument('numbers', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'The numbers to be added');
    }
    /**
     * Sum the numbers.
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $result = 0;
        $text = "";
        $arr = $input->getArgument('numbers');
        for($x = 0; $x < count($arr); $x++){
                $result += (int)$arr[$x];
                if(strlen($text)){
                        $text .= " + ". $arr[$x];
                } else {
                        $text = $arr[$x];
                }
        }
        $text .= " = ";
        $output->writeln($text . $result);
    }
}
