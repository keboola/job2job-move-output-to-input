<?php

declare(strict_types=1);

namespace MyComponent;

use Keboola\Component\BaseComponent;
use project\Controller\TodoController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Exception\IOException;

class Component extends BaseComponent
{
    protected function run(): void
    {
        $this->moveOutputToInput($this->getDataDir());
    }

    private function moveOutputToInput(string $dataDir): void
    {
        // delete input
        $this->remove($dataDir . "/in/tables");
        $this->remove($dataDir . "/in/files");
        $this->remove($dataDir . "/in/user");
        $this->remove($dataDir . "/in/user");
        $this->remove($dataDir . "/in");
        $this->remove("/tmp");

        // delete state file
        $fs = new Filesystem();
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
            "/tmp",
        ];

        $fs->mkdir($structure);
    }

    private function remove(string $path): void {
        try {
            (new Filesystem())->remove($path);
        }
        catch (IOException $e) {
            $this->getLogger()->debug($e->getMessage());
        }
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
