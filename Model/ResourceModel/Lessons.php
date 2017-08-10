<?php

namespace Sysint\MagentoAcademy\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

use Sysint\MagentoAcademy\Api\Data\LessonsInterface;

class Lessons extends AbstractDb
{

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(LessonsInterface::TABLE_NAME, LessonsInterface::ID_FIELD);
    }
}