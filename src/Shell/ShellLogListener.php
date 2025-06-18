<?php

namespace CoverGenius\Tinker\Shell;

use Covergenius\Php\Logger\Resources\CodeExecutionLogger;
use Psy\ExecutionLoop\AbstractListener;
use Psy\Shell;

class ShellLogListener extends AbstractListener
{
    /**
     * @var CodeExecutionLogger|null
     */
    protected ?CodeExecutionLogger $logger;

    public function __construct()
    {
        $this->logger = new CodeExecutionLogger();
    }

    /**
     * Listen for code execution.
     *
     * @param Shell $shell
     * @param  string  $code
     * @return void
     */
    public function onExecute(Shell $shell, string $code): void
    {
        $this->logger->addToLog($code);
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

    /**
     * Commits the log
     *
     * This ensures that the log is always saved, even if the shell is exited
     * or the process is terminated.
     *
     * @return void
     */
    public function __destruct()
    {
        $this->logger->commitLog();
    }
}
