<?php

declare(strict_types=1);

namespace MyComponent;

use Keboola\Component\BaseComponent;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class Component extends BaseComponent
{
    protected function run(): void
    {
        $this->moveOutputToInput($this->getDataDir());
    }

    private function moveOutputToInput(string $dataDir): void
    {
        // delete input
        $fs = new Filesystem();
        $structure = [
            $dataDir . "/in/tables",
            $dataDir . "/in/files",
            $dataDir . "/in/user",
            $dataDir . "/in",
             //"/tmp",
        ];
        $finder = new Finder();
        $finder->files()->in($structure);
        $fs->remove($finder);
        $fs->remove($structure);

        // delete state file
        $fs->remove($dataDir . "/out/state.json");
        $fs->remove($dataDir . "/out/state.yml");

        // rename
        $fs->rename(
            $dataDir . DIRECTORY_SEPARATOR . 'out',
            $dataDir . DIRECTORY_SEPARATOR . 'in'
        );

        // create empty output
        $fs = new Filesystem();
        $fs->mkdir($dataDir);

        $structure = [
            $dataDir . "/out",
            $dataDir . "/out/tables",
            $dataDir . "/out/files",
            $dataDir . "/in/user",
            // "/tmp",
        ];

        $fs->mkdir($structure);
    }

    protected function getConfigClass(): string
    {
        return Config::class;
    }

    protected function getConfigDefinitionClass(): string
    {
        return ConfigDefinition::class;
    }
}
