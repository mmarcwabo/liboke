<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Pesa_Log
{
    public function __construct()
    {
    }
    /**
     * _log
     * @param $to_write_to_logs - String / Message to log
     * @return void
     */

    public function _log($to_write_to_logs)
    {
        $this->logger = new Logger('pesa');
        $this->logger->pushHandler(new StreamHandler(_LOG_DIR_ . 'logis.logs', Logger::DEBUG));
        $this->logger->info($to_write_to_logs);
    }
}