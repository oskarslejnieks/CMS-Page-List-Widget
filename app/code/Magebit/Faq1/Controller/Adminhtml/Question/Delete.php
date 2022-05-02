<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq1\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magebit\Faq1\Api\QuestionRepositoryInterface;

/**
 * Class that let's us delete specific row
 */
class Delete extends Action
{
    /**
     * @var QuestionRepositoryInterface
     */
    protected QuestionRepositoryInterface $questionRepository;


    /**
     * @param Action\Context $context
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Action\Context $context,
        QuestionRepositoryInterface $questionRepository
    ) {
        parent::__construct($context);
        $this->questionRepository = $questionRepository;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magebit_Faq1::question');
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $this->questionRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('The question has been deleted.'));
                $resultRedirect->setPath('faq1/*/');
                return $resultRedirect;
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('The question no longer exists.'));
                return $resultRedirect->setPath('faq1/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('faq1/question/edit', ['id' => $id]);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('There was a problem deleting the question'));
                return $resultRedirect->setPath('faq1/question/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('Can\'t find a question to delete.'));
        $resultRedirect->setPath('faq1/*/');
        return $resultRedirect;
    }
}
