<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq1\Model;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magebit\Faq1\Model\ResourceModel\Question\CollectionFactory;

/**
 * Data provider for UI components based on Questions
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $questionCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $questionCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $question) {
            $this->_loadedData[$question->getId()] = $question->getData();
        }
        return $this->_loadedData;
    }
}
