<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 5/5/17
 * Time: 2:08 PM
 */ 
class Etre_ShippingFeatures_Block_Checkout_Onepage_Shipping extends Mage_Checkout_Block_Onepage_Shipping {

    public function getCountryOptions()
    {
        $options    = false;
        $useCache   = Mage::app()->useCache('config');
        if ($useCache) {
            $cacheId    = 'DIRECTORY_COUNTRY_SELECT_STORE_' . Mage::app()->getStore()->getCode();
            $cacheTags  = array('config');
            if ($optionsCache = Mage::app()->loadCache($cacheId)) {
                $options = unserialize($optionsCache);
            }
        }

        if ($options == false) {
            $disabledShippingCountries = Mage::helper('etre_shippingfeatures')->getStoreDisabledShippingAddressCountries();
            if(!empty($disabledShippingCountries) && is_array($disabledShippingCountries)):
                $this->getCountryCollection()->addFieldToFilter('country_id', array('nin' => $disabledShippingCountries));
            endif;
            $options = $this->getCountryCollection()->toOptionArray();
            if(empty($options)):
                $options = [
                    [
                        'value'=>"",
                        'label'=>Mage::helper('etre_shippingfeatures')->__('Selection is temporarily disabled.'),
                    ]
                ];
            endif;
            if ($useCache) {
                Mage::app()->saveCache(serialize($options), $cacheId, $cacheTags);
            }
        }
        return $options;
    }

}