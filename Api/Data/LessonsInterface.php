<?php

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

    const CACHE_TAG                 = 'sysint_magentoacademy';

    const REGISTRY_KEY              = 'sysint_magentoacademy_lesson';

    /** @return int */
    public function getId();

    /** @return string */
    public function getTitle();

    /**
     * @param string $title
     * @return LessonsInterface
     */
    public function setTitle($title);

    /** @return string */
    public function getSpeaker();

    /**
     * @param string $name
     * @return LessonsInterface
     */
    public function setSpeaker($name);

    /** @return \DateTime */
    public function getStartDate();

    /**
     * @param \DateTime|string $statDate
     * @return LessonsInterface
     */
    public function setStartDate($statDate);

    /**
     * @return \DateTime
     */
    public function getEndDate();

    /**
     * @param \DateTime|string $endDate
     * @return LessonsInterface
     */
    public function setEndDate($endDate);

    /**
     * @return string
     */
    public function getShortDescription();

    /**
     * @param string $shortDescription
     * @return LessonsInterface
     */
    public function setShortDescription($shortDescription);
}
