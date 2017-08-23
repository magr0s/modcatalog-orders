
//= basket/_core.js


(function($) {    
    
    $.Basket.init();

    $('.quick-product-add').on('click', function(e) {
        e.preventDefault();
        var $this = $(this),
            data = {
                product_id: $this.attr('data-product-id') || 0,
                quantity: 1,
                options: {}
            };

        $.Basket.process.add(data);
    });

    $('.product-add').on('click', function(e){
        e.preventDefault();
        var $this = $(this),
            data = {
                id: $this.attr('data-product-id'),
                quantity: $('#product-quantity').val() || 1,
                options: {}
            };

        $.Basket.process.add(data);
    });

    var orderForm = {
        init: function() {

        }
    };

})(jQUery);