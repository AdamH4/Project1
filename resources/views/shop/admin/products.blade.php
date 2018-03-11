@extends('master')
@section('body')
    <div class="container col-8">
        <div class="row" >
            @foreach($products as $product)
                <div class="col-3">
                    <a href="{{route('admin.product.show' ,$product->id) }}" id="black-tag">
                        <img class="img-fluid img-thumbnail" src="{{ asset('images/'. $product->picture) }}" height="200" width="200">
                        <h4 >{{ ucfirst($product->name) }}</h4>
                        <h3>{{$product->price}},- €</h3>
                    </a>
                    <form action="{{route('admin.products.delete', $product->id)}}" method="POST">
                        {{csrf_field()}}
                        <button type="submit"><i class="far fa-trash-alt"></i></button>
                    </form>
                    <p>{{ ucfirst($product->category) }}</p>
                </div>
            @endforeach
        </div>
        <div class="pagination">
            {{$products->links()}}
        </div>
    </div>
@endsection