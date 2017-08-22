<?php

class modCatalogMgrBasketProductsCreateProcessor extends modObjectCreateProcessor {
    
    public $classKey = 'catalogBasketProduct';

    public function initialize() {

        if (!$this->getProperty('product_id')) {
            return 'The product ID is missing.';
        }

        return parent::initialize();
    }

    public function beforeSet() {

        if (!$product = $this->modx->getObject('modResource', (int)$this->getProperty('product_id'))) {
            $error = 'The product was not found.';
            $this->modx->log(xPDO::LOG_LEVEL_ERROR, "[Basket] - {$error}");
            $this->modx->log(xPDO::LOG_LEVEL_ERROR, print_r($this->getProperties(), true));
            return $error;
        }

        if (!$basket = $this->modx->getObject('catalogBasket', (int)$this->getProperty('basket_id'))) {
            
            if(!$response = $this->modx->runProcessor('create', array(
                
            ),array(
                "processors_path"  => dirname(dirname(dirname(__FILE__))). '/',
            ))){
                $error = "The basket was not created.";
                $this->modx->log(xPDO::LOG_LEVEL_ERROR, "[Billing] - {$error}");
                return $error;
            }
            
            // else
            if($response->isError() OR !$basket = $response->getObject() OR !$basket_id = $basket['id']){
                $error = "The basket was not created";
                $this->modx->log(xPDO::LOG_LEVEL_ERROR, "[Basket] - {$error}");
                $this->modx->log(xPDO::LOG_LEVEL_ERROR, print_r($response->getResponse(), 1));
                return $error;
            }

            $this->setProperty('basket_id', $basket_id);
        }

        $this->setPrices($product);

        return parent::beforeSet();
    }

    protected function setPrices(xPDOObject & $product) {
        $data = array(
            'price'             => (int)$product->getTVValue('price'),
            'discount_price'    => (int)$product->getTVValue('discount_price'),
        );

        $this->object->fromArray($data);

        return true;
    }

    public function cleanup() {
        $response = parent::cleanup();
        $response['message'] = $this->getProperty('success_message', 'The product has been added to the basket successfully.');
        return $response;
    }

}
return 'modCatalogMgrBasketProductsCreateProcessor';