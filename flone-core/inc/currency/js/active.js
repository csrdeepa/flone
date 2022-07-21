(function($) {
    "use strict";

    var initSwitchCurrency = function() {
        $('body').on('click', '.same-language-currency li a', function() {
            var currency = $(this).data('currency');
            $.cookie('flone_currency', currency, {
                path: '/'
            });
            location.reload();
            $(document.body).trigger('wc_fragment_refresh');
        });
    }

    initSwitchCurrency();

})(jQuery);