<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
        <li class="hidden">
            <a href="#page-top"></a>
        </li>

        <li>
            <a href="{{ route('admin.roles') }}" title="Uprawnienia użytkowników">Role</a>
        </li>

        <li>
            <a href="{{ route('admin.users') }}" title="Zarejestrowani użytkownicy">Użytkownicy</a>
        </li>

        <li class="page-scroll">
            <a href="{{ route('admin.services') }}">Usługi</a>
        </li>
    <!-- Authentication Links -->
        @if (Auth::guest())
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