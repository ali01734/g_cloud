<section class="sidebar">
    <ul class="sidebar-menu">
        @foreach($sideBarLinks as $link)
            <li>
                <a href="{{ $link['href'] }}">
                    <i class="fa {{ $link['fa'] }}"></i>
                    <span> {{ $link['text'] }}  </span>
                    @if (isset($link['count']))
                        <small class="label pull-right bg-blue">
                            {{ $link['count'] }}
                        </small>
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
</section>