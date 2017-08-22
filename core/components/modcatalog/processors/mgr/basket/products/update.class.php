<?php

class modCatalogMgrBasketProductsUpdateProcessor extends modObjectUpdateProcessor {

    public $classKey = 'catalogBasketProducts';

    public function initialize() {

        if ($basket_product_id = (int)$this->getProperty('basket_product_id')) {
            if (
                $basket_id = $this->getProperty('basket_id')
                && $product_id = $this->getProperty('product_id')
                && $object = $this->modx->getObject($this->classKey, array(
                    'basket_id'     => $basket_id,
                    'product_id'    => $product_id
                ))
            ) {
                $basket_product_id = $object->id;
            }
        }

        if (!$basket_product_id) {
            return 'The basket product ID is missing.';
        }

        $this->setProperty('id', $basket_product_id);
        
        return parent::initialize();
    }

    public function cleanup() {
        $response = parent::cleanup();
        $response['message'] = $this->getProperty('success_message', 'Заказ успешно обновлен');
        return $response;
    }
}
return 'modCatalogMgrBasketProductsUpdateProcessor';