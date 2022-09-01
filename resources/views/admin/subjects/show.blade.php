@extends('admin.base')

@section('content-header-title')
    {{ $subject->name }}
    <a href="{{ route('admin.subjects.index') }}"
       class="btn btn-warning pull-right">
        {{ trans('strings.subjectList') }}
        &nbsp;
        <i class="fa fa-level-up"></i>
    </a>
@endsection


@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-book"></i>&nbsp;
                {{ trans('strings.theCourses') }}
            </h3>
            <div class="pull-right">
                <form action="{{ route('admin.subjects.show', ['id' => $subject->id]) }}"
                      class="form form-inline"
                      method="get">
                    <a href="{{ route('admin.courses.create', ['id' => $subject->id ]) }}"
                       class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                        {{ trans('strings.add') }}
                    </a>
                    &nbsp;

                    <div class="form-group">
                        <select name="per_page" class="form-control">
                            @for($i = 10; $i <= 100; $i += 10)
                                <option value="{{$i}}"
                                        @if($perPage == $i) selected @endif>
                                    {{$i}}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="level" class="form-control">
                            <option value> {{ trans('strings.all') }} </option>
                            @foreach($levels as $level)
                                <option
                                    value="{{ $level->id }}"
                                    @if($selectedLevel == $level->id) selected @endif
                                >
                                    {{ $level->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="branch" class="form-control">
                            <option value> {{ trans('strings.all') }} </option>
                            @foreach($branches as $branch)
                                <option
                                    value="{{ $branch->id }}"
                                    @if($selectedBranch == $branch->id) selected @endif
                                >
                                    {{ $branch->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>

                </form>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th class="td-small"> # </th>
                    <th> {{ trans('strings.name') }} </th>
                    <th> {{ trans('strings.theLevel') }} </th>
                    <th> {{ trans('strings.theBranches') }}</th>
                    <th class="td-small"></th>
                    <th class="td-small"></th>
                </tr>
                @foreach($courses as $course)
                    <tr>
                        <td> {{ $course->id }} </td>
                        <td>
                            <a href="{{ route('admin.courses.show', ['id' => $course->id]) }}">
                                {{ $course->name }}
                            </a>
                        </td>
                        <td> {{ $course->level->name or trans('strings.without') }} </td>
                        <td style="line-height: 2.3em">
                            @foreach($course->branches as $key => $branch)
                                <div class="label label-default">
                                    {{ $branch->name }}
                                </div> &nbsp;
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.courses.edit', ['id' => $course->id]) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td>
                        <td>
                            @include('admin.partials.btn-form', [
                                'url' => route('courses.destroy', $course->id),
                                'method' => 'DELETE',
                                'fa' => 'fa-trash',
                                'prevent' => true,
                            ])
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <form action="" class="form form-inline" method="get">
                    <div style="display: inline-block;">
                        {!! $courses->render() !!}
                    </div>
                </form>

            </div>

        </div>
    </div>
@endsection