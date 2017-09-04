<?php
/**
 * PHP Command Line Applications
 *
 * @license MIT
 */

namespace andrewwoods\phpCliApps;

/**
 * Class Talks
 * @package andrewwoods\phpCliApps
 */
class Talks
{
    /**
     * Talks constructor.
     */
    public function __construct()
    {
    }

    /**
     * Get the talks as an array of associative arrays
     *
     * @return array
     */
    public function get()
    {
        include DATA_PATH . '/talks.php';

        return $talks;
    }

    /**
     * Filter the list of talks when a keyword is available.
     *
     * @param string $keyword
     *
     * @return array
     */
    public function search($keyword = '')
    {
        $talks = $this->get();
        if (empty($keyword)) {
            return $talks;
        }

        $data = [];
        foreach ($talks as $talk) {
            $talkTitle = strtolower($talk['title']);
            $keyword = strtolower($keyword);

            if (strpos($talkTitle, $keyword) !== false) {
                $data[] = $talk;
            }
        }

        return $data;
    }

}
