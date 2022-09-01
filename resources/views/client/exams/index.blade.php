@extends('client.courses.base')

@section('course.sidebar')

@endsection

@section('course.content')

    <h1 class="sidebar-title" style="margin: 0px auto 40px auto">
        <a href="{{ route('subjects.show', $course->subject->id) }}">
            <small class="text-blue">
                <i class="fa fa-arrow-right"></i>
                {{ $course->subject->name }}
            </small>
        </a>
        <br>
        {{ $course->name }}
    </h1>

    @include('client.partials.exam-title-bar', [
           'url' => '#',
           'count' => $exams->count(),
           'title' => trans('strings.theExams'),
        ])

    @if ($exams->isEmpty())
        <div class="callout primary">
            <i class="fa fa-info-circle"></i> &nbsp;
            {{ trans('strings.thereAreNoExams') }}
        </div>
    @else
        <table>
            <tr class="text-bold">
                <td></td>
                <td style="width: 1%">{{ trans('strings.theExam') }}</td>
                <td style="width: 1%">{{ trans('strings.theCorrection') }}</td>
            </tr>
            @foreach($exams as $exam)
                <tr>
                    <td> {{ $exam->description }} </td>
                    <td class="center text-dark-blue">
                        <a href="/storage/exams/exams/{{ $exam->id }}.pdf"
                           target="_blank">
                            <i class="fa fa-file-pdf-o"></i>
                        </a>
                    </td>
                    <td class="center text-dark-blue">
                        @if($exam->hasCorrection())
                            <a href="/storage/exams/corrections/{{ $exam->id }}.pdf"
                               target="_blank">
                                <i class="fa fa-file-pdf-o"></i>
                            </a>
                        @else
                            <i class="fa fa-times"></i>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
    <div class="center">
        {!! $exams->render() !!}
    </div>
@endsection


