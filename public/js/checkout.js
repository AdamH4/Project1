var stripe = Stripe('pk_test_aQnNOphfY95Tep3X1OapJp7y');

var $form = $('#checkout-form');

$form.submit(function (event) {
        stripe.card.createToken({
            number: $('#card-number').val(),
            cvc: $('#card-cvc').val(),
            exp_month: $('#card-expiry-month').val(),
            exp_year: $('#card-expiry-year').val(),
            name: $('#card-name').val()
        }, stripeResponseHandler());
        return false;
});

function stripeResponseHandler(status, response) {

}