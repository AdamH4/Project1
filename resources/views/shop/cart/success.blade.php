@extends('master')
@section('body')
    <div class="container col-6" id="success-message">
        <h1>Objednavka prebehla uspesne</h1>
        <hr>
        <h6>Vasu objednavku evidujeme, poslali sme Vam email ktory je zaroven aj fakturou k tejto objednavke</h6>
        <form action="{{route('home')}}" method="GET">
            <button type="submit" class="btn btn-dark">OK</button>
        </form>
    </div>
@endsection