<?php

namespace src\handlers;

class ExceptionHandler
{
    public function __construct()
    {
        set_exception_handler(array($this, 'handleException'));
    }

    public function handleException(\Exception $exception): void
    {
        restore_error_handler();
        restore_exception_handler();
        $this->displayException($exception);
    }

    public function displayException($exception)
    {
        echo "\n" . get_class($exception);
        echo "\n" . $exception->getMessage() . "\n" . $exception->getFile() . ':' . $exception->getLine();
        echo "\n" . $exception->getTraceAsString() . "\n";
    }

}