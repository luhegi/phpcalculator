<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Divide command.
 */
class DivideCommand extends Command {
    /**
     * Configure command, set parameters definition.
     */
    protected function configure() {
        $this->setName('divide')
            ->setDescription('Divide all given Numbers.')
            ->addArgument('numbers', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'The numbers to be divided');
    }
    /**
     * Sum the numbers.
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $arr = $input->getArgument('numbers');
        $result = (int)$arr[0];
        $text = $arr[0];
        for($x = 1; $x < count($arr); $x++){
            $result /= (int)$arr[$x];
            $text .= " / ". $arr[$x];
        }
        $text .= " = ";
        $output->writeln($text . $result);
    }
}
