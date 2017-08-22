<?php

class modCatalogMgrBasketCreateProcessor extends modObjectCreateProcessor {
    
    public $classKey = 'catalogBasket';

    public function initialize() {

        $this->setProperties(array(
            'createdon' => time()
        ));

        return parent::initialize();
    }
}
return 'modCatalogMgrBasketCreateProcessor';