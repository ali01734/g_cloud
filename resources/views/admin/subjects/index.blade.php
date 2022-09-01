@extends('admin.base')

@section('content-header-title')
    <i class="fa fa-book"></i> &nbsp;
    {{ trans('strings.subjectList') }}
@endsection

@section('bread-crumbs')
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <div>
                <a href="/admin/subjects/create" class="btn btn-primary pull-right">
                    <i class="fa fa-plus"></i>
                    {{ trans('strings.add') }}
                </a>
            </div>
        </div>

        <div class="box-body no-padding">
            <table class="table">
                @foreach($subjects as $subject)
                    <tr>
                        <td style="background: {{$subject->color}}"></td>
                        <td style="width: 64px">
                            <img src="{{$subject->icon}}" style="width: 100%">
                        </td>
                        <td style="vertical-align: middle; font-size: 1.5em">
                            {{$subject->name}}
                        </td>
                        <td>
                            <a class="text-blue text-bold"
                               href="{{ route('admin.subjects.show', $subject->id) }}">
                                {{ trans('strings.theCourses') }}
                                &nbsp;
                                <i class="fa fa-book"></i>
                            </a>
                        </td>
                        <td>
                            <a class="text-blue text-bold"
                               href="{{ route('admin.exams.index', $subject->id) }}">
                                {{ trans('strings.theExams') }}
                                &nbsp;
                                <i class="fa fa-files-o"></i>
                            </a>
                        </td>
                        <td>
                            <a class="text-blue text-bold"
                               href="{{ route('admin.bacs.index', $subject->id) }}">
                                {{ trans('strings.bac') }}
                                &nbsp;
                                <i class="fa fa-star"></i>
                            </a>
                        </td>
                        <td class="center td-small">
                            {!!
                                Form::open([
                                    'method' => 'delete',
                                    'route' => ['subjects.destroy', $subject->id],
                                ])
                            !!}
                            <button type="submit"
                                    class="link-button text-large text-red"
                                    data-prevent>
                                <i class="fa fa-times"></i>
                            </button>
                            {!! Form::close() !!}
                        </td>
                        <td class="center td-small">
                            <a
                                href="{{ route('admin.subjects.edit', $subject->id) }}"
                                class="text-large"
                            >
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
@endsection