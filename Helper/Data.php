<?php

namespace Rukhsar\Faq\Helper;

use \Magento\Store\Model\ScopeInterface;
use \Magento\Framework\App\Helper\Context;
use \Magento\Framework\ObjectManagerInterface;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Data
 *
 * @package Rukhsar\Faq\Helper
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 */
class Data extends AbstractHelper
{
    /**
     * @param      $field
     * @param null $storeId
     *
     * @return mixed
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue('rukhsar_faq/'.$field, ScopeInterface::SCOPE_STORE, $storeId);
    }

    /**
     * @return mixed
     */
    public function getDefaultCategory()
    {
        return $this->getConfigValue('general/default_category');
    }
}
