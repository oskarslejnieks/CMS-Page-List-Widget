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

/**
 * Action for MassEnabling questions
 */
class MassEnable extends Action
{

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
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $questionCollFactory,
        QuestionRepositoryInterface $questionRepository)
    {
        $this->filter = $filter;
        $this->questionCollFactory = $questionCollFactory;
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
             * About this... I know I have to call method "enableQuestion()" here, but when I try to call
             * it, I either get an error or it just permanently loads. These 3 lines are exactly the same as
             * 3 lines in enableQuestion method.
             */
            $questionDataObject = $this->questionRepository->get($questionId);
            $questionDataObject->setStatus(1);
            $this->questionRepository->save($questionDataObject);
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been enabled.', $collection->getSize()));
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('faq1/question/index');
    }
}

