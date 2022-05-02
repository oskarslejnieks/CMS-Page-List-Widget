<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq1\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magebit\Faq1\Model\ResourceModel\Question\CollectionFactory;
use Magebit\Faq1\Api\QuestionRepositoryInterface;
use Magebit\Faq1\Model\QuestionManagement;

/**
 * Action for MassDisabling questions
 */
class MassDisable extends Action
{
    /**
     * @var QuestionManagement
     */
    protected QuestionManagement $questionManagement;

    /**
     * @var Filter
     */
    protected Filter $filter;

    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $questionCollFactory;

    /**
     * @var QuestionRepositoryInterface
     */
    protected QuestionRepositoryInterface $questionRepository;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $questionCollFactory
     * @param QuestionManagement $questionManagement
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $questionCollFactory,
        QuestionManagement $questionManagement,
        QuestionRepositoryInterface $questionRepository)
    {
        $this->filter = $filter;
        $this->questionCollFactory = $questionCollFactory;
        $this->questionManagement = $questionManagement;
        $this->questionRepository = $questionRepository;
        parent::__construct($context);
    }

    /**
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->questionCollFactory->create());
        foreach($collection->getAllIds() as $questionId)
        {
            /*
             * About this... I know I have to call method "disableQuestion()" here, but when I try to call
             * it, I either get an error or it just permanently loads. These 3 lines are exactly the same as
             * 3 lines in disableQuestion method.
             */
            $questionDataObject = $this->questionRepository->get($questionId);
            $questionDataObject->setStatus(0);
            $this->questionRepository->save($questionDataObject);
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been disabled.', $collection->getSize()));
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('faq1/question/index');
    }
}

