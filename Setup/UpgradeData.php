<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2019, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Setup;

use Psr\Log\LoggerInterface;

use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

use Sysint\MagentoAcademy\Api\LessonsRepositoryInterface;
use Sysint\MagentoAcademy\Model\ResourceModel\Lessons\CollectionFactory;

class UpgradeData implements UpgradeDataInterface
{
    /** @var LessonsRepositoryInterface  */
    private $repository;

    /** @var SearchCriteriaBuilder  */
    private $searchCriteriaBuilder;

    /** @var CollectionFactory  */
    private $collectionFactory;

    /** @var LoggerInterface  */
    private $logger;

    /**
     * UpgradeData constructor.
     * @param LessonsRepositoryInterface $repository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param CollectionFactory $collectionFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        LessonsRepositoryInterface $repository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CollectionFactory $collectionFactory,
        LoggerInterface $logger
    ) {
        $this->repository            = $repository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->collectionFactory     = $collectionFactory;
        $this->logger                = $logger;
    }


    /** {@inheritDoc} */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->logger->info(sprintf("%s is called", self::class));

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $this->updateCountColumn();
        }
    }

    /**
     * Update count column
     * @return void
     */
    private function updateCountColumn()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();

        $data = $this->repository->getList($searchCriteria);

        foreach ($data->getItems() as $lesson) {
            $lesson->setCount(1);
        }

        $collection = $this->collectionFactory->create();

        $collection->setData($data->getItems());

        try {
            $collection->save();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
