<?php

namespace CoverGenius\Tinker\Shell;

use Covergenius\Php\Logger\Resources\ArbitraryDataLogger;
use Psy\ExecutionLoop\AbstractListener;
use Psy\Shell;

class ShellLogListener extends AbstractListener
{
    /**
     * Listen for code execution.
     *
     * @param Shell $shell
     * @param  string  $code
     * @return void
     */
    public function onExecute(Shell $shell, string $code): void
    {
        ArbitraryDataLogger::log([
            'source' => 'tinker',
            'code' => $code
        ]);
    }

    /**
     * Determines if this log listener is supported.
     *
     * @return bool
     */
    public static function isSupported(): bool
    {
        return true; //implement a proper check
    }
}
