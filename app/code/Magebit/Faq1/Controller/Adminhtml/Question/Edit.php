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

use Magebit\Faq1\Model\QuestionRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\Page;
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
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
        $this->_questionRepository = $questionRepository;
        $this->_coreRegistry = $coreRegistry;
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $this->_coreRegistry->register('id', $id);

        return $this->_pageFactory->create();
    }
}
