<?php

namespace nataalam\Debug;

use Colors\Color;
/**
 * Utility class for printing colored message to the terminal
 * in Seed classes and migrations for example.
 *
 */
class ConsoleService
{
    private $color;

    public function __construct(Color $c)
    {
        $this->color = $c;
    }

    /**
     *  Show a green success message
     * @param $string string The string to print
     */
    public function success($string) {
        $c = $this->color;
        echo $c($string)->green()->bold() . PHP_EOL;
    }

    /**
     * Print a cyan message
     * @param $string string The string to print
     */
    public function info($string) {
        $c = $this->color;
        echo $c($string)->cyan()->bold() . PHP_EOL;
    }

    /**
     * Print a warning message
     * @param $string string The string to print
     */
    public function warning($string) {
        $c = $this->color;
        echo $c($string)->yellow()->bold() . PHP_EOL;
    }

    /**
     * Print an error message
     * @param $string string The string to print
     */
    public function error($string) {
        $c = $this->color;
        echo $c($string)->red()->bold() . PHP_EOL;
    }

    /**
     * Print the string and color only the parts surrounded by ~
     * @param $string String to print
     */
    public function emph($string) {
        $c = $this->color;

        $result =  preg_replace_callback(
            '/~([^~]*)~/',
            function($matches) use ($c) {
                return $c(trim($matches[0], '~'))->green()->bold();
            },
            $string
        );

        echo $result . PHP_EOL;
    }

    public function ulist($strings) {
        $c = $this->color;

        foreach ($strings as $string) {
            echo $c("> ")->bold()->blue() . $string . PHP_EOL;
        }
    }
}