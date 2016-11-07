<?php
/**
 * Loyalty Discount Module Observer
 *
 * This Observer is responsible for adding "Loyalty Discount" as Addition Condition Option
 *
 * @package     John_LoyaltyDiscount
 * @author      John Varghese <johnpj4u@gmail.com>
 */

class John_LoyaltyDiscount_Model_Observer
{
    /*
     * To set Loyalty Discount as an additional Condition option
     * the corresponding model need to be specified here so that magento can use that model
     * for applying conditions if the selected condition is "Loyalty Discount"
     * 
     * Event for this Observer is salesrule_rule_condition_combine
     * */
    public function addLoyaltyDiscount($observer)
    {
        $helper = Mage::helper('loyaltydiscount');
        if(!$helper->isActive()){
            return $observer;
        }

        $additional = $observer->getAdditional();
        $conditions = (array) $additional->getConditions();

        $conditions = array_merge_recursive($conditions, array(
            array('label' => $helper->__('Loyalty Discount'), 'value'=>'loyaltydiscount/condition'),
        ));

        $additional->setConditions($conditions);
        $observer->setAdditional($additional);

        return $observer;
    }
}