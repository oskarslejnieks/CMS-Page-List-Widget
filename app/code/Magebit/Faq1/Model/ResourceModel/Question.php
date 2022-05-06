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

namespace Magebit\Faq1\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magebit\Faq1\Api\Data\QuestionInterface;

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
        $this->_init(QuestionInterface::MAINTABLE, QuestionInterface::IDFIELDNAME);
    }
}
