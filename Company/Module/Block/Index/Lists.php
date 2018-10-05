<?php
namespace Company\Module\Block\Index;

class Lists extends \Magento\Framework\View\Element\Template
{
    protected $_register;
    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $register,
        array $data = []
    ) {
        $this->_register = $register;
        parent::__construct($context, $data);
    }

    public function getRegisterData()
    {
        return $this->_register->registry('custom_summary_products');
    }
}
