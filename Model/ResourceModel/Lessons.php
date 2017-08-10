<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

use Sysint\MagentoAcademy\Api\Data\LessonsInterface;

class Lessons extends AbstractDb
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(LessonsInterface::TABLE_NAME, LessonsInterface::ID_FIELD);
    }
}
