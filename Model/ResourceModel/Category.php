<?php
namespace Rukhsar\Faq\Model\ResourceModel;

/**
 * Class Category
 *
 * @package Rukhsar\Faq\Model\ResourceModel
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 *
 */
class Category extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Category constructor.
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
        $this->_init('rukhsar_faq_category', 'id');
    }
}
