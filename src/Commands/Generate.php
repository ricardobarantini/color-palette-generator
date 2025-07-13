<?php

namespace ColorPaletteGenerator\Commands;

use ColorPaletteGenerator\ColorPaletteGenerator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: "generate")]
class Generate extends Command
{
    protected SymfonyStyle $io;
    protected string $defaultOutputPath;

    public function __construct()
    {
        parent::__construct("generate");
        $this->defaultOutputPath = $_SERVER['HOME']."/output.html";
    }

    protected function configure(): void
    {
        $this->setDefinition(
            new InputDefinition([
                new InputArgument('file_path'),
                new InputArgument('output_path'),
                new InputOption(name: 'input_format', mode: InputOption::VALUE_OPTIONAL, default: 'json'),
            ]),
        );
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        if (! $input->getArgument('file_path')) {
            $file_path = $this->io->ask('What is the file input path?');
            $input->setArgument('file_path', $file_path);
        }

        if (! $input->getArgument('output_path')) {
            $output_path = $this->io->ask('What is the file output path?', $this->defaultOutputPath);
            $input->setArgument('output_path', $output_path);
        }
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        try {
            (new ColorPaletteGenerator())
                ->setFilePath($input->getArgument('file_path'))
                ->setInputFormat($input->getOption('input_format'))
                ->setOutputPath($input->getArgument('output_path'))
                ->generate();

            $this->io->success([
                "Color palette generated",
                "Input file: {$input->getArgument('file_path')}",
                "Input format: {$input->getOption('input_format')}",
                "Output file: {$input->getArgument('output_path')}",
            ]);

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->io->error($e->getMessage());
            return Command::FAILURE;
        }
    }
}