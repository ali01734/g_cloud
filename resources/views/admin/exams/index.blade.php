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
        <div class="box-header">
            <h3 class="box-title">
                <i class="fa fa-files-o"></i>
                {{ trans('strings.theExams') }}
                <div class="badge"> {{ $exams->total() }} </div>
            </h3>

            <div class="pull-right">
                <a href="{{ route('admin.exams.create', $subject->id) }}"
                   class="btn btn-primary">
                    {{ trans('strings.add') }}
                    &nbsp;
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tr class="text-bold">
                    <td class="td-small"> # </td>
                    <td> {{ trans('strings.theCourses') }} </td>
                    <td> {{ trans('strings.theBranches') }} </td>
                    <td> </td>
                    <td class="td-small">
                        {{ trans('strings.theExam') }}
                    </td>
                    <td class="td-small">
                        {{ trans('strings.theCorrection') }}
                    </td>
                    <td class="td-small"></td>
                    <td class="td-small"></td>
                </tr>
                @foreach($exams as $exam)
                    <tr>
                        <td>
                            <a href="#"> {{ $exam->id }} </a>
                        </td>
                        <td>
                            @foreach($exam->courses as $course)
                                <a href="{{ route('admin.courses.show', $course->id) }}"
                                   class="label label-success">
                                    <i class="fa fa-book"></i> &nbsp;
                                    {{ $course->name }}
                                </a>
                                &nbsp;
                            @endforeach
                        </td>
                        <td>
                            @foreach($exam->branches as $branch)
                                <div class="label label-primary"> {{ $branch->name }} </div> &nbsp;
                            @endforeach
                        </td>
                        <td title="{{ $exam->created_at }}">
                            {{ $exam->created_at }}
                        </td>
                        <td class="center">
                            <a href="/storage/exams/exams/{{ $exam->id }}.pdf"
                               target="_blank">
                                <i class="fa fa-file-pdf-o"></i>
                            </a>
                        </td>
                        <td class="center">
                            @if ($exam->hasCorrection())
                                <a href="/storage/exams/corrections/{{ $exam->id }}.pdf"
                                   target="_blank">
                                    <i class="fa fa-file-pdf-o"></i>
                                </a>
                            @else
                                <i class="fa fa-times text-gray"></i>
                            @endif
                        </td>
                        <td>
                            @include('admin.partials.btn-form', [
                                'url' => route('exams.delete', $exam->id),
                                'method' => 'DELETE',
                                'fa' => 'fa-trash',
                                'prevent' => true,
                            ])
                        </td>
                        <td>
                            <a href="{{ route('admin.exams.edit', $exam->id) }}">
                                <i class="fa fa-pencil text-blue"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                {!! $exams->render() !!}
            </div>
        </div>
    </div>
@endsection