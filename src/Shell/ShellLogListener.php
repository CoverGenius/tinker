<?php

namespace CoverGenius\Tinker\Shell;

use Psy\ExecutionLoop\AbstractListener;
use Psy\Shell;

class ShellLogListener extends AbstractListener
{
    /**
     * Listen for code execution.
     *
     * @param Shell $shell the shell instance
     * @param  string  $code the code from psy that we want to log
     * @return void
     */
    public function onExecute(Shell $shell, string $code): void
    {
        \Covergenius\Php\Logger\Resources\ArbitraryDataLogger::log([
            'source' => 'tinker',
            'code' => $code
        ]);
    }

    /**
     * Determines if this log listener is supported.
     *
     * currently we check if php-logger class for arbitrary data logging exists
     *
     * @return bool
     */
    public static function isSupported(): bool
    {
        return class_exists('\Covergenius\Php\Logger\Resources\ArbitraryDataLogger');
    }
}
