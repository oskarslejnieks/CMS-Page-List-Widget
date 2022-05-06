<?php
/**
 * This file is part of the Magebit FAQ1 package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magebit_Faq1
 * to newer versions in the future.
 *
 * @copyright Copyright (c) 2022 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit <info@magebit.com>
 * @license   MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Magebit\Faq1\Controller\Adminhtml\Question;

use Exception;
use Magebit\Faq1\Api\Data\QuestionInterface;
use Magebit\Faq1\Api\QuestionRepositoryInterface;
use Magebit\Faq1\Model\QuestionFactory;
use Magento\Backend\App\Action;
use Magebit\Faq1\Model\Question;
use Magento\Backend\Model\View\Result\Redirect;
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
     * @var QuestionFactory
     */
    private QuestionFactory $questionFactory;

    /**
     * @var QuestionRepositoryInterface
     */
    private QuestionRepositoryInterface $questionRepository;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param QuestionFactory $questionFactory
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        QuestionFactory $questionFactory,
        QuestionRepositoryInterface $questionRepository
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->questionFactory = $questionFactory;
        $this->questionRepository = $questionRepository;
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
                $data['status'] = QuestionInterface::STATUS;
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
                    $question = $this->questionRepository->get((int)$id);
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
