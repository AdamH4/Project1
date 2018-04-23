<nav class="navbar navbar-expand-sm navbar-light fixed-top" id="navigation-bar">
    <ul class="navbar-nav mx-auto text-center">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <div class="navbar-header">
            <a href="{{route('home')}}">
                <img class="navbar-brand" src="{{asset('images/logo_mini_mini.png')}}">
            </a>
        </div>
    @if(! auth()->check())
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
        <a class="nav-link" id="nav-about-us" href="{{route('about.us')}}">@lang('navigation.about')</a>
    </li>
    <li class="nav-item" id="nav-search">
        <nav class="navbar navbar-expand-sm">
            <form class="form-inline" action="{{route('search')}}" method="GET">
                <input class="form-control" type="text" placeholder="@lang('navigation.search')" id="search-bar" name="search">
                <button class="btn btn-dark" type="submit" id="search-button"><i class="fas fa-search"></i></button>
            </form>
        </nav>
    </li>
    @foreach(\LaravelLocalization::getSupportedLocales() as $locale => $properties)
        <li class="nav-item" id="nav-language">
            <a class="nav-link" rel="alternate" hreflang="{{ $locale }}" href="{{ \LaravelLocalization::getLocalizedURL($locale, null, [], true) }}">
                {{ $properties['name'] }}
            </a>
        </li>
    @endforeach
    @if(auth()->check())
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="nav-dropdown">
                @if(strlen(auth()->user()->name) > 10)
                    {{substr(auth()->user()->name,0,10)}}...
                @else
                    {{auth()->user()->name}}
                @endif
            </a>
            <div class="dropdown-menu" aria-labelledby="nav-dropdown">
                <a class="dropdown-item" href="{{route('user.change')}}">@lang('navigation.change_password')</a>
                <a class="dropdown-item" href="{{route('user.add.information')}}">@lang('message.add_information')</a>
                <a class="dropdown-item" href="{{route('user.delete.information')}}">@lang('message.delete_information')</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('logout')}}">@lang('navigation.logout')</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('cart')}}">@lang('navigation.cart') <span class="badge badge-dark">{{\Cart::instance(auth()->user()->id)->content()->count()}}</span></a>
        </li>
    @endif
        </div>
    </ul>
</nav>








