<?php

namespace Rukhsar\Faq\Block\Adminhtml\Groups\Edit\Tab;

use Magento\Framework\Registry;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Framework\Data\FormFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

/**
 * Class General
 *
 * @package Rukhsar\Faq\Block\Adminhtml\Groups\Edit\Tab
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 */
class General extends Generic implements TabInterface
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * General constructor.
     *
     * @param \Magento\Backend\Block\Template\Context   $context
     * @param \Magento\Framework\Registry               $registry
     * @param \Magento\Framework\Data\FormFactory       $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config         $wysiwygConfig
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param array                                     $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $data = []
    )
    {
        $this->_objectManager = $objectManager;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return \Magento\Backend\Block\Widget\Form\Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('group');
        $form = $this->_formFactory->create();

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General')]
        );

        if ($model->getId()) {
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'id']
            );
        }
        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label'	=> __('Title'),
                'required' => true
            ]
        );
        $fieldset->addField(
            'description',
            'editor',
            [
                'name' => 'description',
                'label' => __('Description'),
                'required' => false,
                'style' => 'height: 15em; width: 100%;',
                'config' => $this->_wysiwygConfig->getConfig()
            ]
        );
        $categoriesTree = [
            ['value'=>"0",'label'=>__('None')]
        ];
        $categories = $this->_objectManager->get('\Rukhsar\Faq\Model\Category')->getCollection();
        if ($categories->count()>0) {
            foreach ($categories as $category) {
                $title = $category->getTitle();
                $parentId = $category->getParentId();
                do {
                    $parent = $this->_objectManager->get('\Rukhsar\Faq\Model\Category')->load($parentId);
                    if($parent->getTitle()){
                        $title = $parent->getTitle().' - '.$title;
                    }
                    if($parent->getParentId() > 0){
                        $parentId = $parent->getParentId();
                    }
                    else{
                        $parentId = false;
                    }
                } while ($parentId != false);
                $categoryItem = [
                    'value' => $category->getId(),
                    'label' => $title
                ];
                $categoriesTree[] = $categoryItem;
            }
        }
        $fieldset->addField(
            'category_id',
            'select',
            [
                'name' => 'category_id',
                'label'	=> __('Category'),
                'required' => true,
                'values' => $categoriesTree
            ]
        );
        $fieldset->addField(
            'active',
            'select',
            [
                'name' => 'active',
                'label'	=> __('Active'),
                'required' => true,
                'values' => [
                    ['value'=>"1",'label'=>__('Yes')],
                    ['value'=>"0",'label'=>__('No')]
                ]
            ]
        );

        if (!$model->getData('sort')) {
            $model->setData('sort', '0');
        }
        $fieldset->addField(
            'sort',
            'text',
            [
                'name' => 'sort',
                'label'	=> __('Sort'),
                'required' => true
            ]
        );
        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabLabel()
    {
        return __('Group');
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabTitle()
    {
        return __('Group');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }
}
