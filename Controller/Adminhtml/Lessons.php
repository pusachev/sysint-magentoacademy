<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Controller\Adminhtml;

use Psr\Log\LoggerInterface;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;


use Sysint\MagentoAcademy\Api\Data\LessonsInterface;
use Sysint\MagentoAcademy\Api\LessonsRepositoryInterface;
use Sysint\MagentoAcademy\Model\LessonsFactory;

abstract class Lessons extends Action
{
    const ACL_RESOURCE          = 'Sysint_MagentoAcademy::all';
    const MENU_ITEM             = 'Sysint_MagentoAcademy::all';
    const PAGE_TITLE            = 'MagentoAcademy Lessons';
    const BREADCRUMB_TITLE      = 'Lessons';
    const QUERY_PARAM_ID        = 'id';

    /** @var Registry  */
    protected $registry;

    /** @var PageFactory  */
    protected $pageFactory;

    /** @var  LessonsFactory */
    protected $modelFactory;

    /** @var LessonsInterface */
    protected $model;

    /** @var Page */
    protected $resultPage;

    /** @var LessonsRepositoryInterface */
    protected $repository;

    /** @var Logger */
    protected $logger;

    /**
     * @param Context                       $context
     * @param Registry                      $registry
     * @param PageFactory                   $pageFactory
     * @param LessonsRepositoryInterface    $lessonsRepository
     * @param LessonsFactory                $factory
     * @param LoggerInterface               $logger
     */
    public function __construct(
        Context $context,
        Registry $registry,
        PageFactory $pageFactory,
        LessonsRepositoryInterface $lessonsRepository,
        LessonsFactory $factory,
        LoggerInterface $logger
    ){
        $this->registry       = $registry;
        $this->pageFactory    = $pageFactory;
        $this->repository     = $lessonsRepository;
        $this->modelFactory   = $factory;
        $this->logger         = $logger;

        parent::__construct($context);
    }

    /** {@inheritdoc} */
    public function execute()
    {
        $this->_setPageData();

        return $this->resultPage;
    }

    /** {@inheritdoc} */
    protected function _isAllowed()
    {
        $result = parent::_isAllowed();
        $result = $result && $this->_authorization->isAllowed(static::ACL_RESOURCE);

        return $result;
    }

    /**
     * @return Page
     */
    protected function _getResultPage()
    {
        if (null === $this->resultPage) {
            $this->resultPage = $this->pageFactory->create();
        }

        return $this->resultPage;
    }

    /**
     * @return Lessons
     */
    protected function _setPageData()
    {
        $resultPage = $this->_getResultPage();
        $resultPage->setActiveMenu(static::MENU_ITEM);
        $resultPage->getConfig()->getTitle()->prepend((__(static::PAGE_TITLE)));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));

        return $this;
    }

    /** @return LessonsInterface */
    protected function getModel()
    {
        if (null === $this->model) {
            $this->model = $this->modelFactory->create();
        }

        return $this->model;
    }

    /**
     * @return ResultInterface
     */
    protected function doRefererRedirect()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl($this->_redirect->getRefererUrl());

        return $redirect;
    }

    /**
     * @return ResponseInterface
     */
    protected function redirectToGrid()
    {
        return $this->_redirect('*/*/');
    }
}
