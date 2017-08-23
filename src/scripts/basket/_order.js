var orderForm = {
    init: function(form) {
        var $form = $(form),
            settings = {
                connector: 'assets/components/modcatalog/connectors/connector.php'
            };

        if ($form.length > 0) {
            this.validation($form);
            $form.on('submit', this.events.onSubmited(e));
        }
    },
    events: {
        onSubmited: function(e) {
            e.preventDefault();

            var $this = $(this);

            if (!$this.valid()) return false;

            $.ajax({
                url: orderForm.settings.connector,
                data: $this.serialize(),
                method: 'post',
                beforeSend: function() {
                    $this.find('[type="submit"]')
                        .props('disabled', true);
                },
                success: function (response) {}
            });

        }
    },
    validation: function($element) {
        if ($element.hasClass('validate')) {
            _loadScript(function() {
                $element.validate({
                    rules: {
                        client_name: {
                            required: true,
                        },
                        client_phone: {
                            required: true                        
                        },
                        client_email: {
                            email: true
                        }
                    }
                });
            });
        }
    }
};