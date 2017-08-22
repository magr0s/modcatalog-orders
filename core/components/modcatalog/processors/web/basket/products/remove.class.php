<?php
require_once dirname(__FILE__) . '/update.class.php';

class modCatalogWebBasketProductsRemoveProcessor extends modCatalogWebBasketProductsUpdateProcessor {

    public function initialize() {

        $this->setProperty('quantity', 0);
        
        return parent::initialize();
    }
}
return 'modCatalogWebBasketProductsRemoveProcessor';