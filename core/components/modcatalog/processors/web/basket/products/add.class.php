<?php

require_once MODX_CORE_PATH . 'components/modcatalog/processors/mgr/basket/products/add.class.php';

class modCatalogWebBasketProductsAddProcessor extends modCatalogMgrBasketProductsAddProcessor {

    public function initialize() {

        $this->setProperties(array(
            'basket_id'    => $this->modx->catalog->getActiveBasketID(),
        ));

        return parent::initialize();
    }

    protected function processResponse($response){
        
       if(
           !$response->isError() 
           AND $object = $response->getObject() 
           AND !empty($object['baket_id'])
       ){
           $_SESSION['basket_id'] = $object['basket_id'];
       }
       
       return parent::processResponse($response);
   } 
}
return 'modCatalogWebBasketProductsAddProcessor';