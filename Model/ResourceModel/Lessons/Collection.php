<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Model\ResourceModel\Lessons;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use Sysint\MagentoAcademy\Model\Lessons as Model;
use Sysint\MagentoAcademy\Model\ResourceModel\Lessons as ResourceModel;

class Collection extends AbstractCollection
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
