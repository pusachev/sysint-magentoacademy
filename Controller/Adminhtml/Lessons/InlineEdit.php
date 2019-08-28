<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Sysint\MagentoAcademy\Controller\Adminhtml\Lessons;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Cms\Controller\Adminhtml\Page\PostDataProcessor;


use Sysint\MagentoAcademy\Api\Data\LessonsInterface;

use Sysint\MagentoAcademy\Api\LessonsRepositoryInterface as LessonsRepository;

/**
 * Cms page grid inline edit controller
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Magento_Cms::save';

    /**
     * @var \Magento\Cms\Controller\Adminhtml\Page\PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * @var \Sysint\MagentoAcademy\Api\LessonsRepositoryInterface
     */
    protected $lessonsRepository;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param PostDataProcessor $dataProcessor
     * @param LessonsRepository $lessonsRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        PostDataProcessor $dataProcessor,
        LessonsRepository $lessonsRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->dataProcessor = $dataProcessor;
        $this->lessonsRepository = $lessonsRepository;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }

        foreach (array_keys($postItems) as $pageId) {
            /** @var \Sysint\MagentoAcademy\Model\Lessons $page */
            $page = $this->lessonsRepository->getById($pageId);
            try {
                $pageData = $this->filterPost($postItems[$pageId]);
                $this->validatePost($pageData, $page, $error, $messages);
                $extendedPageData = $page->getData();
                $this->setCmsPageData($page, $extendedPageData, $pageData);
                $this->lessonsRepository->save($page);
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $messages[] = $this->getErrorWithPageId($page, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithPageId($page, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithPageId(
                    $page,
                    __('Something went wrong while saving the page.')
                );
                $error = true;
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Filtering posted data.
     *
     * @param array $postData
     * @return array
     */
    protected function filterPost($postData = [])
    {
        $pageData = $this->dataProcessor->filter($postData);
        $pageData['custom_theme'] = isset($pageData['custom_theme']) ? $pageData['custom_theme'] : null;
        $pageData['custom_root_template'] = isset($pageData['custom_root_template'])
            ? $pageData['custom_root_template']
            : null;
        return $pageData;
    }

    /**
     * Validate post data
     *
     * @param array $pageData
     * @param \Magento\Cms\Model\Page $page
     * @param bool $error
     * @param array $messages
     * @return void
     */
    protected function validatePost(array $pageData, \Sysint\MagentoAcademy\Model\Lessons $page, &$error, array &$messages)
    {
        if (!($this->dataProcessor->validate($pageData) && $this->dataProcessor->validateRequireEntry($pageData))) {
            $error = true;
            foreach ($this->messageManager->getMessages(true)->getItems() as $error) {
                $messages[] = $this->getErrorWithPageId($page, $error->getText());
            }
        }
    }

    /**
     * Add page title to error message
     *
     * @param LessonsInterface $page
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithPageId(LessonsInterface $page, $errorText)
    {
        return '[Page ID: ' . $page->getId() . '] ' . $errorText;
    }

    /**
     * Set cms page data
     *
     * @param \Magento\Cms\Model\Page $page
     * @param array $extendedPageData
     * @param array $pageData
     * @return $this
     */
    public function setCmsPageData(\Sysint\MagentoAcademy\Model\Lessons $page, array $extendedPageData, array $pageData)
    {
        $page->setData(array_merge($page->getData(), $extendedPageData, $pageData));
        return $this;
    }
}
