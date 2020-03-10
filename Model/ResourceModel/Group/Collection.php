<?php
namespace Rukhsar\Faq\Model\ResourceModel\Group;

/**
 * Class Collection
 *
 * @package Rukhsar\Faq\Model\ResourceModel\Group
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 *
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';
    /**
     * @var string
     */
    protected $_eventPrefix = 'rukhsar_faq_group_collection';
    /**
     * @var string
     */
    protected $_eventObject = 'group_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Rukhsar\Faq\Model\Group', 'Rukhsar\Faq\Model\ResourceModel\Group');
    }
}
