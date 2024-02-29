<?php

declare(strict_types=1);

namespace Loophp\PhpSemverBin\Commands;

use Composer\Semver\Semver;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

final class SemverSatisfiedByCommand extends Command {

    protected function configure() {
        $this->setName('semver:satisfied-by')
            ->setDescription('TODO')
            ->setHelp('TODO')
            ->addArgument('constraint', InputArgument::REQUIRED, 'Constraint')
            ->addArgument('version', InputArgument::IS_ARRAY, 'Version(s)');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $semver = new Semver();

        $satisfies = $semver->satisfiedBy($input->getArgument('version'), $input->getArgument('constraint'));

        if ([] === $satisfies) {
            if ($input->getOption('quiet') !== true) {
                $output->writeln('Version ' . $input->getArgument('version') . ' does not satisfy constraint ' . $input->getArgument('constraint'));
            }
            return Command::FAILURE;
        }

        if ($input->getOption('quiet') !== true) {
            $output->writeln('Version ' . $input->getArgument('version') . ' satisfies constraint ' . $input->getArgument('constraint'));
        }
        return Command::SUCCESS;
    }
}
