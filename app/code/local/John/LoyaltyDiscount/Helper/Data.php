<?php
/**
 * Loyalty Discount Module Helper
 *
 *
 * @package     John_LoyaltyDiscount
 * @author      John Varghese <johnpj4u@gmail.com>
 */
class John_LoyaltyDiscount_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function isActive()
    {
        if (Mage::getStoreConfig('loyaltydiscount/general/enabled')) {
            return true;
        }
        return false;
    }
}