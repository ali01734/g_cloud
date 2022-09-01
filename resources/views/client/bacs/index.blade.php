@extends('client.base')

@section('content')
    <div class="small-12 column align-center bg-white expanded">
        <div class="row  expanded padding-40 padding-lr-60">
            <h1 class="sidebar-title column small-12">
                <a href="{{ route('subjects.show', $subject->id) }}">
                    <small class="text-blue">
                        <i class="fa fa-arrow-right"></i>
                        {{ $subject->name }}
                    </small>
                </a>
            </h1>
            <div class="column small-12">
                @include('client.partials.exam-title-bar', [
                    'title' => trans("strings.bac_index_title_$type"),
                    'count' => $bacs->count(),
                    'url' => '#',
                ])
            </div>
            <div class="column small-12">
                @if($bacs->isEmpty())
                    <div class="callout primary">
                        <i class="fa fa-info-circle"></i>
                        &nbsp;
                        {{ trans('strings.thereAreNoBacs') }}
                    </div>
                @else
                    <table>
                        <thead>
                            <tr class="text-bold">
                                <td>
                                    <strong> {{ trans('strings.academicYear') }} </strong>
                                </td>
                                @if(empty($type))
                                    <td> {{ trans('strings.' . (empty($type) ? 'theSemester' : 'theRegion')) }}</td>
                                @endif
                                <td style="width: 1%"> {{ trans('strings.theExam') }} </td>
                                <td style="width: 1%"> {{ trans('strings.theCorrection') }} </td>
                            </tr>
                        </thead>
                        <tbody
                            id="bacs-table-view"
                            data-onchange-url="{{ route('api.bacs.index', [$subject, $type]) }}"
                            data-onchange-template="bacs-table-template"
                            data-onchange-inputs="region-select branch-select"
                        >
                        <tr>
                            <td colspan="4">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <div class="row expanded align-center ">
            <div class="columns medium-8">
                @include('client.comments.index')
            </div>
        </div>
    </div>

    <script id="bacs-table-template" type="text/x-handlebars-template">
        @{{#each bacs }}
            <tr class="fadeIn">
                <td> @{{ year }} </td>
                <td>
                    @{{ ar_type }}
                </td>
                <td class="center">
                    @{{#if has_exam  }}
                        <a href="@{{ exam_url }}" target="_blank" class="text-blue">
                            <i class="fa fa-file-pdf-o"></i>
                        </a>
                    @{{^}}
                        <i class="fa fa-times"></i>
                    @{{/if }}
                </td>
                <td class="center">
                    @{{#if has_correction  }}
                        <a href="@{{ correction_url }}" target="_blank" class="text-blue">
                            <i class="fa fa-file-pdf-o"></i>
                        </a>
                    @{{^}}
                        <i class="fa fa-times"></i>
                    @{{/if }}
                </td>
            </tr>
        @{{/each}}
    </script>
@endsection