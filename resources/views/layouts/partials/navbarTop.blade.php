<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
        <li class="hidden">
            <a href="#page-top"></a>
        </li>
        @foreach ($menuTop as $item)
            <li class="page-scroll">
                <a href="{{ url(App::getLocale(), $item->alias) }}">{{ $item->title }}</a>
            </li>
        @endforeach
        @if ($servicesCnt > 0)
            <li class="page-scroll">
                <a href="{{ route('services.index') }}">Twoje usługi</a>
            </li>
        @endif
    <!-- Authentication Links -->
        @if (Auth::guest())
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" class="hidden" action="{{ route('logout') }}" method="POST">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        @endif


    </ul>
</div>
<!-- /.navbar-collapse -->