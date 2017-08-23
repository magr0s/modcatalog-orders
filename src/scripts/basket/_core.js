(function($) {

    $.Basket = {

        init: function(settings) {

            var defaults = {
                connector:          'assets/components/modcatalog/connectors/connector.php',
                storage_lifetime:   3600 * 24 * 1000
            };
            $.extend(defaults, settings);
            this.settings = defaults;

            var storage = this.store.get(this.settings.connector) || {};
        },
        store: {
            get: function(connector) {
                var basketStorage = localStorage.getItem('basket') || {};

                if (basketStorage && +new Date() - basketStorage.lifetime < $.Basket.settings.storage_lifetime ) {
                    return basketStorage.basket;
                } else {
                    $.ajax({
                        url: connector,
                        data: {
                            action: 'basket/products/getlist'
                        },
                        method: 'post',
                        success: function(response) {
                            console.log(response)
                        }
                    });
                }
            },
            set: function(basket) {

                var data = {
                    lifetime: +new Date(),
                    basket: basket
                };

                localStorage.setItem('basket', $data);
            }
        },
        process: {
            add: function(data) {
                if ($.Basket.storage.length > 0) {
                    var inBasket = false;
                    $.each($.Basket.storage.products, function(index, value){
                        if (value.id == data.id) {
                            inBasket = true;
                        }
                        return !inBasket;
                    });
                }
            }
        }
    };

})(jQuery);