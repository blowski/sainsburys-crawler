<?php

namespace Blowski\ConsoleCommands;

use Blowski\Services\CategoryPageToJsonTransformer;
use Blowski\Services\PageManager;
use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

/**
 * Class CrawlCommand
 * @package Blowski
 *
 * Asks for a URL, which should be a category URL on the Sainsbury's site.
 * It will then attempt to load the URL, parse the data, and return a
 * pretty-printed JSON string with:
 *  - title
 *  - description
 *  - unit price
 *  - size of the relevant product page
 *
 * Run in debug mode (-vvv) to show details of HTTP requests
 */
class CrawlCommand extends Command
{

    protected $client;

    protected function configure()
    {
        $this
            ->setName('sainsburys:crawl')
            ->setDescription('Consumes a URL, processes the response and presents it')
            ->addArgument('url', InputArgument::OPTIONAL, "The URL of the category to be consumed")
        ;
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $this->client = new Client([
            'cookies' => true,
            'timeout' => 30,
            'connect_timeout' => 30,
            'allow_redirects' => true,
            'debug' => ($output->getVerbosity() === OutputInterface::VERBOSITY_DEBUG)
        ]);

        if(!$input->getArgument('url')) {
            $helper = $this->getHelper('question');
            $question = new Question("What's the URL of the category that you want to consume?".PHP_EOL);
            $question->setValidator(function($answer) {
                try {
                    $this->client->get($answer);
                } catch(\Exception $ex) {
                    throw new \RuntimeException("Cannot load URL");
                }
                return $answer;
            });
            $url = $helper->ask($input, $output, $question);

            $input->setArgument('url', $url);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $page_manager = new PageManager($this->client);
        $output->writeln('Getting results...');
        $transformer = new CategoryPageToJsonTransformer($page_manager);
        $output->write($transformer->transform($input->getArgument('url'), TRUE).PHP_EOL);
        $output->writeln('All done');

    }

}