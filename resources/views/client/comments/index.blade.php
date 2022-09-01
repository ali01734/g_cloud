<div class="row expanded align-center">
    <div class="column small-12">
        <h2 class="text-dark-blue text-medium text-bold">
            {{ trans('strings.theComments') }}
            <div class="badge"> {{ $comments->count() }} </div>
        </h2>

        <div class="row">
            @if (Auth::user())
                <div class="column small-12" data-toggle="reply-buttons">
                    <form action="{{ $postUrl }}" method="POST">
                        {{ csrf_field() }}
                        <textarea name="text" style="min-height: 100px" placeholder="{{ trans('strings.writeAComment') }}"></textarea>
                        <div id="reply-buttons" data-toggler="hidden" class=" hidden" data-animate="hinge-in-from-top hinge-out-from-top">
                            <div class="pull-left">
                                <a href
                                   class="button secondary cancel-button">
                                    <i class="fa fa-ban"></i>
                                    {{ trans('strings.cancel') }}
                                </a>
                                <button type="submit" class="button">
                                    <i class="fa fa-check"></i>
                                    {{ trans('strings.post') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <div class="text-center column">
                    <a href="/login"
                       class="button success">
                        <i class="fa fa-sign-in"></i> &nbsp;
                        {{ trans('strings.loginToComment') }}
                    </a>
                </div>
            @endif
        </div>

        @foreach($comments as $comment)
            @include('client.comments.partials.comment', ['comment' => $comment, 'showReplyForm' => true])
        @endforeach

        @if (!$comments->isEmpty())
            <div class="row align-center">
                <div class="column shrink">
                    {!! $comments->render() !!}
                </div>
            </div>
        @endif
    </div>
</div>