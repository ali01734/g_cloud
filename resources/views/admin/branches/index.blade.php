@extends('admin.base')

@section('content-header-title')
    <i class="fa fa-code-fork"></i>
    {{ trans('strings.theBranches') }}
@endsection

@section('content')
    @include('admin.branches.partials.modal', [
        'id' => 'create-modal',
        'title' => trans('strings.addABranch'),
        'fa' => 'fa-plus-circle',
        'url' => route('branches.store'),
        'method' => 'post',
    ])

    <div class="box">
        <div class="box-header">
            <span class="text-bold text-blue">
                <i class="fa fa-code-fork"></i>
                {{ trans('strings.theBranches') }}
            </span>
            <div class="pull-right">
                <a href=""
                   data-toggle="modal"
                   data-target="#create-modal"
                   class="btn btn-success">
                    {{ trans('strings.add') }}
                    &nbsp; <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered">
                <tr class="text-bold">
                    <td class="td-small">#</td>
                    <td> {{ trans('strings.name') }} </td>
                    <td> {{ trans('strings.firstYear') }}</td>
                    <td> {{ trans('strings.secondYear') }}</td>
                    <td class="td-small"></td>
                    <td class="td-small"></td>
                </tr>
                @foreach($branches as $branch)
                    <tr>
                        <td> {{ $branch->id }} </td>
                        <td> {{ $branch->name }} </td>
                        <td>
                            @if($branch->first_year)
                                <i class="fa fa-check text-green"></i>
                            @else
                                <i class="fa fa-times text-gray"></i>
                            @endif
                        </td>
                        <td>
                            @if($branch->second_year)
                                <i class="fa fa-check text-green"></i>
                            @else
                                <i class="fa fa-times text-gray"></i>
                            @endif
                        </td>
                        <td>
                            <a href=""
                               data-toggle="modal"
                               data-target="#edit-modal-{{ $branch->id }}">
                                <i class="fa fa-pencil"></i>
                            </a>

                            {{-- Edit modal --}}
                            @include('admin.branches.partials.modal', [
                                'id' => "edit-modal-$branch->id",
                                'title' => trans('strings.editABranch'),
                                'fa' => 'fa-edit',
                                'url' => route('branches.update', $branch->id),
                                'method' => 'PUT',
                                'branch' => $branch,
                            ])
                        </td>
                        <td>
                            @include('admin.partials.btn-form', [
                                'fa' => 'fa-trash',
                                'url' => route('branches.destroy', $branch->id),
                                'method' => 'DELETE',
                                'prevent' => 'true'
                            ])
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>


@endsection