@extends('admin.base')

@section('content-header-title')
    <i class="fa fa-comments"></i>&nbsp;
    {{ trans('strings.theComments') }}
@endsection

@section('content')
    {{-- Reported comments --}}
    <div class="box">
        <div class="box-header">
            <strong class="text-blue">
                <i class="fa fa-flag"></i> &nbsp;
                {{ trans('strings.reportedComments') }}
            </strong>
            &nbsp;
            <div class="badge badge-primary">
                {{ $reportedComments->total() }}
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tr class="text-bold">
                    <td class="td-small"> # </td>
                    <td> {{ trans('strings.theContent') }}</td>
                    <td> {{ trans('strings.theDate') }} </td>
                    <td> {{ trans('strings.thePage') }} </td>
                    <td class="td-small">
                        <i class="fa fa-flag"
                           title="{{ trans('strings.numberOfReports') }}">
                        </i>
                    </td>
                    <td class="td-small"></td>
                    <td class="td-small"></td>
                    <td class="td-small"></td>
                    <td class="td-small"></td>
                </tr>
                @foreach($reportedComments as $cmt)
                    <tr>
                        <td> {{ $cmt->id }} </td>
                        <td>
                            <div class="text-overflow"> {{ $cmt->text }} </div>
                        </td>
                        <td> {{ $cmt->created_at->diffForHumans() }} </td>
                        <td>
                            @include('admin.comments.partials.page-link')
                        </td>
                        <td>
                            <div class="label label-danger">
                                {{ $cmt->reporters()->count() }}
                            </div>
                        </td>
                        <td>
                            <a href class="users-toggle">
                                <i class="fa fa-users"></i>
                            </a>
                        </td>
                        <td>
                            @include('admin.partials.delete-btn', ['url' => route('comments.destroy', $cmt->id)])
                        </td>
                        <td>
                            @include('admin.partials.btn-form', [
                                'url' => route('comments.reports.clear', $cmt->id),
                                'method' => 'delete',
                                'fa' => 'fa-times',
                                'color' => 'text-orange',
                                'title' => trans('strings.removeReports')
                            ])
                        </td>
                        <td>
                            @if (!$cmt->reporting_blocked)
                                @include('admin.partials.block-btn', [
                                    'url' => route('comments.block_reporting', $cmt->id),
                                    'title' => trans('strings.blockReporting'),
                                ])
                            @else
                                <i class="fa fa-lock"
                                   title="{{ trans('strings.repotingIsBlocked') }}"></i>
                            @endif
                        </td>
                    </tr>
                    <tr class="users-tr">
                        <td colspan="8">
                            @foreach($cmt->reporters as $user)
                                <a href="{{ route('users.show', $user->id) }}"
                                   class="label label-default item-label"
                                   target="_blank">
                                    {{ $user->username }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="box-header">
            {{ $reportedComments->render() }}
        </div>
    </div>

    {{-- All The comments --}}
    <div class="box">
        <div class="box-header">
            <strong class="text-blue">
                <i class="fa fa-comments"></i>&nbsp;
                {{ trans('strings.allTheComments') }}
            </strong>
            &nbsp;
            <div class="badge badge-primary">
                {{ $comments->total() }}
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tr class="text-bold">
                    <td class="td-small"> # </td>
                    <td> {{ trans('strings.theContent') }}</td>
                    <td> {{ trans('strings.theDate') }} </td>
                    <td> {{ trans('strings.thePage') }} </td>
                    <td class="td-small"></td>
                </tr>
                @foreach($comments as $cmt)
                    <tr>
                        <td> {{ $cmt->id }}</td>
                        <td>
                            <div class="text-overflow">
                                {{ $cmt->text }}
                            </div>
                        </td>
                        <td>
                            {{ $cmt->created_at->diffForHumans() }}
                        </td>
                        <td>
                            @include('admin.comments.partials.page-link')
                        </td>
                        <td>
                            @include('admin.partials.delete-btn', ['url' => route('comments.destroy', $cmt)])
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="box-footer">
            {!! $comments->render() !!}
        </div>
    </div>

    <script>

        $(function() {
            $('.users-tr').hide();

            $('.users-toggle').click(function(e) {
                e.preventDefault();
                $(this)
                    .closest('tr')
                    .next()
                    .toggle('fast');
                //$('.users-tr').hide();
            });
        })
    </script>


@endsection