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
            <i class="fa fa-star"></i>
            &nbsp;
            {{ trans('strings.bacExams')  }}
            <div class="badge">
                {{ $bacs->total() }}
            </div>


            <div class="pull-right" style="display: inline-block">
                {!!
                    Form::open([
                        'url' => '#',
                        'method' =>'get',
                        'class' => 'form-inline',
                    ])
                !!}
                    <div class="form-group">
                        <select name="branch"
                                class="form-control">
                            <option value="">
                                {{ trans('strings.allBacTypes') }}
                            </option>
                            @foreach($types as $t)
                                <option value="{{ $t }}">
                                    {{ trans("strings.$t") }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-search"></i>
                    </button>

                    {{-- Add Button --}}
                    &nbsp;
                    <a href="{{ route('admin.bacs.create', $subject->id) }}"
                       class="btn btn-primary"
                       id="create-button">
                        {{ trans('strings.add') }}
                        &nbsp;
                        <i class="fa fa-plus"></i>
                    </a>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="box-body">
            @if($bacs->isEmpty())
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i>
                    &nbsp;
                    {{ trans('strings.thereAreNoBacs') }}
                </div>
            @else
                <table class="table table-bordered">
                    <tr class="text-bold">
                        <td class="td-small"> # </td>
                        <td> {{trans('strings.academicYear')}} </td>
                        <td> {{trans('strings.theBranches')}} </td>
                        <td></td>
                        <td class="td-small"> {{ trans('strings.theExam') }} </td>
                        <td class="td-small"> {{ trans('strings.theCorrection') }} </td>
                        <td> {{ trans('strings.theRegion') }} </td>
                        <td class="td-small"></td>
                        <td class="td-small"></td>
                    </tr>
                    @foreach($bacs as $bac)
                        <tr>
                            <td>
                                {{ $bac->id }}
                            </td>
                            <td>
                                {{ $bac->year - 1 }} &dash;
                                {{ $bac->year }}
                            </td>
                            <td>
                                {{-- Branch group --}}
                                @foreach($bac->branches as $b)
                                   <div class="label label-primary item-label">
                                       {{ $b->name }}
                                   </div>
                                @endforeach
                            </td>
                            <td>
                                {{-- The type --}}
                                {{ trans("strings.$bac->type") }}
                            </td>
                            <td class="center">
                                @if($bac->hasExam())
                                    <a target="_blank" href="{{ $bac->getUrl() }}">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                @else
                                    <i class="fa fa-times text-gray"></i>
                                @endif
                            </td>
                            <td class="center">
                                @if($bac->hasCorrection())
                                    <a href="{{ $bac->getCorrectionUrl() }}"
                                       target="_blank" >
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                @else
                                    <i class="fa fa-times text-gray"></i>
                                @endif
                            </td>
                            <td>
                                {{ $bac->region ? trans("strings.region$bac->region") : '-' }}
                            </td>
                            <td>
                                <a href="{{ route('admin.bacs.edit', $bac->id) }}" name="edit-link">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                            <td class="center">
                                {!!
                                    Form::open([
                                        'method' => 'DELETE',
                                        'url' => route('bacs.destroy', $bac->id)
                                    ])
                                !!}
                                    <button class="link-button text-red"
                                            type="submit"
                                            data-prevent>
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
        <div class="box-footer">
            <div class="pull-right">
                {{ $bacs->render() }}
            </div>
        </div>
    </div>
@endsection