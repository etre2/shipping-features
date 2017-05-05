<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 5/5/17
 * Time: 2:06 PM
 */ 
class Etre_ShippingFeatures_Helper_Data extends Mage_Core_Helper_Abstract {


    /**
     * @return array
     */
    public function getStoreDisabledShippingAddressCountries(){
        return explode(',',Mage::getStoreConfig('shipping/etre_shipping_options/disallow_shipping_to_country'));
    }

}