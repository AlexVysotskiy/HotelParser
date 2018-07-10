<?php

namespace AppBundle\Command;

use AppBundle\ReadWriteBuilder\HotelFromCsvBuilder;
use AppBundle\ReadWriteBuilder\ReadWriteServiceDirector;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReadHotelsFromCsvCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:read_csv')
            ->addArgument('file', InputArgument::REQUIRED, 'Path to file with hotels.')
            ->addArgument('output', InputArgument::IS_ARRAY, 'List of required outputs.')
            ->setDescription('Import hotels from CSV file and write it into files with required format.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filePath = realpath(trim($input->getArgument('file')));
        $formats = $input->getArgument('output');

        try {

            $serviceBuilder = new ReadWriteServiceDirector();
            $serviceBuilder->setBuilder(new HotelFromCsvBuilder($filePath, $formats));

            $service = $serviceBuilder->getService();

            $output->writeln('Start reading file..');

            $service->process();

            $output->writeln('Done.');

        } catch (\Exception $e) {

            $output->writeln('Fatal error:');
            $output->writeln($e->getMessage());
        }

    }

}
