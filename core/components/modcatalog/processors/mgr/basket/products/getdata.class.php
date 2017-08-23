<?php

require_once MODX_CORE_PATH . 'components/modxsite/processors/site/web/getdata.class.php';

class modCatalogMgrBasketProductsGetdataProcessor extends modSiteWebGetdataProcessor {

    public $classKey = 'catalogBasketProduct';

    protected $totalSum = 0;
    protected $totalSumOriginal = 0;
    protected $positions = 0;
    protected $quantity = 0;
    protected $discount = 0;

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $c = parent::breapreQueryBeforeCount($c);

        $where = array();

        if ($basket_id = $this->getProperty('basket_id')) {
            $where['basket_id'] = $basket_id;
        }

        if ($this->getProperty('show_canceled', false)) {
            $where['quantity:>'] = 0;
        }

        if ($where) {
            $c->where($where);
        }

        return $c;
    }

    public function setSelection(xPDOQuery $c) {
        $c = parent::setSelection($c);

        $c->innerJoin('catalogBasket');
        $c->innerJoin('modResource', 'Product');
        
        # TODO:
        # Add to select product TVs data
        
        $c->select(array(
            "{$this->classKey}.id as basket_product_id",
            "{$this->classKey}.basket_id as basket_id",
            "{$this->classKey}.product_id as product_id",
            "{$this->classKey}.price as product_price",
            "{$this->classKey}.discount_price as product_discount_price",
        ));

    }
}
return 'modCatalogMgrBasketProductsGetdataProcessor';