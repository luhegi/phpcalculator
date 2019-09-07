<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Multiply command.
 */
class MultiplyCommand extends Command {
    /**
     * Configure command, set parameters definition.
     */
    protected function configure() {
        $this->setName('multiply')
            ->setDescription('Multiply all given Numbers.')
            ->addArgument('numbers', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'The numbers to be multiplied');
    }
    /**
     * Sum the numbers.
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $arr = $input->getArgument('numbers');
        $result = (int)$arr[0];
        $text = $arr[0];
        for($x = 1; $x < count($arr); $x++){
            $result *= (int)$arr[$x];
            $text .= " * ". $arr[$x];
        }
        $textoutput = $text ." = ";

        $json = new \stdClass();
        $json->command = "multiply";
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
