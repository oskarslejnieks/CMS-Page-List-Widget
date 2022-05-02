<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq1\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * CRUD resource model has to extend AbstractDb, which contain functions for fetching information from database
 */
class Question extends AbstractDb
{
    /**
     * Define main table
     * @return void
     *
     */
    protected function _construct()
    {
        $this->_init('faq1', 'id');
    }
}
