<?php

namespace Billink\Billink\Model;

use Billink\Billink\Logger\Handler\BillinkTraces;
use Magento\Framework\App\RequestInterface;
use Magento\Sales\Api\Data\OrderInterface;

class Debug extends \Monolog\Logger
{
    public function __construct(
        BillinkTraces $logger,
        RequestInterface $request
    ) {
        parent::__construct("BillinkTracer", [$logger]);
        $this->request = $request;
    }

    private function debugEnabled(): bool {
        return true; //TODO
    }

    public function trace()
    {
        if (!$this->debugEnabled()) {
            return;
        }

        $this->debug($this->request->getMethod() . " .: " . $this->request->getRequestString());

        $traces = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $this->debug(print_r($traces, true));
    }
}