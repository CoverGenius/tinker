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

    /**
     * Listen for code execution.
     *
     * @param Shell $shell
     * @param  string  $code
     * @return void
     */
    public function onExecute(Shell $shell, string $code): void
    {
        if ($this->logger instanceof CodeExecutionLogger) {
            $this->logger->addToLog($code);
        } else {
            $this->logger = CodeExecutionLogger::startLog($code);
        }
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
     * Commits the log if the logger has been initialized.
     *
     * This ensures that the log is always saved, even if the shell is exited
     * or the process is terminated.
     *
     * @return void
     */
    public function __destruct()
    {
        if ($this->logger instanceof CodeExecutionLogger) {
            $this->logger->commitLog();;
        }
    }
}
