<nav class="navbar navbar-expand-sm navbar-light fixed-top" id="navigation-bar">
    <div class="container">
        <ul class="navbar-nav">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">@lang('navigation.home')</a>
            </li>
        @if(auth()->check())
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="nav-dropdown">
                    {{ucfirst(auth()->user()->name)}}
                </a>
                <div class="dropdown-menu" aria-labelledby="nav-dropdown">
                    <a class="dropdown-item" href="{{route('user.change')}}">@lang('navigation.change_password')</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('logout')}}">@lang('navigation.logout')</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('cart')}}">@lang('navigation.cart')</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">@lang('navigation.login')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('registration.index')}}">@lang('navigation.registration')</a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{route('products')}}">@lang('navigation.products')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('contacts')}}">@lang('navigation.contacts')</a>
        </li>
        <li class="nav-item">
            <nav class="navbar navbar-expand-sm">
                <form class="form-inline" action="{{route('search')}}" method="GET">
                    <input class="form-control" type="text" placeholder="@lang('navigation.search')" id="search-bar">
                    <button class="btn btn-dark" type="submit" id="search-button">@lang('navigation.find')</button>
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








