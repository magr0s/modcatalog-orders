<?php

$this->loadClass('modProcessor', '', false, true);

class modCatalogService extends modProcessor {

    function __construct(modX & $modx,array $properties = array()) {
        parent::__construct($modx, $properties);

        $this->setProperties(array(
            'basket_use_cookie'         => $this->modx->getOption('modcatalog.basket.use_cookie', null, true),
            'basket_cookie_life_time'   => $this->modx->getOption('modcatalog.basket.cookie_life_time', null, time() + (3600 * 27 *7)),
        ));
    }

    public function getActiveBasketID() {
        $basket_id = null;

        if (!$basket_id = $_SESSION['basket'] && $this->getProperty('basket_use_cookie')){
            if ($basket_id = $_COOKIE['basket']) {
                $this->refreshBasketSession($basket_id);
            }
        }
    }

    protected function refreshBasketSession($basket_id) {
        $_SESSION['basket'] = $basket_id;
        setcookie('basket', $basket_id, $this->getProperty('basket_cookie_life_time'), '/');
    }

    public function flushBasketSession() {
        unset($_SESSION['basket']);
        unset($_COOKIE['basket']);
    }

    function process() {}
}