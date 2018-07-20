<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface LessonsSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get lessons list.
     *
     * @return LessonsInterface[]
     */
    public function getItems();

    /**
     * Set blocks list.
     *
     * @param LessonsInterface[] $items
     * @return LessonsSearchResultsInterface
     */
    public function setItems(array $items);
}
