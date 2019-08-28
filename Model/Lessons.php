<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Stdlib\DateTime;

use Sysint\MagentoAcademy\Api\Data\LessonsInterface;
use Sysint\MagentoAcademy\Model\ResourceModel\Lessons as ResourceModel;

class Lessons extends AbstractModel implements LessonsInterface, IdentityInterface
{
    /**
     * No route page id
     */
    const NOROUTE_PAGE_ID = 'no-route';

    /** {@inheritdoc} */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s", LessonsInterface::CACHE_TAG, $this->getId())];
    }

    /** {@inheritdoc} */
    public function getTitle()
    {
        return $this->getData(LessonsInterface::TITLE_FIELD);
    }

    /** {@inheritdoc} */
    public function setTitle($title)
    {
        $this->setData(LessonsInterface::TITLE_FIELD, $title);

        return $this;
    }

    /** {@inheritdoc} */
    public function getSpeaker()
    {
        return $this->getData(LessonsInterface::SPEAKER_FIELD);
    }

    /** {@inheritdoc} */
    public function setSpeaker($name)
    {
        $this->setData(LessonsInterface::SPEAKER_FIELD, $name);

        return $this;
    }

    /** {@inheritdoc} */
    public function getStartDate()
    {
        return $this->getData(LessonsInterface::START_DATE_FIELD);
    }

    /** {@inheritdoc} */
    public function setStartDate($statDate)
    {
        if ($statDate instanceof \DateTime) {
            $statDate = $statDate->format(DateTime::DATETIME_PHP_FORMAT);
        }

        $this->setData(LessonsInterface::START_DATE_FIELD, $statDate);

        return $this;
    }

    /** {@inheritdoc} */
    public function getEndDate()
    {
        return $this->getData(LessonsInterface::END_DATE_FIELD);
    }

    /** {@inheritdoc} */
    public function setEndDate($endDate)
    {
        if ($endDate instanceof \DateTime) {
            $endDate = $endDate->format(DateTime::DATETIME_PHP_FORMAT);
        }

        $this->setData(LessonsInterface::END_DATE_FIELD, $endDate);

        return $this;
    }

    /** {@inheritdoc} */
    public function getShortDescription()
    {
        return $this->getData(LessonsInterface::SHORT_DESCRIPTION_FILED);
    }

    /** {@inheritdoc} */
    public function setShortDescription($shortDescription)
    {
        $this->setData(LessonsInterface::SHORT_DESCRIPTION_FILED, $shortDescription);

        return $this;
    }

    /** {@inheritDoc} */
    public function setCount($count)
    {
        $this->setData(LessonsInterface::COUNT_FIELD, $count);

        return $this;
    }

    /** {@inheritDoc} */
    public function getCount()
    {
        return $this->getData(LessonsInterface::COUNT_FIELD);
    }


}
