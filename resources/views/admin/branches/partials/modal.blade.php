@extends('admin.modal')

{{--@section('modal.id', $id)--}}
@section('modal.id'){{ $id }}@overwrite
@section('modal.title'){{ $title }}@overwrite
@section('modal.fa'){{ $fa }}@overwrite
@section('modal.form.url'){{ $url }}@overwrite
@section('modal.form.method'){{ $method == 'PUT' || $method == 'DELETE' ? 'POST' : $method }}@overwrite
@section('modal.form.method-field'){{ method_field($method) }}@overwrite

@section('modal.body')
    <div class="form-group">
        <label> {{ trans('strings.name') }} </label>
        <input type="text"
               name="name"
               value="{{ isset($branch) ? $branch->name : '' }}"
               required
               class="form-control">
    </div>
    <div class="form-group">
        <label class="checkbox">
            <input type="hidden"
                   name="first_year"
                   value="0">
            <input type="checkbox"
                   name="first_year"
                   value="1"
                   {{ isset($branch) && $branch->first_year ? 'checked': ''  }}>

            {{ trans('strings.firstYear') }}
        </label>
    </div>
    <div class="form-group">
        <label class="checkbox">
            <input type="hidden"
                   name="second_year"
                   value="0">
            <input type="checkbox"
                   name="second_year"
                   value="1"
                   {{ isset($branch) && $branch->second_year ? 'checked': ''  }}>
            {{ trans('strings.secondYear') }}
        </label>
    </div>
@overwrite