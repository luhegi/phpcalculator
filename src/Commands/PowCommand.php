<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Pow command.
 */
class PowCommand extends Command {
    /**
     * Configure command, set parameters definition.
     */
    protected function configure() {
        $this->setName('pow')
            ->setDescription('Exponent the given Numbers.')
            ->addArgument('base', InputArgument::REQUIRED, 'The base number')
            ->addArgument('exp', InputArgument::REQUIRED, 'The exponent number');
    }
    /**
     * Sum the numbers.
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $result = pow( $input->getArgument('base'), $input->getArgument('exp') );
        $text = $input->getArgument('base') ." ^ ". $input->getArgument('exp');

        $textoutput = $text ." = ";

        $json = new \stdClass();
        $json->command = "pow";
        $json->description = $text;
        $json->result = $result;
        $json->output = $textoutput . $result;
        $json->time = \Carbon\Carbon::now()->format('Y-m-d H:i:s');

        $get_current = file_get_contents('history.json');
        $tempArray = json_decode($get_current);
        array_push($tempArray, $json);
        $jsonData = json_encode($tempArray);
        file_put_contents('history.json', $jsonData);

        $output->writeln($textoutput . $result);
    }
}
