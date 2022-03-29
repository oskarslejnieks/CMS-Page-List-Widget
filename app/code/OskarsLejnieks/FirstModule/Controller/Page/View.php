<?php

declare(strict_types=1);

namespace OskarsLejnieks\FirstModule\Controller\Page;

use Magento\Framework\Controller\Result\Json;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class View extends Action{
    public function execute() {
        $jsonResult = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $jsonResult->setData([
            'message' => 'My Second Page'
        ]);
        return $jsonResult;
    }
}