@extends('master')
@section('body')
    <div class="container col-9" id="cart-table">
        @if(! $products->isEmpty())
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
            <tr>
                <td>
                    <a href="{{route('product.show',$product->id)}}">
                        {{$product->name}}
                        <img src="{{ asset('images/'. $product->options->picture) }}" height="100" width="100">
                    </a>
                </td>
                <td>
                    <form action="{{route('cart.minus',$product->rowId)}}" method="POST">
                        {{csrf_field()}}
                        <button type="submit">-</button>
                    </form>
                    {{$product->qty}}
                    <form action="{{route('cart.plus',$product->rowId)}}" method="POST">
                        {{csrf_field()}}
                        <button type="submit">+</button>
                    </form>
                </td>
                <td>{{$product->price}}</td>
                <td>
                    <form action="{{route('cart.delete',$product->rowId)}}" method="POST">
                        {{csrf_field()}}
                        <button type="submit">X</button>
                    </form>
                </td>
            </tr>
            @endforeach
            <tr>
                <td>
                    <form action="{{route('cart.delete.all')}}" method="POST">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-outline-danger">Delete all</button>
                    </form>
                </td>
                <td></td>
                <td>Total price:{{$total}}</td>
                <td></td>
            </tr>
            </tbody>
        </table>
            @if(! $u->isEmpty())
            <form action="{{route('cart.select.payment',$total)}}" method="POST">
                {{csrf_field()}}
                <button type="submit" class="btn btn-dark">Next</button>
            </form>
            @else
                <h5>Please verify your email for making transaction</h5>
            @endif
            @else
                <h5>Nothing in cart go to a <a href="{{route('products')}}">shop</a></h5>
        @endif
    </div>
@endsection

