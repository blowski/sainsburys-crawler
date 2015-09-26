<?php

namespace Blowski\ConsoleCommands;

use Blowski\Services\HTMLToJsonTransformer;
use Blowski\Services\URLConsumer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CrawlCommand extends Command
{

    protected $url;

    public function setUrl($url)
    {
        $this->url = $url;
    }

    protected function configure()
    {
        $this
            ->setName('sainsburys:crawl')
            ->setDescription('Consumes a URL, processes the response and presents it')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    }

}