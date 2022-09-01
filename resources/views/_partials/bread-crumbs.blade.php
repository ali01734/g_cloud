@if(isset($breadCrumbs))
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home </a></li>

        @foreach($breadCrumbs as $crumb)
            <li class="active">
                <a href="{{ $crumb['href'] }}"> {{ $crumb['name'] }} </a>
            </li>
        @endforeach
    </ol>
@endif