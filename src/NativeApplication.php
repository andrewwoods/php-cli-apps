<?php
/**
 * PHP Command Line Applications
 *
 * @license MIT
 */

namespace andrewwoods\phpCliApps;

/**
 * Class NativeApplication
 * @package andrewwoods\phpCliApps
 */
class NativeApplication extends AbstractApplication
{
    protected $name = 'native.php';

    protected $version = '0.2.0';

    protected $options = [];

    protected $arguments = [];

    /**
     * NativeApplication constructor.
     *
     * @param array $options
     * @param array $arguments
     */
    public function __construct(array $options, array $arguments)
    {
        $this->options = $options;
        $this->arguments = $arguments;
    }

    /**
     * Execute the command for this command class.
     *
     * Check for options tha preempt the main logic.
     *
     * @return void
     */
    public function run()
    {
        if (isset($this->options['h']) || isset($this->options['help'])) {
            $this->displayHelp();
            exit(0);
        }

        if (isset($this->options['v']) || isset($this->options['version'])) {
            echo $this->getNameAndVersion();
            exit(0);
        }

        $this->main();
    }

    /**
     * The main logic
     */
    protected function main()
    {
        $keyword = (isset($this->arguments[0])) ? $this->arguments[0] : '';

        $talksRepository = new Talks();
        $talks = $talksRepository->get();
        $filtered = $talksRepository->search($talks, $keyword);

        $this->displayTable($filtered);
    }

    /**
     * Display the talks as a formatted table
     *
     * @param array $filtered
     * @return void
     */
    protected function displayTable($filtered)
    {
        $header = [
            'talkId'    => 'ID',
            'title'     => 'Title',
            'speakerId' => 'Speaker',
            'date'      => 'Date',
            'startTime' => 'Start Time',
            'endTime'   => 'End Time',
            'type'      => 'Type',
            'level'     => 'Level'
        ];
        $divider = [
            'talkId'    => '--',
            'title'     => '-----',
            'speakerId' => '-------',
            'date'      => '----',
            'startTime' => '----------',
            'endTime'   => '--------',
            'type'      => '----',
            'level'     => '-----'
        ];
        $this->displayTableRow($header);
        $this->displayTableRow($divider);
        foreach ($filtered as $row) {
            $this->displayTableRow($row);
        }
    }

    /**
     * Display an associative array as a row in a formatted table
     *
     * @param array $row
     * @return void
     */
    protected function displayTableRow($row)
    {

        printf("%-5s | %-57s | %-7s | %-10s | %-10s | %-10s | %-7s | %s\n",
            $row['talkId'],
            $row['title'],
            $row['speakerId'],
            $row['date'],
            $row['startTime'],
            $row['endTime'],
            $row['type'],
            $row['level']
        );
    }

    /**
     * Show how to use this program
     *
     * @return void
     */
    public function displayHelp()
    {
        echo $this->getNameAndVersion();

        echo <<<SHOW_HELP

{$this->name} [options] <keyword>
        
-h | --help Display this help
-v | --version Display the version information of this program

<keyword> is a term to filter the talks listing

SHOW_HELP;
    }

}
