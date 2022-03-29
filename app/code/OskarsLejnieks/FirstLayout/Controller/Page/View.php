<?php

declare(strict_types=1);

namespace OskarsLejnieks\FirstLayout\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

class View extends Action{
    public function execute() {
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $block = $page->getLayout()->getBlock('oskarslejnieks.first.layout.example');

        $block->setData('custom_parameter','Controller Data');

        return $page;
    }
}