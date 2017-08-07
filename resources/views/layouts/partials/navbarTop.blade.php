<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
        <li class="hidden">
            <a href="#page-top"></a>
        </li>
        @foreach ($menuTop as $item)
            <li class="page-scroll">
                <a href="/{{ $item->alias }}">{{ $item->title }}</a>
            </li>
        @endforeach
        @if ($servicesCnt > 0)
        <li class="page-scroll">
            <a href="/services">Twoje usługi</a>
        </li>
        @endif
    </ul>
</div>
<!-- /.navbar-collapse -->