<?php
/*
 * @author Alex (LinhTran)
 * @Date : 02/04/2013
 */

namespace Butvang\BvBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class GreetCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('bv:mycommand')
            ->setDescription('Greet someone')
            ->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?')
            ->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dialog = $this->getHelperSet()->get('dialog');
        if (!$dialog->askConfirmation($output, '<question>Do you confirm spamming our users?</question>', false)) {
            return;
        }    
        $output->getFormatter()->setStyle('fcbarcelona', new OutputFormatterStyle('red', 'blue', array('blink', 'bold', 'underscore')));
        $name = $input->getArgument('name');
        if ($name) {
            $text = 'Hello '.$name;
        } else {
            $text = 'Hello';
        }

        if ($input->getOption('yell')) {
            $text = strtoupper($text);
        }
        $output->writeln('<fcbarcelona>'. $text .'</fcbarcelona>');
    }
}