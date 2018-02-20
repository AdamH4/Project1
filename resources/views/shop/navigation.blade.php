


@if(auth()->check())
    <a href="/user/change">
        {{ ucfirst(\Auth::user()->name) }}
    </a>
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
                        <button type="submit" class="btn btn-default">
                            <span style="height: 20px" class="glyphicon glyphicon-search">Find
                            </span>
                        </button>
                    </span>
            </div>
    </form>
</div>



@lang('message.welcome')


