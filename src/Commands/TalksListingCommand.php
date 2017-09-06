<?php
/**
 * PHP Command Line Applications
 *
 * @license MIT
 */

namespace andrewwoods\phpCliApps\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
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


        $talksRepository = new Talks();
        $talks = $talksRepository->search($keyword);

        $table = new Table($output);
        $table
            ->setHeaders(['ID', 'Title', 'Speaker', 'Date', 'Start Time', 'End Time', 'Type', 'Level'])
            ->setRows($talks)
            ->render();
    }

}
