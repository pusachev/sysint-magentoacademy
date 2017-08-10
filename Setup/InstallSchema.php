<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;

use Sysint\MagentoAcademy\Api\Data\LessonsInterface;

class InstallSchema implements InstallSchemaInterface
{
    /** {@inheritdoc} */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /** create table `sysint_magentoacademy_lessons` */
        $table = $installer->getConnection()->newTable(
            $installer->getTable(LessonsInterface::TABLE_NAME)
        )->addColumn(
            LessonsInterface::ID_FIELD,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
            'Lessons ID'
        )->addColumn(
            LessonsInterface::TITLE_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Lesson Title'
        )->addColumn(
            LessonsInterface::SPEAKER_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Lesson Speaker'
        )->addColumn(
            LessonsInterface::SHORT_DESCRIPTION_FILED,
            Table::TYPE_TEXT,
            '2M',
            [],
            'Lesson Short Description'
        )->addColumn(
            LessonsInterface::START_DATE_FIELD,
            Table::TYPE_DATETIME,
            null,
            ['nullable' => false],
            'Lesson Start Time'
        )->addColumn(
            LessonsInterface::END_DATE_FIELD,
            Table::TYPE_DATETIME,
            null,
            ['nullable' => false],
            'Lesson End Time'
        )->addIndex(
            $setup->getIdxName(
                $installer->getTable(LessonsInterface::TABLE_NAME),
                [LessonsInterface::TITLE_FIELD, LessonsInterface::SHORT_DESCRIPTION_FILED],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            [LessonsInterface::TITLE_FIELD, LessonsInterface::SHORT_DESCRIPTION_FILED],
            ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
        )->setComment(
            'Sysint MagentoAcademy Lessons Table'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
