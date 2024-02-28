<?php

declare(strict_types=1);

namespace Loophp\PhpSemverBinConsole\Commands;

use Composer\Semver\Semver;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

final class SemverSatisfiesCommand extends Command {

    protected function configure() {
        $this->setName('semver:satisfies')
            ->setDescription('TODO')
            ->setHelp('TODO')
            ->addArgument('version', InputArgument::REQUIRED, 'Version')
            ->addArgument('constraint', InputArgument::REQUIRED, 'Constraint');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $semver = new Semver();

        $satisfies = $semver->satisfies($input->getArgument('version'), $input->getArgument('constraint'));

        if (false === $satisfies) {
            $output->writeln('Version ' . $input->getArgument('version') . ' does not satisfy constraint ' . $input->getArgument('constraint'));
            return Command::FAILURE;
        }

        $output->writeln('Version ' . $input->getArgument('version') . ' satisfies constraint ' . $input->getArgument('constraint'));
        return Command::SUCCESS;
    }
}
