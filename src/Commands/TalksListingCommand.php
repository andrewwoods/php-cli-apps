<?php
/**
 * PHP Command Line Applications
 *
 * @license MIT
 */

namespace andrewwoods\phpCliApps\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use andrewwoods\phpCliApps\Talks;

/**
 * Class TalksListingCommand
 * @package andrewwoods\phpCliApps\Command
 */
class TalksListingCommand extends Command
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("talks:list")
             ->setDescription("List all talks")
             ->addArgument('keyword', InputArgument::OPTIONAL, 'include a word to filter by');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $keyword = $input->getArgument('keyword');

        if ( $input->getOption('version') ) {
            echo $this->displayVersionInfo();
            exit(0);
        }

        $talksRepository = new Talks();
        $talks = $talksRepository->get();
        $filtered = $talksRepository->search($talks, $keyword);

        $table = new Table($output);
        $table
            ->setHeaders(['ID', 'Title', 'Speaker', 'Date', 'Start Time', 'End Time', 'Type', 'Level'])
            ->setRows($filtered)
            ->render();
    }

    /**
     * Display the version info
     *
     * @return string
     */
    protected function displayVersionInfo()
    {
        echo $this->getName() . ' 0.1.0-alpha';
    }

}
