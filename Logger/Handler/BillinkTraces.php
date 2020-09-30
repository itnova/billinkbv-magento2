<?php

namespace Billink\Billink\Logger\Handler;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\DriverInterface;
use Magento\Framework\Logger\Handler\Base;
use Magento\Framework\Session\SessionManagerInterface;
use Monolog\Logger;

/**
 * Class BillinkTraces
 * @package Billink\Billink\Logger\Handler
 */
class BillinkTraces extends Base
{
    const DIR = '/log/billink/traces/';

    /**
     * @var int
     */
    protected $loggerType = Logger::DEBUG;

    /**
     * BillinkTraces constructor.
     * @param DriverInterface $filesystem
     * @param SessionManagerInterface $sessionManager
     * @param null $filePath
     * @param null $fileName
     * @throws \Exception
     */
    public function __construct(
        DriverInterface $filesystem,
        SessionManagerInterface $sessionManager,
        DirectoryList $directoryList,
        $filePath = null,
        $fileName = null
    ) {
        parent::__construct(
            $filesystem,
            $directoryList->getPath(\Magento\Framework\App\Filesystem\DirectoryList::VAR_DIR)
                . self::DIR . $sessionManager->getSessionId() . "/" . time() . ".log",
            $fileName
        );
    }
}