<nav class="navbar navbar-expand-sm navbar-light fixed-top" id="navigation-bar">
    <div class="container">
        <ul class="navbar-nav">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">Home</a>
            </li>
        @if(auth()->check())
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="nav-dropdown">
                    {{ucfirst(auth()->user()->name)}}
                </a>
                <div class="dropdown-menu" aria-labelledby="nav-dropdown">
                    <a class="dropdown-item" href="{{route('user.change')}}">Change password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('cart')}}">Cart</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('registration.index')}}">Registration</a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{route('products')}}">Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('contacts')}}">Contacts</a>
        </li>
        <li class="nav-item">
            <nav class="navbar navbar-expand-sm">
                <form class="form-inline" action="{{route('search')}}" method="GET">
                    <input class="form-control" type="text" placeholder="Search" id="search-bar">
                    <button class="btn btn-dark" type="submit">@lang('message.find')</button>
                </form>
            </nav>
        </li>
    @foreach(\LaravelLocalization::getSupportedLocales() as $locale => $properties)
            <li class="nav-item">
                <a class="nav-link" rel="alternate" hreflang="{{ $locale }}" href="{{ \LaravelLocalization::getLocalizedURL($locale, null, [], true) }}">
                    {{ $properties['name'] }}
                </a>
            </li>
    @endforeach
            </div>
        </ul>
    </div>
</nav>








