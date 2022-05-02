<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq1\Controller\Adminhtml\Question;

use Exception;
use Magebit\Faq1\Api\QuestionRepositoryInterface;
use Magebit\Faq1\Model\QuestionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\Helper\Js;
use Magebit\Faq1\Model\Question;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class that let's us save new question and edited questions
 */
class Save extends Action
{

    /**
     * @var DataPersistorInterface
     */
    protected DataPersistorInterface $dataPersistor;

    /**
     * @var Js
     */
    protected Js $_backendJsHelper;

    /**
     * @var QuestionFactory
     */
    private $questionFactory;

    /**
     * @var QuestionRepositoryInterface
     */
    private $questionRepository;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param Js $backendJsHelper
     * @param QuestionFactory|null $questionFactory
     * @param QuestionRepositoryInterface|null $questionRepository
     */

    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        Js $backendJsHelper,
        QuestionFactory $questionFactory = null,
        QuestionRepositoryInterface $questionRepository = null
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->_backendJsHelper = $backendJsHelper;
        $this->questionFactory = $questionFactory
            ?: ObjectManager::getInstance()->get(QuestionFactory::class);
        $this->questionRepository = $questionRepository
            ?: ObjectManager::getInstance()->get(QuestionRepositoryInterface::class);
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Magebit_Faq1::save');
    }

    /**
     * @return Redirect|ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /**
         * @var Redirect $resultRedirect
         */
        $resultRedirect = $this->resultRedirectFactory->create();
        if($data)
        {
            if(isset($data['status']) && $data['status'] === 'true')
            {
                $data['status'] = Question::STATUS;
            }
            if(empty($data['id']))
            {
                $data['id'] = null;
            }
            /**
             * @var Question $question
             */
            $question = $this->questionFactory->create();

            $id = $this->getRequest()->getParam('id');
            if($id)
            {
                try {
                    $question = $this->questionRepository->get($id);
                }
                catch (LocalizedException $e)
                {
                    $this->messageManager->addErrorMessage(__('This question no longer exists'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $question->setData($data);


            try {
                $this->questionRepository->save($question);
                $this->messageManager->addSuccessMessage(__('You saved the question.'));
                $this->dataPersistor->clear('question_question');
                if($this->getRequest()->getParam('save'))
                {
                    return $resultRedirect->setPath('*/*/new', ['id' => $question->getId(), '_current' => true]);
                }
                if($this->getRequest()->getParam('back'))
                {
                    return $resultRedirect->setPath('*/*/index', ['id' => $question->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            }
            catch (LocalizedException $e)
            {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?:$e);
            }
            catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the question.'));
            }

            $this->dataPersistor->set('question_question', $data);

            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
