<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Api\Data;

interface LessonsInterface
{
    const TABLE_NAME                = 'sysint_magentoacademy_lessons';

    const ID_FIELD                  = 'lesson_id';
    const TITLE_FIELD               = 'title';
    const SPEAKER_FIELD             = 'speaker';
    const START_DATE_FIELD          = 'start_date';
    const END_DATE_FIELD            = 'end_date';
    const SHORT_DESCRIPTION_FILED   = 'short_description';
    const COUNT_FIELD               = 'count';

    const CACHE_TAG                 = 'sysint_magentoacademy';

    const REGISTRY_KEY              = 'sysint_magentoacademy_lesson';

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getTitle();

    /**
     * @param string $title
     * @return LessonsInterface
     */
    public function setTitle($title);

    /**
     * @return mixed
     */
    public function getSpeaker();

    /**
     * @param string $name
     * @return \Sysint\MagentoAcademy\Api\Data\LessonsInterface
     */
    public function setSpeaker($name);

    /**
     * @return mixed
     */
    public function getStartDate();

    /**
     * @param \DateTime|string $statDate
     * @return \Sysint\MagentoAcademy\Api\Data\LessonsInterface
     */
    public function setStartDate($statDate);

    /**
     * @return \DateTime
     */
    public function getEndDate();

    /**
     * @param \DateTime|string $endDate
     * @return \Sysint\MagentoAcademy\Api\Data\LessonsInterface
     */
    public function setEndDate($endDate);

    /**
     * @return string
     */
    public function getShortDescription();

    /**
     * @param string $shortDescription
     * @return \Sysint\MagentoAcademy\Api\Data\LessonsInterface
     */
    public function setShortDescription($shortDescription);

    /**
     * @param int $count
     * @return \Sysint\MagentoAcademy\Api\Data\LessonsInterface
     */
    public function setCount($count);

    /**
     * @return int
     */
    public function getCount();
}
