<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Setup;

use Psr\Log\LoggerInterface;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Transaction;
use Magento\Framework\DB\TransactionFactory;

use Sysint\MagentoAcademy\Api\Data\LessonsInterface;
use Sysint\MagentoAcademy\Api\Data\LessonsInterfaceFactory;

class InstallData implements InstallDataInterface
{
    /** @var LessonsInterfaceFactory  */
    private $lessonsFactory;

    /** @var TransactionFactory */
    private $transactionFactory;

    /** LoggerInterface */
    private $logger;

    public function __construct(
        LessonsInterfaceFactory $lessonsFactory,
        TransactionFactory $transactionFactory,
        LoggerInterface $logger
    ) {
        $this->lessonsFactory       = $lessonsFactory;
        $this->transactionFactory   = $transactionFactory;
        $this->logger               = $logger;
    }

    /** {@inheritdoc} */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var Transaction $transactionalModel */
        $transactionalModel = $this->transactionFactory->create();

        $startDate = new \DateTimeImmutable();
        $endDate = $startDate->add(new \DateInterval('P7D'));

        for ($i = 1; $i < 25; $i++) {
            /** @var LessonsInterface $lesson */
            $lesson = $this->lessonsFactory->create();
            $lesson->setTitle(sprintf("Title %d", $i));
            $lesson->setSpeaker(sprintf("Speaker %d", $i));
            $lesson->setShortDescription(
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt '
            );
            $lesson->setStartDate($startDate);
            $lesson->setEndDate($endDate);

            $transactionalModel->addObject($lesson);
        }

        try {
            $transactionalModel->save();
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}
