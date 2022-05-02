<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq1\Controller\Adminhtml\Question;

use Magebit\Faq1\Model\QuestionRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class that let's us edit specific question through form
 */
class Edit extends Action
{
    /**
     * @var PageFactory
     */
    protected PageFactory $_pageFactory;

    /**
     * @var QuestionRepository
     */
    protected QuestionRepository $_questionRepository;

    /**
     * @var Registry
     */
    protected Registry $_coreRegistry;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param QuestionRepository $questionRepository
     * @param Registry $coreRegistry
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        QuestionRepository $questionRepository,
        Registry $coreRegistry
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_questionRepository = $questionRepository;
        $this->_coreRegistry = $coreRegistry;

        return parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $this->_coreRegistry->register('id', $id);
        return $this->_pageFactory->create();
    }
}
