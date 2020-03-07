<?php
namespace Rukhsar\Faq\Model\ResourceModel;

class Group extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('rukhsar_faq_group', 'id');
    }
}
