<?php
namespace Rukhsar\Faq\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 *
 * @package Rukhsar\Faq\Setup
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 *
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param \Magento\Framework\Setup\SchemaSetupInterface   $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     *
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $categoryTable = $setup->getConnection()->newTable(
            $setup->getTable('rukhsar_faq_category')
            )->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity'  =>  true,
                    'unsigned'  =>  true,
                    'nullable'  =>  false,
                    'primary'   =>  true
                ],
                'Id'
            )->addColumn(
                'parent_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                255,
                [
                    'nullable'  =>  false,
                    'default'   =>  0
                ],
                'Parent Id'
            )->addColumn(
                'title',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [
                    'nullable'  =>  true
                ],
                'Ttitle'
            )->addColumn(
                'description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [
                    'nullable'  =>  true
                ],
                'Description'
            )->addColumn(
                'active',
                \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                null,
                [
                    'nullable'  =>  false,
                    'default'   =>  false
                ],
                'Active'
            )->addColumn(
                'sort',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                1,
                [
                    'nullable'  =>  false,
                    'default'   =>  0
                ],
                'Sort'
            )->setComment('FAQ Category Table');

        $setup->getConnection()->createTable($categoryTable);

        $groupTable = $setup->getConnection()->newTable($setup->getTable('rukhsar_faq_group'))
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity'  =>  true,
                    'unsigned'  =>  true,
                    'nullable'  =>  false,
                    'primary'   =>  true
                ],
                'Id'
            )->addColumn(
                'category_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                255,
                [
                    'nullable'  =>  false,
                    'default'   =>   '0'
                ],
                'Category Id'
            )->addColumn(
                'title',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [
                    'nullable'  =>  true
                ],
                'Title'
            )->addColumn(
                'active',
                \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                null,
                [
                    'nullable'  =>  false,
                    'default'   =>  true
                ],
                'Active'
            )->addColumn(
                'sort',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                1,
                [
                    'nullable'  =>  false,
                    'default'   =>  '0'
                ],
                'Sort'
            )->setComment('FAQ Group Table');

        $setup->getConnection()->createTable($groupTable);

        $itemTable = $setup->getConnection()->newTable($setup->getTable('rukhsar_faq_item'))
        ->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [
                'identity' => true, 
                'unsigned' => true, 
                'nullable' => false, 
                'primary' => true
            ],
            'Id'
        )->addColumn(
            'group_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            255,
            [
                'nullable' => false,
                'default' => '0'
            ],
            'Group Id'
        )->addColumn(
            'title',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            'Title'
        )->addColumn(
            'question',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [
                'nullable' => true
            ],
            'Question'
        )->addColumn(
            'answer',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [
                'nullable' => true
            ],
            'Answer'
        )->addColumn(
            'active',
            \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
            null,
            [
                'nullable' => false,
                'default' => true
            ],
            'Active'
        )->addColumn(
            'sort',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            1,
            [
                'nullable' => false,
                'default' => '0'
            ],
            'Sort'
        )->setComment(
            'FAQ Item Table'
        );
        
        $setup->getConnection()->createTable($itemTable);

        $installer->endSetup();

    }
}
