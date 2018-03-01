@if(auth()->check())
    <form action="{{route('user.change')}}" method="POST">
        {{csrf_field()}}
        <button type="submit" class="btn-link">{{ ucfirst(\Auth::user()->name) }}</button>
    </form>
@endif
@if(auth()->check())
    <a href="{{ route('logout') }}">
        Logout
    </a>
@endif
<div class="dashboard-tab">
    <form class="container" action="{{ route('search') }}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="bla bla in here...">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-search">
                            @lang('message.find')
                        </span>
                        </button>
                    </span>
            </div>
    </form>
</div>
<ul>
    @foreach(\LaravelLocalization::getSupportedLocales() as $locale => $properties)
        <li>
            <a rel="alternate" hreflang="{{ $locale }}" href="{{ \LaravelLocalization::getLocalizedURL($locale, null, [], true) }}">
                {{ $properties['name'] }}
            </a>
        </li>
    @endforeach
</ul>


