# PHP Command Line Applications

This is created for the PNWPHP 2017 Kickoff meetup at [Seattle PHP](http://seaphp.com). This code
complements [the slides](http://bit.ly/2vMrhPp) from the talk. The talk discusses the development of
command line applications for PHP using two different styles - one using native
PHP functions, one using symfony components.

## Project Structure

There are two main scripts to run

* native.php
* symfony.php
* **src/** - contains classes specific to this project

## Native PHP

requires the parsing of $argv and using getopt() method

## Symfony Console

provides a suite of classes and helpers to help simplify your cli applications.
Some of that classes are:

* Command
* Application
* InputOption
* InputArgument
* Table



