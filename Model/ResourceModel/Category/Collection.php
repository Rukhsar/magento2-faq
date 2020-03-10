<?php
namespace Rukhsar\Faq\Model\ResourceModel\Category;

/**
 * Class Collection
 *
 * @package Rukhsar\Faq\Model\ResourceModel\Category
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
    protected $_eventPrefix = 'rukhsar_faq_category_collection';
    /**
     * @var string
     */
    protected $_eventObject = 'category_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Rukhsar\Faq\Model\Category', 'Rukhsar\Faq\Model\ResourceModel\Category');
    }
}
