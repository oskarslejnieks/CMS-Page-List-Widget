<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq1\Controller\Adminhtml\Question;


use Magebit\Faq1\Api\QuestionRepositoryInterface as QuestionRepository;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class that let's us inline-edit specific row in admin grid
 */
class InlineEdit extends Action
{
    /**
     * Authorization level of a basic admin session
     */

    protected QuestionRepository $questionRepository;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected JsonFactory $jsonFactory;

    /**
     * @param Context $context
     * @param QuestionRepository $questionRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        QuestionRepository $questionRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->questionRepository = $questionRepository;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return ResponseInterface|Json|ResultInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData(
                [
                    'messages' => [__('Please correct the data sent.')],
                    'error' => true,
                ]
            );
        }

        foreach (array_keys($postItems) as $questionId) {
            $question = $this->questionRepository->get($questionId);
            try {
                $question->setData(array_merge($question->getData(), $postItems[$questionId]));
                $this->questionRepository->save($question);
            }  catch (\Exception $e) {
                $messages[] = "[Error:]  {$e->getMessage()}";
                $error = true;
            }
        }

        return $resultJson->setData(
            [
                'messages' => $messages,
                'error' => $error
            ]
        );
    }

}
