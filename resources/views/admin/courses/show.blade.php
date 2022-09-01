@extends('admin.base')

@section('')

@endsection

@section('content-header-title')
    {{ $course->name }}

    <div class="pull-right">
        {!!
            Form::open([
                'url' => route('courses.destroy', $course->id),
                'method' => 'delete'
            ])
        !!}

            <a href="{{ route('admin.subjects.show', $course->subject->id) }}"
               class="btn btn-default">
                {{ $course->subject->name }}
                &nbsp;
                <i class="fa fa-level-up"></i>
            </a>
            &nbsp;

            <a class="btn btn-warning" href="{{ route('admin.courses.edit', $course->id) }}">
                {{ trans('strings.edit') }}
                &nbsp;
                <i class="fa fa-pencil"></i>
            </a>

            <button class="btn btn-danger" type="submit" data-prevent>
                {{ trans('strings.delete') }}
                &nbsp;
                <i class="fa fa-times"></i>
            </button>

        {!! Form::close() !!}
    </div>

@endsection

@section('content-header-title-small')
    {{ trans('strings.lessonsAndExercises') }}
@endsection

@section('content')

    {{-- Lessons --}}
    <div class="row">
        <div class="col-lg-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('strings.lessons') }}</h3>
                    <a href="{{ route('admin.lessons.create', [ $course->id ]) }}"
                       class="btn btn-success pull-right">
                        {{ trans('strings.add') }}
                        &nbsp;
                        <i class="fa fa-plus"></i>
                    </a>
                </div>

                <div class="box-body">
                    @if($lessons->isEmpty())
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i>
                            &nbsp;
                            {{ trans('strings.thereAreNoLessons') }}
                        </div>
                    @else
                        <table class="table table-bordered">
                            <tr>
                                <th class="td-small"> # </th>
                                <th>{{ trans('strings.name') }}</th>
                                <th></th>
                                <th class="td-small"></th>
                                <th class="td-small"></th>
                                <th class="td-small"></th>
                                <th class="td-small"></th>
                            </tr>

                            @foreach($lessons as $lesson)
                                <tr>
                                    <td class="center">
                                        {{ $lesson->id }}
                                    </td>
                                    <td>
                                        <a href="">
                                            {{$lesson->name}}
                                        </a>
                                    </td>
                                    <td title="{{ $lesson->created_at }}"
                                        class="nowrap">
                                        {{--{{ $lesson->created_at->diffForHumans() }}--}}
                                    </td>
                                    <td>
                                        @if ($lesson->youtube_id)
                                            <i class="fa fa-youtube-play text-red"></i>
                                        @else
                                            <i class="fa fa-youtube-play text-gray"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.lessons.edit', [$lesson->id]) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </td>
                                    <td style="text-align: center">
                                        {!!
                                            Form::open([
                                                'method' => 'delete',
                                                'url' => route("lessons.destroy", [$lesson->id])
                                            ])
                                        !!}

                                        {!!
                                            Form::button('<i class="fa fa-times"></i>', [
                                                'type' => 'submit',
                                                'class' => 'link-button fg-red',
                                                'data-prevent' => '',
                                            ])
                                        !!}

                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        <a href="{{ route('lessons.show', $lesson->id) }}"
                                           target="_blank">
                                            <i class="fa fa-file-text-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div><!-- /.box-body -->
                <div class="box-footer" style="text-align: center">
                    {!! $lessons->render() !!}
                </div>
            </div>
        </div>


        {{-- Exercises --}}
        <div class="col-lg-6">
            <div class="box ">

                <div class="box-header with-border">
                    <h3 class="box-title"> {{ trans('strings.exercises') }} </h3>
                    <a href="{{ route('admin.exercises.create', [$course->id]) }}" class="btn btn-success pull-right">
                        {{ trans('strings.add') }}
                        &nbsp;
                        <i class="fa fa-plus"></i>
                    </a>
                </div>

                <div class="box-body">
                    @if ($exercises->isEmpty())
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i>
                            {{ trans('strings.thereAreNoExercises')  }}
                        </div>
                    @else
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th class="td-small"> # </th>
                                <th> {{ trans('strings.name') }} </th>
                                <td> {{ trans('strings.theDate') }} </td>
                                <th style="width: 40px"> {{ trans('strings.difficulty') }} </th>
                                <th class="td-small"></th>
                                <th class="td-small"></th>
                                <th class="td-small"></th>
                                <th class="td-small"></th>
                            </tr>

                            @foreach($exercises as $exercise)
                                <tr>
                                    <td class="center">
                                        {{ $exercise->id }}
                                    </td>
                                    <td> {{ $exercise->name }} </td>
                                    <td title="{{ $exercise->created_at }}"
                                        class="nowrap">
                                         {{--{{ $exercise->created_at->diffForHumans() }}--}}
                                    </td>
                                    <td>
                                        @if ($exercise->difficulty == 'easy')
                                            <span class="badge bg-green col-lg-12">
                                                {{ trans("strings.$exercise->difficulty") }}
                                            </span>
                                        @elseif ($exercise->difficulty == 'medium')
                                            <span class="badge bg-orange col-lg-12">
                                                {{ trans("strings.$exercise->difficulty") }}
                                            </span>
                                        @else
                                            <span class="badge bg-red col-lg-12">
                                                {{ trans("strings.$exercise->difficulty") }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.exercises.edit', [$exercise->id]) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @if ($exercise->youtube_id)
                                            <i class="fa fa-youtube-play text-red"></i>
                                        @else
                                            <i class="fa fa-youtube-play text-gray"></i>
                                        @endif
                                    </td>
                                    <td>
                                        {!! Form::open([
                                            'method' => 'delete',
                                            'url' => route("exercises.destroy", [$exercise->id])
                                        ]) !!}

                                        {!!
                                            Form::button('<i class="fa fa-times"></i>', [
                                                'type' => 'submit',
                                                'class' => 'link-button fg-red',
                                                'data-prevent' => ''
                                            ])
                                        !!}

                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        <a href="{{ route('exercises.show', $exercise->id) }}"
                                           target="_blank">
                                            <i class="fa fa-file-text-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @endif
                </div><!-- /.box-body -->
                <div class="box-footer clearfix" style="text-align: center">
                    {!! $exercises->render() !!}
                </div>
            </div>
        </div>
    </div>

@endsection