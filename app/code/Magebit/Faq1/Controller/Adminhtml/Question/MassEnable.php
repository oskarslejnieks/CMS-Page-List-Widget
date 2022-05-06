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

use Magebit\Faq1\Model\QuestionManagement;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use Magebit\Faq1\Model\ResourceModel\Question\CollectionFactory;
use Magebit\Faq1\Api\QuestionRepositoryInterface;

/**
 * Action for MassEnabling questions
 */
class MassEnable extends Action
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
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $questionCollFactory,
        QuestionRepositoryInterface $questionRepository,
        QuestionManagement $questionManagement)
    {
        $this->filter = $filter;
        $this->questionCollFactory = $questionCollFactory;
        $this->questionRepository = $questionRepository;
        $this->questionManagement = $questionManagement;
        parent::__construct($context);
    }

    /**
     * @throws CouldNotSaveException
     * @throws LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->questionCollFactory->create());
        foreach($collection->getAllIds() as $questionId)
        {
           $this->questionManagement->enableQuestion((int) $questionId);
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been enabled.', $collection->getSize()));
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('faq1/question/index');
    }
}
