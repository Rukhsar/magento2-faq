<?php
namespace Rukhsar\Faq\Model\ResourceModel;

/**
 * Class Group
 *
 * @package Rukhsar\Faq\Model\ResourceModel
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 *
 */
class Group extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Group constructor.
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    /**
     *
     */
    protected function _construct()
    {
        $this->_init('rukhsar_faq_group', 'id');
    }
}
