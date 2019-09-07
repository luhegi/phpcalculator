<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use \Carbon\Carbon;

class Utility extends Command 
{
    
    public function __construct()
    {
        parent::__construct();
    }

    protected function operation(
        InputInterface $input,
        OutputInterface $output,
        $operation
    ) {
        $arr = $input->getArgument('numbers');
        $result = (int)$arr[0];
        $text = $arr[0];
        switch ($operation) {
            case 'add':
                for($x = 1; $x < count($arr); $x++){
                    $result += (int)$arr[$x];
                    $text .= " + ". $arr[$x];
                }
                break;

            case 'substract':
                for($x = 1; $x < count($arr); $x++){
                    $result -= (int)$arr[$x];
                    $text .= " - ". $arr[$x];
                }
                break;

            case 'multiply':
                for($x = 1; $x < count($arr); $x++){
                    $result *= (int)$arr[$x];
                    $text .= " * ". $arr[$x];
                }
                break;

            case 'divide':
                for($x = 1; $x < count($arr); $x++){
                    $result /= (int)$arr[$x];
                    $text .= " / ". $arr[$x];
                }
                break;

            default:
                
                break;    
        }
        $textoutput = $text ." = ";
        $this->addHistory(
            $operation,
            $text,
            $result,
            $textoutput . $result
        );

        $output->writeln($textoutput .$result);
    }

    protected function addHistory(
        $operation,
        $description,
        $result,
        $output
    ) { 
        $json = new \stdClass();
        $json->command = $operation;
        $json->description = $description;
        $json->result = $result;
        $json->output = $output;
        $json->time = \Carbon\Carbon::now()->format('Y-md H:i:s');

        $get_current = file_get_contents('history.json');
        $tempArray = json_decode($get_current);
        array_push($tempArray, $json);
        $jsonData = json_encode($tempArray);
        file_put_contents('history.json', $jsonData);

        return $json;
    }
}