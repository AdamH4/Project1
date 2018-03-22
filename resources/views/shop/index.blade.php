@extends('master')
@section('body')
<div class="container col-7">
</div>
<div class="text-center">
<div id="demo" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
    </ul>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="img-fluid img-rounded" src="{{asset('images/slider.jpg')}}" alt="Los Angeles" width="1100" height="500">
            <div class="carousel-caption">
                <h3></h3>
                <p></p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="img-fluid " src="{{asset('images/biocrem.jpg')}}" alt="Chicago" width="1100" height="500">
            <div class="carousel-caption">
                <h3></h3>
                <p></p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="img-fluid img-rounded" src="{{asset('images/biocrem1.jpg')}}" alt="New York" width="1100" height="500">
            <div class="carousel-caption">
                <h3></h3>
                <p></p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>
</div>

<script>
    setTimeout(function() {
        $('#flash-message').fadeOut(1000);
    }, 5000); // <-- time in milliseconds
</script>
@endsection