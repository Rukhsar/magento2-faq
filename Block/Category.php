<?php

namespace Rukhsar\Faq\Block;

/**
 * Class Category
 *
 * @package Rukhsar\Faq\Block
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 */
class Category extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }
}
