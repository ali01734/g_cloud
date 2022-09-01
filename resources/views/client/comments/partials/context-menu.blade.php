
<div class="pull-left" style="display: inline-block">
    <ul class="dropdown menu" data-dropdown-menu>
        <li>
            <a href="#">&nbsp;</a>
            <ul class="menu">
                <li>
                    <a href="">
                        <i class="fa fa-flag-o"></i>
                        {{ trans('strings.report') }}
                    </a>
                </li>
                @if(Auth::user() && Auth::user()->id == $comment->user_id)
                    <li class="text-red">
                        <a href="">
                            <form action="{{route('comments.destroy', $comment)}}" method="POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit">
                                    <i class="fa fa-times "></i>
                                    {{ trans('strings.delete') }}
                                </button>
                            </form>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    </ul>
</div>
