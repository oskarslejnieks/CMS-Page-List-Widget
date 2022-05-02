<?php

namespace Magebit\Faq1\Model\Question\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * class that shows "Enabled" or "Disabled" on backend admin grid depending on value (0 or 1)
 */
class Status implements ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [['value' => 1, 'label' => __('Enabled')], ['value' => 0, 'label' => __('Disabled')]];
    }
}
