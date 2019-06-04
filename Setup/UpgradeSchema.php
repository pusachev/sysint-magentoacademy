<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2019, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Setup;

use Psr\Log\LoggerInterface;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

use Sysint\MagentoAcademy\Api\Data\LessonsInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->logger->info(sprintf("%s is called", self::class));

        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $this->addCountColumn($setup);
        }

        $setup->endSetup();
    }

    private function addCountColumn(SchemaSetupInterface $setup)
    {
        $table = $setup->getTable(LessonsInterface::TABLE_NAME);

        $connection = $setup->getConnection();

        $connection->addColumn(
            $table,
            LessonsInterface::COUNT_FIELD,
            [
                'type'      => Table::TYPE_SMALLINT,
                'nullable'  => true,
                'comment'   => 'count field'
            ]
        );
    }
}