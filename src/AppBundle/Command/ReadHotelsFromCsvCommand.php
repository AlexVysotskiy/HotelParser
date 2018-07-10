<?php

namespace AppBundle\Command;

use AppBundle\ReadWriteBuilder\HotelFromCsvBuilder;
use AppBundle\ReadWriteBuilder\ReadWriteServiceDirector;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Exceptions\GeneralException;

class ReadHotelsFromCsvCommand extends Command {

    protected function configure() {
        $this
                ->setName('app:read_csv')
                ->addOption(
                        'file', 'f', InputOption::VALUE_REQUIRED, 'Path to file with hotels.', null
                )
                ->addOption(
                        'output', 'o', InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'List of required outputs.', []
                )
                ->addOption(
                        'sort', 's', InputOption::VALUE_OPTIONAL, 'Sorting in format \'fields_name:(DESC|ASC)\'.'
                )
                ->addOption(
                        'filter', 'r', InputOption::VALUE_OPTIONAL, 'Filtering in format \'field (eq|neq|lt|lte|gt|gte|like) value\'.'
                )
                ->setDescription('Import hotels from CSV file and write it into files with required format.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        try {

            $filePath = trim($input->getOption('file'));
            $formats = $input->getOption('output');
            $sorting = $input->getOption('sort') ? explode(':', $input->getOption('sort')) : [];
            $filtering = $input->getOption('filter') ? explode(' ', $input->getOption('filter')) : [];
            
            if (!empty($filePath) && $formats) {

                $serviceBuilder = new ReadWriteServiceDirector();
                $serviceBuilder->setBuilder(new HotelFromCsvBuilder(realpath($filePath), $formats, $sorting, $filtering));
                $service = $serviceBuilder->getService();
                $output->writeln('Start reading file..');
                $service->process();
                $output->writeln('Done.');
            } else {
                throw new GeneralException('Missed params!');
            }
        } catch (\Exception $e) {

            $output->writeln('Fatal error:');
            $output->writeln($e->getMessage());
        }
    }

}
