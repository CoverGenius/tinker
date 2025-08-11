<?php

namespace CoverGenius\Tinker\Shell;

use Psy\Shell;

class CustomShell extends Shell
{
    protected function getDefaultLoopListeners(): array
    {
        $listeners = parent::getDefaultLoopListeners();

        $listeners[] = new ShellLogListener();

        return $listeners;
    }
}
