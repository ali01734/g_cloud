@extends('admin.base')

@section('content-header-title')
    <i class="fa fa-graduation-cap"></i>
    {{ trans('strings.theLevels') }}

    <div class="pull-right">
        <a href=""
           class="btn btn-success"
           data-toggle="modal"
           data-target="#create-modal">
            {{ trans('strings.add') }} &nbsp;
            <i class="fa fa-plus"></i>
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        @foreach($levels as $level)
            <div class="col-sm-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-graduation-cap"></i>
                            {{ $level->name }}
                        </h3>

                        <div class="pull-right">
                            <a href="#"
                               data-toggle="modal"
                               data-target="#addBranchModal{{ $level->id }}"
                               class="text-green flip-btn">
                                <i class="fa fa-plus"></i>
                            </a>
                            &nbsp;
                            @include('admin.partials.btn-form', [
                                'method' => 'delete',
                                'fa' => 'fa-trash',
                                'url' => route('levels.destroy', $level->id),
                                'prevent' => true,
                            ])
                            &nbsp;
                            <a href="#"
                               data-toggle="modal"
                               data-target="#edit-modal-{{ $level->id }}"
                               class="text-orange flip-btn">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        @foreach($level->branches as $branch)
                            <span class="label label-primary margin-left-5 margin-bottom-5" style="font-size: 1em;">
                                {{ $branch->name }}
                                &nbsp;
                                <div style="display: inline-block">
                                    {!! Form::open(['url' => route('levels.branches.unlink', [$level->id, $branch->id]), 'method' => 'delete']) !!}
                                    <button type="submit" class="collapsed-link link-button fa fa-times text-red"></button>
                                    {!! Form::close() !!}
                                </div>
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    {{-- Modals--}}
    @foreach($levels as $level)

        @include('admin.levels.partials.update-form', [
            'id' => "edit-modal-$level->id",
            'title' => trans('strings.editALevel'),
            'fa' => 'fa-edit',
            'method' => 'PUT',
            'value' => $level->name,
            'url' => route('levels.update', $level->id),
        ])

        <div class="modal fade" id="addBranchModal{{ $level->id }}" tabindex="-1" role="dialog" aria-labelledby="addBranchModalLabel">
            {!! Form::open(['url' => route('levels.branches.store', $level->id), 'method' => 'post']) !!}
            {!! Form::hidden('redirectTo', route('admin.levels.index')) !!}
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="addBranchModalLabel">
                            {{ trans('strings.addBranch') }}
                        </h4>
                    </div>

                    <div class="modal-body" >
                        <class class="row">
                            <select name="branch" class="form-control">
                                @foreach ($branchesLeft[$level->id] as $branch)
                                    <option value="{{ $branch->id }}">
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </class>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            {{ trans('strings.cancel') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{ trans('strings.basic.ok') }}
                        </button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    @endforeach

    @include('admin.levels.partials.update-form', [
        'id' => 'create-modal',
        'title' => trans('strings.addALevel'),
        'fa' => 'fa-plus-circle',
        'method' => 'POST',
        'url' => route('levels.store')
    ])

@endsection