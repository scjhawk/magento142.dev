<?php
/**
 * @package     BlueAcorn\CustomShippingMethod
 * @version
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Copyright © 2015 Blue Acorn, Inc.
 */
class BlueAcorn_CustomShippingMethod_Model_Carrier extends Mage_Shipping_Model_Carrier_Abstract implements Mage_Shipping_Model_Carrier_Interface
{
    protected $_code = 'blueacorn_customshippingmethod';

    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        $result = Mage::getModel('shipping/rate_result');

        $result->append($this->_getStandardShippingRate());
        $result->append($this->_getExpressShippingRate());

        return $result;
    }

    protected function _getStandardShippingRate()
    {
        // @var $rate Mage_Shipping_Model_Rate_Result_Method
        $rate = Mage::getModel('shipping/rate_result_method');

        // getConfigData(config_key) returns the configuration value for the carriers/[carrier_code]/[config_key]
        $rate->setCarrier($this->_code);

        $rate->setCarrierTitle($this->getConfigData('title'));

        $rate->setMethod('standard');
        $rate->setMethodTitle('Standard');

        $rate->setPrice(14.99);
        $rate->setCost(0);

        return $rate;
    }

    protected function _getExpressShippingRate()
    {
        // @var $rate Mage_Shipping_Model_Rate_Result_Method
        $rate = Mage::getModel('shipping/rate_result_method');

        // getConfigData(config_key) returns the configuration value for the carriers/[carrier_code]/[config_key]
        $rate->setCarrier($this->_code);

        $rate->setCarrierTitle($this->getConfigData('title'));

        $rate->setMethod('express');
        $rate->setMethodTitle('Express (Quicker \'n Spit');

        $rate->setPrice(34.99);
        $rate->setCost(0);

        return $rate;
    }

    protected function _getFreeShippingRate()
    {
        $rate = Mage::getModel('shipping/rate_result_method');

        $rate->setCarrier($this->_code);

        $rate->setCarrierTitle($this->getConfigData('title'));

        $rate->setMethod('free_shipping');
        $rate->setMethodTitle('Free Shipping (3 - 5 days)');

        $rate->setPrice(0);
        $rate->setCost(0);

        return $rate;
    }

    public function getAllowedMethods()
    {
        return array(
            'standard'      => 'Standard',
            'express'       => 'Express',
            'free_shipping' => 'Free Shipping',
        );
    }
}