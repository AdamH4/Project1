@component('mail::message')
# Dobry den posielave Vam tento email ako fakturu k Vasej objednavke.

Verime ze vsetko prebehlo v poriadku no ak nie nevahajte a kontaktujte nas na <a href="{{route('contacts')}}">nasej adrese</a>.

#Dorucovacia a fakturacna adresa:
<li>{{$information['first_name']}}</li>
<li>{{$information['second_name']}}</li>
<li>{{$information['city']}}</li>
<li>{{$information['street']}}</li>
<li>{{$information['postcode']}}</li>
<li>{{$information['country']}}</li>
<li>{{$information['phone_number']}}</li>

#Vas objednany tovar:

@component('mail::table')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Price</th>
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

<h4>Dakujeme za Vas nakup.</h4>
@endcomponent
