<?php
/**
 * Loyalty Discount Condition model
 *
 * This Module is responsible for Adding Loyalty Discount condition and validate the condition
 *
 * @package     John_LoyaltyDiscount
 * @author      John Varghese <johnpj4u@gmail.com>
 */
class John_LoyaltyDiscount_Model_Condition extends Mage_Rule_Model_Condition_Abstract
{
    /*
     * Set Conditional attribute for Loyalty Discount
     * */
    public function loadAttributeOptions() {
        $attributes = array(
            'lifetimeOrderRequired' => Mage::helper('loyaltydiscount')->__('Minimum LifeTime Order Amount Required')
        );
        $this->setAttributeOption($attributes);
        return $this;
    }

    /*
     * To Display Conditional attribute as text
     * if you remove this function then it will display as a select box
     * */
    public function getAttributeElement() {
        $element = parent::getAttributeElement();
        $element->setShowAsText(true);
        return $element;
    }

    /*
     * Set Operator as "equal to" for Loyalty Discount attribute
     * */
    public function getDefaultOperatorInputByType()
    {
        if (null === $this->_defaultOperatorInputByType) {
            $this->_defaultOperatorInputByType = array(
                'select'      => array('=='),
            );
        }
        return $this->_defaultOperatorInputByType;
    }

    /*
     * Set Corresponding operator type
     * We have only one option "select" which has only one value "is equal to"
     * */
    public function getInputType() {

        return 'select';
    }

    /*
     * Set the Attribute Value type as text
     * which is used for input Minimum LifeTime Order Amount Required
     * */
    public function getValueElementType() {
        return 'text';
    }


    /*
     * This Function is responsible for validatng the Rule condition and help to apply Loyalty Discount for Customers
     * It will validate only if the Module is enabled from admin backend configuration
     * */
    public function validate(Varien_Object $object) {
        if(!Mage::helper('loyaltydiscount')->isActive()){
            return false;
        }
        $customerId = Mage::getSingleton('customer/session')->getCustomer()->getId();
        #$lifeTimeOrderTotal = $object->getData($this->getAttribute());
        $lifeTimeOrderTotal = $this->getValue();
        if($customerId)
            return $this->isLoyaltyCustomer($customerId, $lifeTimeOrderTotal);
        else
            return false;
    }


    /*
     * Check whether the Customer is a eligible for Loyalty Discount
     * by checking all completed orders by the customer
     * */
    protected function isLoyaltyCustomer($customerId, $lifeTimeOrderTotal)
    {
        $orderCollection = Mage::getModel('sales/order')->getCollection()
            ->addFieldToFilter('customer_id', $customerId)
            ->addAttributeToFilter('status', Mage_Sales_Model_Order::STATE_COMPLETE)
            ->addAttributeToSelect('grand_total')
            ->getColumnValues('grand_total')
        ;
        $totalSum = array_sum($orderCollection);
        // Check for Minimum Amount spent for getting Loyalty Discount
        if($totalSum >= $lifeTimeOrderTotal){
            return true;
        }
        else
            return false;
    }
}