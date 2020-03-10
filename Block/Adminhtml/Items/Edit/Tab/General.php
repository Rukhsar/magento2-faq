<?php

namespace Rukhsar\Faq\Block\Adminhtml\Items\Edit\Tab;
 
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;

/**
 * Class General
 *
 * @package Rukhsar\Faq\Block\Adminhtml\Items\Edit\Tab
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
     */public function __construct(
		Context $context,
		Registry $registry,
		FormFactory $formFactory,
		Config $wysiwygConfig,
		\Magento\Framework\ObjectManagerInterface $objectManager,
		array $data = []
	) {
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
		$model = $this->_coreRegistry->registry('item');
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
			'question',
			'editor',
			[
				'name' => 'question',
				'label' => __('Question'),
				'required' => true,
				'style' => 'height: 15em; width: 100%;',
				'config' => $this->_wysiwygConfig->getConfig()
			]
		);
		$fieldset->addField(
			'answer',
			'editor',
			[
				'name' => 'answer',
				'label' => __('Answer'),
				'required' => true,
				'style' => 'height: 15em; width: 100%;',
				'config' => $this->_wysiwygConfig->getConfig()
			]
		);
		$groupsTree = [
			['value'=>"0",'label'=>__('None')]
		];
		$groups = $this->_objectManager->get('\Rukhsar\Faq\Model\Group')->getCollection();
		if ($groups->count() > 0) {
			foreach ($groups as $group) {
				$title = $group->getTitle();
				$categoryId = $group->getCategoryId();
				do {
					$category = $this->_objectManager->get('\Rukhsar\Faq\Model\Category')->load($categoryId);
					if($category->getTitle()){
						$title = $category->getTitle().' - '.$title;
					}
					if($category->getParentId() > 0){
						$categoryId = $category->getParentId();
					}
					else{
						$categoryId = false;
					}
				} while ($categoryId != false);
				$groupItem = [
					'value' => $group->getId(),
					'label' => $title
				];
				$groupsTree[] = $groupItem;
			}
		}
		$fieldset->addField(
			'group_id',
			'select',
			[
				'name' => 'group_id',
				'label'	=> __('Group'),
				'required' => true,
				'values' => $groupsTree
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
		return __('Item');
	}

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabTitle()
    {
		return __('Item');
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
