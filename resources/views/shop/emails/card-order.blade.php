@component('mail::message')
# Dobrý deň posielame Vám tento email ako faktúru k Vašej objednávke ku ktorej platbu evidujeme
(Good day we sent you this email as bill for your order to which we make the payment)

Veríme že všetko prebehlo v poriadku no ak nie neváhajte a kontaktujte nás na <a href="{{route('contacts')}}">našej adrese</a>.
(We believe that everything went ok, but if not just contact us on our <a href="{{route('contacts')}}">contact address</a>)

#Doručovacia a fakturačná adresa:
(Delivery and invoice address:)
<li>{{$information['first_name']}}</li>
<li>{{$information['last_name']}}</li>
<li>{{$information['city']}}</li>
<li>{{$information['street']}}</li>
<li>{{$information['postcode']}}</li>
<li>{{$information['country']}}</li>
<li>{{$information['phone_number']}}</li>
@if($note)
# Poznámka:
  (Note:)
{{$note}}
@endif

#Vaša objednávka vám bude odoslaná službou akú ste si vybrali({{$type}})
(Your order will be dispatched by service you have chosen({{$type}}))

#Váš objednaný tovar:
(Your ordering goods)
@component('mail::table')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>Produkt(Product)</th>
            <th>Množstvo(Quantity)</th>
            <th>Cena(Price)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>
                    <a href="{{route('product.show',$product->id)}}">
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
        </tbody>
    </table>
@endcomponent
<hr>
<h4>Suma k zaplateniu: {{$total}}</h4>
(Sum to pay: {{$total}})

<h4>Ďakujeme Vám za nákup.</h4>
(We appreciate your order)
@endcomponent
