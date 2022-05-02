<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq1\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * This is a collection model that allow us to filter and fetch a collection table data.
 */
abstract class Collection extends AbstractCollection implements \Magento\Framework\DB\Adapter\AdapterInterface
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';


    /**
     * Define model & resource model
     *
     */
    protected function _construct(){
        $this->_init(\Magebit\Faq1\Model\Question::class, \Magebit\Faq1\Model\ResourceModel\Question::class);
    }
}
