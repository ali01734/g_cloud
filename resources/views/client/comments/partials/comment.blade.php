<div class="comment callout padding-10" id="comment-{{ $comment->id }}">
    <div class="row">
        <div class="columns shrink">
            <div class="small-photo">
                <img src="{{ $comment->author->photoUrlOrDefault() }}">
            </div>
        </div>
        <div class="column">
            <strong class="text-blue">
                <a href="{{ route('users.show', $comment->author->id) }}">
                    {{ $comment->author->username }}
                </a>
                @include('client.comments.partials.context-menu')
            </strong>
            <div class="date">
                {{ $comment->created_at->diffForHumans() }}
            </div>
        </div>
        <article class="columns small-12">
            {{ $comment->text }}
        </article>
    </div>

    @if(Auth::user() && $showReplyForm == TRUE)
        <div class="row">
            <div class="text-dark-blue" data-toggle="reply-form-{{$comment->id}}">
                <i class="fa fa-reply"></i>
                {{ trans('strings.reply') }}
            </div>
        </div>

        <div class="reply-form hidden" id="reply-form-{{$comment->id}}" data-toggler  data-animate="hinge-in-from-top hinge-out-from-top">
            {!! Form::open(['url' => $replyUrl($comment->id), 'method' => 'POST']) !!}
            <div class="row">
                <textarea name="text"></textarea>
                <div>
                    <a href="" class="button alert hide-button">
                        <i class="fa fa-ban"></i>
                    </a>
                    <button type="submit" class="button">
                        <i class="fa fa-check"></i> &nbsp;
                        {{ trans('strings.post') }}
                    </button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    @endif

    @if($comment->replies->count() !== 0)
        <div class="column underline-link text-center" >
            <a href="#" data-toggle="replies-{{$comment->id}}">
                {{trans('strings.showReplies')}}
                <span class="badge" style="font-size: 12px">{{$comment->replies->count()}}</span>
            </a>
        </div>
    @endif

    <div id="replies-{{$comment->id}}"
         class="hidden"
         data-toggler
         data-animate="hinge-in-from-top hinge-out-from-top">
        @foreach($comment->replies as $reply)
            <div class="reply">
                @include('client.comments.partials.comment', ['comment' => $reply, 'showReplyForm' => false])
            </div>
        @endforeach
    </div>
</div>