<?php

namespace Billink\Billink\Block\Adminhtml\System\Config\Form\Field\FeeRange;

use Billink\Billink\Gateway\Helper\Workflow;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\View\Element\Html\Select;

/**
 * Class WorkflowType
 * @package Billink\Billink\Block\Adminhtml\System\Config\Form\Field\FeeRange
 */
class WorkflowType extends Select
{
    /**
     * @var Workflow
     */
    private $workflowHelper;

    /**
     * WorkflowType constructor.
     * @param Context $context
     * @param Workflow $workflowHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Workflow $workflowHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->workflowHelper = $workflowHelper;
    }

    /**
     * @return string
     */
    protected function _toHtml()
    {
        if (!$this->getOptions()) {
            $types = $this->workflowHelper->getTypes();
            foreach ($types as $type) {
                $key = $this->workflowHelper->getOptionKey($type['value']);

                $this->addOption($key, $type['label']);
            }
        }

        return parent::_toHtml();
    }

    /**
     * Sets name for input element
     *
     * @param string $value
     * @return $this
     */
    public function setInputName($value): static
    {
        return $this->setName($value);
    }
}
