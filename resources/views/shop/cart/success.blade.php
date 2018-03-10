@extends('master')
@section('body')
    <div class="container col-6">
        <h1>Vasu objednavku evidujeme, poslali sme Vam email ktory je zaroven aj fakturou k tejto objednavke</h1>
        <form action="{{route('home')}}" method="GET">
            <button type="submit" class="btn btn-dark">OK</button>
        </form>
    </div>
@endsection