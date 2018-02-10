


@if(auth()->check())
    <li class="nav-link">
        {{ ucfirst(\Auth::user()->name) }}
    </li>
@endif


@if(auth()->check())

        <a href="/logout">Logout</a>

@endif

<div class="dashboard-tab">
    <form class="container">
        <form action="/search" method="GET">
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
