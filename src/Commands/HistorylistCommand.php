<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

/**
 * Substract command.
 */
class HistorylistCommand extends Command {
    /**
     * Configure command, set parameters definition.
     */
    protected function configure() {
        $this->setName('history:list')
            ->setDescription('Show calculator history.')
            ->addArgument('commands', InputArgument::IS_ARRAY | InputArgument::OPTIONAL, 'Filter the history by commands');
    }
    /**
     * Sum the numbers.
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $get_history = file_get_contents('history.json');
        $history = json_decode($get_history);

        if(count($history)) {
            $table = new Table($output);
            $rows = [];
            if(count($input->getArgument('commands'))) {
                foreach ($history as $key => $value) {
                    if(in_array($value->command, $input->getArgument('commands'))) {
                        $rows[] = [$key, $value->command, $value->description, $value->result, $value->output, $value->time];
                    }
                }
            } else {
                foreach ($history as $key => $value) {
                    $rows[] = [$key, $value->command, $value->description, $value->result, $value->output, $value->time];
                }
            }

            $table->setHeaders(['No', 'Command', 'Description', 'Result', 'Output', 'Time'])
                ->setRows($rows);
            $table->render();
        } else {
            $output->writeln('History is empty');
        }
    }
}
