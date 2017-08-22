<?php

class modCatalogMgrBasketProductsAddProcessor extends modProcessor {
    
    public function initialize() {
        
        $this->setDefaultProperties(array(
            'quantity'          => 1,
            'success_message'   => 'The product has been added to the basket successfully.'
        ));

        return parent::initialize();
    }

    public function process() {
        
        $this->findObject();

        if ($this->getProperty('basket_product_id')) {            
            $action = 'update';
        } else {
            $action = 'create';
        }

        if(!$response = $this->modx->runProcessor("{$action}", 
            $this->getProperties(),
            array(
                "processors_path"  => dirname(__FILE__) . '/',
            )
        )){
            $error = "Ошибка выполнения запроса";
            $this->modx->log(xPDO::LOG_LEVEL_ERROR, "[Basket] - ".__CLASS__." - {$error}");
            $this->modx->log(xPDO::LOG_LEVEL_ERROR, print_r($this->getProperties(), true));
            return $this->failure($error);
        }

        return $this->processResponse($response);
    }

    private function findObject() {
        
        if ( !$this->getProperty('basket_product_id') && $object = $this->getObject() ) {
            
            $this->setProperties(array(
                'basket_product_id'  => $object->id,
                'quantity'          => $object->quantity + $this->getProperty('quantity')
            ));
        }
    }

    protected function getObject() {

        $object = null;

        if (
            $basket_id = $this->getProperty('basket_id', null)
            && $product_id = $this->getProperty('product_id', null)
        ) {
            $object = $this->modx->getObject('catalogBasketProduct', array(
                'basket_id'    => $basket_id,
                'product_id'   => $product_id
            ));
        }

        return $object;
    }

    protected function processResponse($response){
        return $response->getResponse();
    }
}
return 'modCatalogMgrBasketProductsAddProcessor';