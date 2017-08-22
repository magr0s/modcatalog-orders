<?php

require_once MODX_CORE_PATH . 'components/modcatalog/processors/mgr/basket/products/update.class.php';

class modCatalogWebBasketProductsUpdateProcessor extends modCatalogMgrBasketProductsUpdateProcessor {

    function initialize() {
        
        if (!$basket_id = $this->modx->catalog->getActiveBasketID()) {
            return 'The basket was not found.';
        }

        $this->setProperty('basket_id', $basket_id);

        if (!$product_id = $this->getProperty('product_id')) {
            return 'The product ID is missing.';
        }

        $this->setProperty('basket_product_id', $product_id);

        return parent::initialize();
    }

    public function beforeSet() {

        if ($this->object->id != $this->getProperty('product_id')) {
            return 'Product not fount in basket.';
        }

        return parent::initialize();
    }
}
return 'modCatalogWebBasketProductsUpdateProcessor';