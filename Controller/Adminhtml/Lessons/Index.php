<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Controller\Adminhtml\Lessons;

use Sysint\MagentoAcademy\Controller\Adminhtml\Lessons as BaseAction;

class Index extends BaseAction
{
    const ACL_RESOURCE      = 'Sysint_MagentoAcademy::grid';
    const MENU_ITEM         = 'Sysint_MagentoAcademy::grid';
    const PAGE_TITLE        = 'Lessons Grid';
    const BREADCRUMB_TITLE  = 'Lessons Grid';
}
