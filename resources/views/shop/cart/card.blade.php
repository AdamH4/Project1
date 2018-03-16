@extends('master')
@section('body')
    <div class="container col-9">
        {{csrf_field()}}
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-success">
                {{ session()->get('error') }}
            </div>
        @endif
        <form action="{{route('cart.select.payment',$type)}}" method="POST">
            {{csrf_field()}}
            <button class="btn btn-dark"><i class="fas fa-arrow-alt-circle-left"></i></button>
        </form>
        <form action="{{route('card.checkout',$type)}}" method="POST" id="payment-form">
            {{csrf_field()}}
            @if($information->isEmpty())
            <h2>@lang('message.informations')</h2>
            <hr>
            <div class="form-group">
            <label for="first_name">@lang('message.first_name')</label>
            <input type="text" id="first_name" name="first_name" class="form-control" required>
            <label for="second_name">@lang('message.second_name')</label>
            <input type="text" id="second_name" name="second_name" class="form-control" required>
            <input type="hidden"  id="name_on_card" name="name_on_card" value="{{auth()->user()->name}}" required>
            <label for="city">@lang('message.city')</label>
            <input type="text" id="city" name="city" class="form-control" required>
            <label for="street">@lang('message.street')</label>
            <input type="text" id="street" name="street" class="form-control" required>
            <label for="postcode">@lang('message.postcode')</label>
            <input type="text" id="postcode" name="postcode" class="form-control" required>
            <label for="country">@lang('message.country')</label>
            <input type="text" id="country" name="country" class="form-control" required>
            <label for="phone_number">@lang('message.phone_number')</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" required>
            <label for="note">@lang('message.note')</label>
            <textarea name="note" id="note" class="form-control"></textarea>
            <label for="card-element">@lang('message.card_credit')</label>
            <div id="card-element">
            </div>
            <div id="card-errors" role="alert"></div>
            </div>
            <button class="btn btn-dark form-control">@lang('message.submit_payment')</button>
            @else
                <h2>@lang('message.use_information') <a href="{{route('user.add.information')}}" id="purple-tag">@lang('message.it')</a></h2>
                <hr>
                <label for="note">@lang('message.note')</label>
                <textarea name="note" id="note" class="form-control"></textarea>
                <label for="card-element">@lang('message.card_credit')</label>
                <div id="card-element">
                </div>
                <div id="card-errors" role="alert"></div>
                <br>
                <button class="btn btn-dark form-control">@lang('message.submit_payment')</button>
            @endif
        </form>
    <div id="cashondelivery-table">
        <table class="table table-striped col-3">
            <thead class="thead-dark">
            <tr>
                <th>@lang('message.product')</th>
                <th>@lang('message.quantity')</th>
                <th>@lang('message.price')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        <a href="{{route('product.show',$product->id)}}" id="purple-tag">
                            <img src="{{ asset('images/'. $product->options->picture) }}" height="100" width="100">
                            {{$product->name}}
                        </a>
                    </td>
                    <td>
                        <div class="quantity col-2">
                            {{$product->qty}}
                        </div>
                    </td>
                    <td>
                        <div class="price">
                            {{$product->price}}
                        </div>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td>@lang('message.total') {{$total}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

        <script>
            // Create a Stripe client.
            var stripe = Stripe('pk_test_aQnNOphfY95Tep3X1OapJp7y');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {
                style: style,
                hidePostalCode:true,
            });

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
    </script>

@endsection()